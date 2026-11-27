@extends('layouts.pembeli')

@section('title', 'Detail Pembayaran #' . str_pad($transaksi->id_transaksi, 5, '0', STR_PAD_LEFT) . ' - NusaCandle')

@section('content')
    @php
        $isDemoPreview = $isDemoPreview ?? false;
        $pesanan = $transaksi->pesanan;
        $totalItem = $pesanan->detailPesanan->sum('jumlah');
        $totalHargaProduk = $pesanan->detailPesanan->sum(fn($detail) => $detail->harga_satuan * $detail->jumlah);
        $biayaTambahan = max(0, (int) $pesanan->total_harga - (int) $totalHargaProduk);
        $poinDidapat = floor($totalHargaProduk / 10000);
        // ✅ Data rekening (sama seperti di keranjang)
        $rekeningData = [
            'bca' => '8271 0812 3456 7890',
            'mandiri' => '130 00 1234567 8',
            'gopay' => '0812 8899 1201',
            'dana' => '0857 3344 9022',
            'shopeepay' => '0821 7766 4503',
            'cod' => 'Bayar tunai di tempat saat barang diterima',
        ];
        $rekeningLabel = [
            'bca' => 'BCA Virtual Account',
            'mandiri' => 'Mandiri Virtual Account',
            'gopay' => 'GoPay',
            'dana' => 'DANA',
            'shopeepay' => 'ShopeePay',
            'cod' => 'COD (Bayar di Tempat)',
        ];
        $nomorRekening = $rekeningData[$transaksi->metode_pembayaran] ?? '-';
        $labelMetode = $rekeningLabel[$transaksi->metode_pembayaran] ?? $transaksi->metode_label;
        $isBankTransfer = in_array($transaksi->metode_pembayaran, ['bca', 'mandiri']);
        $kodePesanan =
            '#NC-' . $pesanan->created_at->format('Ymd') . '-' . str_pad($pesanan->id_pesanan, 4, '0', STR_PAD_LEFT);
        $kodeTransaksi =
            '#TRX-' .
            $transaksi->created_at->format('Ymd') .
            '-' .
            str_pad($transaksi->id_transaksi, 4, '0', STR_PAD_LEFT);
        $statusPembayaran = $transaksi->status_pembayaran;
        $progressIndex = match ($statusPembayaran) {
            'berhasil' => 3,
            'gagal' => 2,
            default => 1,
        };
        $progressLineWidthClass = match (min($progressIndex, 3)) {
            0 => 'w-0',
            1 => 'w-1/3',
            2 => 'w-2/3',
            default => 'w-full',
        };
        $createdAt = $transaksi->created_at->locale('id')->translatedFormat('d M Y, H:i') . ' WIB';
        $updatedAt = $transaksi->updated_at ?? null;
        $updatedAtLabel = $updatedAt?->locale('id')->translatedFormat('d M Y, H:i');
        $updatedAtLabel = $updatedAtLabel ? $updatedAtLabel . ' WIB' : null;
        $progressSteps = [
            ['label' => 'Transaksi Dibuat', 'description' => $createdAt],
            ['label' => 'Menunggu Pembayaran', 'description' => $createdAt],
            [
                'label' => 'Pembayaran Diverifikasi',
                'description' =>
                    $statusPembayaran === 'berhasil'
                        ? $updatedAtLabel ?? 'Pembayaran berhasil diverifikasi'
                        : ($statusPembayaran === 'gagal'
                            ? 'Pembayaran tidak berhasil'
                            : 'Menunggu verifikasi'),
            ],
            [
                'label' => 'Pembayaran Berhasil',
                'description' =>
                    $statusPembayaran === 'berhasil'
                        ? $updatedAtLabel ?? 'Pembayaran lunas'
                        : ($statusPembayaran === 'gagal'
                            ? 'Pembayaran tidak lunas'
                            : 'Belum lunas'),
            ],
        ];
        $statusPresentation = match ($statusPembayaran) {
            'berhasil' => [
                'title' => 'Pembayaran Berhasil Diverifikasi',
                'description' =>
                    'Transaksi telah selesai dan dana terkonfirmasi otomatis oleh sistem perbankan. Pesanan lilin aromaterapi Anda sedang diproses oleh artisan di Batu, Jawa Timur.',
                'badge' => 'Lunas',
            ],
            'gagal' => [
                'title' => 'Pembayaran Dibatalkan',
                'description' => 'Pembayaran ini tidak berhasil diselesaikan.',
                'badge' => 'Gagal',
            ],
            default => [
                'title' => 'Menunggu Pembayaran',
                'description' => 'Pembayaran belum diverifikasi. Periksa status kembali setelah pembayaran dilakukan.',
                'badge' => 'Belum Lunas',
            ],
        };
        $statusCardClasses = match ($statusPembayaran) {
            'berhasil' => 'bg-[#e6f5e2] text-[#3d633b]',
            'gagal' => 'bg-[#fff1f1] text-[#8B1E1E]',
            default => 'bg-[#fff9e8] text-[#80652d]',
        };
        $statusIconClasses = match ($statusPembayaran) {
            'berhasil' => 'bg-[#47784a]',
            'gagal' => 'bg-[#a51f24]',
            default => 'bg-[#a97723]',
        };
        $statusBadgeClasses = match ($statusPembayaran) {
            'berhasil' => 'bg-[#47784a] text-white',
            'gagal' => 'bg-[#a51f24] text-white',
            default => 'bg-[#f3e7c7] text-[#80652d]',
        };
    @endphp

    <div class="min-h-screen bg-[#faf7ed] text-[#2C1810] print:bg-white">
        <div class="mx-auto max-w-7xl px-4 pb-10 pt-4 sm:px-6 lg:px-8">

            {{-- ===== HEADER ===== --}}
            <nav aria-label="Jejak halaman"
                class="mb-2 flex flex-wrap items-center gap-1.5 text-[10px] text-[#796d5d] print:hidden">
                <a href="{{ route('home') }}" class="transition hover:text-[#8B1E1E]">Beranda</a>
                <span aria-hidden="true">&gt;</span>
                <a href="{{ route('pembeli.transaksi.index') }}" class="transition hover:text-[#8B1E1E]">Transaksi Saya</a>
                <span aria-hidden="true">&gt;</span>
                <span class="font-semibold text-[#2C1810]">Detail Transaksi ({{ $kodeTransaksi }})</span>
            </nav>

            <header class="mb-4 flex flex-wrap items-start justify-between gap-3">
                <div>
                    <h1 class="font-serif text-2xl font-bold leading-tight text-[#8B1E1E] sm:text-3xl">Detail Pembayaran
                    </h1>
                    <p class="mt-1 max-w-2xl text-[11px] leading-relaxed text-[#796d5d]">
                        Rincian verifikasi pembayaran dan informasi transaksi pesanan lilin aromaterapi NusaCandle Anda.
                    </p>
                </div>
                <a href="{{ route('pembeli.transaksi.index') }}"
                    class="inline-flex shrink-0 items-center gap-1.5 rounded-md border border-[#e5dccb] bg-[#f5f0e5] px-3 py-2 text-[10px] font-semibold text-[#52645a] transition hover:bg-[#ece5d6] print:hidden">
                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Riwayat Pembayaran
                </a>
            </header>

            {{-- ===== BAR SEGMENTED STATUS ===== --}}
            <div
                class="mb-4 flex flex-wrap items-center justify-between gap-3 rounded-lg border border-[#e8dfcf] bg-[#fffdf7] px-3 py-2.5 shadow-sm">
                <span
                    class="flex h-7 w-7 items-center justify-center rounded-md border border-[#e5dccb] bg-white text-[#796d5d]">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M7 12h10m-7 6h4" />
                    </svg>
                </span>
                <div class="flex flex-wrap items-center gap-1.5">
                    <span
                        class="inline-flex items-center gap-1 rounded-full px-3 py-1 text-[9px] font-semibold {{ $statusPembayaran === 'berhasil' ? 'bg-[#2E7D32] text-white' : 'border border-[#e5dccb] bg-white text-[#796d5d]' }}">
                        <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                        </svg>
                        Berhasil (Aktif)
                    </span>
                    <span
                        class="inline-flex items-center gap-1 rounded-full px-3 py-1 text-[9px] font-semibold {{ $statusPembayaran === 'menunggu' ? 'bg-[#2E7D32] text-white' : 'border border-[#e5dccb] bg-white text-[#796d5d]' }}">
                        <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="9" stroke-width="2" />
                        </svg>
                        Menunggu Bayar
                    </span>
                    <span
                        class="inline-flex items-center gap-1 rounded-full px-3 py-1 text-[9px] font-semibold {{ $statusPembayaran === 'gagal' ? 'bg-[#2E7D32] text-white' : 'border border-[#e5dccb] bg-white text-[#796d5d]' }}">
                        <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Gagal / Kedaluwarsa
                    </span>
                </div>
            </div>

            {{-- ===== CARD STATUS + PROGRESS ===== --}}
            <section class="mb-4 rounded-xl border border-[#eee9df] bg-white p-4 shadow-sm sm:p-5"
                aria-labelledby="transaction-status-title">
                <div class="mb-6 flex items-start gap-3 rounded-lg px-3 py-3 sm:px-4 {{ $statusCardClasses }}">
                    <span
                        class="mt-0.5 flex h-7 w-7 shrink-0 items-center justify-center rounded-full text-white {{ $statusIconClasses }}"
                        aria-hidden="true">
                        @if ($statusPembayaran === 'berhasil')
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M9 12l2 2 4-4m6 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        @elseif ($statusPembayaran === 'gagal')
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        @else
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        @endif
                    </span>
                    <div class="min-w-0 flex-1">
                        <div class="flex flex-wrap items-center gap-2">
                            <h2 id="transaction-status-title"
                                class="font-serif text-sm font-bold leading-tight sm:text-base">
                                {{ $statusPresentation['title'] }}</h2>
                            <span
                                class="rounded-full px-2 py-0.5 text-[7px] font-bold sm:text-[8px] {{ $statusBadgeClasses }}">{{ $statusPresentation['badge'] }}</span>
                        </div>
                        <p class="mt-1 text-[8px] leading-relaxed opacity-90 sm:text-[9px]">
                            {{ $statusPresentation['description'] }}</p>
                    </div>
                </div>
                <div class="overflow-x-auto pb-1">
                    <ol class="relative grid min-w-[620px] grid-cols-4">
                        <li aria-hidden="true"
                            class="absolute left-[12.5%] right-[12.5%] top-3.5 h-0.5 rounded-full bg-[#e9e9e2]">
                            <span
                                class="absolute left-0 top-0 h-full rounded-full bg-[#47784a] {{ $progressLineWidthClass }}"></span>
                        </li>
                        @foreach ($progressSteps as $index => $step)
                            @php
                                $isComplete = $statusPembayaran === 'berhasil' || $index < $progressIndex;
                                $isCurrent = $statusPembayaran !== 'berhasil' && $index === $progressIndex;
                                $stepClasses = $isComplete
                                    ? 'bg-[#47784a] text-white'
                                    : ($isCurrent
                                        ? ($statusPembayaran === 'gagal'
                                            ? 'bg-[#a51f24] text-white'
                                            : 'bg-[#a97723] text-white')
                                        : 'bg-[#f2f0eb] text-[#b9b2a7]');
                            @endphp
                            <li class="relative z-10 flex min-w-0 flex-col items-center px-2 text-center">
                                <span
                                    class="flex h-7 w-7 items-center justify-center rounded-full ring-4 ring-white {{ $stepClasses }}">
                                    @if ($isComplete)
                                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                    @elseif ($statusPembayaran === 'gagal' && $isCurrent)
                                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    @else
                                        {{ $index + 1 }}
                                    @endif
                                </span>
                                <span
                                    class="mt-2 block text-[8px] font-semibold leading-snug {{ $isCurrent ? ($statusPembayaran === 'gagal' ? 'text-[#a51f24]' : 'text-[#80652d]') : ($isComplete ? 'text-[#2C1810]' : 'text-[#8f877c]') }} sm:text-[9px]">{{ $step['label'] }}</span>
                                <span
                                    class="mt-1 block text-[7px] leading-snug text-[#9a8f81] sm:text-[8px]">{{ $step['description'] }}</span>
                            </li>
                        @endforeach
                    </ol>
                </div>
            </section>

            {{-- ===== GRID UTAMA ===== --}}
            <div class="grid grid-cols-2 items-start gap-4 md:grid-cols-[minmax(0,1.7fr)_minmax(280px,0.85fr)]">

                {{-- ========== KOLOM KIRI ========== --}}
                <div class="min-w-0 space-y-4">

                    {{-- Informasi Transaksi --}}
                    <section class="rounded-xl border border-[#e8dfcf] bg-white p-4 shadow-sm sm:p-5">
                        <div class="mb-3 flex items-center justify-between gap-2 border-b border-[#f1ece2] pb-2.5">
                            <h2 class="flex items-center gap-1.5 font-serif text-sm font-bold text-[#2C1810] sm:text-base">
                                <svg class="h-4 w-4 text-[#8B1E1E]" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                Informasi Transaksi
                            </h2>
                            <span
                                class="inline-flex items-center gap-1 rounded-full bg-[#e8f2e2] px-2.5 py-1 text-[8px] font-semibold text-[#2E7D32]">
                                <span class="h-1.5 w-1.5 rounded-full bg-[#2E7D32]"></span>{{ $transaksi->status_label }}
                            </span>
                        </div>

                        <div class="grid grid-cols-1 gap-2.5 sm:grid-cols-2">
                            <div class="rounded-lg border border-[#eee5d7] bg-[#faf7ed] p-3">
                                <p class="text-[8px] font-semibold uppercase tracking-wide text-[#796d5d]">ID Transaksi</p>
                                <div class="mt-1 flex items-center justify-between gap-2">
                                    <p class="font-mono text-[11px] font-bold text-[#2C1810]">{{ $kodeTransaksi }}</p>
                                    <button type="button" onclick="copyText('{{ $kodeTransaksi }}')"
                                        class="text-[#796d5d] transition hover:text-[#8B1E1E]"
                                        aria-label="Salin ID transaksi">
                                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <rect x="9" y="9" width="11" height="11" rx="2"
                                                stroke-width="2" />
                                            <path stroke-linecap="round" stroke-width="2" d="M5 15V5a2 2 0 012-2h10" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="rounded-lg border border-[#eee5d7] bg-[#faf7ed] p-3">
                                <p class="text-[8px] font-semibold uppercase tracking-wide text-[#796d5d]">ID Pesanan
                                    Terkait</p>
                                <div class="mt-1 flex items-center justify-between gap-2">
                                    <p class="font-mono text-[11px] font-bold text-[#8B1E1E]">{{ $kodePesanan }}</p>
                                    <a href="{{ route('pembeli.pesanan.show', $pesanan->id_pesanan) }}"
                                        class="inline-flex items-center gap-0.5 whitespace-nowrap text-[9px] font-semibold text-[#2E7D32] transition hover:text-[#276236]">Lihat
                                        Pesanan
                                        <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            <div class="rounded-lg border border-[#eee5d7] bg-[#faf7ed] p-3">
                                <p class="text-[8px] font-semibold uppercase tracking-wide text-[#796d5d]">Waktu Selesai
                                    Verifikasi</p>
                                <p class="mt-1 flex items-center gap-1.5 text-[10px] font-semibold text-[#2C1810]">
                                    <svg class="h-3.5 w-3.5 text-[#796d5d]" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <rect x="3" y="4" width="18" height="18" rx="2"
                                            stroke-width="2" />
                                        <path stroke-linecap="round" stroke-width="2" d="M16 2v4M8 2v4M3 10h18" />
                                    </svg>
                                    {{ $statusPembayaran === 'berhasil' ? $updatedAtLabel ?? '-' : 'Belum diverifikasi' }}
                                </p>
                            </div>
                            <div class="rounded-lg border border-[#eee5d7] bg-[#faf7ed] p-3">
                                <p class="text-[8px] font-semibold uppercase tracking-wide text-[#796d5d]">Nama Pelanggan
                                </p>
                                <p class="mt-1 flex items-center gap-1.5 text-[10px] font-semibold text-[#2C1810]">
                                    <svg class="h-3.5 w-3.5 text-[#796d5d]" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <circle cx="12" cy="8" r="4" stroke-width="2" />
                                        <path stroke-linecap="round" stroke-width="2" d="M4 20a8 8 0 0116 0" />
                                    </svg>
                                    {{ auth()->user()->nama_lengkap }}
                                    @if (auth()->user()->email)
                                        <span
                                            class="text-[8px] font-normal text-[#796d5d]">({{ auth()->user()->email }})</span>
                                    @endif
                                </p>
                            </div>
                            <div class="rounded-lg border border-[#eee5d7] bg-[#faf7ed] p-3 sm:col-span-2">
                                <p class="text-[8px] font-semibold uppercase tracking-wide text-[#796d5d]">
                                    {{ $isBankTransfer ? 'Nomor Virtual Account / Rekening Tujuan' : 'Nomor Akun E-Wallet / QRIS' }}
                                </p>
                                <div class="mt-1 flex items-center justify-between gap-2">
                                    <p class="font-mono text-[11px] font-bold tracking-wide text-[#8B1E1E]">
                                        {{ $nomorRekening }}</p>
                                    <button type="button" onclick="copyText('{{ $nomorRekening }}')"
                                        class="inline-flex items-center gap-1 whitespace-nowrap rounded border border-[#e5dccb] bg-white px-2 py-1 text-[8px] font-semibold text-[#52645a] transition hover:border-[#8B1E1E] hover:text-[#8B1E1E]">
                                        <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <rect x="9" y="9" width="11" height="11" rx="2"
                                                stroke-width="2" />
                                            <path stroke-linecap="round" stroke-width="2" d="M5 15V5a2 2 0 012-2h10" />
                                        </svg>
                                        Salin
                                    </button>
                                </div>
                            </div>
                        </div>
                    </section>

                    {{-- Rincian Lilin Botanikal --}}
                    <section class="rounded-xl border border-[#e8dfcf] bg-white p-4 shadow-sm sm:p-5">
                        <div class="mb-3 flex items-center justify-between gap-2 border-b border-[#f1ece2] pb-2.5">
                            <h2 class="flex items-center gap-1.5 font-serif text-sm font-bold text-[#2C1810] sm:text-base">
                                <svg class="h-4 w-4 text-[#8B1E1E]" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 3c-1 2-3 3-3 6a3 3 0 006 0c0-3-2-4-3-6z" />
                                    <path stroke-linecap="round" stroke-width="2" d="M8 21h8m-4-3v3" />
                                </svg>
                                Rincian Lilin Botanikal
                            </h2>
                            <span
                                class="rounded-full bg-[#f5f0e5] px-2.5 py-1 text-[8px] font-semibold text-[#796d5d]">{{ $totalItem }}
                                Lilin Aromaterapi</span>
                        </div>

                        <div class="space-y-3">
                            @foreach ($pesanan->detailPesanan as $detail)
                                <article
                                    class="flex gap-3 border-b border-[#f1ece2] pb-3 last:border-0 last:pb-0 sm:gap-4">
                                    <div
                                        class="relative h-20 w-20 shrink-0 overflow-hidden rounded-lg border border-[#eee5d7] sm:h-24 sm:w-24">
                                        @if ($detail->produk?->gambar)
                                            <img src="{{ asset('storage/' . $detail->produk->gambar) }}"
                                                alt="{{ $detail->produk->nama_produk }}"
                                                class="h-full w-full object-cover">
                                        @else
                                            <div class="flex h-full w-full items-center justify-center bg-[#f3eddf]">
                                                <svg class="h-10 w-10" viewBox="0 0 64 64" fill="none"
                                                    aria-hidden="true">
                                                    <path d="M32 6c-7 10-5 15 0 18 5-3 7-8 0-18Z" fill="#e99b43" />
                                                    <rect x="14" y="23" width="36" height="31" rx="7"
                                                        fill="#536044" stroke="#ded2b6" stroke-width="2" />
                                                    <ellipse cx="32" cy="24" rx="17" ry="4"
                                                        fill="#e9dfc9" />
                                                </svg>
                                            </div>
                                        @endif
                                        <span
                                            class="absolute left-1 top-1 rounded bg-[#8B1E1E] px-1.5 py-0.5 text-[6px] font-bold uppercase text-white">NusaCandle</span>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <div class="flex items-start justify-between gap-2">
                                            <h3
                                                class="font-serif text-[12px] font-bold leading-snug text-[#2C1810] sm:text-sm">
                                                {{ $detail->produk?->nama_produk ?? 'Produk' }}</h3>
                                            <p class="shrink-0 text-[11px] font-bold text-[#8B1E1E] sm:text-sm">
                                                Rp{{ number_format($detail->harga_satuan * $detail->jumlah, 0, ',', '.') }}
                                            </p>
                                        </div>
                                        <span
                                            class="mt-1 inline-flex items-center gap-1 rounded-full bg-[#e8f2e2] px-2 py-0.5 text-[7px] font-semibold text-[#2E7D32]">
                                            <svg class="h-2.5 w-2.5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                            Lilin Alami · Batch Malang
                                        </span>
                                        @if ($detail->produk?->deskripsi)
                                            <p class="mt-1.5 line-clamp-2 text-[9px] leading-relaxed text-[#796d5d]">
                                                {{ $detail->produk->deskripsi }}</p>
                                        @endif
                                        <div class="mt-2 flex items-center justify-between gap-2">
                                            <p class="text-[9px] text-[#796d5d]">Harga Satuan: <span
                                                    class="font-semibold text-[#2C1810]">Rp{{ number_format($detail->harga_satuan, 0, ',', '.') }}</span>
                                            </p>
                                            <span
                                                class="rounded border border-[#e5dccb] bg-white px-2 py-1 text-[8px] font-semibold text-[#2C1810]">Jumlah:
                                                {{ $detail->jumlah }} Pcs</span>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </section>

                    {{-- Bukti Pembayaran Pelanggan --}}
                    <section class="rounded-xl border border-[#e8dfcf] bg-white p-4 shadow-sm sm:p-5">
                        <div class="mb-3 flex items-center gap-2 border-b border-[#f1ece2] pb-2.5">
                            <span class="flex h-6 w-6 items-center justify-center rounded-full bg-[#e8f2e2] text-[#2E7D32]"
                                aria-hidden="true">
                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </span>
                            <h2 class="font-serif text-sm font-bold text-[#2C1810] sm:text-base">Bukti Pembayaran Pelanggan
                            </h2>
                            @if ($transaksi->bukti_pembayaran)
                                <span
                                    class="ml-auto rounded-full bg-[#e8f2e2] px-2 py-0.5 text-[7px] font-semibold text-[#2E7D32]">Bukti
                                    Tersedia</span>
                            @endif
                        </div>
                        @if ($transaksi->bukti_pembayaran)
                            @if (strtolower(pathinfo($transaksi->bukti_pembayaran, PATHINFO_EXTENSION)) === 'pdf')
                                <a href="{{ asset('storage/' . $transaksi->bukti_pembayaran) }}" target="_blank"
                                    rel="noopener noreferrer"
                                    class="flex items-center gap-3 rounded-lg border border-[#e8dfcf] bg-[#faf7ed] p-3 transition hover:border-[#8B1E1E]">
                                    <svg class="h-8 w-8 shrink-0 text-[#8B1E1E]" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                    <span class="text-[10px] font-semibold text-[#8B1E1E]">Lihat bukti pembayaran
                                        PDF</span>
                                </a>
                            @else
                                <a href="{{ asset('storage/' . $transaksi->bukti_pembayaran) }}" target="_blank"
                                    rel="noopener noreferrer" class="block">
                                    <img src="{{ asset('storage/' . $transaksi->bukti_pembayaran) }}"
                                        alt="Bukti pembayaran"
                                        class="max-h-64 w-full rounded-lg border border-[#eee5d7] object-contain">
                                </a>
                            @endif
                        @else
                            <p class="rounded-md border border-[#eddfb8] bg-[#fff9e8] px-3 py-2 text-[9px] text-[#80652d]">
                                {{ $transaksi->metode_pembayaran === 'cod' ? 'Pembayaran COD — tidak perlu upload bukti. Bayar tunai saat pesanan diterima.' : 'Belum ada bukti pembayaran yang diunggah.' }}
                            </p>
                        @endif
                    </section>
                </div>

                {{-- ========== KOLOM KANAN ========== --}}
                <div class="min-w-0 space-y-4">

                    {{-- Rincian Pembayaran --}}
                    <section class="rounded-xl border border-[#e8dfcf] bg-white p-4 shadow-sm sm:p-5">
                        <h2
                            class="mb-3 flex items-center gap-1.5 border-b border-[#f1ece2] pb-2.5 font-serif text-sm font-bold text-[#2C1810] sm:text-base">
                            <svg class="h-4 w-4 text-[#8B1E1E]" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <rect x="3" y="5" width="18" height="14" rx="2" stroke-width="2" />
                                <path stroke-linecap="round" stroke-width="2" d="M3 10h18" />
                            </svg>
                            Rincian Pembayaran
                        </h2>

                        <div class="mb-3 flex items-start justify-between gap-2">
                            <span class="text-[9px] font-semibold text-[#796d5d]">Metode Pembayaran</span>
                            <span class="text-right text-[9px] font-semibold text-[#2C1810]">{{ $labelMetode }}</span>
                        </div>
                        @if ($transaksi->metode_pembayaran !== 'cod')
                            <div
                                class="mb-3 flex items-center justify-between gap-2 rounded-lg border border-[#eee5d7] bg-[#faf7ed] p-2.5">
                                <p class="font-mono text-[11px] font-bold tracking-wide text-[#8B1E1E]">
                                    {{ $nomorRekening }}</p>
                                <button type="button" onclick="copyText('{{ str_replace(' ', '', $nomorRekening) }}')"
                                    class="inline-flex items-center gap-1 whitespace-nowrap text-[8px] font-semibold text-[#52645a] transition hover:text-[#8B1E1E]">
                                    <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <rect x="9" y="9" width="11" height="11" rx="2"
                                            stroke-width="2" />
                                        <path stroke-linecap="round" stroke-width="2" d="M5 15V5a2 2 0 012-2h10" />
                                    </svg>
                                    Salin
                                </button>
                            </div>
                        @endif

                        <dl class="space-y-2 border-t border-[#f1ece2] pt-3 text-[10px]">
                            <div class="flex justify-between gap-2">
                                <dt class="text-[#796d5d]">Subtotal Produk ({{ $totalItem }} lilin)</dt>
                                <dd class="font-semibold text-[#2C1810]">
                                    Rp{{ number_format($totalHargaProduk, 0, ',', '.') }}</dd>
                            </div>
                            <div class="flex justify-between gap-2">
                                <dt class="text-[#796d5d]">Biaya Pengiriman &amp; Penanganan</dt>
                                <dd class="font-semibold text-[#2C1810]">
                                    Rp{{ number_format($biayaTambahan, 0, ',', '.') }}</dd>
                            </div>
                        </dl>

                        <div class="mt-3 rounded-lg border border-[#e5dccb] bg-[#faf7ed] p-3">
                            <p class="text-[8px] font-semibold uppercase tracking-wide text-[#796d5d]">Total Pembayaran
                                {{ $statusPembayaran === 'berhasil' ? 'Lunas' : 'Tagihan' }}</p>
                            <div class="mt-1 flex items-end justify-between gap-2">
                                <p class="font-serif text-2xl font-bold text-[#8B1E1E]">
                                    Rp{{ number_format($pesanan->total_harga, 0, ',', '.') }}</p>
                                @if ($statusPembayaran === 'berhasil')
                                    <span
                                        class="rounded-full bg-[#e8f2e2] px-2 py-0.5 text-[8px] font-semibold text-[#2E7D32]">Lunas</span>
                                @endif
                            </div>
                        </div>

                        <div
                            class="mt-3 flex items-center gap-2.5 rounded-lg border border-[#d6e8d0] bg-[#edf6e9] px-3 py-2.5">
                            <span
                                class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-[#d7ebcf] text-[#2E7D32]">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v8m-4-4h8" />
                                </svg>
                            </span>
                            <div class="min-w-0 flex-1">
                                <p class="text-[9px] font-semibold text-[#276236]">+{{ number_format($poinDidapat) }} Poin
                                    NusaCandle</p>
                                <p class="text-[8px] text-[#47784a]">Telah ditambahkan ke akun setia Anda.</p>
                            </div>
                            <a href="{{ route('poin.index') }}"
                                class="shrink-0 text-[9px] font-semibold text-[#2E7D32] underline underline-offset-2">Cek
                                Poin</a>
                        </div>

                        <a href="{{ route('pembeli.pesanan.show', $pesanan->id_pesanan) }}"
                            class="mt-3 flex w-full items-center justify-center gap-1.5 rounded-md bg-[#b83232] px-4 py-2.5 text-[10px] font-semibold text-white transition hover:bg-[#8B1E1E]">
                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            Lihat Detail Pesanan
                        </a>
                        <a href="{{ route('pembeli.transaksi.index') }}"
                            class="mt-2 flex w-full items-center justify-center gap-1.5 rounded-md border border-[#e5dccb] bg-[#f5f0e5] px-4 py-2.5 text-[10px] font-semibold text-[#52645a] transition hover:bg-[#ece5d6]">
                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Kembali ke Riwayat Transaksi
                        </a>
                        <p class="mt-3 text-center text-[8px] leading-relaxed text-[#796d5d]">
                            Butuh bantuan dengan transaksi ini?<br>
                            <span class="font-semibold text-[#2E7D32]">WhatsApp NusaCandle (+62 812-3456-7890)</span>
                        </p>
                    </section>

                    {{-- Konfirmasi Pembayaran (upload bukti) --}}
                    @if (!($isDemoPreview ?? false))
                        <section class="rounded-xl border border-[#e8dfcf] bg-white p-4 shadow-sm sm:p-5">
                            <h2 class="font-serif text-lg font-bold text-[#2C1810] sm:text-xl">Konfirmasi Pembayaran</h2>
                            <p class="mt-1 text-[9px] leading-relaxed text-[#796d5d]">
                                Kirim bukti transfer bank bila sistem belum memperbarui status pesanan Anda secara otomatis.
                            </p>

                            @if (
                                $transaksi->metode_pembayaran !== 'cod' &&
                                    $transaksi->status_pembayaran === 'menunggu' &&
                                    !$transaksi->bukti_pembayaran)
                                <form action="{{ route('pembeli.transaksi.store') }}" method="POST"
                                    enctype="multipart/form-data" class="mt-4">
                                    @csrf
                                    <input type="hidden" name="id_transaksi" value="{{ $transaksi->id_transaksi }}">

                                    {{-- Nama Pemilik Rekening --}}
                                    <div>
                                        <label for="nama_pemilik"
                                            class="mb-1 block text-[8px] font-semibold uppercase tracking-wide text-[#796d5d]">
                                            Nama Pemilik Rekening Pengirim
                                        </label>
                                        <input type="text" id="nama_pemilik" name="nama_pemilik" required
                                            placeholder="Contoh: Rian Anggoro"
                                            class="w-full rounded-md border border-[#e5dccb] bg-white px-3 py-2.5 text-[10px] text-[#2C1810] outline-none focus:border-[#8B1E1E] focus:ring-1 focus:ring-[#8B1E1E]/20">
                                    </div>

                                    {{-- Upload Bukti --}}
                                    <label for="bukti_pembayaran" class="mt-3 block">
                                        <span
                                            class="mb-1 block text-[8px] font-semibold uppercase tracking-wide text-[#796d5d]">
                                            Bukti Pembayaran (Foto/PDF Bukti Transfer)
                                        </span>
                                        <span
                                            class="flex cursor-pointer flex-col items-center justify-center rounded-lg border-2 border-dashed border-[#c9bda9] bg-[#faf7ed] px-4 py-7 text-center transition hover:border-[#8B1E1E] hover:bg-[#f5f0e5]">
                                            <svg class="mb-2 h-7 w-7 text-[#a99c8b]" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 0115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                            </svg>
                                            <span class="text-[9px] font-semibold text-[#2C1810]">Klik untuk pilih file
                                                atau seret gambar bukti transfer ke sini</span>
                                            <span class="mt-1 text-[8px] text-[#796d5d]">Format didukung: JPG, PNG, atau
                                                PDF (Maksimal 5MB)</span>
                                            <span id="file-name"
                                                class="mt-1.5 hidden text-[9px] font-semibold text-[#8B1E1E]"></span>
                                        </span>
                                        <input type="file" name="bukti_pembayaran" id="bukti_pembayaran"
                                            accept=".jpg,.jpeg,.png,.pdf" required class="hidden"
                                            onchange="showFileName(this)">
                                    </label>

                                    {{-- Footer: Privasi + Tombol --}}
                                    <div
                                        class="mt-4 flex flex-wrap items-center justify-between gap-3 border-t border-[#f1ece2] pt-3">
                                        <p class="flex items-center gap-1 text-[8px] text-[#796d5d]">
                                            <svg class="h-3.5 w-3.5 text-[#2E7D32]" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Privasi finansial terlindungi sistem SSL NusaCandle.
                                        </p>
                                        <button type="submit"
                                            class="inline-flex items-center gap-1.5 rounded-md bg-[#8B1E1E] px-4 py-2.5 text-[10px] font-semibold text-white transition hover:bg-[#6B1515]">
                                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.5-4.5a2 2 0 012.8 0L16 16m-2-2l1.5-1.5a2 2 0 012.8 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            Konfirmasi Pembayaran
                                        </button>
                                    </div>
                                </form>
                            @elseif ($transaksi->bukti_pembayaran && $transaksi->status_pembayaran === 'menunggu')
                                <div class="mt-3 rounded-md border border-[#cfe3c7] bg-[#edf6e9] p-3">
                                    <div class="flex items-start gap-2">
                                        <svg class="mt-0.5 h-4 w-4 shrink-0 text-[#2E7D32]" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <div>
                                            <p class="text-[9px] font-semibold text-[#276236]">Bukti pembayaran terkirim
                                            </p>
                                            <p class="mt-0.5 text-[8px] leading-relaxed text-[#47784a]">
                                                Terima kasih! Bukti transfer kamu sudah kami terima dan sedang menunggu
                                                verifikasi admin.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @elseif ($transaksi->status_pembayaran === 'berhasil')
                                <div class="mt-3 rounded-md border border-[#cfe3c7] bg-[#edf6e9] p-3">
                                    <p class="text-[9px] font-semibold text-[#276236]">Pembayaran sudah diverifikasi</p>
                                    <p class="mt-0.5 text-[8px] leading-relaxed text-[#47784a]">
                                        Tidak perlu mengirim bukti lagi. Pesanan Anda sedang diproses.
                                    </p>
                                </div>
                            @elseif ($transaksi->status_pembayaran === 'gagal')
                                <div class="mt-3 rounded-md border border-[#edc4c4] bg-[#fff1f1] p-3">
                                    <p class="text-[9px] font-semibold text-[#9b2727]">Pembayaran dibatalkan</p>
                                    <p class="mt-0.5 text-[8px] leading-relaxed text-[#9b2727]">
                                        Transaksi ini tidak berhasil. Silakan buat pesanan baru bila ingin melanjutkan.
                                    </p>
                                </div>
                            @elseif ($transaksi->metode_pembayaran === 'cod')
                                <div class="mt-3 rounded-md border border-[#cfe3c7] bg-[#edf6e9] p-3">
                                    <p class="text-[9px] font-semibold text-[#276236]">Pembayaran di Tempat (COD)</p>
                                    <p class="mt-0.5 text-[8px] leading-relaxed text-[#47784a]">
                                        Tidak perlu upload bukti. Siapkan pembayaran saat pesanan diterima.
                                    </p>
                                </div>
                            @endif
                        </section>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        function copyText(text) {
            navigator.clipboard.writeText(text).then(() => {
                alert('Berhasil disalin: ' + text);
            }).catch(() => {
                const t = document.createElement('textarea');
                t.value = text;
                document.body.appendChild(t);
                t.select();
                document.execCommand('copy');
                document.body.removeChild(t);
                alert('Berhasil disalin: ' + text);
            });
        }

        function showFileName(input) {
            const name = input.files[0]?.name;
            const el = document.getElementById('file-name');
            if (name) {
                el.textContent = '✓ ' + name;
                el.classList.remove('hidden');
            } else {
                el.classList.add('hidden');
            }
        }
    </script>
@endsection
