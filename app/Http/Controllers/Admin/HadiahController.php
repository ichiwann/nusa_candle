<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Hadiah;
use App\Models\Produk;
use App\Models\PenukaranHadiah;
use Illuminate\View\View;

class HadiahController extends Controller
{
    public function index(): View
    {
        // Statistik
        $totalHadiah = Hadiah::count();
        $totalStokProduk = Produk::sum('stok');

        // Hitung penukaran berdasarkan status
        $penukaranPending = PenukaranHadiah::where('status_klaim', 'pending')->count();
        $penukaranDisetujui = PenukaranHadiah::where('status_klaim', 'disetujui')->count();
        $penukaranDitolak = PenukaranHadiah::where('status_klaim', 'ditolak')->count();
        $totalPenukaran = PenukaranHadiah::count();

        // Daftar hadiah dengan info produk
        $daftarHadiah = Hadiah::with('produk')->orderBy('created_at', 'desc')->get();

        // ✅ DATA PENUKARAN HADIAH (untuk section konfirmasi)
        $daftarPenukaran = PenukaranHadiah::with(['user', 'hadiah.produk'])
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($penukaran) {
                $user = $penukaran->user;
                $poinSekarang = (int) $user->total_poin;
                $poinDitukar = $penukaran->poin_ditukar;

                return [
                    'id_penukaran' => $penukaran->id_penukaran,
                    'nama_user' => $user->nama_lengkap ?? 'Unknown',
                    'username' => $user->username ?? '-',
                    'poin_sekarang' => $poinSekarang,
                    'poin_saat_klaim' => (int) $penukaran->poin_saat_klaim, // ✅ LANGSUNG DARI DB
                    'nama_produk' => $penukaran->hadiah->produk->nama_produk ?? 'Hadiah',
                    'poin_ditukar' => $poinDitukar,
                    'status_klaim' => $penukaran->status_klaim,
                    'catatan' => $penukaran->catatan,
                    'tanggal' => $penukaran->created_at,
                ];
            });

        return view('pages.admin.hadiah', compact(
            'totalHadiah',
            'totalStokProduk',
            'penukaranPending',
            'penukaranDisetujui',
            'penukaranDitolak',
            'totalPenukaran',
            'daftarHadiah',
            'daftarPenukaran'
        ));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'id_produk' => ['required', 'exists:produk,id_produk'],
            'poin_dibutuhkan' => ['required', 'integer', 'min:1'],
        ]);

        $exists = Hadiah::where('id_produk', $validated['id_produk'])->exists();
        if ($exists) {
            return back()->withErrors(['id_produk' => 'Produk ini sudah terdaftar sebagai hadiah.']);
        }

        Hadiah::create($validated);

        return back()->with('success', 'Hadiah berhasil ditambahkan.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $hadiah = Hadiah::findOrFail($id);

        $adaPenukaran = PenukaranHadiah::where('id_hadiah', $id)->exists();
        if ($adaPenukaran) {
            return back()->withErrors(['delete' => 'Tidak bisa menghapus hadiah yang sudah pernah ditukar.']);
        }

        $hadiah->delete();

        return back()->with('success', 'Hadiah berhasil dihapus.');
    }

    /**
     * Approve klaim hadiah
     */
    public function approve(int $id): RedirectResponse
    {
        $penukaran = PenukaranHadiah::findOrFail($id);

        if ($penukaran->status_klaim !== 'pending') {
            return back()->withErrors(['status' => 'Hanya klaim berstatus pending yang bisa diproses.']);
        }

        $penukaran->update(['status_klaim' => 'disetujui']);

        return back()->with('success', 'Klaim hadiah berhasil disetujui. Silakan proses pengiriman hadiah.');
    }

    /**
     * Reject klaim hadiah (kembalikan poin ke user)
     */
    public function reject(Request $request, int $id): RedirectResponse
    {
        $penukaran = PenukaranHadiah::findOrFail($id);

        if ($penukaran->status_klaim !== 'pending') {
            return back()->withErrors(['status' => 'Hanya klaim berstatus pending yang bisa ditolak.']);
        }

        $validated = $request->validate([
            'alasan_tolak' => ['nullable', 'string', 'max:500'],
        ]);

        // Kembalikan poin ke user
        $user = $penukaran->user;
        if ($user) {
            $user->increment('total_poin', $penukaran->poin_ditukar);
        }

        // Update status + simpan alasan di kolom catatan
        $penukaran->update([
            'status_klaim' => 'ditolak',
            'catatan' => ($penukaran->catatan ? $penukaran->catatan . ' | ' : '') . 'Ditolak: ' . ($validated['alasan_tolak'] ?? 'Tidak ada alasan'),
        ]);

        return back()->with('success', 'Klaim hadiah ditolak. Poin user telah dikembalikan.');
    }
}
