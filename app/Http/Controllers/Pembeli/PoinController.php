<?php

namespace App\Http\Controllers\Pembeli;

use App\Http\Controllers\Controller;
use App\Models\PenukaranHadiah;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Hadiah;
use App\Models\KodeRedeem;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PoinController extends Controller
{
    /**
     * Tampilkan halaman poin dan loyalitas
     */
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // ✅ AMBIL SEMUA HADIAH DARI DATABASE (bukan cuma 1)
        $hadiahList = Hadiah::with('produk')
            ->orderBy('poin_dibutuhkan', 'asc')
            ->get();

        $currentPoin = (int) $user->total_poin;

        // Target progress bar = hadiah termurah (fallback 70 kalau belum ada hadiah)
        $targetPoin = (int) ($hadiahList->min('poin_dibutuhkan') ?? 70);
        $progressPercentage = min(100, ($currentPoin / $targetPoin) * 100);
        $kurangPoin = max(0, $targetPoin - $currentPoin);

        // ✅ AMBIL RIWAYAT DARI TABEL penukaran_hadiah
        $riwayatPoin = PenukaranHadiah::with('hadiah.produk')
            ->where('id_user', $user->id_user)
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get()
            ->map(function ($penukaran) {
                return [
                    'tanggal' => $penukaran->created_at,
                    'keterangan' => 'Klaim ' . ($penukaran->hadiah->produk->nama_produk ?? 'Hadiah Refill'),
                    'status' => match ($penukaran->status_klaim) {
                        'pending' => 'Menunggu Persetujuan',
                        'disetujui' => 'Disetujui',
                        'ditolak' => 'Ditolak',
                        default => $penukaran->status_klaim,
                    },
                    'poin' => -$penukaran->poin_ditukar, // Negatif karena poin keluar
                    'catatan' => $penukaran->catatan,
                    'tipe' => 'klaim_hadiah',
                ];
            });

        $membershipStatus = $this->getMembershipStatus($currentPoin);

        return view('pages.pembeli.poin', compact(
            'user',
            'currentPoin',
            'targetPoin',
            'progressPercentage',
            'kurangPoin',
            'membershipStatus',
            'riwayatPoin',
            'hadiahList' // ✅ INI YANG BARU
        ));
    }


    /**
     * Helper: Tentukan status keanggotaan
     */
    private function getMembershipStatus($poin)
    {
        if ($poin >= 200) {
            return ['label' => 'Pelanggan Setia NusaCandle', 'color' => 'text-purple-700', 'bg' => 'bg-purple-100'];
        } elseif ($poin >= 100) {
            return ['label' => 'Sahabat Nusa Gold', 'color' => 'text-yellow-700', 'bg' => 'bg-yellow-100'];
        } elseif ($poin >= 50) {
            return ['label' => 'Sahabat Nusa Silver', 'color' => 'text-gray-700', 'bg' => 'bg-gray-100'];
        }
        return ['label' => 'Pelanggan NusaCandle', 'color' => 'text-green-700', 'bg' => 'bg-green-100'];
    }

    /**
     * Klaim hadiah yang DIPILIH pembeli (tukar poin sesuai harga hadiahnya)
     */
    /**
     * Klaim hadiah yang DIPILIH pembeli (tukar poin sesuai harga hadiahnya)
     */
    public function claimHadiah(Request $request)
    {
        $validated = $request->validate([
            'id_hadiah' => ['required', 'integer', 'exists:hadiah,id_hadiah'],
            'catatan' => ['nullable', 'string', 'max:500'],
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        $hadiah = Hadiah::with('produk')->findOrFail($validated['id_hadiah']);
        $biayaPoin = (int) $hadiah->poin_dibutuhkan;

        if ((int) $user->total_poin < $biayaPoin) {
            return back()->withErrors(['claim' => "Poin Anda belum mencukupi. Hadiah ini butuh {$biayaPoin} poin."]);
        }

        // ✅ CEK STOK: nggak bisa klaim kalau stok produk hadiahnya habis
        if (!$hadiah->produk || (int) $hadiah->produk->stok < 1) {
            return back()->withErrors(['claim' => 'Stok hadiah ini sedang habis.']);
        }

        DB::beginTransaction();
        try {
            PenukaranHadiah::create([
                'id_user' => $user->id_user,
                'id_hadiah' => $hadiah->id_hadiah,
                'poin_ditukar' => $biayaPoin,
                'poin_saat_klaim' => (int) $user->total_poin,
                'status_klaim' => 'pending',
                'catatan' => $validated['catatan'] ?? null,
            ]);

            // Kurangi poin user
            $user->decrement('total_poin', $biayaPoin);

            // ✅ KURANGI STOK PRODUK HADIAH (1 pcs per klaim)
            $hadiah->produk->decrement('stok');

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['claim' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }

        $namaHadiah = $hadiah->produk->nama_produk ?? 'Hadiah';

        return back()->with('success', "Klaim \"{$namaHadiah}\" berhasil! Menunggu persetujuan admin. {$biayaPoin} poin telah dikurangi.");
    }

    /**
     * Proses redeem kode untuk dapat poin
     */
    public function redeem(Request $request): \Illuminate\Http\RedirectResponse
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $validated = $request->validate([
            'kode_redeem' => ['required', 'string', 'max:32'],
        ]);

        // Cari kode redeem di database (status masih 'tersedia')
        $kodeRedeem = KodeRedeem::where('kode', strtoupper(trim($validated['kode_redeem'])))
            ->where('status', 'tersedia')
            ->first();

        // Validasi: kode tidak ditemukan atau sudah terpakai
        if (!$kodeRedeem) {
            return back()->withErrors(['redeem' => 'Kode redeem tidak valid atau sudah digunakan.']);
        }

        // Validasi: kode kadaluarsa
        if ($kodeRedeem->berlaku_hingga && Carbon::parse($kodeRedeem->berlaku_hingga)->isPast()) {
            return back()->withErrors(['redeem' => 'Kode redeem sudah kadaluarsa.']);
        }

        // Tambahkan poin ke user
        $user->increment('total_poin', $kodeRedeem->poin);

        // ✅ Update status + CATAT SIAPA YANG MEMAKAI
        $kodeRedeem->update([
            'status' => 'terpakai',
            'id_user' => $user->id_user,        // ← INI YANG KURANG!
            'dipakai_pada' => now(),
        ]);

        return back()->with('success', "Berhasil! {$kodeRedeem->poin} poin telah ditambahkan ke akun Anda.");
    }
}
