@extends('layouts.pembeli')

@section('title', 'Detail Transaksi #' . str_pad($transaksi->id_transaksi, 5, '0', STR_PAD_LEFT) . ' - NusaCandle')

@section('content')
    @php
        $isDemoPreview = $isDemoPreview ?? false;
        $pesanan = $transaksi->pesanan;
        $totalItem = $pesanan->detailPesanan->sum('jumlah');
        $totalHargaProduk = $pesanan->detailPesanan->sum(
            fn ($detail) => $detail->harga_satuan * $detail->jumlah
        );
        $statusPembayaran = $transaksi->status_pembayaran;
        $progressIndex = match ($statusPembayaran) {
            'berhasil' => 3,
            'gagal' => 2,
            default => 1,
        };
        $createdAt = $transaksi->created_at->locale('id')->translatedFormat('d M Y, H:i') . ' WIB';
        $updatedAt = $transaksi->updated_at ?? null;
        $updatedAtLabel = $updatedAt?->locale('id')->translatedFormat('d M Y, H:i');
        $updatedAtLabel = $updatedAtLabel ? $updatedAtLabel . ' WIB' : null;
        $progressSteps = [
            ['label' => 'Transaksi Dibuat', 'description' => $createdAt],
            ['label' => 'Menunggu Pembayaran', 'description' => $createdAt],
            ['label' => 'Pembayaran Diverifikasi', 'description' => $statusPembayaran === 'berhasil'
                ? ($updatedAtLabel ?? 'Pembayaran berhasil diverifikasi')
                : ($statusPembayaran === 'gagal' ? 'Pembayaran tidak berhasil' : 'Menunggu verifikasi')],
            ['label' => 'Pembayaran Berhasil', 'description' => $statusPembayaran === 'berhasil'
                ? ($updatedAtLabel ?? 'Transaksi lunas')
                : ($statusPembayaran === 'gagal' ? 'Transaksi tidak lunas' : 'Belum lunas')],
        ];
        $statusPresentation = match ($statusPembayaran) {
            'berhasil' => [
                'title' => 'Pembayaran Berhasil Diverifikasi',
                'description' => 'Transaksi telah selesai dan dana terkonfirmasi otomatis oleh sistem perbankan. Pesanan lilin aromaterapi Anda sedang diproses oleh artisan di Batu, Jawa Timur.',
                'badge' => 'Lunas',
            ],
            'gagal' => [
                'title' => 'Transaksi Dibatalkan',
                'description' => 'Transaksi ini tidak berhasil diselesaikan.',
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

    <style>
        body:has(.transaction-detail-page) {
            background: #faf7ed;
        }

        body:has(.transaction-detail-page) > nav:not(#catalog-pagination) {
            border-top: 3px solid #8b1e1e;
            background: #faf7ed;
            box-shadow: none;
        }

        body:has(.transaction-detail-page) footer {
            border-top-color: #e8dfcd;
            background: #f5f0e2;
        }

        @media print {
            body:has(.transaction-detail-page) nav,
            body:has(.transaction-detail-page) footer,
            .transaction-detail-no-print {
                display: none !important;
            }

            body:has(.transaction-detail-page),
            .transaction-detail-page {
                background: #fff !important;
            }
        }
    </style>

    <div class="transaction-detail-page min-h-screen bg-[#faf7ed] text-[#2C1810]">
        <div class="mx-auto max-w-7xl px-4 pb-8 pt-3 sm:px-6 lg:px-8">
            <nav aria-label="Jejak halaman" class="mb-3 flex flex-wrap items-center gap-2 text-[9px] text-[#796d5d]">
                <a href="{{ route('home') }}" class="transition hover:text-[#8B1E1E]">Beranda</a>
                <span aria-hidden="true">/</span>
                <a href="{{ route('pembeli.transaksi.index') }}" class="transition hover:text-[#8B1E1E]">Transaksi Saya</a>
                <span aria-hidden="true">/</span>
                <span class="font-semibold text-[#8B1E1E]">Detail Transaksi</span>
            </nav>

            <header class="mb-4 flex flex-wrap items-end justify-between gap-3">
                <div>
                    <p class="mb-1 text-[8px] font-semibold uppercase tracking-[0.16em] text-[#2E7D32]">NusaCandle · Rincian Pembayaran</p>
                    <h1 class="font-serif text-xl font-bold leading-tight text-[#8B1E1E] sm:text-2xl">Detail Transaksi</h1>
                    <p class="mt-1 text-[9px] text-[#796d5d]">
                        TRX-{{ str_pad($transaksi->id_transaksi, 5, '0', STR_PAD_LEFT) }}
                        <span class="px-1" aria-hidden="true">·</span>
                        Dibuat {{ $transaksi->created_at->locale('id')->translatedFormat('d F Y, H:i') }} WIB
                    </p>
                </div>
                <div class="transaction-detail-no-print flex flex-wrap items-center gap-2">
                    <button type="button" onclick="window.print()" class="inline-flex items-center gap-1.5 rounded-md border border-[#e8dfcf] bg-white px-3 py-2 text-[9px] font-semibold text-[#2C1810] transition hover:border-[#8B1E1E]">
                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 9V2h12v7M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2M6 14h12v8H6v-8z"/>
                        </svg>
                        Cetak / Simpan PDF
                    </button>
                    <a href="{{ route('pembeli.transaksi.index') }}" class="inline-flex items-center gap-1.5 rounded-md bg-[#8B1E1E] px-3 py-2 text-[9px] font-semibold text-white transition hover:bg-[#6B1515]">
                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali
                    </a>
                </div>
            </header>

            @if ($isDemoPreview)
                <div class="mb-3 rounded-lg border border-[#eddfb8] bg-[#fff9e8] px-3 py-2 text-[9px] text-[#796d5d]" role="note">
                    Ini pratinjau transaksi contoh. Informasi ini tidak tersimpan dan bukan transaksi untuk pembayaran.
                </div>
            @endif

            <section class="mb-4 rounded-xl border border-[#eee9df] bg-white p-4 shadow-sm sm:p-5" aria-labelledby="transaction-status-title">
                <div class="mb-6 flex items-start gap-3 rounded-lg px-3 py-3 sm:px-4 {{ $statusCardClasses }}">
                    <span class="mt-0.5 flex h-7 w-7 shrink-0 items-center justify-center rounded-full text-white {{ $statusIconClasses }}" aria-hidden="true">
                        @if ($statusPembayaran === 'berhasil')
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        @elseif ($statusPembayaran === 'gagal')
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        @else
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        @endif
                    </span>
                    <div class="min-w-0 flex-1">
                        <div class="flex flex-wrap items-center gap-2">
                            <h2 id="transaction-status-title" class="font-serif text-sm font-bold leading-tight sm:text-base">{{ $statusPresentation['title'] }}</h2>
                            <span class="rounded-full px-2 py-0.5 text-[7px] font-bold sm:text-[8px] {{ $statusBadgeClasses }}">{{ $statusPresentation['badge'] }}</span>
                        </div>
                        <p class="mt-1 text-[8px] leading-relaxed opacity-90 sm:text-[9px]">{{ $statusPresentation['description'] }}</p>
                    </div>
                </div>
                <div class="overflow-x-auto pb-1">
                    <ol class="relative grid min-w-[620px] grid-cols-4">
                        <li aria-hidden="true" class="absolute left-[12.5%] right-[12.5%] top-3.5 h-0.5 rounded-full bg-[#e9e9e2]">
                            <span class="absolute left-0 top-0 h-full rounded-full bg-[#47784a]" style="width: {{ min($progressIndex, 3) * 33.333 }}%;"></span>
                        </li>
                        @foreach ($progressSteps as $index => $step)
                            @php
                                $isComplete = $statusPembayaran === 'berhasil' || $index < $progressIndex;
                                $isCurrent = $statusPembayaran !== 'berhasil' && $index === $progressIndex;
                                $stepClasses = $isComplete
                                    ? 'bg-[#47784a] text-white'
                                    : ($isCurrent
                                        ? ($statusPembayaran === 'gagal' ? 'bg-[#a51f24] text-white' : 'bg-[#a97723] text-white')
                                        : 'bg-[#f2f0eb] text-[#b9b2a7]');
                            @endphp
                            <li class="relative z-10 flex min-w-0 flex-col items-center px-2 text-center">
                                <span class="flex h-7 w-7 items-center justify-center rounded-full ring-4 ring-white {{ $stepClasses }}">
                                    @if ($isComplete)
                                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                        </svg>
                                    @elseif ($statusPembayaran === 'gagal' && $isCurrent)
                                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    @else
                                        {{ $index + 1 }}
                                    @endif
                                </span>
                                <span class="mt-2 block text-[8px] font-semibold leading-snug {{ $isCurrent ? ($statusPembayaran === 'gagal' ? 'text-[#a51f24]' : 'text-[#80652d]') : ($isComplete ? 'text-[#2C1810]' : 'text-[#8f877c]') }} sm:text-[9px]">
                                    {{ $step['label'] }}
                                </span>
                                <span class="mt-1 block text-[7px] leading-snug text-[#9a8f81] sm:text-[8px]">{{ $step['description'] }}</span>
                            </li>
                        @endforeach
                    </ol>
                </div>
            </section>

            <div class="grid grid-cols-1 items-start gap-4 lg:grid-cols-[minmax(0,1.7fr)_minmax(250px,0.8fr)]">
                <div class="min-w-0 space-y-4">
                    <section class="rounded-lg border border-[#e8dfcf] bg-white p-3 shadow-sm sm:p-4">
                        <div class="mb-3 flex items-center justify-between gap-2 border-b border-[#f1ece2] pb-2">
                            <h2 class="font-serif text-[11px] font-bold sm:text-xs">Informasi Transaksi</h2>
                            <span class="rounded-full px-2 py-0.5 text-[7px] font-semibold {{ $transaksi->status_color }}">{{ $transaksi->status_label }}</span>
                        </div>
                        <dl class="grid grid-cols-1 gap-2 sm:grid-cols-2">
                            <div class="rounded-md bg-[#faf7ed] p-2.5">
                                <dt class="text-[7px] font-semibold uppercase tracking-wide text-[#796d5d]">ID Transaksi</dt>
                                <dd class="mt-1 text-[9px] font-semibold text-[#8B1E1E]">TRX-{{ str_pad($transaksi->id_transaksi, 5, '0', STR_PAD_LEFT) }}</dd>
                            </div>
                            <div class="rounded-md bg-[#faf7ed] p-2.5">
                                <dt class="text-[7px] font-semibold uppercase tracking-wide text-[#796d5d]">ID Pesanan</dt>
                                <dd class="mt-1 text-[9px] font-semibold text-[#8B1E1E]">
                                    #NC-{{ $pesanan->created_at->format('Y') }}-{{ str_pad($pesanan->id_pesanan, 4, '0', STR_PAD_LEFT) }}
                                </dd>
                            </div>
                            <div class="rounded-md bg-[#faf7ed] p-2.5">
                                <dt class="text-[7px] font-semibold uppercase tracking-wide text-[#796d5d]">Tanggal Transaksi</dt>
                                <dd class="mt-1 text-[8px] text-[#2C1810]">{{ $transaksi->created_at->locale('id')->translatedFormat('d F Y, H:i') }} WIB</dd>
                            </div>
                            <div class="rounded-md bg-[#faf7ed] p-2.5">
                                <dt class="text-[7px] font-semibold uppercase tracking-wide text-[#796d5d]">Metode Pembayaran</dt>
                                <dd class="mt-1 text-[8px] font-semibold text-[#2C1810]">{{ $transaksi->metode_label }}</dd>
                            </div>
                            <div class="rounded-md bg-[#faf7ed] p-2.5">
                                <dt class="text-[7px] font-semibold uppercase tracking-wide text-[#796d5d]">Nama Pemesan</dt>
                                <dd class="mt-1 text-[8px] text-[#2C1810]">{{ auth()->user()->nama_lengkap }}</dd>
                            </div>
                            <div class="rounded-md bg-[#faf7ed] p-2.5">
                                <dt class="text-[7px] font-semibold uppercase tracking-wide text-[#796d5d]">Kontak Pemesan</dt>
                                <dd class="mt-1 break-words text-[8px] text-[#2C1810]">
                                    {{ auth()->user()->no_telepon ?: auth()->user()->email ?: auth()->user()->username }}
                                </dd>
                            </div>
                            <div class="rounded-md bg-[#faf7ed] p-2.5 sm:col-span-2">
                                <dt class="text-[7px] font-semibold uppercase tracking-wide text-[#796d5d]">Alamat Pengiriman</dt>
                                <dd class="mt-1 text-[8px] leading-relaxed text-[#2C1810]">
                                    {{ auth()->user()->alamat ?: 'Alamat belum dilengkapi di profil.' }}
                                </dd>
                            </div>
                        </dl>
                    </section>

                    <section class="rounded-lg border border-[#e8dfcf] bg-white p-3 shadow-sm sm:p-4">
                        <div class="mb-3 flex items-center justify-between gap-2 border-b border-[#f1ece2] pb-2">
                            <h2 class="font-serif text-[11px] font-bold sm:text-xs">Rincian Lilin Botanikal</h2>
                            <span class="rounded-full bg-[#e8f2e2] px-2 py-0.5 text-[7px] font-semibold text-[#2E7D32]">{{ $totalItem }} Barang</span>
                        </div>
                        <div class="space-y-2.5">
                            @foreach ($pesanan->detailPesanan as $detail)
                                <article class="flex items-center gap-2.5 border-b border-[#f1ece2] pb-2.5 last:border-0 last:pb-0 sm:gap-3">
                                    @if ($detail->produk?->gambar)
                                        <img src="{{ asset('storage/' . $detail->produk->gambar) }}" alt="{{ $detail->produk->nama_produk }}" class="h-12 w-12 shrink-0 rounded-md border border-[#eee5d7] object-cover sm:h-14 sm:w-14">
                                    @else
                                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-md border border-[#eee5d7] bg-[#f3eddf] sm:h-14 sm:w-14" aria-label="Lilin aromaterapi">
                                            <svg class="h-8 w-8" viewBox="0 0 64 64" fill="none" aria-hidden="true">
                                                <ellipse cx="32" cy="55" rx="21" ry="4" fill="#604a35" opacity=".22"/>
                                                <path d="M32 6c-7 10-5 15 0 18 5-3 7-8 0-18Z" fill="#e99b43"/>
                                                <path d="M32 11c-3 5-2 8 0 10 2-2 3-5 0-10Z" fill="#fff1bc"/>
                                                <rect x="14" y="23" width="36" height="31" rx="7" fill="#536044" stroke="#ded2b6" stroke-width="2"/>
                                                <ellipse cx="32" cy="24" rx="17" ry="4" fill="#e9dfc9"/>
                                                <rect x="19" y="34" width="26" height="11" rx="2" fill="#e9dfc9"/>
                                                <path d="M23 38h18" stroke="#8b7658" stroke-width="1.5"/>
                                            </svg>
                                        </div>
                                    @endif
                                    <div class="min-w-0 flex-1">
                                        <span class="mb-1 inline-flex rounded-full bg-[#e8f2e2] px-1.5 py-0.5 text-[6px] font-semibold text-[#2E7D32] sm:text-[7px]">NusaCandle · Lilin Alami</span>
                                        <h3 class="font-serif text-[9px] font-bold leading-snug sm:text-[10px]">{{ $detail->produk?->nama_produk ?? 'Produk' }}</h3>
                                        <p class="mt-1 text-[7px] text-[#796d5d] sm:text-[8px]">
                                            {{ $detail->jumlah }} pcs <span class="px-1" aria-hidden="true">·</span>
                                            Rp{{ number_format($detail->harga_satuan, 0, ',', '.') }} / pcs
                                        </p>
                                    </div>
                                    <p class="shrink-0 text-right text-[9px] font-bold text-[#8B1E1E] sm:text-[10px]">
                                        Rp{{ number_format($detail->harga_satuan * $detail->jumlah, 0, ',', '.') }}
                                    </p>
                                </article>
                            @endforeach
                        </div>
                    </section>

                    <section class="rounded-lg border border-[#e8dfcf] bg-white p-3 shadow-sm sm:p-4">
                        <div class="mb-3 flex items-center gap-2 border-b border-[#f1ece2] pb-2">
                            <span class="flex h-6 w-6 items-center justify-center rounded-full bg-[#e8f2e2] text-[#2E7D32]" aria-hidden="true">
                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </span>
                            <h2 class="font-serif text-[11px] font-bold sm:text-xs">Bukti Pembayaran Pelanggan</h2>
                            @if ($transaksi->bukti_pembayaran)
                                <span class="ml-auto rounded-full bg-[#e8f2e2] px-2 py-0.5 text-[7px] font-semibold text-[#2E7D32]">Bukti Tersedia</span>
                            @endif
                        </div>
                        @if ($transaksi->bukti_pembayaran)
                            @if (strtolower(pathinfo($transaksi->bukti_pembayaran, PATHINFO_EXTENSION)) === 'pdf')
                                <a href="{{ asset('storage/' . $transaksi->bukti_pembayaran) }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 rounded-md border border-[#e8dfcf] bg-[#faf7ed] p-3 text-[9px] font-semibold text-[#8B1E1E] transition hover:border-[#8B1E1E]">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                    </svg>
                                    Lihat bukti pembayaran PDF
                                </a>
                            @else
                                <a href="{{ asset('storage/' . $transaksi->bukti_pembayaran) }}" target="_blank" rel="noopener noreferrer" class="inline-block">
                                    <img src="{{ asset('storage/' . $transaksi->bukti_pembayaran) }}" alt="Bukti pembayaran transaksi" class="max-h-48 rounded-md border border-[#eee5d7] object-contain">
                                </a>
                            @endif
                        @else
                            <p class="rounded-md border border-[#eddfb8] bg-[#fff9e8] px-3 py-2 text-[8px] text-[#80652d]">
                                Belum ada bukti pembayaran yang diunggah.
                            </p>
                        @endif
                    </section>
                </div>

                <aside class="min-w-0 space-y-3">
                    <section class="rounded-lg border border-[#e8dfcf] bg-white p-3 shadow-sm sm:p-4">
                        <div class="mb-2 flex items-center justify-between gap-2 border-b border-[#f1ece2] pb-2">
                            <h2 class="font-serif text-[11px] font-bold sm:text-xs">Rincian Pembayaran</h2>
                            <svg class="h-3.5 w-3.5 text-[#8B1E1E]" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <dl class="space-y-2 border-b border-[#f1ece2] pb-3 text-[8px]">
                            <div class="flex justify-between gap-2">
                                <dt class="text-[#796d5d]">Harga Produk</dt>
                                <dd class="font-semibold">Rp{{ number_format($totalHargaProduk, 0, ',', '.') }}</dd>
                            </div>
                            <div class="flex justify-between gap-2">
                                <dt class="text-[#796d5d]">Metode Pembayaran</dt>
                                <dd class="text-right font-semibold">{{ $transaksi->metode_label }}</dd>
                            </div>
                            <div class="flex justify-between gap-2">
                                <dt class="text-[#796d5d]">Status Pembayaran</dt>
                                <dd class="font-semibold">{{ $transaksi->status_label }}</dd>
                            </div>
                        </dl>
                        <div class="flex items-center justify-between gap-2 pt-3">
                            <span class="text-[9px] font-semibold">Total Tagihan</span>
                            <span class="font-serif text-sm font-bold text-[#8B1E1E] sm:text-base">Rp{{ number_format($pesanan->total_harga, 0, ',', '.') }}</span>
                        </div>
                    </section>
                </aside>
            </div>
        </div>
    </div>
@endsection