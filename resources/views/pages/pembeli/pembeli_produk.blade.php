@extends('layouts.pembeli')

@section('title', 'Koleksi Produk Eksklusif - NusaCandle')

@section('content')
    <div class="catalog-page">
        <style>
            body:has(.catalog-page) {
                background: #faf8f2;
            }

            body:has(.catalog-page) nav:not(#catalog-pagination) {
                background: #faf8f2;
                border-top: 3px solid #8b1e1e;
                box-shadow: none;
            }

            body:has(.catalog-page) nav:not(#catalog-pagination) > div > div {
                position: relative;
                height: 3.25rem;
            }

            body:has(.catalog-page) nav:not(#catalog-pagination) > div > div > div:nth-child(2) {
                display: flex;
                align-items: center;
                gap: 0.1rem;
                position: absolute;
                top: 50%;
                left: 50%;
                white-space: nowrap;
                transform: translate(-50%, -50%);
            }

            body:has(.catalog-page) nav:not(#catalog-pagination) > div > div > div:nth-child(2) a {
                padding: 0.45rem 0.6rem;
                font-size: 0.65rem;
            }

            body:has(.catalog-page) nav:not(#catalog-pagination) > div {
                width: 100%;
                max-width: 80rem;
                padding: 0 1.5rem;
            }

            body:has(.catalog-page) footer {
                background: #f7f3e8;
                margin-top: 1.5rem;
            }

            body:has(.catalog-page) footer > div {
                padding-top: 1.5rem;
                padding-bottom: 1rem;
            }

            body:has(.catalog-page) footer > div > div:first-child {
                gap: 1.25rem;
            }

            body:has(.catalog-page) footer h3 {
                font-size: 0.9rem;
            }

            body:has(.catalog-page) footer h4 {
                margin-bottom: 0.5rem;
                font-size: 0.7rem;
            }

            body:has(.catalog-page) footer p,
            body:has(.catalog-page) footer li {
                font-size: 0.58rem;
                line-height: 1.45;
            }

            body:has(.catalog-page) footer > div > div:last-child {
                margin-top: 1rem;
                padding-top: 0.75rem;
            }

            body:has(.catalog-page) footer > div > div:last-child p,
            body:has(.catalog-page) footer > div > div:last-child a {
                font-size: 0.5rem;
            }

            .catalog-page {
                --candle-red: #8b1e1e;
                --candle-ink: #2c1810;
                --candle-muted: #718078;
                --candle-cream: #faf8f2;
                color: var(--candle-ink);
            }

            .catalog-candle {
                position: relative;
                width: 58%;
                height: 67%;
                border: 2px solid #b6aa91;
                border-top: 0;
                border-radius: 5px 5px 12px 12px;
                background: linear-gradient(90deg, #ffffff50, #fffdf480 35%, #ffffff50), #ece7d9;
                box-shadow: inset 5px 0 8px #ffffff90, inset -5px 0 8px #9b8b6720, 0 8px 12px #2c18101c;
            }

            .catalog-candle::before {
                position: absolute;
                top: -9px;
                left: 50%;
                width: calc(100% + 10px);
                height: 9px;
                border: 1px solid #92856b;
                border-radius: 3px 3px 2px 2px;
                background: linear-gradient(#d5c9ad, #eee5d3 45%, #c4b799);
                box-shadow: 0 2px 3px #2c18102b;
                content: "";
                transform: translateX(-50%);
            }

            .catalog-candle::after {
                position: absolute;
                top: 30%;
                right: -2px;
                left: -2px;
                height: 31%;
                border-top: 1px solid #b49b6f;
                border-bottom: 1px solid #b49b6f;
                background: linear-gradient(90deg, #fffaf0, #f8f2e3 60%, #fffaf0);
                content: "";
            }

            .catalog-candle-label {
                position: absolute;
                z-index: 1;
                top: 38%;
                right: 20%;
                left: 20%;
                height: 5%;
                background: #8b1e1e9c;
            }

            .catalog-candle-label::after {
                position: absolute;
                top: 220%;
                right: 12%;
                left: 12%;
                height: 2px;
                background: #b9aa8b99;
                content: "";
            }

            .catalog-product-media {
                background: linear-gradient(135deg, #ece9dd, #f7f3e9 48%, #e5dfd0);
            }

            .catalog-product:nth-child(4n + 2) .catalog-product-media {
                background: linear-gradient(135deg, #e6e1d3, #f5f0e5 48%, #dbd3c3);
            }

            .catalog-product:nth-child(4n + 2) .catalog-candle {
                background: linear-gradient(90deg, #e6decb, #f8f2e4 38%, #e1d8c6);
            }

            .catalog-product:nth-child(4n + 3) .catalog-product-media {
                background: linear-gradient(135deg, #e6e2d7, #f8f3e8 48%, #d7d4c9);
            }

            .catalog-product:nth-child(4n + 3) .catalog-candle {
                background: linear-gradient(90deg, #ddd5c5, #f3eddf 38%, #d5ccba);
            }

            .catalog-product:nth-child(4n) .catalog-product-media {
                background: linear-gradient(135deg, #e9e2d4, #f7f0e2 48%, #dfd3bf);
            }

            .catalog-product:nth-child(4n) .catalog-candle {
                background: linear-gradient(90deg, #dfd2bd, #f7efdf 38%, #dacbb5);
            }

            .catalog-skeleton-line {
                height: 3px;
                border-radius: 9999px;
                background: #e8e4da;
            }

            .catalog-product[hidden] {
                display: none;
            }

            .catalog-card-title,
            .catalog-card-description {
                display: -webkit-box;
                overflow: hidden;
                -webkit-box-orient: vertical;
            }

            .catalog-card-title {
                height: 2.6em;
                line-height: 1.3;
                -webkit-line-clamp: 2;
            }

            .catalog-card-description {
                height: 2.7em;
                line-height: 1.35;
                -webkit-line-clamp: 2;
            }

            @media (max-width: 359px) {
                #catalog-grid {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                }
            }

            @media (max-width: 900px) {
                body:has(.catalog-page) nav:not(#catalog-pagination) > div > div {
                    gap: 0.3rem;
                }

                body:has(.catalog-page) nav:not(#catalog-pagination) > div > div > a {
                    gap: 0.25rem;
                }

                body:has(.catalog-page) nav:not(#catalog-pagination) > div > div > a img {
                    width: 1.55rem;
                    height: 1.55rem;
                }

                body:has(.catalog-page) nav:not(#catalog-pagination) > div > div > a h1 {
                    font-size: 0.78rem;
                }

                body:has(.catalog-page) nav:not(#catalog-pagination) > div > div > a p {
                    font-size: 0.4rem;
                }

                body:has(.catalog-page) nav:not(#catalog-pagination) > div > div > div:nth-child(2) a {
                    padding: 0.42rem 0.48rem;
                    font-size: 0.58rem;
                }

                body:has(.catalog-page) nav:not(#catalog-pagination) > div > div > div:last-child {
                    gap: 0.2rem;
                }

                body:has(.catalog-page) nav:not(#catalog-pagination) > div > div > div:last-child > a {
                    padding: 0.35rem;
                }

                body:has(.catalog-page) nav:not(#catalog-pagination) > div > div > div:last-child > a svg {
                    width: 0.9rem;
                    height: 0.9rem;
                }
            }

            @media (max-width: 767px) {
                body:has(.catalog-page) nav:not(#catalog-pagination) > div > div {
                    display: grid !important;
                    grid-template-areas:
                        "brand actions"
                        "menu menu";
                    grid-template-columns: minmax(0, 1fr) auto;
                    height: auto !important;
                    min-height: 3.25rem;
                    gap: 0.25rem 0.5rem;
                    padding: 0.35rem 0;
                }

                body:has(.catalog-page) nav:not(#catalog-pagination) > div > div > a:first-child {
                    grid-area: brand;
                    min-width: 0;
                }

                body:has(.catalog-page) nav:not(#catalog-pagination) > div > div > div:nth-child(2) {
                    position: static;
                    grid-area: menu;
                    display: flex !important;
                    width: 100%;
                    justify-content: space-between;
                    gap: 0.15rem;
                    overflow-x: auto;
                    border-top: 1px solid #eee8dc;
                    padding-top: 0.2rem;
                    transform: none;
                    scrollbar-width: none;
                }

                body:has(.catalog-page) nav:not(#catalog-pagination) > div > div > div:nth-child(2)::-webkit-scrollbar {
                    display: none;
                }

                body:has(.catalog-page) nav:not(#catalog-pagination) > div > div > div:nth-child(2) a {
                    flex: 0 0 auto;
                    padding: 0.3rem 0.35rem;
                    font-size: 0.55rem;
                }

                body:has(.catalog-page) nav:not(#catalog-pagination) > div > div > div:last-child {
                    grid-area: actions;
                }
            }

            @media (max-width: 680px) {
                body:has(.catalog-page) nav:not(#catalog-pagination) > div {
                    width: calc(100% - 16px);
                    padding: 0;
                }
            }
        </style>

        <section class="bg-[#FAF8F2] px-4 pb-6 pt-5 text-center sm:px-6 lg:pb-6 lg:pt-5">
            <div class="mx-auto max-w-4xl">
                <div class="mb-2 inline-flex items-center gap-1 rounded-full bg-[#c4e7b5] px-2.5 py-0.5 text-[8px] font-medium text-[#42643a]">
                    <svg class="h-2.5 w-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    100% SOY WAX + MINYAK ATSIRI APEL MALANG ASLI
                </div>
                <h1 class="font-serif text-[1.8rem] font-bold leading-tight text-[#2C1810] sm:text-[1.8rem] lg:text-[1.8rem]">
                    Koleksi Produk Eksklusif <span class="italic text-[#8B1E1E]">NusaCandle</span>
                </h1>
                <p class="mx-auto mt-2 max-w-3xl text-[11px] leading-[1.55] text-[#718078]">
                    Satu Formula Tunggal Lilin Aromaterapi Aroma Apel, Dihadirkan dalam 10 Karya Seni Stiker<br
                        class="hidden sm:block">
                    Kemasan Gelas Khas Malang.
                </p>
                <div class="mx-auto mt-2 h-px w-14 bg-[#e6c6bd]"></div>
            </div>
        </section>

        <section class="bg-[#FAF8F2] px-6 pb-3 md:px-16">
            <div class="mx-auto max-w-6xl rounded-[10px] border border-[#eee8dc] bg-white p-3.5 shadow-sm">
                <div class="flex flex-row items-center gap-4">
                    <form action="{{ route('produk.index') }}" method="GET"
                        class="relative flex min-w-0 flex-1 items-center rounded-md border border-[#eee8dc] bg-[#FAF8F2] p-1.5">
                        @if (request('status'))
                            <input type="hidden" name="status" value="{{ request('status') }}">
                        @endif
                        <svg class="ml-1.5 h-3.5 w-3.5 shrink-0 text-[#8b7b68]" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="search" name="search" value="{{ request('search') }}"
                            placeholder="Cari edisi stiker kearifan lokal..."
                            class="h-6 min-w-0 flex-1 border border-[#c7c0b5] bg-white px-2 text-[9px] text-[#2C1810] outline-none placeholder:text-[#9a8f84] focus:border-[#8B1E1E]">
                    </form>

                    <div class="flex shrink-0 items-center gap-1.5">
                        <svg class="h-3 w-3 text-[#718078]" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M7 12h10m-7 6h4" />
                        </svg>
                        <span class="whitespace-nowrap text-[8px] text-[#5b554d]">Filter Status:</span>
                        <div class="flex items-center gap-0.5 rounded bg-[#f3efe6] p-0.5">
                            <a href="{{ route('produk.index', request()->except('status')) }}"
                                class="flex items-center gap-1 whitespace-nowrap rounded px-2 py-1 text-[8px] font-semibold transition {{ !request('status') || request('status') === 'ready' ? 'bg-white text-[#8B1E1E] shadow-sm' : 'text-[#718078] hover:bg-white/70' }}">
                                <span class="h-1.5 w-1.5 rounded-full bg-[#4d9851]"></span>
                                Semua (Ready)
                            </a>
                            <a href="{{ route('produk.index', array_merge(request()->except('status'), ['status' => 'preorder'])) }}"
                                class="whitespace-nowrap rounded px-2 py-1 text-[8px] transition {{ request('status') === 'preorder' ? 'bg-white font-semibold text-[#8B1E1E] shadow-sm' : 'text-[#5b554d] hover:bg-white/70' }}">
                                Pre-order
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-[#FAF8F2] px-6 pb-8 md:px-16 lg:pb-10">
            <div class="mx-auto max-w-6xl">
                <div id="catalog-grid" class="grid grid-cols-4 gap-2">
                    @forelse ($produk as $item)
                        <article class="catalog-product flex h-full flex-col overflow-hidden rounded-lg border border-[#eee8dc] bg-[#fffefa] shadow-sm transition duration-300 hover:shadow-md"
                            data-catalog-item>
                            <a href="{{ route('produk.show', $item->id_produk) }}" class="block">
                                <div class="catalog-product-media relative flex aspect-square items-center justify-center overflow-hidden">
                                    @if ($item->gambar)
                                        <img src="{{ asset('storage/' . $item->gambar) }}"
                                            alt="{{ $item->nama_produk }}" class="h-full w-full object-cover">
                                    @else
                                        <div class="catalog-candle" aria-hidden="true">
                                            <span class="catalog-candle-label"></span>
                                        </div>
                                    @endif
                                    <span class="absolute left-1.5 top-1.5 rounded-full bg-[#47784a] px-1.5 py-0.5 text-[5px] font-semibold text-white shadow-sm sm:left-2 sm:top-2 sm:text-[7px]">
                                        {{ Str::contains($item->nama_produk, '|') ? trim(Str::after($item->nama_produk, '|')) : 'Edisi Apel Malang' }}
                                    </span>
                                    <span class="absolute bottom-1.5 right-1.5 rounded bg-white/90 px-1.5 py-0.5 text-[5px] font-semibold text-[#2C1810] shadow-sm">
                                        Netto 220 gr
                                    </span>
                                </div>
                            </a>
                            <div class="flex flex-1 flex-col p-1.5 sm:p-2">
                                <a href="{{ route('produk.show', $item->id_produk) }}" class="block">
                                    <h3 class="catalog-card-title font-serif text-[8px] font-bold text-[#2C1810] sm:text-[10px]">
                                        {{ $item->nama_produk }}
                                    </h3>
                                </a>
                                <div class="mt-1 flex items-center justify-between gap-1">
                                    <div class="flex items-center gap-0.5 text-[5px] sm:text-[6px]">
                                        <span class="tracking-[-1px] text-[#b83232]" aria-hidden="true">☆☆☆☆☆</span>
                                        <span class="text-[#786e61]">Belum diulas</span>
                                    </div>
                                    <span class="shrink-0 whitespace-nowrap rounded-full bg-[#dff0d8] px-1.5 py-0.5 text-[5px] font-semibold text-[#47784a]">
                                        {{ $item->stok > 0 ? 'Stok Ready' : 'Pre-order' }}
                                    </span>
                                </div>
                                <p class="catalog-card-description mt-1 text-[6px] text-[#786e61]">
                                    Lilin aromaterapi soy wax dengan aroma apel khas Malang.
                                </p>
                                <div class="mt-auto flex items-baseline gap-1.5 border-t border-[#f1ece2] pt-1.5">
                                    <p class="font-serif text-[7px] font-bold text-[#8B1E1E] sm:text-[9px]">
                                        Rp {{ number_format($item->harga, 0, ',', '.') }}
                                    </p>
                                    <p class="text-[5px] text-[#9a8f84] line-through">
                                        Rp {{ number_format($item->harga + 25000, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center gap-1 px-1.5 pb-1.5 sm:px-2 sm:pb-2">
                                <a href="{{ route('produk.show', $item->id_produk) }}"
                                    class="flex min-w-0 flex-1 items-center justify-center gap-1 rounded bg-[#b83232] px-1 py-1 text-[5px] font-semibold text-white transition hover:bg-[#8B1E1E] sm:px-2 sm:py-1.5 sm:text-[8px]">
                                    Lihat Detail
                                    <span aria-hidden="true">→</span>
                                </a>
                                @if ($item->stok > 0)
                                    <form action="{{ route('keranjang.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id_produk" value="{{ $item->id_produk }}">
                                        <input type="hidden" name="jumlah" value="1">
                                        <button type="submit" aria-label="Tambah {{ $item->nama_produk }} ke keranjang"
                                            class="flex h-5 w-5 shrink-0 items-center justify-center rounded border border-[#eee8dc] text-[#8B1E1E] transition hover:bg-[#f3efe6] sm:h-6 sm:w-6">
                                            <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5m1.6 8l-1.2 2.2a1 1 0 00.9 1.5H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                        </button>
                                    </form>
                                @else
                                    <span title="Stok habis"
                                        class="flex h-5 w-5 shrink-0 items-center justify-center rounded border border-[#eee8dc] text-[#b8aa96] sm:h-6 sm:w-6">
                                        <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5m1.6 8l-1.2 2.2a1 1 0 00.9 1.5H17" />
                                        </svg>
                                    </span>
                                @endif
                            </div>
                        </article>
                    @empty
                        @if (request()->filled('search') || request()->filled('status'))
                            <div class="col-span-full rounded-2xl border border-[#eee8dc] bg-white px-6 py-14 text-center">
                                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-[#FAF8F2]">
                                    <svg class="h-7 w-7 text-[#8B1E1E]" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                                <h3 class="mt-4 font-serif text-xl font-bold text-[#2C1810]">Produk tidak ditemukan</h3>
                                <p class="mt-2 text-sm text-[#718078]">Coba gunakan kata kunci atau filter yang berbeda.</p>
                                <a href="{{ route('produk.index') }}"
                                    class="mt-5 inline-flex rounded-lg bg-[#8B1E1E] px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-[#6B1515]">
                                    Lihat semua produk
                                </a>
                            </div>
                        @else
                            @foreach (range(0, 4) as $demoSet)
                                @foreach ($demoProducts as $index => $demoProduct)
                                    @php
                                        $demoIndex = ($demoSet * count($demoProducts)) + $index;
                                    @endphp
                                <article class="catalog-product flex h-full flex-col overflow-hidden rounded-lg border border-[#eee8dc] bg-[#fffefa] shadow-sm"
                                    data-catalog-item>
                                    <div class="catalog-product-media relative flex aspect-square items-center justify-center overflow-hidden">
                                        <span class="absolute left-1.5 top-1.5 z-10 rounded-full bg-[#47784a] px-1.5 py-0.5 text-[5px] font-semibold text-white sm:text-[7px]">
                                            {{ Str::after($demoProduct['name'], '| ') }}
                                        </span>
                                        <span class="absolute bottom-1.5 right-1.5 z-10 rounded bg-white/90 px-1.5 py-0.5 text-[5px] font-semibold text-[#2C1810] shadow-sm">
                                            Netto 220 gr
                                        </span>
                                        <svg class="absolute inset-0 h-full w-full" viewBox="0 0 320 320"
                                            role="img" aria-label="Contoh foto produk {{ $demoProduct['name'] }}">
                                            <defs>
                                                <linearGradient id="demo-backdrop-{{ $demoIndex }}" x1="0" y1="0" x2="1" y2="1">
                                                    <stop offset="0" stop-color="{{ $demoProduct['accent'] }}" stop-opacity=".24" />
                                                    <stop offset=".55" stop-color="#f8f3e8" />
                                                    <stop offset="1" stop-color="#d8cbb2" />
                                                </linearGradient>
                                                <linearGradient id="demo-glass-{{ $demoIndex }}" x1="0" y1="0" x2="1" y2="0">
                                                    <stop offset="0" stop-color="#d9d2c2" stop-opacity=".82" />
                                                    <stop offset=".22" stop-color="#fffdf3" stop-opacity=".95" />
                                                    <stop offset=".78" stop-color="#f5f0e2" stop-opacity=".92" />
                                                    <stop offset="1" stop-color="#c5b99f" stop-opacity=".85" />
                                                </linearGradient>
                                                <filter id="demo-shadow-{{ $demoIndex }}" x="-.5" y="-.5" width="2" height="2">
                                                    <feGaussianBlur stdDeviation="9" />
                                                </filter>
                                            </defs>
                                            <rect width="320" height="320" fill="url(#demo-backdrop-{{ $demoIndex }})" />
                                            <circle cx="55" cy="68" r="52" fill="#ffffff" opacity=".23" />
                                            <circle cx="275" cy="92" r="38" fill="{{ $demoProduct['accent'] }}" opacity=".12" />
                                            <path d="M0 224C65 197 118 226 174 211s96-4 146-24v133H0z" fill="#bba88b" opacity=".5" />
                                            <path d="M0 256c67-18 134-9 196-18s92 4 124-9v91H0z" fill="#8f775d" opacity=".22" />
                                            <ellipse cx="160" cy="267" rx="78" ry="13" fill="#392d20" opacity=".22" filter="url(#demo-shadow-{{ $demoIndex }})" />
                                            <g fill="none" stroke="{{ $demoProduct['accent'] }}" stroke-linecap="round" opacity=".7">
                                                <path d="M42 220c25-25 34-51 26-82m-14 40c-14-2-22-11-25-24m33 7c14-7 21-18 22-33m156 93c-4-31 6-56 30-76m-20 41c-14-5-21-15-22-29m30 7c14-3 23-12 27-25" stroke-width="4" />
                                            </g>
                                            <g fill="{{ $demoProduct['accent'] }}" opacity=".56">
                                                <ellipse cx="51" cy="166" rx="17" ry="8" transform="rotate(32 51 166)" />
                                                <ellipse cx="79" cy="145" rx="18" ry="8" transform="rotate(-32 79 145)" />
                                                <ellipse cx="236" cy="172" rx="18" ry="8" transform="rotate(28 236 172)" />
                                                <ellipse cx="265" cy="151" rx="17" ry="8" transform="rotate(-34 265 151)" />
                                            </g>
                                            <g>
                                                <rect x="113" y="100" width="94" height="150" rx="17" fill="url(#demo-glass-{{ $demoIndex }})" stroke="#a99b80" stroke-width="3" />
                                                <ellipse cx="160" cy="103" rx="45" ry="9" fill="#fffdf1" stroke="#aa9b80" stroke-width="2" />
                                                <rect x="111" y="83" width="98" height="20" rx="5" fill="#b8aa8e" stroke="#8d8069" stroke-width="2" />
                                                <path d="M117 88h86" stroke="#e6ddcb" stroke-width="4" opacity=".8" />
                                                <rect x="122" y="151" width="76" height="57" rx="3" fill="{{ $demoProduct['label'] }}" stroke="#bca987" stroke-width="1.5" />
                                                <path d="M131 164h58" stroke="{{ $demoProduct['accent'] }}" stroke-width="2" opacity=".75" />
                                                <text x="160" y="180" text-anchor="middle" fill="{{ $demoProduct['accent'] }}" font-family="Georgia,serif" font-size="8" font-weight="bold">NUSACANDLE</text>
                                                <text x="160" y="193" text-anchor="middle" fill="#665b49" font-family="Arial,sans-serif" font-size="6">MALANG BOTANICAL</text>
                                                <path d="M121 113v30m8-30v24m63-20v40" stroke="#fff" stroke-width="3" opacity=".45" />
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="flex flex-1 flex-col p-1.5 sm:p-2">
                                        <div class="mb-1 flex items-center justify-between gap-1">
                                            <div class="flex items-center gap-0.5 text-[5px] sm:text-[6px]">
                                                <span class="tracking-[-1px] text-[#b83232]" aria-hidden="true">★★★★★</span>
                                                <span class="text-[#786e61]">({{ $demoProduct['reviews'] }})</span>
                                            </div>
                                            <span class="shrink-0 whitespace-nowrap rounded-full bg-[#dff0d8] px-1.5 py-0.5 text-[5px] font-semibold text-[#47784a]">
                                                Stok Ready
                                            </span>
                                        </div>
                                        <h3 class="catalog-card-title font-serif text-[8px] font-bold text-[#2C1810] sm:text-[10px]">
                                            {{ $demoProduct['name'] }}@if ($demoSet > 0) - Variasi {{ $demoSet + 1 }}@endif
                                        </h3>
                                        <p class="catalog-card-description mt-1 text-[6px] text-[#786e61]">
                                            Lilin aromaterapi soy wax dengan aroma apel khas Malang.
                                        </p>
                                        <div class="mt-auto flex items-baseline gap-1.5 border-t border-[#f1ece2] pt-1.5">
                                            <p class="font-serif text-[7px] font-bold text-[#8B1E1E] sm:text-[9px]">
                                                Rp {{ number_format($demoProduct['price'], 0, ',', '.') }}
                                            </p>
                                            <p class="text-[5px] text-[#9a8f84] line-through">
                                                Rp {{ number_format($demoProduct['price'] + 25000, 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-1 px-1.5 pb-1.5 sm:px-2 sm:pb-2">
                                        <a href="{{ route('produk.preview', $demoIndex) }}"
                                            class="flex-1 rounded bg-[#b83232] px-1 py-1 text-center text-[5px] font-semibold text-white transition hover:bg-[#8B1E1E] sm:py-1.5 sm:text-[8px]">
                                            Lihat Detail <span aria-hidden="true">→</span>
                                        </a>
                                        <button type="button" data-demo-cart-add
                                            data-demo-id="{{ $demoIndex }}"
                                            data-product-name="{{ $demoProduct['name'] }}@if ($demoSet > 0) - Variasi {{ $demoSet + 1 }}@endif"
                                            data-product-price="{{ $demoProduct['price'] }}"
                                            data-cart-url="{{ route('keranjang.index') }}"
                                            title="Tambah produk ke keranjang"
                                            aria-label="Tambah {{ $demoProduct['name'] }} ke keranjang"
                                            class="flex h-5 w-5 items-center justify-center rounded border border-[#eee8dc] text-[#8B1E1E] transition hover:bg-[#f3efe6] sm:h-6 sm:w-6">
                                            <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5m1.6 8l-1.2 2.2a1 1 0 00.9 1.5H17m0 0a2 2 0 100 4 2 2 0 000-4z" />
                                            </svg>
                                        </button>
                                    </div>
                                </article>
                                @endforeach
                            @endforeach
                        @endif
                    @endforelse
                </div>

                @if ($produk->isNotEmpty() || (!request()->filled('search') && !request()->filled('status')))
                    <nav id="catalog-pagination" class="mt-5 flex items-center justify-center gap-1" aria-label="Navigasi katalog">
                        <button type="button" data-page-direction="-1"
                            class="flex h-6 items-center justify-center rounded border border-[#e7dfd1] bg-white px-2 text-[8px] text-[#718078] transition hover:border-[#8B1E1E] hover:text-[#8B1E1E]"
                            aria-label="Halaman sebelumnya">
                            Sebelumnya
                        </button>
                        <div id="catalog-page-numbers" class="flex items-center gap-1"></div>
                        <button type="button" data-page-direction="1"
                            class="flex h-6 items-center justify-center rounded border border-[#e7dfd1] bg-white px-2 text-[8px] text-[#718078] transition hover:border-[#8B1E1E] hover:text-[#8B1E1E]"
                            aria-label="Halaman berikutnya">
                            Berikutnya
                        </button>
                    </nav>
                    <p id="catalog-pagination-label" class="mt-1 text-center text-[8px] text-[#8b8982]"
                        data-total="{{ $produk->isNotEmpty() ? $produk->count() : 50 }}"
                        data-demo="{{ $produk->isEmpty() ? 'true' : 'false' }}">
                        @if ($produk->isNotEmpty())
                            Menampilkan 1-{{ min($produk->count(), 10) }} dari {{ $produk->count() }} produk
                        @else
                            Menampilkan 10 dari 50 Desain Koleksi Khas Malang
                        @endif
                    </p>
                @endif
            </div>
        </section>

        <section class="bg-[#FAF8F2] px-4 pb-7 pt-4 sm:px-6 lg:pb-9">
            <div class="mx-auto max-w-7xl">
                <div class="mb-3 text-center">
                    <p class="text-[7px] font-bold uppercase tracking-[0.16em] text-[#62805c] sm:text-[9px]">
                        Standard Pengiriman NusaCandle
                    </p>
                    <h2 class="mt-1 font-serif text-sm font-semibold text-[#2C1810] sm:text-lg">
                        Jaminan Keamanan Hingga Meja Anda
                    </h2>
                </div>
                <div class="grid gap-2 md:grid-cols-3 sm:gap-3">
                    <article class="rounded-md border border-[#eee8dc] bg-[#fffefa] p-2.5 shadow-sm sm:p-4">
                        <div class="mb-2 flex h-7 w-7 items-center justify-center rounded bg-[#f3efe6] text-[#9b2424]">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M12 3l8 3v5c0 5-3.4 8.3-8 10-4.6-1.7-8-5-8-10V6l8-3z" />
                            </svg>
                        </div>
                        <h3 class="font-serif text-[10px] font-semibold text-[#2C1810] sm:text-sm">
                            Proteksi Honeycomb Wrap
                        </h3>
                        <p class="mt-1 text-[8px] leading-[1.55] text-[#786e61] sm:text-[11px]">
                            Setiap toples lilin dilapisi kemasan <em>honeycomb kraft paper</em> tebal 3 lapis ramah
                            lingkungan plus bantalan busa teruji jatuh. Garansi toples pecah kami ganti baru 100% gratis.
                        </p>
                        <p class="mt-1.5 flex items-center gap-1 text-[7px] font-semibold text-[#4c754e] sm:text-[9px]">
                            <span aria-hidden="true">✓</span> Bebas Plastik Sekali Pakai
                        </p>
                    </article>
                    <article class="rounded-md border border-[#eee8dc] bg-[#fffefa] p-2.5 shadow-sm sm:p-4">
                        <div class="mb-2 flex h-7 w-7 items-center justify-center rounded bg-[#f3efe6] text-[#a42b26]">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 2v3m0 14v3m10-10h-3M5 12H2m17.07 7.07l-2.12-2.12M7.05 7.05L4.93 4.93m14.14 0l-2.12 2.12M7.05 16.95l-2.12 2.12M12 8v4l2.5 2.5" />
                            </svg>
                        </div>
                        <h3 class="font-serif text-[10px] font-semibold text-[#2C1810] sm:text-sm">
                            Jaminan Aroma Tahan Lama
                        </h3>
                        <p class="mt-1 text-[8px] leading-[1.55] text-[#786e61] sm:text-[11px]">
                            Menggunakan konsentrasi <em>fragrance load</em> optimal 10% grade terapeutik. Aroma menyebar
                            rata ke seluruh ruangan tanpa menyebabkan sakit kepala atau rasa enek.
                        </p>
                        <p class="mt-1.5 flex items-center gap-1 text-[7px] font-semibold text-[#4c754e] sm:text-[9px]">
                            <span aria-hidden="true">✓</span> Sertifikasi Formula Aman
                        </p>
                    </article>
                    <article class="rounded-md border border-[#eee8dc] bg-[#fffefa] p-2.5 shadow-sm sm:p-4">
                        <div class="mb-2 flex h-7 w-7 items-center justify-center rounded bg-[#f3efe6] text-[#537a50]">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l9-5 9 5-9 5-9-5zm0 0v9l9 5 9-5V8m-9 5v9m-5-17l10 6" />
                            </svg>
                        </div>
                        <h3 class="font-serif text-[10px] font-semibold text-[#2C1810] sm:text-sm">
                            Batch Segar Kota Malang
                        </h3>
                        <p class="mt-1 text-[8px] leading-[1.55] text-[#786e61] sm:text-[11px]">
                            Diproduksi dalam kelompok kecil (<em>small-batch</em>) maksimal 50 toples per proses tuang
                            untuk menjaga kepadatan lilin soy dan kestabilan wangi atsiri apel segar.
                        </p>
                        <p class="mt-1.5 flex items-center gap-1 text-[7px] font-semibold text-[#4c754e] sm:text-[9px]">
                            <span aria-hidden="true">▣</span> Pengiriman Reguler &amp; Same-day
                        </p>
                    </article>
                </div>

                <div class="mt-4 flex flex-col gap-3 rounded-md border border-[#eee8dc] bg-[#fffefa] p-3.5 shadow-sm sm:flex-row sm:items-center sm:justify-between sm:px-6 sm:py-5">
                    <div class="max-w-xl">
                        <p class="flex items-center gap-1 text-[7px] font-semibold uppercase tracking-wide text-[#a42b26] sm:text-[9px]">
                            <span aria-hidden="true">✥</span> Ritual Nyala NusaCandle
                        </p>
                        <h2 class="mt-1 font-serif text-sm font-medium leading-tight text-[#2C1810] sm:text-lg">
                            Mengapa Kami Mempertahankan Satu Formula Aroma?
                        </h2>
                        <p class="mt-1 text-[8px] leading-[1.55] text-[#786e61] sm:text-[10px]">
                            Kami percaya pada kesempurnaan fokus. Lilin kedelai kami dipadukan khusus dengan ekstrak apel
                            Malang autentik, sementara 10 edisi stiker merayakan kekayaan budaya dan panorama agung Malang Raya.
                        </p>
                    </div>
                    <div class="flex shrink-0 items-center justify-end gap-2">
                        <div class="text-center">
                            <p class="font-serif text-[11px] font-bold text-[#9b2424] sm:text-sm">10 Desain</p>
                            <p class="text-[6px] text-[#786e61] sm:text-[8px]">Kearifan Lokal Malang</p>
                        </div>
                        <a href="{{ route('pembeli.transaksi.index') }}"
                            class="inline-flex items-center gap-1 whitespace-nowrap rounded bg-[#f3efe6] px-2.5 py-2 text-[7px] font-semibold text-[#2C1810] transition hover:bg-[#e9e1d3] sm:px-3 sm:text-[9px]">
                            <svg class="h-3 w-3 text-[#9b2424]" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M8 3H5a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2V8l-5-5h-3M8 3v5h5M8 13h8m-8 4h8" />
                            </svg>
                            Riwayat Pembelian
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        (() => {
            document.addEventListener('click', (event) => {
                if (!(event.target instanceof Element)) {
                    return;
                }

                const button = event.target.closest('[data-demo-cart-add]');
                if (!button) {
                    return;
                }

                try {
                    const cartKey = 'nusacandle-demo-cart';
                    const cart = JSON.parse(localStorage.getItem(cartKey) || '[]');
                    const validItem = (item) => item
                        && typeof item.id === 'string'
                        && typeof item.name === 'string'
                        && Number.isSafeInteger(item.price)
                        && item.price >= 0
                        && Number.isSafeInteger(item.quantity)
                        && item.quantity > 0;
                    const product = {
                        id: button.dataset.demoId,
                        name: button.dataset.productName,
                        price: Number(button.dataset.productPrice),
                        quantity: 1
                    };

                    if (!Array.isArray(cart) || !cart.every(validItem)
                        || !product.id || !product.name
                        || !Number.isSafeInteger(product.price) || product.price < 0) {
                        throw new Error('Data produk demo tidak valid.');
                    }

                    const existingProduct = cart.find((item) => item.id === product.id);
                    if (existingProduct) {
                        existingProduct.quantity += 1;
                    } else {
                        cart.push(product);
                    }

                    localStorage.setItem(cartKey, JSON.stringify(cart));
                    window.location.assign(button.dataset.cartUrl);
                } catch (error) {
                    console.error('Produk demo gagal ditambahkan ke keranjang.', error);
                    alert('Produk demo tidak dapat disimpan di browser ini.');
                }
            });

            const grid = document.getElementById('catalog-grid');
            const pagination = document.getElementById('catalog-pagination');
            const numbers = document.getElementById('catalog-page-numbers');
            const paginationLabel = document.getElementById('catalog-pagination-label');

            if (!grid || !pagination || !numbers || !paginationLabel) {
                return;
            }

            const cards = Array.from(grid.querySelectorAll('[data-catalog-item]'));
            const pageSize = 10;
            const pageCount = Math.max(1, Math.ceil(cards.length / pageSize));
            const total = Number(paginationLabel.dataset.total);
            const isDemo = paginationLabel.dataset.demo === 'true';
            let currentPage = 1;

            const renderPage = () => {
                cards.forEach((card, index) => {
                    card.hidden = index < (currentPage - 1) * pageSize || index >= currentPage * pageSize;
                });

                const firstItem = (currentPage - 1) * pageSize + 1;
                const lastItem = Math.min(currentPage * pageSize, total);
                paginationLabel.textContent = isDemo
                    ? `Menampilkan ${lastItem} dari ${total} Desain Koleksi Khas Malang`
                    : `Menampilkan ${firstItem}-${lastItem} dari ${total} produk`;

                numbers.replaceChildren();
                for (let page = 1; page <= pageCount; page += 1) {
                    const button = document.createElement('button');
                    button.type = 'button';
                    button.textContent = String(page);
                    button.setAttribute('aria-label', `Halaman ${page}`);
                    button.className = page === currentPage
                        ? 'h-6 min-w-6 rounded bg-[#8B1E1E] px-2 text-[10px] font-semibold text-white'
                        : 'h-6 min-w-6 rounded border border-[#e7dfd1] bg-white px-2 text-[10px] font-semibold text-[#718078] transition hover:border-[#8B1E1E] hover:text-[#8B1E1E]';
                    button.addEventListener('click', () => {
                        currentPage = page;
                        renderPage();
                    });
                    numbers.append(button);
                }

                pagination.querySelectorAll('[data-page-direction]').forEach((button) => {
                    button.disabled = (button.dataset.pageDirection === '-1' && currentPage === 1)
                        || (button.dataset.pageDirection === '1' && currentPage === pageCount);
                    button.classList.toggle('cursor-not-allowed', button.disabled);
                    button.classList.toggle('opacity-40', button.disabled);
                });
            };

            pagination.querySelectorAll('[data-page-direction]').forEach((button) => {
                button.addEventListener('click', () => {
                    currentPage += Number(button.dataset.pageDirection);
                    renderPage();
                });
            });

            renderPage();
        })();
    </script>
@endsection
