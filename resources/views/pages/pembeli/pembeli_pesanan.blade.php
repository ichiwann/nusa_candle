@extends('layouts.pembeli')

@section('title', 'Pesanan Saya - NusaCandle')

@section('content')
    @php
        $showDemoOrders = $pesananAktif->isEmpty() && $riwayatPesanan->isEmpty() && !request()->filled('search');
        $makeDemoDetail = fn (int $quantity) => (object) [
            'produk' => (object) [
                'nama_produk' => 'NusaCandle - Lilin Aroma Terapi Aroma Apel',
                'gambar' => null,
            ],
            'jumlah' => $quantity,
            'harga_satuan' => 89000,
        ];
        $makeDemoOrder = function (int $id, string $date, string $status, string $label, string $color, int $quantity) use ($makeDemoDetail) {
            return (object) [
                'id_pesanan' => $id,
                'created_at' => \Illuminate\Support\Carbon::parse($date)->locale('id'),
                'status_pesanan' => $status,
                'status_label' => $label,
                'status_color' => $color,
                'total_harga' => 89000 * $quantity,
                'detailPesanan' => collect([$makeDemoDetail($quantity)]),
            ];
        };
        $pesananAktifTampilan = $showDemoOrders
            ? collect([
                $makeDemoOrder(8841, '2024-10-24', 'dikirim', 'Dalam Perjalanan', 'bg-[#e8f2e2] text-[#2E7D32]', 2),
                $makeDemoOrder(8820, '2024-10-25', 'diproses', 'Sedang Diproses', 'bg-[#f8e6e5] text-[#8B1E1E]', 1),
            ])
            : $pesananAktif;
        $riwayatPesananTampilan = $showDemoOrders
            ? collect([
                $makeDemoOrder(7102, '2024-09-12', 'selesai', 'Selesai', 'bg-[#e8f2e2] text-[#2E7D32]', 1),
                $makeDemoOrder(6510, '2024-08-08', 'selesai', 'Selesai', 'bg-[#e8f2e2] text-[#2E7D32]', 3),
            ])
            : $riwayatPesanan;
    @endphp

    <style>
        body {
            background-color: #faf7ed;
        }

        body > nav {
            background-color: #faf7ed !important;
            border-top: 3px solid #8b1e1e;
            box-shadow: none !important;
        }

        body > main {
            background-color: #faf7ed;
        }

        body > footer {
            background-color: #f5f0e2 !important;
            border-top-color: #e8dfcd !important;
            margin-top: 2rem !important;
        }

    </style>

    <div class="bg-[#faf7ed]">
        <header class="bg-[#faf7ed]">
            <div class="mx-auto max-w-7xl px-4 py-3 sm:px-6 lg:px-8">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <div class="mb-1 inline-flex items-center gap-1.5 rounded-full bg-[#e8f2e2] px-2 py-1">
                            <svg class="h-3 w-3 text-[#2E7D32]" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-[8px] font-semibold text-[#2E7D32] sm:text-[9px]">NusaCandle - Lilin Aroma Terapi Aroma Apel</span>
                        </div>
                        <h1 class="font-serif text-xl font-bold leading-tight text-[#2C1810] sm:text-2xl">Pesanan Saya</h1>
                        <p class="mt-1 text-[9px] text-[#718078] sm:text-[10px]">Lacak status pesanan aktif dan riwayat pesanan lilin aromaterapi Anda.</p>
                    </div>

                    <form action="{{ route('pembeli.pesanan.index') }}" method="GET" class="relative w-full sm:max-w-xs">
                        <svg class="absolute left-3 top-1/2 h-3.5 w-3.5 -translate-y-1/2 text-[#718078]" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari pesanan..."
                            class="w-full rounded-md border border-[#e7dfd1] bg-white py-2 pl-9 pr-3 text-[9px] text-[#2C1810] outline-none focus:border-[#8B1E1E] focus:ring-1 focus:ring-[#8B1E1E]/20 sm:text-[10px]">
                    </form>
                </div>
            </div>
        </header>

        <div class="mx-auto max-w-7xl px-4 py-3 sm:px-6 sm:py-5 lg:px-8">

            {{-- SECTION: PESANAN AKTIF --}}
            <section class="mb-6 sm:mb-8">
                <div class="mb-2 flex items-center justify-between gap-3 sm:mb-3">
                    <h2 class="flex items-center gap-2 font-serif text-sm font-bold text-[#2C1810] sm:text-base">
                        <span class="h-2 w-2 rounded-full bg-[#8B1E1E]"></span>
                        Pesanan Aktif
                    </h2>
                    <span class="text-[8px] text-[#718078] sm:text-[9px]">
                        {{ $pesananAktifTampilan->count() }} Pesanan Berjalan
                        @if ($showDemoOrders)
                            <span class="font-semibold text-[#8B1E1E]"> · Contoh</span>
                        @endif
                    </span>
                </div>

                @if ($pesananAktifTampilan->count() > 0)
                    <div class="space-y-2.5">
                        @foreach ($pesananAktifTampilan as $pesanan)
                            <div class="overflow-hidden rounded-lg border border-[#eee8dc] bg-white shadow-sm">
                                {{-- Header Card --}}
                                <div class="flex flex-wrap items-center justify-between gap-2 border-b border-[#f1ece2] bg-white px-3 py-2 sm:px-4">
                                    <div class="flex flex-wrap items-center gap-2 sm:gap-3">
                                        <p class="font-mono text-[8px] font-bold text-[#2C1810] sm:text-[9px]">
                                            #NC-{{ $pesanan->created_at->format('Y') }}-{{ str_pad($pesanan->id_pesanan, 4, '0', STR_PAD_LEFT) }}
                                        </p>
                                        <p class="flex items-center gap-1 text-[8px] text-[#718078] sm:text-[9px]">
                                            <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            {{ $pesanan->created_at->locale('id')->translatedFormat('d F Y') }}
                                        </p>
                                    </div>
                                    <span
                                        class="inline-flex items-center gap-1 rounded-full px-2 py-0.5 text-[7px] font-semibold sm:text-[8px] {{ $pesanan->status_color }}">
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
                                    <div class="flex flex-wrap items-center gap-2.5 px-3 py-2.5 sm:flex-nowrap sm:gap-3 sm:px-4">
                                        <div class="flex-shrink-0">
                                            @if ($detail->produk->gambar)
                                                <img src="{{ asset('storage/' . $detail->produk->gambar) }}"
                                                    alt="{{ $detail->produk->nama_produk }}"
                                                    class="h-12 w-12 rounded-md object-cover sm:h-14 sm:w-14">
                                            @else
                                                <div
                                                    class="flex h-12 w-12 items-center justify-center rounded-md bg-[#f3eddf] sm:h-14 sm:w-14">
                                                    <svg class="h-7 w-7 text-[#b8aa96]" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="min-w-[180px] flex-1">
                                            <h3 class="font-serif text-[10px] font-bold leading-snug text-[#2C1810] sm:text-xs">
                                                {{ $detail->produk->nama_produk }}</h3>
                                            <div class="mt-1 flex flex-wrap items-center gap-1.5 text-[8px] text-[#718078] sm:gap-2 sm:text-[9px]">
                                                <span>Jumlah: <strong class="text-[#2C1810]">{{ $detail->jumlah }} Pcs</strong></span>
                                                <span aria-hidden="true">•</span>
                                                <span>Harga Satuan: <strong
                                                        class="text-[#2C1810]">Rp{{ number_format($detail->harga_satuan, 0, ',', '.') }}</strong></span>
                                            </div>
                                        </div>

                                        <div class="min-w-[115px] rounded-md bg-[#faf7ed] px-3 py-2 text-right sm:min-w-[130px]">
                                            <p class="mb-0.5 text-[7px] text-[#718078] sm:text-[8px]">Total Pembayaran</p>
                                            <p class="font-serif text-sm font-bold text-[#8B1E1E] sm:text-base">
                                                Rp{{ number_format($pesanan->total_harga, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                @endforeach

                                {{-- Footer Card --}}
                                <div class="flex justify-end border-t border-[#f1ece2] bg-[#faf7ed] px-3 py-2 sm:px-4">
                                    <a href="{{ $showDemoOrders ? route('pembeli.pesanan.preview', $pesanan->id_pesanan) : route('pembeli.pesanan.show', $pesanan->id_pesanan) }}"
                                        class="inline-flex items-center gap-1.5 rounded-md border border-[#e7dfd1] bg-white px-2.5 py-1.5 text-[8px] font-semibold text-[#2C1810] transition hover:border-[#8B1E1E] hover:text-[#8B1E1E] sm:text-[9px]">
                                        <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
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
                    <div class="rounded-lg border border-[#eee8dc] bg-white p-6 text-center sm:p-8">
                        <svg class="mx-auto mb-3 h-12 w-12 text-[#c8bda9]" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                        <p class="mb-1 text-[10px] font-semibold text-[#2C1810]">Belum ada pesanan aktif</p>
                        <p class="mb-4 text-[9px] text-[#718078]">Pesanan yang sedang diproses atau dikirim akan muncul di
                            sini.</p>
                        <a href="{{ route('produk.index') }}"
                            class="inline-block rounded-md bg-[#8B1E1E] px-4 py-2 text-[9px] font-semibold text-white transition hover:bg-[#6B1515]">
                            Mulai Belanja
                        </a>
                    </div>
                @endif
            </section>

            {{-- SECTION: RIWAYAT PESANAN --}}
            <section>
                <div class="mb-2 flex items-center justify-between gap-3 sm:mb-3">
                    <h2 class="flex items-center gap-1.5 font-serif text-sm font-bold text-[#2C1810] sm:text-base">
                        <svg class="h-4 w-4 text-[#2E7D32]" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Riwayat Pesanan
                    </h2>
                    <span class="text-[8px] text-[#718078] sm:text-[9px]">
                        Pesanan Selesai
                        @if ($showDemoOrders)
                            <span class="font-semibold text-[#8B1E1E]"> · Contoh</span>
                        @endif
                    </span>
                </div>

                @if ($riwayatPesananTampilan->count() > 0)
                    <div class="grid grid-cols-1 gap-2.5 sm:grid-cols-2">
                        @foreach ($riwayatPesananTampilan as $pesanan)
                            <div class="overflow-hidden rounded-lg border border-[#eee8dc] bg-white shadow-sm">
                                {{-- Header --}}
                                <div class="flex items-center justify-between gap-2 border-b border-[#f1ece2] px-3 py-2">
                                    <div>
                                        <p class="font-mono text-[8px] font-bold text-[#2C1810] sm:text-[9px]">
                                            #NC-{{ $pesanan->created_at->format('Y') }}-{{ str_pad($pesanan->id_pesanan, 4, '0', STR_PAD_LEFT) }}
                                        </p>
                                        <p class="text-[7px] text-[#718078] sm:text-[8px]">{{ $pesanan->created_at->locale('id')->translatedFormat('d F Y') }}</p>
                                    </div>
                                    <span
                                        class="inline-flex items-center gap-1 rounded-full bg-[#e8f2e2] px-2 py-0.5 text-[7px] font-semibold text-[#2E7D32] sm:text-[8px]">
                                        <svg class="h-2.5 w-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                        Selesai
                                    </span>
                                </div>

                                {{-- Body --}}
                                @foreach ($pesanan->detailPesanan as $detail)
                                    <div class="flex gap-2.5 px-3 py-2.5">
                                        <div class="flex-shrink-0">
                                            @if ($detail->produk->gambar)
                                                <img src="{{ asset('storage/' . $detail->produk->gambar) }}"
                                                    alt="{{ $detail->produk->nama_produk }}"
                                                    class="h-10 w-10 rounded-md object-cover sm:h-12 sm:w-12">
                                            @else
                                                <div
                                                    class="flex h-10 w-10 items-center justify-center rounded-md bg-[#f3eddf] sm:h-12 sm:w-12">
                                                    <svg class="h-6 w-6 text-[#b8aa96]" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex-1">
                                            <h3 class="font-serif text-[9px] font-bold leading-snug text-[#2C1810] sm:text-[10px]">
                                                {{ $detail->produk->nama_produk }}</h3>
                                            <p class="mt-1 text-[7px] text-[#718078] sm:text-[8px]">Jumlah: <strong
                                                    class="text-[#2C1810]">{{ $detail->jumlah }} Pcs</strong></p>
                                            <p class="mt-1 text-[7px] font-semibold text-[#8B1E1E] sm:text-[8px]">Harga:
                                                Rp{{ number_format($detail->harga_satuan, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                @endforeach

                                {{-- Footer --}}
                                <div class="border-t border-[#f1ece2] bg-[#faf7ed] px-3 py-2">
                                    <div class="mb-2 flex items-center justify-between">
                                        <div>
                                            <p class="text-[7px] text-[#718078] sm:text-[8px]">Total Pembayaran</p>
                                            <p class="font-serif text-sm font-bold text-[#8B1E1E] sm:text-base">
                                                Rp{{ number_format($pesanan->total_harga, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                    <div class="flex gap-1.5">
                                            <a href="{{ $showDemoOrders ? route('pembeli.pesanan.preview', $pesanan->id_pesanan) : route('pembeli.pesanan.show', $pesanan->id_pesanan) }}"
                                                class="inline-flex flex-1 items-center justify-center gap-1 rounded-md border border-[#e7dfd1] bg-white px-2 py-1.5 text-[7px] font-semibold text-[#2C1810] transition hover:border-[#8B1E1E] hover:text-[#8B1E1E] sm:text-[8px]">
                                            <svg class="h-3 w-3" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            Lihat Detail
                                            </a>
                                            @if ($showDemoOrders)
                                                <button type="button" disabled title="Contoh pesanan"
                                                class="inline-flex flex-1 cursor-not-allowed items-center justify-center gap-1 rounded-md bg-[#8B1E1E] px-2 py-1.5 text-[7px] font-semibold text-white opacity-60 sm:text-[8px]">
                                        @else
                                            <form action="{{ route('pembeli.pesanan.reorder', $pesanan->id_pesanan) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="inline-flex flex-1 items-center justify-center gap-1 rounded-md bg-[#8B1E1E] px-2 py-1.5 text-[7px] font-semibold text-white transition hover:bg-[#6B1515] sm:text-[8px]">
                                        @endif
                                                <svg class="h-3 w-3" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                                </svg>
                                                Beli Lagi
                                        @if ($showDemoOrders)
                                            </button>
                                        @else
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="rounded-lg border border-[#eee8dc] bg-white p-6 text-center sm:p-8">
                        <svg class="mx-auto mb-3 h-12 w-12 text-[#c8bda9]" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <p class="mb-1 text-[10px] font-semibold text-[#2C1810]">Belum ada riwayat pesanan</p>
                        <p class="text-[9px] text-[#718078]">Pesanan yang sudah selesai akan muncul di sini.</p>
                    </div>
                @endif
            </section>
        </div>
    </div>

@endsection
