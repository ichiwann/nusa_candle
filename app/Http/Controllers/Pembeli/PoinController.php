<?php

namespace App\Http\Controllers\Pembeli;

use App\Http\Controllers\Controller;
use App\Models\PenukaranHadiah;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Hadiah;

class PoinController extends Controller
{
    /**
     * Tampilkan halaman poin dan loyalitas
     */
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $targetPoin = 70;
        $currentPoin = (int) $user->total_poin;
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
            'riwayatPoin'
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
     * Klaim hadiah refill (tukar 70 poin)
     */
    public function claimHadiah(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $targetPoin = 70;

        if ((int) $user->total_poin < $targetPoin) {
            return back()->withErrors(['claim' => 'Poin Anda belum mencukupi untuk klaim hadiah.']);
        }

        // Cari hadiah yang butuh 70 poin di tabel 'hadiah'
        $hadiah = Hadiah::where('poin_dibutuhkan', $targetPoin)->first();

        if (!$hadiah) {
            return back()->withErrors(['claim' => 'Hadiah tidak tersedia di sistem.']);
        }

        // ✅ SIMPAN KE TABEL penukaran_hadiah (Status pending dulu)
        PenukaranHadiah::create([
            'id_user' => $user->id_user,
            'id_hadiah' => $hadiah->id_hadiah,
            'poin_ditukar' => $targetPoin,
            'poin_saat_klaim' => (int) $user->total_poin, // ✅ SNAPSHOT POIN SAAT KLAIM
            'status_klaim' => 'pending',
            'catatan' => $request->catatan ?? null, // Alamat/catatan dari user
        ]);

        // Kurangi poin user
        $user->decrement('total_poin', $targetPoin);

        return back()->with('success', "Klaim hadiah berhasil! Menunggu persetujuan admin. {$targetPoin} poin telah dikurangi.");
    }
}
