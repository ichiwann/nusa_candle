@extends('layouts.pembeli')

@section('title', 'NusaCandle - Lilin Aromaterapi Alami dari Jawa Timur')

@section('content')

<!-- HERO SECTION -->
<section class="bg-gradient-to-br from-emerald-50 via-stone-50 to-emerald-50 py-16 md:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div>
                <span class="inline-block bg-emerald-100 text-emerald-900 text-xs font-semibold uppercase tracking-wider px-3 py-1.5 rounded-full mb-4">
                    East Java Highlands Artisanal
                </span>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-serif font-bold text-stone-900 leading-tight mb-6">
                    Aroma Apel Jawa Timur di Setiap Ruang Anda.
                </h1>
                <p class="text-stone-600 text-lg leading-relaxed mb-8">
                    Lilin aromaterapi handmade dari sari apel murni perkebunan dataran tinggi. 
                    Dibuat dengan tangan, standar kemewahan alami.
                </p>
                <div class="flex flex-wrap gap-3">
                    <a href="#produk" class="bg-emerald-900 hover:bg-emerald-800 text-white font-semibold px-6 py-3 rounded-xl transition shadow-lg hover:shadow-xl">
                        Jelajahi Produk
                    </a>
                    <a href="#" class="bg-white hover:bg-stone-50 text-emerald-900 font-semibold px-6 py-3 rounded-xl transition border border-stone-200">
                        Tentang Kami
                    </a>
                </div>
            </div>
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1603006905003-be475563bc59?w=800&h=600&fit=crop" 
                     alt="NusaCandle Hero" 
                     class="rounded-3xl shadow-2xl w-full object-cover aspect-[4/3]">
            </div>
        </div>
    </div>
</section>

<!-- KEUNGGULAN -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-serif font-bold text-stone-900 mb-3">Kenapa NusaCandle?</h2>
            <p class="text-stone-600">Kualitas premium dengan standar internasional</p>
        </div>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="text-center p-6">
                <div class="w-14 h-14 bg-emerald-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-emerald-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-stone-900 mb-2">100% Alami</h3>
                <p class="text-sm text-stone-600">Soy wax & essential oil murni, bebas bahan kimia berbahaya.</p>
            </div>
            <div class="text-center p-6">
                <div class="w-14 h-14 bg-emerald-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-emerald-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-stone-900 mb-2">Tahan Lama</h3>
                <p class="text-sm text-stone-600">Bakar hingga 50 jam dengan aroma yang konsisten.</p>
            </div>
            <div class="text-center p-6">
                <div class="w-14 h-14 bg-emerald-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-emerald-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-stone-900 mb-2">Sertifikasi IFRA</h3>
                <p class="text-sm text-stone-600">Aman untuk anak, hewan peliharaan, dan lingkungan.</p>
            </div>
        </div>
    </div>
</section>

<!-- PRODUK TERBARU -->
<section id="produk" class="py-16 bg-stone-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-end justify-between mb-10">
            <div>
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-stone-900 mb-2">Produk Terbaru</h2>
                <p class="text-stone-600">Koleksi aromaterapi pilihan untuk Anda</p>
            </div>
            <a href="#" class="text-sm font-semibold text-emerald-900 hover:text-emerald-700 transition hidden sm:block">Lihat Semua →</a>
        </div>

        @if($produkTerbaru->count() > 0)
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($produkTerbaru as $produk)
                    <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition group">
                        <div class="aspect-square bg-stone-100 overflow-hidden">
                            @if($produk->gambar)
                                <img src="{{ asset('images/produk/' . $produk->gambar) }}" alt="{{ $produk->nama_produk }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-stone-400">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="p-4">
                            <h3 class="font-semibold text-stone-900 mb-1 truncate">{{ $produk->nama_produk }}</h3>
                            <p class="text-emerald-900 font-bold">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-16 bg-white rounded-2xl">
                <svg class="w-16 h-16 mx-auto text-stone-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
                <h3 class="text-lg font-semibold text-stone-700 mb-2">Belum Ada Produk</h3>
                <p class="text-stone-500 text-sm">Produk akan segera ditambahkan oleh admin.</p>
            </div>
        @endif
    </div>
</section>

<!-- CTA SECTION -->
<section class="py-16 bg-emerald-900 text-white">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-serif font-bold mb-4">Bergabung dengan NusaCandle</h2>
        <p class="text-emerald-100/80 mb-8 max-w-2xl mx-auto">
            Daftar sekarang dan dapatkan poin loyalitas di setiap pembelian. 
            Tukarkan dengan lilin edisi khusus dan hadiah eksklusif.
        </p>
        @guest
            <a href="{{ route('register') }}" class="inline-block bg-white text-emerald-900 font-semibold px-8 py-3 rounded-xl hover:bg-emerald-50 transition shadow-lg">
                Daftar Sekarang
            </a>
        @else
            <a href="{{ route('pembeli.dashboard') }}" class="inline-block bg-white text-emerald-900 font-semibold px-8 py-3 rounded-xl hover:bg-emerald-50 transition shadow-lg">
                Ke Dashboard Saya
            </a>
        @endguest
    </div>
</section>

@endsection