<?php

namespace App\Http\Controllers\Pembeli;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PembeliTransaksiController extends Controller
{
    public function index(): View
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $transaksiList = Transaksi::with(['pesanan.detailPesanan.produk'])
            ->whereHas('pesanan', function ($query) use ($user) {
                $query->where('id_user', $user->id_user);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        $transaksiBerjalan = $transaksiList->filter(fn ($t) => $t->status_pembayaran === 'menunggu');
        $riwayatTransaksi = $transaksiList->filter(fn ($t) => in_array($t->status_pembayaran, ['berhasil', 'gagal']));

        $totalBerhasil = $riwayatTransaksi->where('status_pembayaran', 'berhasil')->count();
        $totalMenunggu = $transaksiBerjalan->count();
        $totalDibatalkan = $riwayatTransaksi->where('status_pembayaran', 'gagal')->count();

        $transaksiKonfirmasi = $transaksiBerjalan->firstWhere('metode_pembayaran', '!=', 'cod');

        return view('pages.pembeli.pembeli_transaksi', compact(
            'transaksiBerjalan', 'riwayatTransaksi',
            'totalBerhasil', 'totalMenunggu', 'totalDibatalkan', 'transaksiKonfirmasi'
        ));
    }

    /**
     * Upload bukti pembayaran — hanya transfer bank / e-wallet, bukan COD.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'id_transaksi' => ['required', 'exists:transaksi,id_transaksi'],
            'nama_pemilik' => ['required', 'string', 'max:100'],
            'bukti_pembayaran' => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'],
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        $transaksi = Transaksi::with('pesanan')
            ->where('id_transaksi', $validated['id_transaksi'])
            ->whereHas('pesanan', fn ($q) => $q->where('id_user', $user->id_user))
            ->firstOrFail();

        // ✅ COD tidak perlu bukti bayar
        if ($transaksi->metode_pembayaran === 'cod') {
            return back()->withErrors(['bukti_pembayaran' => 'Pesanan COD tidak memerlukan bukti pembayaran.']);
        }

        // ✅ Hanya bisa upload selama masih menunggu verifikasi
        if ($transaksi->status_pembayaran !== 'menunggu') {
            return back()->withErrors(['bukti_pembayaran' => 'Transaksi ini sudah diproses, bukti tidak dapat diunggah lagi.']);
        }

        $path = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');

        $transaksi->update([
            'bukti_pembayaran' => $path,
            'status_pembayaran' => 'menunggu', // tetap menunggu verifikasi admin
        ]);

        return redirect()->route('pembeli.transaksi.show', $transaksi->id_transaksi)
            ->with('success', 'Bukti pembayaran berhasil dikirim. Menunggu verifikasi admin.');
    }

    public function show(int $id): View
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $transaksi = Transaksi::with(['pesanan.detailPesanan.produk'])
            ->where('id_transaksi', $id)
            ->whereHas('pesanan', fn ($q) => $q->where('id_user', $user->id_user))
            ->firstOrFail();

        return view('pages.pembeli.pembeli_detail_transaksi', compact('transaksi'));
    }
}