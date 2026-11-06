<?php

namespace App\Http\Controllers\Pembeli;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pesanan;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PembeliPesananController extends Controller
{
    public function index(Request $request): View
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $query = Pesanan::with(['detailPesanan.produk'])
            ->where('id_user', $user->id_user);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('id_pesanan', 'like', "%{$search}%");
        }

        $semuaPesanan = $query->orderBy('created_at', 'desc')->get();

        // Pisahkan pesanan aktif dan riwayat
        $pesananAktif = $semuaPesanan->filter(function ($p) {
            return !in_array($p->status_pesanan, ['selesai', 'dibatalkan']);
        });

        $riwayatPesanan = $semuaPesanan->filter(function ($p) {
            return $p->status_pesanan === 'selesai';
        });

        return view('pages.pembeli.pembeli_pesanan', compact(
            'pesananAktif',
            'riwayatPesanan'
        ));
    }

    public function show(int $id): View
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $pesanan = Pesanan::with(['detailPesanan.produk', 'transaksi'])
            ->where('id_pesanan', $id)
            ->where('id_user', $user->id_user)
            ->firstOrFail();

        return view('pages.pembeli.pembeli_pesanan_detail', compact('pesanan'));
    }

    public function reorder(int $id): \Illuminate\Http\RedirectResponse
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $pesanan = Pesanan::with('detailPesanan')
            ->where('id_pesanan', $id)
            ->where('id_user', $user->id_user)
            ->firstOrFail();

        // Tambahkan semua item dari pesanan lama ke keranjang
        foreach ($pesanan->detailPesanan as $detail) {
            $existing = \App\Models\Keranjang::where('id_user', $user->id_user)
                ->where('id_produk', $detail->id_produk)
                ->first();

            if ($existing) {
                $existing->increment('jumlah', $detail->jumlah);
            } else {
                \App\Models\Keranjang::create([
                    'id_user' => $user->id_user,
                    'id_produk' => $detail->id_produk,
                    'jumlah' => $detail->jumlah,
                ]);
            }
        }

        return redirect()->route('keranjang.index')->with('success', 'Produk dari pesanan sebelumnya berhasil ditambahkan ke keranjang.');
    }
}
