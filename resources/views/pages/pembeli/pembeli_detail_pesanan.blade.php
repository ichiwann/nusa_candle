@extends('layouts.pembeli')

@section('title', 'Detail Pesanan #' . str_pad($pesanan->id_pesanan, 4, '0', STR_PAD_LEFT) . ' - NusaCandle')

@section('content')
    <div class="min-h-screen bg-[#FAF9F6]">
        
        {{-- Breadcrumb (Diberi batas max-w-7xl) --}}
        <div class="bg-white border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex items-center gap-2 text-sm">
                    <a href="{{ route('home') }}" class="text-[#718078] hover:text-[#8B1E1E]">Beranda</a>
                    <span class="text-[#718078]">/</span>
                    <a href="{{ route('pembeli.pesanan.index') }}" class="text-[#718078] hover:text-[#8B1E1E]">Pesanan Saya</a>
                    <span class="text-[#718078]">/</span>
                    <span class="text-[#8B1E1E] font-semibold">Detail Pesanan</span>
                </div>
            </div>
        </div>

        {{-- Konten Utama (Diberi batas max-w-7xl agar tidak terlalu melebar) --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            
            {{-- Header Detail --}}
            <div class="mb-8">
                <div class="flex flex-wrap items-center gap-3 mb-2">
                    <h1 class="font-serif text-3xl font-bold text-[#2C1810]">
                        Pesanan #NC-{{ $pesanan->created_at->format('Y') }}-{{ str_pad($pesanan->id_pesanan, 4, '0', STR_PAD_LEFT) }}
                    </h1>
                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold {{ $pesanan->status_color }}">
                        {{ $pesanan->status_label }}
                    </span>
                </div>
                <p class="text-[#718078] text-sm">Dibuat pada {{ $pesanan->created_at->format('d F Y, H:i') }} WIB</p>
            </div>

            @if (session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-md flex items-center gap-2">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('success') }}
                </div>
            @endif

            {{-- GRID UTAMA - 2 Kolom --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                {{-- KOLOM KIRI (2/3 lebar) --}}
                <div class="lg:col-span-2 space-y-6">
                    
                    {{-- Info Pembayaran --}}
                    @php $transaksi = $pesanan->transaksi->first(); @endphp
                    
                    @if($transaksi)
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <h2 class="font-serif text-xl font-bold text-[#2C1810] mb-4">Informasi Pembayaran</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <p class="text-xs text-[#718078] mb-1">Metode Pembayaran</p>
                                <p class="font-semibold text-[#2C1810] capitalize">{{ $transaksi->metode_pembayaran }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-[#718078] mb-1">Status Pembayaran</p>
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold {{ $transaksi->status_color }}">
                                    {{ $transaksi->status_label }}
                                </span>
                            </div>
                        </div>

                        {{-- Tampilkan Nomor VA jika Transfer --}}
                        @if($pesanan->status_pesanan === 'menunggu_pembayaran' && in_array($transaksi->metode_pembayaran, ['bca', 'mandiri']))
                        <div class="bg-[#FAF9F6] border border-[#8B1E1E]/30 rounded-lg p-4">
                            <p class="text-xs text-[#718078] mb-2">Nomor Virtual Account / Rekening Tujuan</p>
                            <div class="flex items-center justify-between flex-wrap gap-3">
                                <p id="nomor-va" class="font-mono text-xl font-bold text-[#8B1E1E] tracking-wider">
                                    {{ $transaksi->metode_pembayaran === 'bca' ? '8271 0812 3456 7890' : '130 00 1234567 8' }}
                                </p>
                                <button type="button" onclick="copyVA()" class="bg-[#8B1E1E] text-white px-4 py-2 rounded-md text-sm font-semibold hover:bg-[#6B1515] transition flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                    Salin
                                </button>
                            </div>
                            <p class="text-xs text-[#718078] mt-3">Segera transfer sesuai total pembayaran di bawah ini.</p>
                        </div>
                        @endif

                        @if($transaksi->metode_pembayaran === 'cod')
                        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                            <p class="text-sm text-green-800 font-semibold">💵 Pembayaran di Tempat (COD)</p>
                            <p class="text-xs text-green-700 mt-1">Silakan siapkan uang pas sebesar total tagihan saat kurir mengirimkan pesanan Anda.</p>
                        </div>
                        @endif
                    </div>
                    @endif

                    {{-- Daftar Produk --}}
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <h2 class="font-serif text-xl font-bold text-[#2C1810] mb-4">Produk yang Dipesan</h2>
                        
                        <div class="space-y-4">
                            @foreach($pesanan->detailPesanan as $detail)
                            <div class="flex gap-4 pb-4 border-b border-gray-100 last:border-0 last:pb-0">
                                @if($detail->produk->gambar)
                                    <img src="{{ asset('storage/' . $detail->produk->gambar) }}" alt="{{ $detail->produk->nama_produk }}" class="w-20 h-20 object-cover rounded-md flex-shrink-0">
                                @else
                                    <div class="w-20 h-20 bg-gray-200 rounded-md flex items-center justify-center flex-shrink-0">
                                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif
                                <div class="flex-1">
                                    <h3 class="font-serif text-lg font-bold text-[#2C1810]">{{ $detail->produk->nama_produk }}</h3>
                                    <div class="flex flex-wrap items-center gap-3 mt-1 text-sm text-[#718078]">
                                        <span>Jumlah: <strong class="text-[#2C1810]">{{ $detail->jumlah }} Pcs</strong></span>
                                        <span>•</span>
                                        <span>Harga Satuan: <strong class="text-[#2C1810]">Rp{{ number_format($detail->harga_satuan, 0, ',', '.') }}</strong></span>
                                    </div>
                                </div>
                                <div class="text-right flex-shrink-0">
                                    <p class="font-bold text-[#8B1E1E]">Rp{{ number_format($detail->harga_satuan * $detail->jumlah, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                {{-- AKHIR KOLOM KIRI --}}

                {{-- KOLOM KANAN (1/3 lebar) --}}
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 sticky top-24">
                        <h2 class="font-serif text-xl font-bold text-[#2C1810] mb-6">Ringkasan Pembayaran</h2>

                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between text-sm">
                                <span class="text-[#718078]">Total Harga Produk</span>
                                <span class="font-semibold text-[#2C1810]">Rp{{ number_format($pesanan->total_harga - 20000, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-[#718078]">Ongkos Kirim</span>
                                <span class="font-semibold text-[#2C1810]">Rp 15.000</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-[#718078]">Packaging</span>
                                <span class="font-semibold text-[#2C1810]">Rp 5.000</span>
                            </div>
                        </div>

                        <div class="border-t border-gray-200 pt-4 mb-6">
                            <div class="flex justify-between items-baseline">
                                <span class="text-sm font-semibold text-[#718078]">Total Tagihan</span>
                                <p class="font-serif text-2xl font-bold text-[#8B1E1E]">Rp{{ number_format($pesanan->total_harga, 0, ',', '.') }}</p>
                            </div>
                        </div>

                        <a href="{{ route('pembeli.pesanan.index') }}" class="w-full border border-gray-200 hover:border-[#8B1E1E] text-[#718078] hover:text-[#8B1E1E] px-6 py-3 rounded-md font-semibold transition flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Kembali ke Daftar Pesanan
                        </a>

                        @if($pesanan->status_pesanan === 'menunggu_pembayaran')
                        <a href="{{ route('pembeli.transaksi.index') }}" class="w-full mt-3 bg-[#8B1E1E] hover:bg-[#6B1515] text-white px-6 py-3 rounded-md font-semibold transition flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                            </svg>
                            Upload Bukti Bayar
                        </a>
                        @endif
                    </div>
                </div>
                {{-- AKHIR KOLOM KANAN --}}

            </div>
            {{-- AKHIR GRID UTAMA --}}
            
        </div>
    </div>

    <script>
        function copyVA() {
            const vaText = document.getElementById('nomor-va').textContent.trim();
            navigator.clipboard.writeText(vaText).then(() => {
                alert('Nomor rekening berhasil disalin!');
            });
        }
    </script>
@endsection