<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class HadiahController extends Controller
{
    /**
     * Menampilkan halaman daftar hadiah
     */
    public function index(): View
    {
        $hasProdukTable = Schema::hasTable('produk');
        $hasHadiahTable = Schema::hasTable('hadiah');
        $hasUserTable = Schema::hasTable('user');

        $hadiahs = collect();
        $products = collect();

        // Ambil data hadiah yang di-join dengan tabel produk
        if ($hasHadiahTable && $hasProdukTable) {
            $hadiahs = DB::table('hadiah')
                ->join('produk', 'produk.id_produk', '=', 'hadiah.id_produk')
                ->orderBy('hadiah.id_hadiah', 'desc') // Urutkan dari yang terbaru
                ->get([
                    'hadiah.id_hadiah',
                    'hadiah.id_produk',
                    'hadiah.poin_dibutuhkan',
                    'produk.nama_produk',
                    'produk.stok',
                    'produk.harga',
                ]);
        }

        // Ambil semua produk untuk dropdown form
        if ($hasProdukTable) {
            $products = DB::table('produk')->orderBy('nama_produk')->get(['id_produk', 'nama_produk', 'stok']);
        }

        return view('pages.admin.hadiah', [ // Pastikan path view sesuai struktur folder kamu
            'hadiahs' => $hadiahs,
            'products' => $products,
            'hasHadiahTable' => $hasHadiahTable,
            'totalMembers' => $hasUserTable ? DB::table('user')->where('role', 'pembeli')->count() : 0,
            'totalPoints' => $hasUserTable ? (int) DB::table('user')->where('role', 'pembeli')->sum('total_poin') : 0,
        ]);
    }

    /**
     * Menyimpan data hadiah baru
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'id_produk' => ['required', 'integer', Rule::exists('produk', 'id_produk')],
            'poin_dibutuhkan' => ['required', 'integer', 'min:1', 'max:100000000'],
        ]);

        // Cek apakah produk sudah pernah dijadikan hadiah
        $exists = DB::table('hadiah')->where('id_produk', $validated['id_produk'])->exists();
        if ($exists) {
            return back()->withErrors(['id_produk' => 'Produk ini sudah terdaftar sebagai hadiah.'])->withInput();
        }

        DB::table('hadiah')->insert([
            'id_produk' => $validated['id_produk'],
            'poin_dibutuhkan' => $validated['poin_dibutuhkan'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Hadiah berhasil ditambahkan ke program loyalitas.');
    }

    /**
     * Memperbarui data hadiah
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $validated = $request->validate([
            'id_produk' => ['required', 'integer', Rule::exists('produk', 'id_produk')],
            'poin_dibutuhkan' => ['required', 'integer', 'min:1', 'max:100000000'],
        ]);

        // Pastikan data yang mau diupdate ada
        $hadiahRecord = DB::table('hadiah')->where('id_hadiah', $id)->first();
        abort_unless($hadiahRecord, 404, 'Data hadiah tidak ditemukan.');

        // Cek duplikasi (kecuali ID dirinya sendiri)
        $duplicate = DB::table('hadiah')
            ->where('id_produk', $validated['id_produk'])
            ->where('id_hadiah', '!=', $id)
            ->exists();

        if ($duplicate) {
            return back()->withErrors(['id_produk' => 'Produk ini sudah terdaftar sebagai hadiah lain.'])->withInput();
        }

        DB::table('hadiah')->where('id_hadiah', $id)->update([
            'id_produk' => $validated['id_produk'],
            'poin_dibutuhkan' => $validated['poin_dibutuhkan'],
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Data hadiah berhasil diperbarui.');
    }

    /**
     * Menghapus data hadiah
     */
    public function destroy(int $id): RedirectResponse
    {
        $deleted = DB::table('hadiah')->where('id_hadiah', $id)->delete();
        abort_unless($deleted, 404, 'Data hadiah tidak ditemukan.');

        return back()->with('success', 'Hadiah berhasil dihapus dari program loyalitas.');
    }
}