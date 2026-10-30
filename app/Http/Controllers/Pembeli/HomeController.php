<?php

namespace App\Http\Controllers\Pembeli;

use App\Http\Controllers\Controller;
use App\Models\Produk;

class HomeController extends Controller
{
    public function index()
    {
        // Nanti ambil produk dari database, untuk sekarang dummy dulu
        $produkTerbaru = Produk::latest()->take(8)->get();
        
        return view('pages.pembeli.home', compact('produkTerbaru'));
    }
}
