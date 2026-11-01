<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class GiftController extends Controller
{
    public function index(): View
    {
        $hasProducts = Schema::hasTable('produk');
        $hasGifts = Schema::hasTable('hadiah');
        $gifts = collect();
        $products = collect();

        if ($hasGifts && $hasProducts) {
            $gifts = DB::table('hadiah')
                ->join('produk', 'produk.id_produk', '=', 'hadiah.id_produk')
                ->orderBy('hadiah.id_hadiah')
                ->get([
                    'hadiah.id_hadiah',
                    'hadiah.id_produk',
                    'hadiah.poin_dibutuhkan',
                    'hadiah.created_at',
                    'produk.nama_produk',
                    'produk.stok',
                    'produk.harga',
                ]);
        }

        if ($hasProducts) {
            $products = DB::table('produk')->orderBy('nama_produk')->get(['id_produk', 'nama_produk', 'stok']);
        }

        return view('pages.admin.gifts', [
            'gifts' => $gifts,
            'products' => $products,
            'hasGiftsTable' => $hasGifts,
            'totalMembers' => Schema::hasTable('user') ? DB::table('user')->where('role', 'pembeli')->count() : 0,
            'totalPoints' => Schema::hasTable('user') ? (int) DB::table('user')->where('role', 'pembeli')->sum('total_poin') : 0,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'id_produk' => ['required', 'integer', Rule::exists('produk', 'id_produk')],
            'poin_dibutuhkan' => ['required', 'integer', 'min:1', 'max:100000000'],
        ]);

        $exists = DB::table('hadiah')->where('id_produk', $validated['id_produk'])->exists();
        if ($exists) {
            return back()->withErrors(['id_produk' => 'Produk ini sudah terdaftar sebagai hadiah.'])->withInput();
        }

        DB::table('hadiah')->insert([
            ...$validated,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Hadiah berhasil ditambahkan.');
    }

    public function update(Request $request, int $gift): RedirectResponse
    {
        $validated = $request->validate([
            'id_produk' => ['required', 'integer', Rule::exists('produk', 'id_produk')],
            'poin_dibutuhkan' => ['required', 'integer', 'min:1', 'max:100000000'],
        ]);

        $giftRecord = DB::table('hadiah')->where('id_hadiah', $gift)->first();
        abort_unless($giftRecord, 404);

        $duplicate = DB::table('hadiah')
            ->where('id_produk', $validated['id_produk'])
            ->where('id_hadiah', '!=', $gift)
            ->exists();

        if ($duplicate) {
            return back()->withErrors(['id_produk' => 'Produk ini sudah terdaftar sebagai hadiah.'])->withInput();
        }

        DB::table('hadiah')->where('id_hadiah', $gift)->update([
            ...$validated,
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Hadiah berhasil diperbarui.');
    }

    public function destroy(int $gift): RedirectResponse
    {
        $deleted = DB::table('hadiah')->where('id_hadiah', $gift)->delete();
        abort_unless($deleted, 404);

        return back()->with('success', 'Hadiah berhasil dihapus.');
    }
}
