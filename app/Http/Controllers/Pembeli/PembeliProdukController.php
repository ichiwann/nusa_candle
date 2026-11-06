<?php

namespace App\Http\Controllers\Pembeli;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\View\View;

class PembeliProdukController extends Controller
{
    public function index(Request $request): View
    {
        $query = Produk::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('nama_produk', 'like', "%{$search}%");
        }

        // Filter Status (berdasarkan stok)
        if ($request->filled('status')) {
            if ($request->status === 'ready') {
                $query->where('stok', '>', 0);
            } elseif ($request->status === 'preorder') {
                $query->where('stok', '=', 0);
            }
        }

        $produk = $query->orderBy('created_at', 'desc')->get();

        // Produk utama (yang pertama/terbaru)
        $produkUtama = $produk->first();

        // Produk lainnya (selain yang utama)
        $produkLainnya = $produk->skip(1)->take(3);

        // Statistik
        $totalStok = Produk::sum('stok');

        return view('pages.pembeli.pembeli_produk', compact(
            'produk',
            'produkUtama',
            'produkLainnya',
            'totalStok'
        ));
    }

    public function show(int $id): View
    {
        $produk = Produk::findOrFail($id);

        return view('pages.pembeli.detail_produk', compact('produk'));
    }
}
