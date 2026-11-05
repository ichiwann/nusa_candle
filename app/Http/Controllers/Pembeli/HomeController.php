<?php

namespace App\Http\Controllers\Pembeli;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Pesanan;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(): View
    {
        // Ambil produk dengan stok terbanyak sebagai produk unggulan
        // (Karena tidak ada kolom 'status' di tabel produk)
        $produkUnggulan = Produk::orderBy('stok', 'desc')->first();
        
        $totalPesananUser = 0;
        $poinUser = 0;
        
        $user = Auth::user();

        if ($user !== null) {
            $totalPesananUser = Pesanan::where('id_user', $user->id_user)->count();
            $poinUser = (int) $user->total_poin;
        }

        return view('pages.pembeli.home', compact(
            'produkUnggulan',
            'totalPesananUser',
            'poinUser'
        ));
    }
}
