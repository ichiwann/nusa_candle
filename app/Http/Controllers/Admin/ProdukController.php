<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Produk;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index(Request $request): View
    {
        $query = Produk::query();

        // 1. Logic Search (Cari berdasarkan Nama Produk)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('nama_produk', 'like', "%{$search}%");
        }

        // 2. Logic Sort (Urutkan)
        $sortBy = $request->get('sort', 'terbaru');
        match ($sortBy) {
            'harga_terendah' => $query->orderBy('harga', 'asc'),
            'harga_tertinggi' => $query->orderBy('harga', 'desc'),
            'stok_terendah' => $query->orderBy('stok', 'asc'),
            'stok_tertinggi' => $query->orderBy('stok', 'desc'),
            default => $query->orderBy('id_produk', 'desc'), // Terbaru
        };

        // 3. Pagination (10 item per halaman, &withQueryString biar search/sort gak ilang pas ganti halaman)
        $produks = $query->paginate(10)->withQueryString();

        // 4. Statistik untuk Cards
        $totalProduk = Produk::count();
        $totalStok = Produk::sum('stok');

        // Hardcode dulu untuk produk terjual & status stok sesuai desain Figma
        $produkTerjual = 1840;
        $statusStokText = 'Aman';

        return view('pages.admin.produk', compact(
            'produks',
            'totalProduk',
            'totalStok',
            'produkTerjual',
            'statusStokText'
        ));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama_produk' => ['required', 'string', 'max:255'],
            'stok' => ['required', 'integer', 'min:0'],
            'harga' => ['required', 'integer', 'min:0'],
            'gambar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ]);

        // 🔥 GENERATE ID PRODUK 7 DIGIT ACAK (1000000 - 9999999)
        do {
            $newId = random_int(1000000, 9999999);
        } while (Produk::where('id_produk', $newId)->exists()); // Cek biar gak dobel

        $validated['id_produk'] = $newId; // Masukkan ke data yang mau disimpan

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('produk', 'public');
        }

        Produk::create($validated);

        return back()->with('success', 'Produk berhasil ditambahkan.');
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $produk = Produk::findOrFail($id);

        $validated = $request->validate([
            'nama_produk' => ['required', 'string', 'max:255'],
            'stok' => ['required', 'integer', 'min:0'],
            'harga' => ['required', 'integer', 'min:0'],
            'gambar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ]);

        if ($request->hasFile('gambar')) {
            if ($produk->gambar) {
                Storage::disk('public')->delete($produk->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('produk', 'public');
        }

        $produk->update($validated);

        return back()->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $produk = Produk::findOrFail($id);

        if ($produk->gambar) {
            Storage::disk('public')->delete($produk->gambar);
        }

        $produk->delete();

        return back()->with('success', 'Produk berhasil dihapus.');
    }
}
