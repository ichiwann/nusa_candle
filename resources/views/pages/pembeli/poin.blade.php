@extends('layouts.pembeli')

@section('title', 'Poin Saya - NusaCandle')

@section('content')
{{-- Breadcrumb --}}
    <div class="points-breadcrumb hidden border-b border-gray-200 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center gap-2 text-sm">
                <a href="{{ route('home') }}" class="text-[#718078] hover:text-[#8B1E1E]">Beranda</a>
                <span class="text-[#718078]">/</span>
                <span class="text-[#8B1E1E] font-semibold">Poin Saya</span>
            </div>
        </div>
    </div>

    <div class="w-full bg-[#faf7ed]">
        <div class="poin-page mx-auto w-full max-w-7xl px-4 py-3 text-[#2c1810] sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="points-intro mb-3">
            <h1 class="font-display text-xl font-bold text-[#2C1810] sm:text-2xl">Poin Saya</h1>
            <p class="mt-1 text-xs text-[#718078]">
                Kumpulkan poin dari setiap pembelian dan nikmati lilin aromaterapi aroma apel gratis<br>
                yang dituangkan hangat dari kota Batu & Malang.
            </p>
        </div>

        {{-- GRID UTAMA: Informasi Poin dan Panduan di kiri, Redeem dan Hadiah di kanan --}}
        <div class="points-layout mb-4 grid grid-cols-1 items-start gap-4 lg:grid-cols-2">

            {{-- PANEL KIRI (col-span-2) --}}
            <div class="flex min-w-0 flex-col gap-4">

                {{-- Kartu Info User & Poin --}}
                <div
                    class="points-summary bg-gradient-to-br from-[#FAF9F6] to-[#F5F5F5] rounded-lg p-4 border border-gray-200">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-12 h-12 rounded-full bg-[#8B1E1E] text-white flex items-center justify-center text-lg font-bold">
                                {{ mb_substr($user->nama_lengkap, 0, 1) }}
                            </div>
                            <div>
                                <h3 class="font-display text-xl font-bold text-[#2C1810]">{{ $user->nama_lengkap }}</h3>
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
                            <span
                                class="rounded px-2 py-1 text-[8px] font-semibold {{ $membershipStatus['bg'] }} {{ $membershipStatus['color'] }}">
                                {{ $membershipStatus['label'] }}
                            </span>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-3">
                        {{-- Saldo Poin --}}
                        <div class="points-balance bg-white rounded-lg p-3 shadow-sm">
                            <p class="text-xs font-semibold uppercase tracking-wider text-[#718078] mb-2">Saldo Poin Saat
                                Ini</p>
                            <div class="flex items-baseline gap-2">
                                <span
                                    class="font-display text-3xl font-bold text-[#8B1E1E]">{{ number_format($currentPoin) }}</span>
                                <span class="text-lg text-[#718078]">Poin</span>
                            </div>
                            <p class="text-xs text-[#718078] mt-2">Terkumpul dari pembelian Lilin Apel Kota Batu.</p>
                        </div>

                        {{-- Aturan Hadiah --}}
                        <div class="points-rule bg-[#E8F5E9] rounded-lg p-3 border border-[#C8E6C9]">
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
                    <div class="points-progress mt-3 bg-white rounded-lg p-3 shadow-sm">
                        <div class="flex items-center justify-between mb-2">
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
                            @php
                                $pointProgressWidths = ['w-0', 'w-1/12', 'w-1/6', 'w-1/4', 'w-1/3', 'w-5/12', 'w-1/2', 'w-7/12', 'w-2/3', 'w-3/4', 'w-5/6', 'w-11/12', 'w-full'];
                                $pointProgressWidth = $pointProgressWidths[min(12, max(0, (int) round($progressPercentage / (100 / 12))))];
                            @endphp
                            <div class="h-3 rounded-full bg-gradient-to-r from-[#8B1E1E] to-[#2E7D32] transition-all duration-500 {{ $pointProgressWidth }}"></div>
                        </div>
                        <div class="flex justify-between text-xs text-[#718078]">
                            <span>0 Poin</span>
                            <span>35 Poin (50%)</span>
                            <span class="font-semibold text-[#2E7D32]">{{ $targetPoin }} Poin (Target Refill)</span>
                        </div>
                    </div>

                    {{-- Status --}}
                    <div
                        class="points-status mt-3 bg-white rounded-lg p-3 shadow-sm {{ $kurangPoin > 0 ? 'border-yellow-500' : 'border-green-500' }}">
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

                <div class="points-guide bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                    <div class="flex items-center gap-2">
                        <svg class="h-4 w-4 text-[#2E7D32]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="font-display text-base font-bold text-[#2C1810]">Tips Menikmati Lilin Aromaterapi</h3>
                    </div>
                    <p class="mt-1 text-[10px] text-[#718078]">Tips Panen Poin Lilin Apel</p>

                    <div class="mt-3 space-y-3">
                        <div class="flex items-start gap-2">
                            <span class="flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-[#FCE4EC] text-[9px] font-bold text-[#8B1E1E]">1</span>
                            <div>
                                <p class="text-xs font-semibold text-[#2C1810]">Beli Varian Lilin Apel</p>
                                <p class="mt-0.5 text-[10px] leading-relaxed text-[#718078]">Setiap Rp10.000 belanja menghasilkan 1 poin.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-2">
                            <span class="flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-[#FCE4EC] text-[9px] font-bold text-[#8B1E1E]">2</span>
                            <div>
                                <p class="text-xs font-semibold text-[#2C1810]">Tulis Ulasan Berfoto</p>
                                <p class="mt-0.5 text-[10px] leading-relaxed text-[#718078]">Dapatkan hingga +10 poin untuk ulasan hangat.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-2">
                            <span class="flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-[#FCE4EC] text-[9px] font-bold text-[#8B1E1E]">3</span>
                            <div>
                                <p class="text-xs font-semibold text-[#2C1810]">Tukarkan Voucher Acara</p>
                                <p class="mt-0.5 text-[10px] leading-relaxed text-[#718078]">Gunakan kode khusus pameran di panel sebelah kanan.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- PANEL KANAN (col-span-1) --}}
            <div class="space-y-4">
                {{-- Tukarkan Redeem Code --}}
                <div class="points-redeem bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                    <div class="flex items-center gap-2 mb-3">
                        <svg class="w-5 h-5 text-[#8B1E1E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                        </svg>
                        <h3 class="font-display text-lg font-bold text-[#2C1810]">Tukarkan Redeem Code</h3>
                    </div>

                    <div class="mb-4">
                        <h4 class="font-semibold text-[#2C1810] mb-2">Punya Kode Promo / Voucher Event?</h4>
                        <p class="points-redeem-description text-xs text-[#718078] mb-3">Tukarkan kode promosi festival
                            kriya atau kartu hadiah
                            khusus untuk langsung menikmati lilin aromaterapi aroma apel Malang.</p>

                        <div class="points-redeem-note bg-[#FCE4EC] rounded-lg p-3 border border-[#F8BBD0]">
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

                @php
                    $reward = $hadiahList->first();
                    $rewardCost = $reward ? (int) $reward->poin_dibutuhkan : 70;
                    $rewardStock = $reward ? (int) ($reward->produk->stok ?? 0) : 0;
                    $rewardName = $reward?->produk?->nama_produk ?? 'NusaCandle - Lilin Aroma Terapi';
                    $canClaimReward = $currentPoin >= $rewardCost && $rewardStock > 0;
                    $missingRewardPoints = max(0, $rewardCost - $currentPoin);
                @endphp

                <div class="points-reward bg-white rounded-lg border border-gray-200 p-4 shadow-sm">
                    <h3 class="font-display text-base font-bold leading-snug text-[#2C1810]">
                        1x Refill Lilin Aroma Terapi Aroma Apel Gratis
                    </h3>
                    <p class="mt-1 text-[10px] leading-relaxed text-[#718078]">
                        Hadiah eksklusif bagi pelanggan setia pecinta wangi botanikal apel Batu &amp; Malang.
                    </p>

                    <div class="mt-3 flex items-center gap-3 rounded-lg bg-[#FAF9F6] p-3">
                        <div class="relative flex h-20 w-20 shrink-0 items-center justify-center rounded-md bg-gradient-to-br from-[#dfe5cc] to-[#b8c69a]">
                            <svg class="h-14 w-14" viewBox="0 0 64 64" fill="none" role="img" aria-label="Ilustrasi lilin aroma apel">
                                <path d="M32 5c-6 8-4 12 0 15 4-3 6-7 0-15Z" fill="#E99B43" />
                                <path d="M32 10c-2 3-2 5 0 7 2-2 2-4 0-7Z" fill="#FFF1BC" />
                                <path d="M32 19v5" stroke="#604A35" stroke-width="2" />
                                <path d="M17 25h30l-3 29a5 5 0 01-5 5H25a5 5 0 01-5-5l-3-29Z" fill="#536044" stroke="#B6AA91" stroke-width="2" />
                                <ellipse cx="32" cy="25" rx="15" ry="4" fill="#E9DFC9" stroke="#B6AA91" stroke-width="2" />
                            </svg>
                            <span class="absolute bottom-1.5 rounded-full bg-[#8B1E1E] px-2 py-0.5 text-[7px] font-bold text-white">
                                Refill Jar
                            </span>
                        </div>
                        <div class="min-w-0">
                            <p class="text-[9px] font-semibold uppercase tracking-wide text-[#718078]">Hadiah Loyalitas</p>
                            <p class="mt-1 font-display text-sm font-bold leading-tight text-[#2C1810]">{{ $rewardName }}</p>
                            <p class="mt-1 text-[9px] text-[#718078]">200 gr · Natural Soy Wax · Stok: {{ $rewardStock }}</p>
                            <p class="mt-1 text-[10px] font-semibold text-[#2E7D32]">Rp0 · Tukar {{ $rewardCost }} Poin</p>
                        </div>
                    </div>

                    <div class="mt-3 flex items-center justify-between gap-2 rounded-lg border border-gray-200 bg-[#FAF9F6] px-3 py-2">
                        <p class="text-[9px] leading-relaxed text-[#718078]">
                            @if ($canClaimReward)
                                Poin Anda mencukupi untuk klaim hadiah.
                            @elseif ($missingRewardPoints > 0)
                                Belum cukup. Kurang {{ $missingRewardPoints }} poin lagi.
                            @else
                                Stok hadiah belum tersedia.
                            @endif
                        </p>
                        @if ($reward && $canClaimReward)
                            <form action="{{ route('poin.klaim') }}" method="POST" class="shrink-0">
                                @csrf
                                <input type="hidden" name="id_hadiah" value="{{ $reward->id_hadiah }}">
                                <button type="submit" class="rounded-md bg-[#8B1E1E] px-3 py-2 text-[9px] font-semibold text-white">
                                    Klaim Hadiah
                                </button>
                            </form>
                        @else
                            <button type="button" disabled class="shrink-0 rounded-md bg-gray-200 px-3 py-2 text-[9px] font-semibold text-gray-500">
                                Klaim Hadiah
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        {{-- ✅ RIWAYAT POIN (Full Width) --}}
        <div class="points-history bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
            <div class="points-history-heading flex items-center justify-between mb-6">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-[#718078] mb-1">Aktivitas & Log Perolehan
                    </p>
                    <h3 class="font-display text-2xl font-bold text-[#2C1810]">Riwayat Poin & Hadiah</h3>
                    <p class="text-xs text-[#718078]">Semua catatan perolehan dan penukaran poin dari setiap transaksi
                        Lilin Aroma Terapi Apel di NusaCandle.</p>
                </div>
                <div class="bg-[#FAF9F6] px-4 py-2 rounded-lg border border-gray-200">
                    <p class="text-[10px] text-[#718078] mb-1">Total Akumulasi</p>
                    <div class="flex items-center gap-2">
                        <p class="font-display text-2xl font-bold text-[#8B1E1E]">{{ number_format($currentPoin) }} Poin</p>
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

        </div>
    </div>
@endsection
