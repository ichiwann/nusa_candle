@extends('layouts.pembeli')

@section('title', 'Poin & Loyalitas Saya - NusaCandle')

@section('content')
    <style>
        body:has(.poin-page) {
            background: #faf7ed;
        }

        body:has(.poin-page) nav:not(#catalog-pagination) {
            border-top: 3px solid #8b1e1e;
            background: #faf7ed;
            box-shadow: none;
        }

        body:has(.poin-page) footer {
            margin-top: 1.5rem;
            border-top-color: #e8dfcf;
            background: #f5f0e2;
        }

        body:has(.poin-page) .points-breadcrumb {
            display: none;
        }

        .poin-page {
            max-width: 80rem;
            padding: 0.75rem 1rem 1.25rem;
            color: #2c1810;
        }

        .poin-page .points-intro {
            display: block;
            margin-bottom: 0.75rem;
        }

        .poin-page .points-intro > div {
            margin-bottom: 0.25rem !important;
        }

        .poin-page .points-intro h1 {
            margin: 0.25rem 0;
            font-size: 1.2rem;
            line-height: 1.2;
        }

        .poin-page .points-intro > p {
            max-width: 42rem;
            margin: 0;
            font-size: 0.58rem;
            line-height: 1.45;
        }

        .poin-page .points-layout {
            display: grid;
            grid-template-columns: minmax(0, 2fr) minmax(15rem, 0.95fr);
            align-items: start;
            gap: 0.65rem;
            margin-bottom: 0.65rem;
        }

        .poin-page .points-layout > div {
            display: flex;
            min-width: 0;
            flex-direction: column;
            gap: 0.65rem;
        }

        .poin-page .points-summary,
        .poin-page .points-reward,
        .poin-page .points-guide,
        .poin-page .points-redeem,
        .poin-page .points-history,
        .poin-page .points-shipping {
            min-width: 0;
            margin: 0 !important;
            border: 1px solid #e8dfcf !important;
            border-radius: 0.5rem !important;
            background: #fff !important;
            padding: 0.7rem !important;
            box-shadow: 0 1px 3px rgb(44 24 16 / 6%) !important;
        }

        .poin-page .points-summary {
            background: linear-gradient(115deg, #fff 0%, #fbfaf5 58%, #f5f8ee 100%) !important;
        }

        .poin-page .points-summary > .flex.items-start.justify-between {
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.55rem !important;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #f1ece2;
        }

        .poin-page .points-summary .w-12.h-12 {
            width: 1.8rem;
            height: 1.8rem;
            font-size: 0.7rem;
        }

        .poin-page .points-summary h3 {
            font-size: 0.72rem;
            line-height: 1.2;
        }

        .poin-page .points-summary .grid.md\:grid-cols-2 {
            gap: 0.5rem;
        }

        .poin-page .points-balance,
        .poin-page .points-rule,
        .poin-page .points-progress,
        .poin-page .points-status,
        .poin-page .points-guide-note,
        .poin-page .points-redeem-note {
            border-radius: 0.35rem !important;
            padding: 0.55rem !important;
        }

        .poin-page .points-balance > div > span:first-child {
            font-size: 1.5rem;
            line-height: 1;
        }

        .poin-page .points-balance > div > span:last-child {
            font-size: 0.62rem;
        }

        .poin-page .points-balance > p:last-child {
            font-size: 0.5rem;
        }

        .poin-page .points-rule > p:nth-of-type(1) {
            font-size: 0.62rem;
            line-height: 1.4;
        }

        .poin-page .points-rule > p:last-child {
            font-size: 0.48rem;
        }

        .poin-page .points-progress {
            margin-top: 0.5rem !important;
        }

        .poin-page .points-progress > div:first-child {
            margin-bottom: 0.35rem !important;
        }

        .poin-page .points-progress > div:first-child p,
        .poin-page .points-progress > div:last-child {
            font-size: 0.48rem;
        }

        .poin-page .points-progress .h-3 {
            height: 0.35rem;
            margin-bottom: 0.3rem !important;
        }

        .poin-page .points-status {
            margin-top: 0.5rem !important;
            border-left: 3px solid #d6aa52 !important;
        }

        .poin-page .points-status p {
            font-size: 0.5rem;
            line-height: 1.45;
        }

        .poin-page .points-reward-heading {
            align-items: flex-start;
            gap: 0.45rem;
            margin-bottom: 0.55rem !important;
        }

        .poin-page .points-reward-heading h3 {
            margin-top: 0.15rem !important;
            font-size: 0.78rem;
            line-height: 1.25;
        }

        .poin-page .points-reward-heading p {
            margin-top: 0.15rem;
            font-size: 0.5rem;
            line-height: 1.4;
        }

        .poin-page .points-reward-product {
            gap: 0.55rem;
            margin-bottom: 0.55rem !important;
            padding: 0.55rem !important;
        }

        .poin-page .points-reward-art {
            width: 3.2rem;
            height: 3.2rem;
            border: 1px solid #eee5d7;
            background: radial-gradient(circle at 50% 35%, #fff 0, #f3eddf 72%);
        }

        .poin-page .points-reward-product h4 {
            margin-bottom: 0.2rem !important;
            font-size: 0.62rem;
            line-height: 1.3;
        }

        .poin-page .points-reward-product p {
            margin-bottom: 0.3rem !important;
            font-size: 0.48rem;
            line-height: 1.4;
        }

        .poin-page .points-reward-footer {
            gap: 0.4rem;
        }

        .poin-page .points-reward-footer p {
            font-size: 0.5rem;
            line-height: 1.4;
        }

        .poin-page .points-guide h3,
        .poin-page .points-redeem h3 {
            font-size: 0.72rem;
        }

        .poin-page .points-guide > h4,
        .poin-page .points-redeem > div > h4 {
            margin-bottom: 0.45rem !important;
            font-size: 0.58rem;
        }

        .poin-page .points-guide-steps {
            gap: 0.5rem !important;
        }

        .poin-page .points-guide-steps p,
        .poin-page .points-guide-note p,
        .poin-page .points-redeem p {
            font-size: 0.49rem;
            line-height: 1.4;
        }

        .poin-page .points-guide-note,
        .poin-page .points-redeem-note {
            margin-top: 0.55rem !important;
        }

        .poin-page .points-redeem-description {
            margin-bottom: 0.5rem !important;
        }

        .poin-page .points-redeem input {
            padding: 0.45rem 0.55rem;
            font-size: 0.55rem;
        }

        .poin-page .points-redeem button {
            padding: 0.45rem 0.65rem;
            font-size: 0.55rem;
        }

        .poin-page .points-history-heading {
            gap: 0.5rem;
            margin-bottom: 0.5rem !important;
        }

        .poin-page .points-history-heading h3 {
            font-size: 0.8rem;
        }

        .poin-page .points-history-heading p,
        .poin-page .points-history td,
        .poin-page .points-history th {
            font-size: 0.48rem;
            line-height: 1.35;
        }

        .poin-page .points-history th,
        .poin-page .points-history td {
            padding: 0.4rem 0.5rem !important;
        }

        .poin-page .points-history td p {
            font-size: 0.5rem;
        }

        .poin-page .points-history-footer {
            gap: 0.5rem;
            margin-top: 0.5rem !important;
            padding-top: 0.45rem !important;
        }

        .poin-page .points-shipping h4 {
            font-size: 0.7rem;
        }

        .poin-page .points-shipping p,
        .poin-page .points-shipping a {
            font-size: 0.5rem;
            line-height: 1.4;
        }

        .poin-page .points-shipping a {
            padding: 0.45rem 0.65rem;
        }

        @media (max-width: 900px) {
            .poin-page .points-layout {
                grid-template-columns: minmax(0, 1fr);
                gap: 0.55rem;
            }

            .poin-page .points-layout > div {
                display: contents;
            }

            .poin-page .points-summary {
                order: 1;
            }

            .poin-page .points-guide {
                order: 2;
            }

            .poin-page .points-reward {
                order: 3;
            }

            .poin-page .points-redeem {
                order: 4;
            }

            .poin-page .points-reward-heading > span {
                flex-shrink: 0;
            }
        }

        @media (max-width: 420px) {
            .poin-page .points-reward-footer {
                align-items: stretch;
                flex-direction: column;
            }

            .poin-page .points-history-heading {
                align-items: flex-start;
                flex-direction: column;
            }

            .poin-page .points-shipping > div {
                align-items: flex-start;
            }
        }
    </style>
    {{-- Breadcrumb --}}
    <div class="points-breadcrumb bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center gap-2 text-sm">
                <a href="{{ route('home') }}" class="text-[#718078] hover:text-[#8B1E1E]">Beranda</a>
                <span class="text-[#718078]">/</span>
                <span class="text-[#8B1E1E] font-semibold">Poin Saya</span>
            </div>
        </div>
    </div>

    <div class="poin-page mx-auto w-full px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="points-intro">
            <div class="flex items-center gap-2 mb-2">
                <svg class="w-6 h-6 text-[#2E7D32]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span
                    class="text-xs font-semibold uppercase tracking-wider text-[#2E7D32] bg-[#E8F5E9] px-2 py-0.5 rounded">Program
                    Loyalitas Artisan Malang</span>
            </div>
            <h1 class="font-serif text-4xl font-bold text-[#2C1810] mb-2">Poin & Loyalitas Saya</h1>
            <p class="text-[#718078] max-w-3xl">Kumpulkan poin dari setiap pembelian dan nikmati lilin aromaterapi aroma
                apel gratis yang dituangkan hangat dari kota Batu & Malang.</p>
        </div>

        {{-- Notifikasi --}}
        @if (session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-md">
                {{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-md">
                <ul class="list-inside list-disc space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- ✅ GRID UTAMA: Panel Kiri (2/3) + Panel Kanan (1/3) --}}
        <div class="points-layout">

            {{-- PANEL KIRI (col-span-2) --}}
            <div class="space-y-6">

                {{-- Kartu Info User & Poin --}}
                <div class="points-summary bg-gradient-to-br from-[#FAF9F6] to-[#F5F5F5] rounded-lg p-6 border border-gray-200">
                    <div class="flex items-start justify-between mb-6">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-12 h-12 rounded-full bg-[#8B1E1E] text-white flex items-center justify-center text-lg font-bold">
                                {{ mb_substr($user->nama_lengkap, 0, 1) }}
                            </div>
                            <div>
                                <h3 class="font-serif text-xl font-bold text-[#2C1810]">{{ $user->nama_lengkap }}</h3>
                                <p class="text-xs text-[#718078]">ID Anggota:
                                    #NC-MBR-{{ str_pad($user->id_user, 4, '0', STR_PAD_LEFT) }}-{{ $user->created_at->format('Y') }}
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="rounded px-2 py-1 text-[8px] font-semibold {{ $membershipStatus['bg'] }} {{ $membershipStatus['color'] }}">
                                {{ $membershipStatus['label'] }}
                            </span>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-4">
                        {{-- Saldo Poin --}}
                        <div class="points-balance bg-white rounded-lg p-5 shadow-sm">
                            <p class="text-xs font-semibold uppercase tracking-wider text-[#718078] mb-2">Saldo Poin Saat
                                Ini</p>
                            <div class="flex items-baseline gap-2">
                                <span
                                    class="font-serif text-5xl font-bold text-[#8B1E1E]">{{ number_format($currentPoin) }}</span>
                                <span class="text-lg text-[#718078]">Poin</span>
                            </div>
                            <p class="text-xs text-[#718078] mt-2">Terkumpul dari pembelian Lilin Apel Kota Batu.</p>
                        </div>

                        {{-- Aturan Hadiah --}}
                        <div class="points-rule bg-[#E8F5E9] rounded-lg p-5 border border-[#C8E6C9]">
                            <div class="flex items-center gap-2 mb-2">
                                <svg class="w-5 h-5 text-[#2E7D32]" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="text-xs font-semibold text-[#2E7D32]">Aturan Hadiah Loyalitas</p>
                            </div>
                            <p class="text-sm text-[#1B5E20] leading-relaxed">Kumpulkan <strong>70 Poin NusaCandle</strong>
                                untuk mendapatkan <strong>1x Refill Lilin Aroma Terapi Aroma Apel Gratis</strong>.</p>
                            <p class="text-xs text-[#2E7D32] mt-2 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Setiap belanja Rp10.000 = 1 Poin otomatis
                            </p>
                        </div>
                    </div>

                    {{-- Progress Bar --}}
                    <div class="points-progress mt-6 bg-white rounded-lg p-5 shadow-sm">
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-[#8B1E1E]" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                </svg>
                                <p class="text-sm font-semibold text-[#2C1810]">Kemajuan Menuju Hadiah Refill</p>
                            </div>
                            <p class="text-sm font-bold text-[#8B1E1E]">{{ $currentPoin }} / {{ $targetPoin }} Poin
                                ({{ number_format($progressPercentage) }}%)</p>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-3 mb-3">
                            <div class="bg-gradient-to-r from-[#8B1E1E] to-[#2E7D32] h-3 rounded-full transition-all duration-500"
                                style="width: {{ $progressPercentage }}%"></div>
                        </div>
                        <div class="flex justify-between text-xs text-[#718078]">
                            <span>0 Poin</span>
                            <span>35 Poin (50%)</span>
                            <span class="font-semibold text-[#2E7D32]">{{ $targetPoin }} Poin (Target Refill)</span>
                        </div>
                    </div>

                    {{-- Status --}}
                    <div
                        class="points-status mt-6 bg-white rounded-lg p-5 shadow-sm {{ $kurangPoin > 0 ? 'border-yellow-500' : 'border-green-500' }}">
                        <div class="flex items-start gap-3">
                            @if ($kurangPoin > 0)
                                <svg class="w-6 h-6 text-yellow-600 flex-shrink-0 mt-0.5" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div>
                                    <p class="font-semibold text-[#2C1810]">Status: Belum Memenuhi Syarat</p>
                                    <p class="text-sm text-[#718078] mt-1">Kurang <strong
                                            class="text-[#8B1E1E]">{{ $kurangPoin }} Poin</strong> lagi untuk mendapatkan
                                        1x Refill Lilin Aroma Terapi Aroma Apel Gratis.</p>
                                </div>
                            @else
                                <svg class="w-6 h-6 text-green-600 flex-shrink-0 mt-0.5" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div>
                                    <p class="font-semibold text-[#2C1810]">Status: <span class="text-green-600">Siap
                                            Klaim Hadiah!</span></p>
                                    <p class="text-sm text-[#718078] mt-1">Selamat! Anda sudah bisa menukarkan poin dengan
                                        hadiah refill lilin.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- ✅ SECTION KLAIM HADIAH (DIPINDAH KE SINI - di dalam Panel Kiri) --}}
                <div class="points-reward bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="points-reward-heading flex items-center justify-between mb-6">
                        <div class="flex items-center gap-3">
                            <div class="bg-[#E8F5E9] p-2 rounded-lg">
                                <svg class="w-6 h-6 text-[#2E7D32]" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </div>
                            <div>
                                <span
                                    class="text-xs font-semibold uppercase tracking-wider text-[#2E7D32] bg-[#E8F5E9] px-2 py-0.5 rounded">Section
                                    Klaim Hadiah</span>
                                <h3 class="font-serif text-2xl font-bold text-[#2C1810] mt-1">1x Refill Lilin Aroma Terapi
                                    Aroma Apel Gratis</h3>
                                <p class="text-xs text-[#718078]">Hadiah eksklusif bagi pelanggan setia pecinta wangi
                                    botanikal apel Batu & Malang.</p>
                            </div>
                        </div>
                        <span class="text-xs font-semibold text-[#8B1E1E] bg-[#FCE4EC] px-3 py-1 rounded-full">Syarat:
                            {{ $targetPoin }} Poin</span>
                    </div>

                    {{-- Produk Hadiah --}}
                    <div class="points-reward-product bg-[#FAF9F6] rounded-lg p-5 mb-6">
                        <div class="flex items-start gap-4">
                            <div class="relative flex-shrink-0">
                                <div class="points-reward-art w-24 h-24 rounded-lg flex items-center justify-center">
                                    <svg class="h-10 w-10" viewBox="0 0 64 64" fill="none" role="img" aria-label="Ilustrasi lilin refill">
                                        <path d="M32 5c-6 8-4 12 0 15 4-3 6-7 0-15Z" fill="#E99B43" />
                                        <path d="M32 10c-2 3-2 5 0 7 2-2 2-4 0-7Z" fill="#FFF1BC" />
                                        <path d="M32 19v5" stroke="#604A35" stroke-width="2" />
                                        <path d="M17 25h30l-3 29a5 5 0 01-5 5H25a5 5 0 01-5-5l-3-29Z" fill="#536044" stroke="#B6AA91" stroke-width="2" />
                                        <ellipse cx="32" cy="25" rx="15" ry="4" fill="#E9DFC9" stroke="#B6AA91" stroke-width="2" />
                                        <path d="M22 36h20v10H22z" fill="#F8F2E3" />
                                        <path d="M25 40h14M25 43h10" stroke="#8B7658" stroke-width="1.5" stroke-linecap="round" />
                                    </svg>
                                </div>
                                <span
                                    class="absolute -top-2 -left-2 bg-[#8B1E1E] text-white text-[10px] font-bold px-2 py-0.5 rounded">Refill
                                    Jar</span>
                            </div>
                            <div class="flex-1">
                                <p class="text-xs font-semibold uppercase tracking-wider text-[#718078] mb-1">Varian
                                    Tunggal Eksklusif</p>
                                <h4 class="font-serif text-lg font-bold text-[#2C1810] mb-2">NusaCandle - Lilin Aroma
                                    Terapi Aroma Apel</h4>
                                <p class="text-xs text-[#718078] leading-relaxed mb-3">200gr 100% Natural Soy Wax dengan
                                    minyak atsiri apel manalagi Malang murni. Ramah lingkungan, bebas racun, pembakaran
                                    bersih hingga 45 jam.</p>
                                <div class="flex flex-wrap gap-2">
                                    <span class="text-[10px] bg-white border border-gray-200 px-2 py-1 rounded">Berat:
                                        200gr</span>
                                    <span class="text-[10px] bg-white border border-gray-200 px-2 py-1 rounded">100% Cotton
                                        Wick</span>
                                    <span
                                        class="text-[10px] bg-[#E8F5E9] text-[#2E7D32] border border-[#C8E6C9] px-2 py-1 rounded font-semibold">Rp0
                                        (Tukar {{ $targetPoin }} Poin)</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Status Hadiah + Form Klaim --}}
                    <div class="points-reward-footer flex flex-wrap items-center justify-between gap-4">
                        <div class="flex items-start gap-3 flex-1 min-w-[300px]">
                            @if ($kurangPoin > 0)
                                <svg class="w-6 h-6 text-gray-400 flex-shrink-0 mt-0.5" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                <div>
                                    <p class="text-sm font-semibold text-[#2C1810]">Status Hadiah: <span
                                            class="text-orange-600">Terkunci</span></p>
                                    <p class="text-xs text-[#718078] mt-1">Kumpulkan {{ $targetPoin }} poin untuk
                                        membuka hadiah (Kurang {{ $kurangPoin }} poin lagi).</p>
                                </div>
                            @else
                                <svg class="w-6 h-6 text-[#2E7D32] flex-shrink-0 mt-0.5" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z" />
                                </svg>
                                <div>
                                    <p class="text-sm font-semibold text-[#2C1810]">Status Hadiah: <span
                                            class="text-[#2E7D32] font-bold">Siap Diklaim!</span></p>
                                    <p class="text-xs text-[#2E7D32] mt-1">Selamat! Poin Anda sudah cukup untuk menukarkan
                                        1x Refill Lilin Aroma Terapi Aroma Apel Gratis.</p>
                                </div>
                            @endif
                        </div>

                        @if ($kurangPoin <= 0)
                            <form action="{{ route('poin.klaim') }}" method="POST"
                                class="flex items-center gap-3 justify-end"
                                onsubmit="return confirm('Tukarkan 70 poin untuk 1x Refill Lilin Aroma Apel Gratis? Poin akan berkurang 70.')">
                                @csrf
                                <button type="submit"
                                    class="bg-[#8B1E1E] hover:bg-[#6B1515] text-white px-6 py-3 rounded-md text-sm font-semibold transition flex items-center gap-2 shadow-sm whitespace-nowrap">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                    Klaim Hadiah
                                </button>
                            </form>
                        @else
                            <div
                                class="bg-[#FAF9F6] border-2 border-dashed border-[#8B1E1E]/30 rounded-lg px-5 py-3 text-center flex-1 min-w-[300px]">
                                <p class="flex items-center gap-1 text-sm font-semibold text-[#8B1E1E]">
                                    <svg class="h-3 w-3 shrink-0" viewBox="0 0 32 32" fill="none" aria-hidden="true">
                                        <path d="M16 3c-3 4-2 6 0 8 2-2 3-4 0-8Z" fill="#E99B43" />
                                        <rect x="8" y="12" width="16" height="16" rx="3" fill="#536044" />
                                        <path d="M11 19h10v5H11z" fill="#E9DFC9" />
                                    </svg>
                                    Ayo kumpulkan poin lagi untuk mendapatkan lilin gratis!
                                </p>
                                <p class="text-xs text-[#718078] mt-1">Tinggal {{ $kurangPoin }} poin lagi menuju hadiah
                                    refill.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- PANEL KANAN (col-span-1) --}}
            <div class="space-y-6">
                {{-- Panduan Tambah Poin --}}
                <div class="points-guide bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center gap-2 mb-4">
                        <svg class="w-5 h-5 text-[#2E7D32]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="font-serif text-lg font-bold text-[#2C1810]">Panduan Tambah Poin</h3>
                    </div>
                    <h4 class="font-semibold text-[#2C1810] mb-4">Tips Panen Poin Lilin Apel</h4>

                    <div class="points-guide-steps space-y-4">
                        <div class="flex items-start gap-3">
                            <div
                                class="w-6 h-6 rounded-full bg-[#FCE4EC] text-[#8B1E1E] flex items-center justify-center text-xs font-bold flex-shrink-0">
                                1</div>
                            <div>
                                <p class="text-sm font-semibold text-[#2C1810]">Beli Varian Lilin Apel</p>
                                <p class="text-xs text-[#718078]">Setiap Rp10.000 belanja lilin aroma apel Kota Batu
                                    menghasilkan 1 poin otomatis.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div
                                class="w-6 h-6 rounded-full bg-[#FCE4EC] text-[#8B1E1E] flex items-center justify-center text-xs font-bold flex-shrink-0">
                                2</div>
                            <div>
                                <p class="text-sm font-semibold text-[#2C1810]">Tulis Ulasan Berfoto</p>
                                <p class="text-xs text-[#718078]">Dapatkan hingga +10 poin ekstra untuk setiap ulasan
                                    hangat lilin aroma apel.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div
                                class="w-6 h-6 rounded-full bg-[#FCE4EC] text-[#8B1E1E] flex items-center justify-center text-xs font-bold flex-shrink-0">
                                3</div>
                            <div>
                                <p class="text-sm font-semibold text-[#2C1810]">Tukarkan Voucher Acara</p>
                                <p class="text-xs text-[#718078]">Gunakan kode khusus pameran kriya di section Tukarkan
                                    Redeem Code di bawah.</p>
                            </div>
                        </div>
                    </div>

                    <div class="points-guide-note mt-6 bg-[#FAF9F6] rounded-lg p-4 border border-gray-200">
                        <p class="text-[10px] font-semibold uppercase tracking-wider text-[#2E7D32] mb-2">Komitmen Alami
                        </p>
                        <p class="text-xs text-[#718078] italic">"Kebaikan aroma murni apel Malang yang menemani setiap
                            sudut relaksasi keluarga Anda."</p>
                    </div>
                </div>

                {{-- Tukarkan Redeem Code --}}
                <div class="points-redeem bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center gap-2 mb-4">
                        <svg class="w-5 h-5 text-[#8B1E1E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                        </svg>
                        <h3 class="font-serif text-lg font-bold text-[#2C1810]">Tukarkan Redeem Code</h3>
                    </div>

                    <div class="mb-6">
                        <h4 class="font-semibold text-[#2C1810] mb-2">Punya Kode Promo / Voucher Event?</h4>
                        <p class="points-redeem-description text-xs text-[#718078] mb-4">Tukarkan kode promosi festival kriya atau kartu hadiah
                            khusus untuk langsung menikmati lilin aromaterapi aroma apel Malang.</p>

                        <div class="points-redeem-note bg-[#FCE4EC] rounded-lg p-4 border border-[#F8BBD0]">
                            <div class="flex items-start gap-2 mb-2">
                                <svg class="w-4 h-4 text-[#8B1E1E] flex-shrink-0 mt-0.5" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="text-xs font-semibold text-[#8B1E1E]">Ketentuan Khusus Voucher</p>
                            </div>
                            <p class="text-xs text-[#2C1810]">Redeem code hanya dapat digunakan untuk: <strong>1x Refill
                                    Lilin Aroma Terapi Aroma Apel Gratis</strong>.</p>
                            <p class="text-[10px] text-[#718078] mt-2 italic">*Hadiah tidak dapat ditukarkan atau ditukar
                                aroma lain karena NusaCandle murni spesialis aroma apel Malang.</p>
                        </div>
                    </div>

                    <form action="{{ route('poin.redeem') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label
                                class="block text-xs font-semibold uppercase tracking-wider text-[#718078] mb-2">Masukkan
                                Redeem Code</label>
                            <input type="text" name="kode_redeem" placeholder="MASUKKAN REDEEM CODE"
                                class="w-full px-4 py-2.5 bg-[#FAF9F6] border border-gray-200 rounded-md text-sm uppercase focus:border-[#8B1E1E] focus:ring-1 focus:ring-[#8B1E1E]/20 outline-none">
                        </div>
                        <button type="submit"
                            class="w-full bg-[#8B1E1E] hover:bg-[#6B1515] text-white px-6 py-3 rounded-md font-semibold transition flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            Tukarkan
                        </button>
                    </form>

                    <p class="text-[10px] text-[#718078] mt-4 flex items-center gap-1">
                        <svg class="w-3 h-3 text-[#2E7D32]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Satu kode hanya valid digunakan 1 kali per akun terdaftar.
                    </p>
                </div>
            </div>
        </div>
        {{-- ✅ RIWAYAT POIN (Full Width) --}}
        <div class="points-history bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
            <div class="points-history-heading flex items-center justify-between mb-6">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-[#718078] mb-1">Aktivitas & Log Perolehan
                    </p>
                    <h3 class="font-serif text-2xl font-bold text-[#2C1810]">Riwayat Poin & Hadiah</h3>
                    <p class="text-xs text-[#718078]">Semua catatan perolehan dan penukaran poin dari setiap transaksi
                        Lilin Aroma Terapi Apel di NusaCandle.</p>
                </div>
                <div class="bg-[#FAF9F6] px-4 py-2 rounded-lg border border-gray-200">
                    <p class="text-[10px] text-[#718078] mb-1">Total Akumulasi</p>
                    <div class="flex items-center gap-2">
                        <p class="font-serif text-2xl font-bold text-[#8B1E1E]">{{ number_format($currentPoin) }} Poin</p>
                        <svg class="w-6 h-6 text-[#8B1E1E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-[#FAF9F6] border-b border-gray-200">
                        <tr>
                            <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-[#718078]">Tanggal
                            </th>
                            <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-[#718078]">Keterangan
                                Aktivitas</th>
                            <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-[#718078]">Status</th>
                            <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-[#718078] text-right">
                                Nilai Poin</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($riwayatPoin as $riwayat)
                            <tr class="hover:bg-[#FAF9F6] transition-colors">
                                <td class="px-4 py-4 text-sm text-[#718078]">
                                    {{ $riwayat['tanggal']->format('d M Y') }}
                                </td>
                                <td class="px-4 py-4">
                                    <div class="flex items-start gap-3">
                                        @if ($riwayat['tipe'] === 'klaim_hadiah')
                                            <div
                                                class="w-8 h-8 rounded-full bg-[#8B1E1E] flex items-center justify-center flex-shrink-0">
                                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                                </svg>
                                            </div>
                                        @elseif($riwayat['tipe'] === 'redeem_code')
                                            <div
                                                class="w-8 h-8 rounded-full bg-[#E8F5E9] flex items-center justify-center flex-shrink-0">
                                                <svg class="w-4 h-4 text-[#2E7D32]" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                                </svg>
                                            </div>
                                        @else
                                            <div
                                                class="w-8 h-8 rounded-full bg-[#FCE4EC] flex items-center justify-center flex-shrink-0">
                                                <svg class="w-4 h-4 text-[#8B1E1E]" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                                </svg>
                                            </div>
                                        @endif
                                        <div>
                                            <p class="font-semibold text-[#2C1810] text-sm">{{ $riwayat['keterangan'] }}
                                            </p>
                                            @if (!empty($riwayat['catatan']))
                                                <p class="text-xs text-[#718078] mt-0.5 italic">📝
                                                    {{ $riwayat['catatan'] }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4">
                                    @php
                                        $statusColors = [
                                            'pending' => 'bg-yellow-100 text-yellow-800',
                                            'Menunggu Persetujuan' => 'bg-yellow-100 text-yellow-800',
                                            'disetujui' => 'bg-green-100 text-green-800',
                                            'Disetujui' => 'bg-green-100 text-green-800',
                                            'ditolak' => 'bg-red-100 text-red-800',
                                            'Ditolak' => 'bg-red-100 text-red-800',
                                            'Selesai' => 'bg-green-100 text-green-800',
                                            'Bonus Diberikan' => 'bg-[#E8F5E9] text-[#2E7D32]',
                                        ];
                                        $colorClass = $statusColors[$riwayat['status']] ?? 'bg-gray-100 text-gray-800';
                                    @endphp
                                    <span
                                        class="inline-flex items-center gap-1 {{ $colorClass }} text-xs font-semibold px-2.5 py-1 rounded">
                                        {{ $riwayat['status'] }}
                                    </span>
                                </td>
                                <td class="px-4 py-4 text-right">
                                    <p
                                        class="font-semibold {{ $riwayat['poin'] < 0 ? 'text-red-600' : 'text-[#2E7D32]' }}">
                                        {{ $riwayat['poin'] > 0 ? '+' : '' }}{{ number_format($riwayat['poin']) }} Poin
                                    </p>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-12 text-center">
                                    <p class="text-sm text-[#718078]">Belum ada riwayat perolehan poin.</p>
                                    <p class="text-xs text-[#718078] mt-1">Mulai belanja untuk mengumpulkan poin!</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="points-history-footer flex items-center justify-between mt-4 pt-4 border-t border-gray-200">
                <p class="text-xs text-[#718078] flex items-center gap-1">
                    <svg class="w-3 h-3 text-[#2E7D32]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Poin Anda berlaku selama 12 bulan dari tanggal perolehan terakhir.
                </p>
                <p class="text-xs text-[#718078]">Menampilkan {{ $riwayatPoin->count() }} entri terbaru</p>
            </div>
        </div>

        {{-- ✅ BANNER BEBAS ONGKIR (Full Width) --}}
        <div class="points-shipping bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-[#8B1E1E] flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-serif text-xl font-bold text-[#2C1810]">Bebas Ongkir untuk Pengambilan Hadiah</h4>
                        <p class="text-sm text-[#718078]">Hadiah refill gratis dapat digabungkan dengan pesanan Anda
                            berikutnya atau dikirim langsung tanpa biaya tambahan.</p>
                    </div>
                </div>
                <a href="{{ route('home') }}"
                    class="bg-[#8B1E1E] hover:bg-[#6B1515] text-white px-6 py-3 rounded-md font-semibold transition flex items-center gap-2 flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    Belanja Lilin Apel Sekarang
                </a>
            </div>
        </div>
    </div>
@endsection
