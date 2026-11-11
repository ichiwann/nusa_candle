@extends('layouts.pembeli')

@section('title', 'Detail Transaksi #' . str_pad($transaksi->id_transaksi, 5, '0', STR_PAD_LEFT) . ' - NusaCandle')

@section('content')
    <div class="min-h-screen bg-[#FAF9F6]">
        {{-- Breadcrumb --}}
        <div class="bg-white border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex items-center gap-2 text-sm">
                    <a href="{{ route('home') }}" class="text-[#718078] hover:text-[#8B1E1E]">Beranda</a>
                    <span class="text-[#718078]">/</span>
                    <a href="{{ route('pembeli.transaksi.index') }}" class="text-[#718078] hover:text-[#8B1E1E]">Transaksi Saya</a>
                    <span class="text-[#718078]">/</span>
                    <span class="text-[#8B1E1E] font-semibold">Detail Transaksi</span>
                </div>
            </div>
        </div>

        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            {{-- Header --}}
            <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
                <div>
                    <h1 class="font-serif text-3xl font-bold text-[#2C1810]">
                        Transaksi #TRX-{{ str_pad($transaksi->id_transaksi, 5, '0', STR_PAD_LEFT) }}
                    </h1>
                    <p class="text-[#718078] text-sm mt-1">
                        Dibuat pada {{ $transaksi->created_at->format('d F Y, H:i') }} WIB
                    </p>
                </div>
                <span class="inline-flex items-center gap-1 px-4 py-1.5 rounded-full text-sm font-semibold {{ $transaksi->status_color }}">
                    {{ $transaksi->status_label }}
                </span>
            </div>

            @if (session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-md flex items-center gap-2">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                {{-- Info Pesanan Terkait --}}
                <div class="p-6 border-b border-gray-200 bg-[#FAF9F6]">
                    <h2 class="font-serif text-xl font-bold text-[#2C1810] mb-4">Informasi Pesanan Terkait</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs text-[#718078] mb-1">Nomor Pesanan</p>
                            <a href="{{ route('pembeli.pesanan.show', $transaksi->pesanan->id_pesanan) }}" class="text-[#8B1E1E] font-semibold hover:underline flex items-center gap-1">
                                #NC-{{ $transaksi->pesanan->created_at->format('Y') }}-{{ str_pad($transaksi->pesanan->id_pesanan, 4, '0', STR_PAD_LEFT) }}
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </div>
                        <div>
                            <p class="text-xs text-[#718078] mb-1">Total Tagihan</p>
                            <p class="font-serif text-xl font-bold text-[#2C1810]">Rp{{ number_format($transaksi->pesanan->total_harga, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>

                {{-- Detail Pembayaran --}}
                <div class="p-6 border-b border-gray-200">
                    <h2 class="font-serif text-xl font-bold text-[#2C1810] mb-4">Detail Pembayaran</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-xs text-[#718078] mb-1">Metode Pembayaran</p>
                            <p class="font-semibold text-[#2C1810] capitalize">{{ $transaksi->metode_label }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-[#718078] mb-1">Status Pembayaran</p>
                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold {{ $transaksi->status_color }}">
                                {{ $transaksi->status_label }}
                            </span>
                        </div>
                    </div>

                    {{-- Jika ada bukti pembayaran --}}
                    @if($transaksi->bukti_pembayaran)
                        <div class="mt-6">
                            <p class="text-xs text-[#718078] mb-2">Bukti Pembayaran</p>
                            <div class="border border-gray-200 rounded-lg p-2 inline-block bg-gray-50">
                                @if(pathinfo($transaksi->bukti_pembayaran, PATHINFO_EXTENSION) === 'pdf')
                                    <div class="flex items-center gap-3 p-4">
                                        <svg class="w-10 h-10 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                        <div>
                                            <p class="text-sm font-semibold text-[#2C1810]">Dokumen PDF</p>
                                            <a href="{{ asset('storage/' . $transaksi->bukti_pembayaran) }}" target="_blank" class="text-xs text-[#8B1E1E] hover:underline">Lihat / Download PDF</a>
                                        </div>
                                    </div>
                                @else
                                    <img src="{{ asset('storage/' . $transaksi->bukti_pembayaran) }}" alt="Bukti Pembayaran" class="max-w-sm rounded-md shadow-sm cursor-pointer hover:opacity-90 transition" onclick="window.open(this.src, '_blank')">
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="mt-6 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                            <p class="text-sm text-yellow-800 font-semibold flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                Belum ada bukti pembayaran yang diunggah.
                            </p>
                            @if($transaksi->status_pembayaran === 'menunggu')
                                <p class="text-xs text-yellow-700 mt-1">Silakan unggah bukti transfer melalui halaman daftar Transaksi jika Anda sudah melakukan pembayaran.</p>
                            @endif
                        </div>
                    @endif
                </div>

                {{-- Footer Actions --}}
                <div class="p-6 bg-[#FAF9F6] flex justify-end">
                    <a href="{{ route('pembeli.transaksi.index') }}" class="inline-flex items-center gap-2 bg-white border border-gray-200 hover:border-[#8B1E1E] text-[#2C1810] px-6 py-2.5 rounded-md text-sm font-semibold transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        Kembali ke Daftar Transaksi
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection