@extends('layouts.pembeli')

@section('title', 'Poin & Loyalitas Saya - NusaCandle')

@section('content')
    {{-- Breadcrumb --}}
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center gap-2 text-sm">
                <a href="{{ route('home') }}" class="text-[#718078] hover:text-[#8B1E1E]">Beranda</a>
                <span class="text-[#718078]">/</span>
                <span class="text-[#8B1E1E] font-semibold">Poin Saya</span>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Header --}}
        <div class="mb-8">
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
                {{ session('success') }}
            </div>
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

        <div class="grid lg:grid-cols-3 gap-6 mb-6">
            {{-- Panel Kiri - Info Poin --}}
            <div class="lg:col-span-2 space-y-6">
                {{-- Kartu Info User & Poin --}}
                <div class="bg-gradient-to-br from-[#FAF9F6] to-[#F5F5F5] rounded-lg p-6 border border-gray-200">
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
                            <span class="text-xs font-semibold text-green-800 bg-green-100 px-2 py-1 rounded">Akun Aktif
                                Terverifikasi</span>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-4">
                        {{-- Saldo Poin --}}
                        <div class="bg-white rounded-lg p-5 shadow-sm">
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
                        <div class="bg-[#E8F5E9] rounded-lg p-5 border border-[#C8E6C9]">
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
                    <div class="mt-6 bg-white rounded-lg p-5 shadow-sm">
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
                    <div class="mt-6 bg-white rounded-lg p-5 shadow-sm border-l-4 border-yellow-500">
                        <div class="flex items-start justify-between">
                            <div class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-yellow-600 flex-shrink-0 mt-0.5" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div>
                                    <p class="font-semibold text-[#2C1810]">Status:
                                        {{ $kurangPoin > 0 ? 'Belum Memenuhi Syarat' : 'Siap Klaim Hadiah!' }}</p>
                                    <p class="text-sm text-[#718078] mt-1">
                                        @if ($kurangPoin > 0)
                                            Kurang <strong class="text-[#8B1E1E]">{{ $kurangPoin }} Poin</strong> lagi
                                            untuk mendapatkan 1x Refill Lilin Aroma Terapi Aroma Apel Gratis.
                                        @else
                                            Selamat! Anda sudah bisa menukarkan poin dengan hadiah refill lilin.
                                        @endif
                                    </p>
                                </div>
                            </div>
                            @if ($kurangPoin > 0)
                                <button
                                    class="bg-[#FAF9F6] hover:bg-[#F5F5F5] text-[#8B1E1E] border-2 border-[#8B1E1E] px-4 py-2 rounded-md text-xs font-semibold transition flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                    Simulasi Tambah {{ $kurangPoin }} Poin
                                </button>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Section Klaim Hadiah --}}
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center justify-between mb-6">
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
                    <div class="bg-[#FAF9F6] rounded-lg p-5 mb-6">
                        <div class="flex items-start gap-4">
                            <div class="relative flex-shrink-0">
                                <div class="w-24 h-24 bg-gray-200 rounded-lg flex items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
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

                    {{-- Status Hadiah - Logic Dinamis --}}
                    <div class="flex items-center justify-between">
                        <div class="flex items-start gap-3">
                            @if ($kurangPoin > 0)
                                {{-- ICON KUNCI (Belum cukup poin) --}}
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
                                {{-- ICON BUKA KUNCI (Sudah bisa klaim) --}}
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

                        {{-- TOMBOL KLAIM - Muncul hanya jika poin >= 70 --}}
                        @if ($kurangPoin <= 0)
                            <form action="{{ route('poin.klaim') }}" method="POST"
                                onsubmit="return confirm('Tukarkan 70 poin untuk 1x Refill Lilin Aroma Apel Gratis? Poin akan berkurang 70.')">
                                @csrf
                                <button type="submit"
                                    class="bg-[#8B1E1E] hover:bg-[#6B1515] text-white px-6 py-3 rounded-md text-sm font-semibold transition flex items-center gap-2 shadow-sm">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                    Klaim Hadiah
                                </button>
                            </form>
                        @else
                            {{-- PESAN MOTIVASI - Muncul jika poin belum cukup --}}
                            <div
                                class="bg-[#FAF9F6] border-2 border-dashed border-[#8B1E1E]/30 rounded-lg px-5 py-3 text-center">
                                <p class="text-sm font-semibold text-[#8B1E1E]">🕯️ Ayo kumpulkan poin lagi untuk
                                    mendapatkan lilin gratis!</p>
                                <p class="text-xs text-[#718078] mt-1">Tinggal {{ $kurangPoin }} poin lagi menuju hadiah
                                    refill.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Panel Kanan - Panduan & Redeem --}}
            <div class="space-y-6">
                {{-- Panduan Tambah Poin --}}
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center gap-2 mb-4">
                        <svg class="w-5 h-5 text-[#2E7D32]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="font-serif text-lg font-bold text-[#2C1810]">Panduan Tambah Poin</h3>
                    </div>
                    <h4 class="font-semibold text-[#2C1810] mb-4">Tips Panen Poin Lilin Apel</h4>

                    <div class="space-y-4">
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

                    {{-- Komitmen Alami --}}
                    <div class="mt-6 bg-[#FAF9F6] rounded-lg p-4 border border-gray-200">
                        <p class="text-[10px] font-semibold uppercase tracking-wider text-[#2E7D32] mb-2">Komitmen Alami
                        </p>
                        <p class="text-xs text-[#718078] italic">"Kebaikan aroma murni apel Malang yang menemani setiap
                            sudut relaksasi keluarga Anda."</p>
                    </div>
                </div>

                {{-- Tukarkan Redeem Code --}}
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center gap-2 mb-4">
                        <svg class="w-5 h-5 text-[#8B1E1E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                        </svg>
                        <h3 class="font-serif text-lg font-bold text-[#2C1810]">Tukarkan Redeem Code</h3>
                    </div>

                    <div class="mb-6">
                        <h4 class="font-semibold text-[#2C1810] mb-2">Punya Kode Promo / Voucher Event?</h4>
                        <p class="text-xs text-[#718078] mb-4">Tukarkan kode promosi festival kriya atau kartu hadiah
                            khusus untuk langsung menikmati lilin aromaterapi aroma apel Malang.</p>

                        <div class="bg-[#FCE4EC] rounded-lg p-4 border border-[#F8BBD0]">
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
                            <input type="text" name="redeem_code" placeholder="MASUKKAN REDEEM CODE"
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

        {{-- Riwayat Poin & Hadiah --}}
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
            <div class="flex items-center justify-between mb-6">
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
                                        @if ($riwayat['type'] === 'purchase')
                                            <div
                                                class="w-8 h-8 rounded-full bg-[#FCE4EC] flex items-center justify-center flex-shrink-0">
                                                <svg class="w-4 h-4 text-[#8B1E1E]" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                                </svg>
                                            </div>
                                        @else
                                            <div
                                                class="w-8 h-8 rounded-full bg-[#E8F5E9] flex items-center justify-center flex-shrink-0">
                                                <svg class="w-4 h-4 text-[#2E7D32]" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                                </svg>
                                            </div>
                                        @endif
                                        <div>
                                            <p class="font-semibold text-[#2C1810] text-sm">{{ $riwayat['keterangan'] }}
                                            </p>
                                            @if ($riwayat['total_pesanan'] > 0)
                                                <p class="text-xs text-[#718078] mt-0.5">{{ $riwayat['total_pesanan'] }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4">
                                    @if ($riwayat['status'] === 'Selesai')
                                        <span
                                            class="inline-flex items-center gap-1 bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-1 rounded">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                            {{ $riwayat['status'] }}
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1 bg-[#E8F5E9] text-[#2E7D32] text-xs font-semibold px-2.5 py-1 rounded">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            {{ $riwayat['status'] }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-4 text-right">
                                    <p class="font-semibold text-[#2E7D32]">+{{ number_format($riwayat['poin']) }} Poin
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

            <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-200">
                <p class="text-xs text-[#718078] flex items-center gap-1">
                    <svg class="w-3 h-3 text-[#2E7D32]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Poin Anda berlaku selama 12 bulan dari tanggal perolehan terakhir.
                </p>
                <p class="text-xs text-[#718078]">Menampilkan {{ $riwayatPoin->count() }}
                    entr{{ $riwayatPoin->count() == 1 ? 'i' : 'i' }} terbaru</p>
            </div>
        </div>

        {{-- Banner Bebas Ongkir --}}
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
            <div class="flex items-center justify-between">
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
