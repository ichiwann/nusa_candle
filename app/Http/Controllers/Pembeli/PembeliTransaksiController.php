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

        // Ambil semua transaksi user dengan relasi pesanan
        $transaksiList = Transaksi::with(['pesanan.detailPesanan.produk'])
            ->whereHas('pesanan', function ($query) use ($user) {
                $query->where('id_user', $user->id_user);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        // Pisahkan transaksi berjalan (menunggu) dan riwayat
        $transaksiBerjalan = $transaksiList->filter(function ($t) {
            return $t->status_pembayaran === 'menunggu';
        });

        $riwayatTransaksi = $transaksiList->filter(function ($t) {
            return in_array($t->status_pembayaran, ['berhasil', 'gagal']);
        });

        // Hitung statistik
        $totalBerhasil = $riwayatTransaksi->where('status_pembayaran', 'berhasil')->count();
        $totalMenunggu = $transaksiBerjalan->count();
        $totalDibatalkan = $riwayatTransaksi->where('status_pembayaran', 'gagal')->count();

        // Ambil transaksi pertama yang menunggu untuk form konfirmasi
        $transaksiKonfirmasi = $transaksiBerjalan->first();

        return view('pages.pembeli.pembeli_transaksi', compact(
            'transaksiBerjalan',
            'riwayatTransaksi',
            'totalBerhasil',
            'totalMenunggu',
            'totalDibatalkan',
            'transaksiKonfirmasi'
        ));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'id_transaksi' => ['required', 'exists:transaksi,id_transaksi'],
            'nama_pemilik' => ['required', 'string', 'max:100'],
            'bukti_pembayaran' => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'], // Max 5MB
        ]);

        $transaksi = Transaksi::findOrFail($validated['id_transaksi']);

        // Pastikan transaksi milik user yang login
        $transaksi->load('pesanan');
        if ($transaksi->pesanan->id_user !== Auth::id()) {
            return back()->withErrors(['id_transaksi' => 'Transaksi tidak ditemukan.']);
        }

        // Upload bukti pembayaran
        if ($request->hasFile('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran');
            $path = $file->store('bukti_pembayaran', 'public');
            $transaksi->update([
                'bukti_pembayaran' => $path,
                'status_pembayaran' => 'menunggu',
            ]);
        }

        return back()->with('success', 'Bukti pembayaran berhasil dikirim. Menunggu verifikasi admin.');
    }

    public function show(int $id): View
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $transaksi = Transaksi::with(['pesanan.detailPesanan.produk'])
            ->where('id_transaksi', $id)
            ->whereHas('pesanan', function ($query) use ($user) {
                $query->where('id_user', $user->id_user);
            })
            ->firstOrFail();

        return view('pages.pembeli.pembeli_transaksi_detail', compact('transaksi'));
    }
}
