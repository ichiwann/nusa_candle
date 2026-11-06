@extends('layouts.pembeli')

@section('title', 'Pesanan Saya - NusaCandle')

@section('content')
    <div class="bg-[#FAF9F6] min-h-screen">
        {{-- Header --}}
        <div class="bg-white border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="flex flex-wrap items-start justify-between gap-4">
                    <div>
                        <div class="inline-flex items-center gap-2 bg-[#E8F5E9] px-3 py-1 rounded-full mb-3">
                            <svg class="w-4 h-4 text-[#2E7D32]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-xs font-semibold text-[#2E7D32]">NusaCandle – Lilin Aroma Terapi Aroma
                                Apel</span>
                        </div>
                        <h1 class="font-serif text-4xl font-bold text-[#2C1810]">Pesanan Saya</h1>
                        <p class="text-[#718078] mt-2">Lacak status pesanan aktif dan telusuri riwayat pesanan lilin
                            aromaterapi Anda.</p>
                    </div>

                    {{-- Search --}}
                    <form action="{{ route('pembeli.pesanan.index') }}" method="GET" class="w-full md:w-80 relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-[#718078]" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari pesanan..."
                            class="w-full pl-10 pr-4 py-2.5 bg-white border border-gray-200 rounded-md text-sm focus:border-[#8B1E1E] focus:ring-1 focus:ring-[#8B1E1E]/20 outline-none">
                    </form>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            {{-- Notifikasi --}}
            @if (session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            {{-- SECTION: PESANAN AKTIF --}}
            <section class="mb-10">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="font-serif text-2xl font-bold text-[#2C1810] flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-[#8B1E1E]"></span>
                        Pesanan Aktif
                    </h2>
                    <span class="text-sm text-[#718078]">{{ $pesananAktif->count() }} Pesanan Berjalan</span>
                </div>

                @if ($pesananAktif->count() > 0)
                    <div class="space-y-4">
                        @foreach ($pesananAktif as $pesanan)
                            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                                {{-- Header Card --}}
                                <div
                                    class="px-6 py-4 border-b border-gray-100 flex items-center justify-between bg-[#FAF9F6]">
                                    <div class="flex items-center gap-4">
                                        <p class="font-mono font-bold text-[#2C1810]">
                                            #NC-{{ $pesanan->created_at->format('Y') }}-{{ str_pad($pesanan->id_pesanan, 4, '0', STR_PAD_LEFT) }}
                                        </p>
                                        <p class="text-sm text-[#718078] flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            {{ $pesanan->created_at->format('d F Y') }}
                                        </p>
                                    </div>
                                    <span
                                        class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold {{ $pesanan->status_color }}">
                                        @if ($pesanan->status_pesanan === 'dikirim')
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                            </svg>
                                        @elseif($pesanan->status_pesanan === 'diproses')
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                            </svg>
                                        @endif
                                        {{ $pesanan->status_label }}
                                    </span>
                                </div>

                                {{-- Body Card --}}
                                @foreach ($pesanan->detailPesanan as $detail)
                                    <div class="px-6 py-4 flex flex-wrap items-center gap-4">
                                        <div class="flex-shrink-0">
                                            @if ($detail->produk->gambar)
                                                <img src="{{ asset('storage/' . $detail->produk->gambar) }}"
                                                    alt="{{ $detail->produk->nama_produk }}"
                                                    class="w-20 h-20 object-cover rounded-md">
                                            @else
                                                <div
                                                    class="w-20 h-20 bg-gray-200 rounded-md flex items-center justify-center">
                                                    <svg class="w-10 h-10 text-gray-400" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="flex-1 min-w-[200px]">
                                            <h3 class="font-serif text-lg font-bold text-[#2C1810]">
                                                {{ $detail->produk->nama_produk }}</h3>
                                            <div class="flex items-center gap-3 mt-1 text-sm text-[#718078]">
                                                <span>Jumlah: <strong class="text-[#2C1810]">{{ $detail->jumlah }}
                                                        Pcs</strong></span>
                                                <span>•</span>
                                                <span>Harga Satuan: <strong
                                                        class="text-[#2C1810]">Rp{{ number_format($detail->harga_satuan, 0, ',', '.') }}</strong></span>
                                            </div>
                                        </div>

                                        <div class="bg-[#FAF9F6] rounded-lg px-6 py-3 text-right min-w-[180px]">
                                            <p class="text-xs text-[#718078] mb-1">Total Pembayaran</p>
                                            <p class="font-serif text-2xl font-bold text-[#8B1E1E]">
                                                Rp{{ number_format($pesanan->total_harga, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                @endforeach

                                {{-- Footer Card --}}
                                <div class="px-6 py-3 border-t border-gray-100 bg-[#FAF9F6] flex justify-end">
                                    <a href="{{ route('pembeli.pesanan.show', $pesanan->id_pesanan) }}"
                                        class="inline-flex items-center gap-2 bg-white border border-gray-200 hover:border-[#8B1E1E] text-[#2C1810] px-4 py-2 rounded-md text-sm font-semibold transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    {{-- Empty State --}}
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-12 text-center">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                        <p class="text-sm font-semibold text-[#2C1810] mb-1">Belum ada pesanan aktif</p>
                        <p class="text-xs text-[#718078] mb-4">Pesanan yang sedang diproses atau dikirim akan muncul di
                            sini.</p>
                        <a href="{{ route('produk.index') }}"
                            class="inline-block bg-[#8B1E1E] hover:bg-[#6B1515] text-white px-6 py-2 rounded-md text-sm font-semibold transition">
                            Mulai Belanja
                        </a>
                    </div>
                @endif
            </section>

            {{-- SECTION: RIWAYAT PESANAN --}}
            <section>
                <div class="flex items-center justify-between mb-4">
                    <h2 class="font-serif text-2xl font-bold text-[#2C1810] flex items-center gap-2">
                        <svg class="w-6 h-6 text-[#2E7D32]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Riwayat Pesanan
                    </h2>
                    <span class="text-sm text-[#718078]">Pesanan Selesai</span>
                </div>

                @if ($riwayatPesanan->count() > 0)
                    <div class="grid md:grid-cols-2 gap-4">
                        @foreach ($riwayatPesanan as $pesanan)
                            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                                {{-- Header --}}
                                <div class="px-5 py-3 border-b border-gray-100 flex items-center justify-between">
                                    <div>
                                        <p class="font-mono font-bold text-[#2C1810]">
                                            #NC-{{ $pesanan->created_at->format('Y') }}-{{ str_pad($pesanan->id_pesanan, 4, '0', STR_PAD_LEFT) }}
                                        </p>
                                        <p class="text-xs text-[#718078]">{{ $pesanan->created_at->format('d F Y') }}</p>
                                    </div>
                                    <span
                                        class="inline-flex items-center gap-1 bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                        Selesai
                                    </span>
                                </div>

                                {{-- Body --}}
                                @foreach ($pesanan->detailPesanan as $detail)
                                    <div class="px-5 py-4 flex gap-3">
                                        <div class="flex-shrink-0">
                                            @if ($detail->produk->gambar)
                                                <img src="{{ asset('storage/' . $detail->produk->gambar) }}"
                                                    alt="{{ $detail->produk->nama_produk }}"
                                                    class="w-16 h-16 object-cover rounded-md">
                                            @else
                                                <div
                                                    class="w-16 h-16 bg-gray-200 rounded-md flex items-center justify-center">
                                                    <svg class="w-8 h-8 text-gray-400" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex-1">
                                            <h3 class="font-serif text-base font-bold text-[#2C1810]">
                                                {{ $detail->produk->nama_produk }}</h3>
                                            <p class="text-xs text-[#718078] mt-1">Jumlah: <strong
                                                    class="text-[#2C1810]">{{ $detail->jumlah }} Pcs</strong></p>
                                            <p class="text-xs text-[#8B1E1E] font-semibold mt-1">Harga:
                                                Rp{{ number_format($detail->harga_satuan, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                @endforeach

                                {{-- Footer --}}
                                <div class="px-5 py-4 border-t border-gray-100 bg-[#FAF9F6]">
                                    <div class="flex items-center justify-between mb-3">
                                        <div>
                                            <p class="text-xs text-[#718078]">Total Pembayaran</p>
                                            <p class="font-serif text-xl font-bold text-[#8B1E1E]">
                                                Rp{{ number_format($pesanan->total_harga, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                    <div class="flex gap-2">
                                        <a href="{{ route('pembeli.pesanan.show', $pesanan->id_pesanan) }}"
                                            class="flex-1 inline-flex items-center justify-center gap-1 bg-white border border-gray-200 hover:border-[#8B1E1E] text-[#2C1810] px-3 py-2 rounded-md text-xs font-semibold transition">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            Lihat Detail
                                        </a>
                                        <form action="{{ route('pembeli.pesanan.reorder', $pesanan->id_pesanan) }}"
                                            method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="flex-1 inline-flex items-center justify-center gap-1 bg-[#8B1E1E] hover:bg-[#6B1515] text-white px-3 py-2 rounded-md text-xs font-semibold transition">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                                </svg>
                                                Beli Lagi
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-12 text-center">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <p class="text-sm font-semibold text-[#2C1810] mb-1">Belum ada riwayat pesanan</p>
                        <p class="text-xs text-[#718078]">Pesanan yang sudah selesai akan muncul di sini.</p>
                    </div>
                @endif
            </section>
        </div>
    </div>
@endsection
