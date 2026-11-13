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
        $demoProducts = $this->demoProducts();

        return view('pages.pembeli.pembeli_produk', compact(
            'produk',
            'produkUtama',
            'produkLainnya',
            'totalStok',
            'demoProducts'
        ));
    }

    public function show(int $id): View
    {
        $produk = Produk::findOrFail($id);

        return view('pages.pembeli.detail_produk', compact('produk'));
    }

    public function preview(int $index): View
    {
        $demoProducts = $this->demoProducts();
        abort_unless($index >= 0 && $index < count($demoProducts) * 5, 404);

        $demoProduct = $demoProducts[$index % count($demoProducts)];
        $demoSet = intdiv($index, count($demoProducts));
        $produk = (object) [
            'id_produk' => 0,
            'nama_produk' => $demoProduct['name'] . ($demoSet > 0 ? ' - Variasi ' . ($demoSet + 1) : ''),
            'stok' => 142,
            'harga' => $demoProduct['price'],
            'gambar' => null,
        ];

        return view('pages.pembeli.detail_produk', [
            'produk' => $produk,
            'isPreview' => true,
        ]);
    }

    private function demoProducts(): array
    {
        return [
            ['name' => 'NusaCandle - Lilin Aroma Apel | Edisi Kebun', 'price' => 89000, 'reviews' => 24, 'label' => '#f3edda', 'accent' => '#75834f'],
            ['name' => 'NusaCandle - Lilin Aroma Apel | Edisi Batik', 'price' => 92000, 'reviews' => 18, 'label' => '#eee6d4', 'accent' => '#927c56'],
            ['name' => 'NusaCandle - Lilin Aroma Apel | Edisi Malang', 'price' => 89000, 'reviews' => 31, 'label' => '#f4eddd', 'accent' => '#9b7651'],
            ['name' => 'NusaCandle - Lilin Aroma Apel | Edisi Heritage', 'price' => 95000, 'reviews' => 16, 'label' => '#e9e2d1', 'accent' => '#806548'],
            ['name' => 'NusaCandle - Lilin Aroma Apel | Edisi Bunga', 'price' => 89000, 'reviews' => 27, 'label' => '#f5eadc', 'accent' => '#9b665c'],
            ['name' => 'NusaCandle - Lilin Aroma Apel | Edisi Alam', 'price' => 92000, 'reviews' => 21, 'label' => '#e9eadb', 'accent' => '#5d7855'],
            ['name' => 'NusaCandle - Lilin Aroma Apel | Edisi Artisan', 'price' => 95000, 'reviews' => 13, 'label' => '#efe4d4', 'accent' => '#956e4e'],
            ['name' => 'NusaCandle - Lilin Aroma Apel | Edisi Minimalis', 'price' => 89000, 'reviews' => 19, 'label' => '#ecebe4', 'accent' => '#727868'],
            ['name' => 'NusaCandle - Lilin Aroma Apel | Edisi Senja', 'price' => 92000, 'reviews' => 22, 'label' => '#f0e2d4', 'accent' => '#a2674d'],
            ['name' => 'NusaCandle - Lilin Aroma Apel | Edisi Panderman', 'price' => 95000, 'reviews' => 15, 'label' => '#e7e8d8', 'accent' => '#687a4e'],
        ];
    }
}
