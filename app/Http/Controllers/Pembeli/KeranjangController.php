<?php

namespace App\Http\Controllers\Pembeli;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class KeranjangController extends Controller
{
    public function index(): View
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $keranjang = Keranjang::with('produk')
            ->where('id_user', $user->id_user)
            ->get();

        // Hitung total
        $totalHarga = 0;
        $totalItem = 0;
        foreach ($keranjang as $item) {
            $totalHarga += $item->produk->harga * $item->jumlah;
            $totalItem += $item->jumlah;
        }

        $ongkir = 15000;
        $packaging = 5000;
        $totalBelanja = $totalHarga + $ongkir + $packaging;

        return view('pages.pembeli.keranjang', compact(
            'keranjang',
            'totalHarga',
            'totalItem',
            'ongkir',
            'packaging',
            'totalBelanja'
        ));
    }

    public function store(Request $request): RedirectResponse
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $validated = $request->validate([
            'id_produk' => ['required', 'exists:produk,id_produk'],
            'jumlah' => ['required', 'integer', 'min:1'],
        ]);

        $produk = Produk::findOrFail($validated['id_produk']);

        if ($produk->stok < $validated['jumlah']) {
            return back()->withErrors(['jumlah' => 'Stok tidak mencukupi.']);
        }

        // Cek apakah produk sudah ada di keranjang
        $existing = Keranjang::where('id_user', $user->id_user)
            ->where('id_produk', $validated['id_produk'])
            ->first();

        if ($existing) {
            $existing->increment('jumlah', $validated['jumlah']);
        } else {
            Keranjang::create([
                'id_user' => $user->id_user,
                'id_produk' => $validated['id_produk'],
                'jumlah' => $validated['jumlah'],
            ]);
        }

        return back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $validated = $request->validate([
            'jumlah' => ['required', 'integer', 'min:1'],
        ]);

        $keranjang = Keranjang::where('id_keranjang', $id)
            ->where('id_user', Auth::id())
            ->firstOrFail();

        $produk = $keranjang->produk;

        if ($produk->stok < $validated['jumlah']) {
            return back()->withErrors(['jumlah' => 'Stok tidak mencukupi.']);
        }

        $keranjang->update(['jumlah' => $validated['jumlah']]);

        return back()->with('success', 'Jumlah produk diperbarui.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $keranjang = Keranjang::where('id_keranjang', $id)
            ->where('id_user', Auth::id())
            ->firstOrFail();

        $keranjang->delete();

        return back()->with('success', 'Produk dihapus dari keranjang.');
    }

    public function clear(): RedirectResponse
    {
        Keranjang::where('id_user', Auth::id())->delete();

        return back()->with('success', 'Keranjang berhasil dikosongkan.');
    }
}
