@extends('layouts.pembeli')

@section('title', request()->has('demo_transaction') ? 'Detail Transaksi - NusaCandle' : 'Transaksi Saya - NusaCandle')

@section('content')
    @php
        $showDemoPreview = $transaksiBerjalan->isEmpty() && $riwayatTransaksi->isEmpty();
        $demoTransaksiBerjalan = (object) [
            'id_transaksi' => 99412,
            'metode_pembayaran' => 'bca',
            'metode_label' => 'BCA Virtual Account',
            'status_pembayaran' => 'menunggu',
            'status_label' => 'Menunggu Pembayaran',
            'status_color' => 'bg-yellow-100 text-yellow-800',
            'bukti_pembayaran' => null,
            'created_at' => \Illuminate\Support\Carbon::parse('2024-09-29 09:12:00'),
            'pesanan' => (object) [
                'id_pesanan' => 8902,
                'status_pesanan' => 'menunggu_pembayaran',
                'status_label' => 'Menunggu Pembayaran',
                'created_at' => \Illuminate\Support\Carbon::parse('2024-09-29 09:12:00'),
                'total_harga' => 89000,
                'detailPesanan' => collect([
                    (object) [
                        'jumlah' => 1,
                        'harga_satuan' => 89000,
                        'produk' => (object) [
                            'gambar' => null,
                            'nama_produk' => 'NusaCandle - Lilin Aroma Terapi Aroma Apel',
                        ],
                    ],
                ]),
            ],
        ];
        $demoRiwayatTransaksi = collect(
            array_map(
                static function (array $row): object {
                    $tanggal = \Illuminate\Support\Carbon::parse($row['tanggal']);
                    $statusColor = match ($row['status']) {
                        'berhasil' => 'bg-green-100 text-green-800',
                        'menunggu' => 'bg-yellow-100 text-yellow-800',
                        default => 'bg-red-100 text-red-800',
                    };
                    $statusPesanan = match ($row['status']) {
                        'berhasil' => 'selesai',
                        'menunggu' => 'menunggu_pembayaran',
                        default => 'dibatalkan',
                    };

                    return (object) [
                        'id_transaksi' => $row['id_transaksi'],
                        'status_pembayaran' => $row['status'],
                        'status_label' => $row['label'],
                        'status_color' => $statusColor,
                        'metode_label' => $row['metode'],
                        'bukti_pembayaran' => null,
                        'created_at' => $tanggal,
                        'pesanan' => (object) [
                            'id_pesanan' => $row['id_pesanan'],
                            'status_pesanan' => $statusPesanan,
                            'status_label' => match ($statusPesanan) {
                                'selesai' => 'Selesai',
                                'dibatalkan' => 'Dibatalkan',
                                default => 'Menunggu Pembayaran',
                            },
                            'created_at' => $tanggal,
                            'total_harga' => $row['total'],
                            'detailPesanan' => collect([
                                (object) [
                                    'jumlah' => $row['jumlah'],
                                    'harga_satuan' => (int) ($row['total'] / $row['jumlah']),
                                    'produk' => (object) [
                                        'gambar' => null,
                                        'nama_produk' => 'NusaCandle - Lilin Aroma Terapi Aroma Apel',
                                    ],
                                ],
                            ]),
                        ],
                    ];
                },
                [
                    [
                        'id_transaksi' => 92110,
                        'id_pesanan' => 8841,
                        'tanggal' => '2024-09-14',
                        'status' => 'berhasil',
                        'label' => 'Berhasil',
                        'metode' => 'QRIS Gopay',
                        'jumlah' => 2,
                        'total' => 178000,
                    ],
                    [
                        'id_transaksi' => 91402,
                        'id_pesanan' => 8012,
                        'tanggal' => '2024-09-10',
                        'status' => 'menunggu',
                        'label' => 'Menunggu Verifikasi',
                        'metode' => 'Transfer Bank BCA',
                        'jumlah' => 1,
                        'total' => 89000,
                    ],
                    [
                        'id_transaksi' => 87192,
                        'id_pesanan' => 7012,
                        'tanggal' => '2024-09-12',
                        'status' => 'berhasil',
                        'label' => 'Berhasil',
                        'metode' => 'Transfer Mandiri',
                        'jumlah' => 1,
                        'total' => 89000,
                    ],
                    [
                        'id_transaksi' => 81023,
                        'id_pesanan' => 6791,
                        'tanggal' => '2024-09-01',
                        'status' => 'gagal',
                        'label' => 'Dibatalkan',
                        'metode' => 'Transfer Bank BCA',
                        'jumlah' => 1,
                        'total' => 89000,
                    ],
                ],
            ),
        );
        $displayTransaksiBerjalan = $showDemoPreview ? collect([$demoTransaksiBerjalan]) : $transaksiBerjalan;
        $displayRiwayatTransaksi = $showDemoPreview ? $demoRiwayatTransaksi : $riwayatTransaksi;
        $displayTotalBerhasil = $showDemoPreview ? 2 : $totalBerhasil;
        $displayTotalMenunggu = $showDemoPreview ? 1 : $totalMenunggu;
        $displayTotalDibatalkan = $showDemoPreview ? 1 : $totalDibatalkan;
        $requestedDemoTransactionId = filter_var(request()->query('demo_transaction'), FILTER_VALIDATE_INT);
        $demoDetailTransaksi =
            $requestedDemoTransactionId !== false
                ? collect([$demoTransaksiBerjalan])
                    ->merge($demoRiwayatTransaksi)
                    ->firstWhere('id_transaksi', $requestedDemoTransactionId)
                : null;
        $showDemoTransactionDetail = $showDemoPreview && $demoDetailTransaksi !== null;
    @endphp

    @if ($showDemoTransactionDetail)
        @include('pages.pembeli.partials.detail_transaksi_content', ['transaksi' => $demoDetailTransaksi, 'isDemoPreview' => true])
    @else
<div class="transactions-page min-h-screen bg-[#faf7ed] text-[#2c1810]">
        {{-- Header --}}
        <div class="transactions-header border-b border-[#e8dfcd] bg-transparent">
            <div class="transactions-header-inner max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="flex flex-wrap items-start justify-between gap-4">
                    <div>
                        <div class="inline-flex items-center gap-2 bg-[#E8F5E9] px-3 py-1 rounded-full mb-3">
                            <svg class="w-4 h-4 text-[#2E7D32]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="text-xs font-semibold text-[#2E7D32]">Portal Pembayaran Pelanggan</span>
                        </div>
                        <h1 class="font-display text-4xl font-bold text-[#2C1810]">Transaksi Saya</h1>
                        <p class="text-[#718078] mt-2 max-w-2xl">Daftar riwayat pembayaran dan konfirmasi transaksi lilin aromaterapi Anda. Kelola tagihan aktif dengan verifikasi aman.</p>
                    </div>

            .transactions-page .transactions-confirmation label {
                margin-bottom: 0.12rem !important;
                font-size: 0.62rem;
            }

            .transactions-page .transactions-confirmation input:not([type="file"]) {
                min-width: 0;
                padding: 0.35rem 0.4rem;
                font-size: 0.66rem;
            }

            .transactions-page .transactions-upload {
                padding: 0.9rem;
            }

            .transactions-page .transactions-upload svg {
                width: 1.15rem;
                height: 1.15rem;
                margin-bottom: 0.2rem !important;
            }

            .transactions-page .transactions-upload p {
                font-size: 0.64rem;
                line-height: 1.35;
            }

            .transactions-page .transactions-privacy {
                font-size: 0.64rem;
            }

            .transactions-page .transactions-confirmation form>button {
                padding: 0.4rem 0.55rem;
                font-size: 0.68rem;
            }

            .transactions-page .transactions-confirmation .transactions-form-body>button {
                padding: 0.4rem 0.55rem;
                font-size: 0.68rem;
            }

            .transactions-page .transactions-guarantee {
                display: none;
            }

            .transactions-page .transactions-history-heading {
                gap: 0.5rem;
                padding: 0.5rem 1rem;
            }

            .transactions-page .transactions-history-heading h2 {
                font-size: 1rem;
            }

            .transactions-page .transactions-history-heading p {
                font-size: 0.62rem;
            }

            .transactions-page .transactions-history-heading>div:last-child {
                gap: 0.2rem;
            }

            .transactions-page .transactions-history-heading span {
                padding: 0.15rem 0.3rem;
                font-size: 0.6rem;
                white-space: nowrap;
            }

            .transactions-page .transactions-history-heading span:last-child {
                background: #f3f0e9;
                color: #6b6258;
            }

            .transactions-page .transactions-history-row {
                gap: 0.45rem;
                padding: 0.45rem 0.75rem;
                background: #fbf8f0;
                border: 1px solid #eee6d4;
                border-radius: 0.4rem;
                margin: 0.35rem 0.6rem;
            }

            .transactions-page .transactions-history-row+.transactions-history-row {
                border-top: 1px solid #eee6d4;
            }

            .transactions-page .transactions-history-icon {
                width: 1.7rem;
                height: 1.7rem;
            }

            .transactions-page .transactions-history-icon svg {
                width: 0.9rem;
                height: 0.9rem;
            }

            .transactions-page .transactions-history-info>div:first-child {
                flex-wrap: wrap;
                gap: 0.2rem;
                margin-bottom: 0.1rem !important;
            }

            .transactions-page .transactions-history-info p:first-child {
                font-size: 0.66rem;
            }

            .transactions-page .transactions-history-info p,
            .transactions-page .transactions-history-total p:first-child {
                font-size: 0.6rem;
            }

            .transactions-page .transactions-history-info p:nth-child(2) {
                font-size: 0.68rem;
            }

            .transactions-page .transactions-history-info span {
                font-size: 0.58rem;
            }

            .transactions-page .transactions-history-total p:last-child {
                font-size: 0.86rem;
            }

            .transactions-page .transactions-history-row>a,
            .transactions-page .transactions-history-row>span {
                gap: 0.2rem;
                padding: 0.3rem 0.4rem;
                font-size: 0.64rem;
            }

            .transactions-page .transactions-empty {
                padding: 1.4rem 0.75rem;
            }

            .transactions-page .transactions-history .transactions-empty {
                padding: 1.2rem 0.75rem;
            }

            .transactions-page .transactions-empty svg {
                width: 2.5rem;
                height: 2.5rem;
                margin-bottom: 0.35rem !important;
            }

            .transactions-page .transactions-empty p:first-of-type {
                font-size: 0.75rem;
            }

            .transactions-page .transactions-empty p:last-of-type {
                font-size: 0.68rem;
            }

            @media (min-width: 500px) and (max-width: 767px) {
                body:has(.transactions-page) nav>div {
                    max-width: none;
                    padding-right: 0.5rem;
                    padding-left: 0.5rem;
                }

                body:has(.transactions-page) nav>div>div {
                    height: 2.5rem;
                    gap: 0.25rem;
                }

                body:has(.transactions-page) nav>div>div>a img {
                    width: 1.6rem;
                    height: 1.6rem;
                }

                body:has(.transactions-page) nav>div>div>a h1 {
                    font-size: 0.75rem;
                    line-height: 1.1;
                }

                body:has(.transactions-page) nav>div>div>a p {
                    font-size: 0.35rem;
                }

                body:has(.transactions-page) nav>div>div>div:nth-child(2) {
                    display: flex;
                    gap: 0;
                }

                body:has(.transactions-page) nav>div>div>div:nth-child(2) a {
                    padding: 0.25rem 0.2rem;
                    font-size: 0.5rem;
                }

                body:has(.transactions-page) nav>div>div>div:nth-child(3) {
                    gap: 0.2rem;
                }

                body:has(.transactions-page) nav>div>div>div:nth-child(3) svg {
                    width: 0.8rem;
                    height: 0.8rem;
                }

                body:has(.transactions-page) nav>div>div>div:nth-child(3)>div>div {
                    width: 1.1rem;
                    height: 1.1rem;
                    font-size: 0.6rem;
                }
            }

            @media (max-width: 480px) {

                .transactions-page .transactions-header-inner,
                .transactions-page .transactions-content {
                    width: calc(100% - 1.4rem);
                    margin-right: 0.7rem;
                    margin-left: 0.7rem;
                    padding-right: 0;
                    padding-left: 0;
                }

                .transactions-page .transactions-header-inner>.flex {
                    flex-wrap: wrap;
                }

                .transactions-page .transactions-grid {
                    grid-template-columns: minmax(0, 1fr);
                }

                .transactions-page .transactions-security {
                    flex-wrap: wrap;
                }

                .transactions-page .transactions-history-heading {
                    align-items: flex-start;
                    flex-direction: column;
                }

                .transactions-page .transactions-history-row {
                    flex-wrap: wrap;
                }

                .transactions-page .transactions-history-info {
                    flex-basis: calc(100% - 2rem);
                }

                .transactions-page .transactions-history-total {
                    margin-left: 2rem;
                }

                .transactions-page .transactions-history-row>a,
                .transactions-page .transactions-history-row>span {
                    margin-left: auto;
                }
            }

            @media (max-width: 480px) {
                .transactions-page .transactions-header-inner>div {
                    gap: 0.35rem;
                }

                .transactions-page .transactions-confirmation .transactions-form-row {
                    grid-template-columns: minmax(0, 1fr);
                }

                .transactions-page .transactions-card-footer {
                    flex-direction: column;
                }

                .transactions-page .transactions-card-footer>* {
                    width: 100%;
                }
            }
        </style>
        <div class="transactions-page">
            {{-- Header --}}
            <div class="transactions-header bg-white border-b border-gray-200">
                <div class="transactions-header-inner max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                    <div class="flex flex-wrap items-start justify-between gap-4">
                        <div>
                            <div class="inline-flex items-center gap-2 bg-[#E8F5E9] px-3 py-1 rounded-full mb-3">
                                <svg class="w-4 h-4 text-[#2E7D32]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-xs font-semibold text-[#2E7D32]">Portal Pembayaran Pelanggan</span>
                            </div>
                            <h1 class="font-serif text-4xl font-bold text-[#2C1810]">Transaksi Saya</h1>
                            <p class="text-[#718078] mt-2 max-w-2xl">Daftar riwayat pembayaran dan konfirmasi transaksi
                                lilin aromaterapi Anda. Kelola tagihan aktif dengan verifikasi aman.</p>
                        </div>

                        {{-- Security Info --}}
                        <div class="transactions-security flex items-center gap-4 text-xs text-[#718078]">
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4 text-[#2E7D32]" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>Enkripsi 256-Bit</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4 text-[#8B1E1E]" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                                <span>Verifikasi Otomatis</span>
                            </div>
                            @if ($showDemoPreview)
                                <span class="transactions-demo-label">PRATINJAU DEMO</span>
                            @endif
                        </div>
                        @if ($showDemoPreview)
                            <span class="transactions-demo-label rounded-full bg-[#f7eee3] px-2 py-1 text-[10px] font-bold tracking-wider text-[#8B1E1E]">PRATINJAU DEMO</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="transactions-content max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

                <div class="transactions-grid grid lg:grid-cols-2 gap-6 mb-8">
                    {{-- TRANSAKSI BERJALAN --}}
                    @if ($displayTransaksiBerjalan->count() > 0)
                        <section>
                            @foreach ($displayTransaksiBerjalan as $transaksi)
                                <div
                                    class="transactions-card bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden mb-4">
                                    {{-- Header --}}
                                    <div
                                        class="transactions-card-header px-6 py-4 border-b border-gray-100 flex items-center justify-between bg-[#FAF9F6]">
                                        <div>
                                            <p class="text-xs font-semibold uppercase tracking-wider text-[#718078] mb-1">
                                                Transaksi Berjalan</p>
                                            <p class="font-mono font-bold text-[#2C1810]">
                                                TRX-{{ str_pad($transaksi->id_transaksi, 5, '0', STR_PAD_LEFT) }}</p>
                                            <p class="text-xs text-[#718078] mt-1">Pesanan
                                                #NC-{{ $transaksi->pesanan->created_at->format('Y') }}-{{ str_pad($transaksi->pesanan->id_pesanan, 4, '0', STR_PAD_LEFT) }}
                                            </p>
                                        </div>
                                        <span
                                            class="inline-flex items-center gap-1 bg-[#FCE4EC] text-[#8B1E1E] px-3 py-1 rounded-full text-xs font-semibold">
                                            <span class="w-2 h-2 rounded-full bg-[#8B1E1E]"></span>
                                            Menunggu Pembayaran
                                        </span>
                                    </div>

            <div class="transactions-grid mb-8 grid gap-6 lg:grid-cols-[0.7fr_1fr]">
                {{-- TRANSAKSI BERJALAN --}}
                @if($displayTransaksiBerjalan->count() > 0)
                <section>
                    @foreach($displayTransaksiBerjalan as $transaksi)
                    <div class="transactions-card bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden mb-4">
                        {{-- Header --}}
                        <div class="transactions-card-header px-6 py-4 border-b border-gray-100 flex items-center justify-between bg-[#FAF9F6]">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-[#718078] mb-1">Transaksi Berjalan</p>
                                <p class="font-mono font-bold text-[#2C1810]">TRX-{{ str_pad($transaksi->id_transaksi, 5, '0', STR_PAD_LEFT) }}</p>
                                <p class="text-xs text-[#718078] mt-1">Pesanan #NC-{{ $transaksi->pesanan->created_at->format('Y') }}-{{ str_pad($transaksi->pesanan->id_pesanan, 4, '0', STR_PAD_LEFT) }}</p>
                            </div>
                            <span class="inline-flex items-center gap-1 bg-[#FCE4EC] text-[#8B1E1E] px-3 py-1 rounded-full text-xs font-semibold">
                                <span class="w-2 h-2 rounded-full bg-[#8B1E1E]"></span>
                                Menunggu Pembayaran
                            </span>
                        </div>
                    @endif
                </div>

                {{-- Garansi Kesegaran Atsiri --}}
                <div class="transactions-guarantee bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-[#E8F5E9] rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-[#2E7D32]" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-serif text-lg font-bold text-[#2C1810] mb-2">Garansi Kesegaran Atsiri</h3>
                            <p class="text-sm text-[#718078] leading-relaxed">Lilin dikemas dengan lapisan kedap udara dan
                                lilin kedelai organik murni langsung dari perkebunan apel Batu, Malang.</p>
                        </div>
                    </div>
                </div>

                {{-- RIWAYAT TRANSAKSI --}}
                <section class="transactions-history bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <div
                        class="transactions-history-heading px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                        <div>
                            <h2 class="font-serif text-2xl font-bold text-[#2C1810]">Riwayat Transaksi</h2>
                            <p class="text-xs text-[#718078] mt-1">Semua catatan pembayaran pemesanan aroma apel
                                NusaCandle.</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded-full">•
                                {{ $displayTotalBerhasil }} Berhasil</span>
                            <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-3 py-1 rounded-full">•
                                {{ $displayTotalMenunggu }} Menunggu Verifikasi</span>
                            <span class="bg-gray-100 text-gray-600 text-xs font-semibold px-3 py-1 rounded-full">•
                                {{ $displayTotalDibatalkan }} Dibatalkan</span>
                        </div>
                    </div>

                    <div class="divide-y divide-gray-100">
                        @forelse($displayRiwayatTransaksi as $transaksi)
                            <div
                                class="transactions-history-row px-6 py-4 flex items-center gap-4 hover:bg-[#FAF9F6] transition">
                                {{-- Icon Status --}}
                                <div
                                    class="transactions-history-icon w-10 h-10 rounded-full {{ $transaksi->status_pembayaran === 'berhasil' ? 'bg-green-100' : ($transaksi->status_pembayaran === 'menunggu' ? 'bg-amber-100' : 'bg-gray-100') }} flex items-center justify-center flex-shrink-0">
                                    @if ($transaksi->status_pembayaran === 'berhasil')
                                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                    @elseif($transaksi->status_pembayaran === 'menunggu')
                                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    @else
                                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    @endif
                                </div>

                                {{-- Info Transaksi --}}
                                <div class="transactions-history-info flex-1 min-w-0">
                                    <div class="flex items-center gap-2 mb-1">
                                        <p class="font-mono font-bold text-[#2C1810]">
                                            TRX-{{ str_pad($transaksi->id_transaksi, 5, '0', STR_PAD_LEFT) }}</p>
                                        <span class="text-xs text-[#718078]">•</span>
                                        <p class="text-xs text-[#718078]">
                                            #NC-{{ $transaksi->pesanan->created_at->format('Y') }}-{{ str_pad($transaksi->pesanan->id_pesanan, 4, '0', STR_PAD_LEFT) }}
                                        </p>
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-semibold {{ $transaksi->status_pembayaran === 'berhasil' ? 'bg-green-100 text-green-700' : ($transaksi->status_pembayaran === 'menunggu' ? 'bg-amber-100 text-amber-700' : 'bg-gray-100 text-gray-600') }}">
                                            {{ $transaksi->status_label }}
                                        </span>
                                    </div>
                                    <p class="text-sm text-[#2C1810] font-semibold truncate">
                                        {{ $transaksi->pesanan->detailPesanan->first()?->produk->nama_produk ?? 'Produk' }}
                                        ({{ $transaksi->pesanan->detailPesanan->sum('jumlah') }} Pcs)
                                    </p>
                                    <p class="text-xs text-[#718078] mt-1">
                                        Metode: {{ $transaksi->metode_label }} •
                                        {{ $transaksi->created_at->format('d M Y') }}
                                    </p>
                                </div>

                                {{-- Total --}}
                                <div class="transactions-history-total text-right flex-shrink-0">
                                    <p class="text-xs text-[#718078] mb-1">
                                        {{ $transaksi->status_pembayaran === 'gagal' ? 'Nilai Tagihan' : 'Total Dibayar' }}
                                    </p>
                                    <p
                                        class="font-serif text-lg font-bold {{ $transaksi->status_pembayaran === 'gagal' ? 'text-gray-500' : 'text-[#8B1E1E]' }}">
                                        Rp{{ number_format($transaksi->pesanan->total_harga, 0, ',', '.') }}
                                    </p>
                                </div>

                                {{-- Tombol --}}
                                @if ($showDemoPreview)
                                    <div class="transactions-demo-product-art flex h-16 w-16 shrink-0 items-center justify-center rounded-md bg-gradient-to-br from-[#e7eedf] to-[#d6c6a9] p-3" aria-label="Ilustrasi lilin aroma apel">
                                        <svg class="h-full w-full" viewBox="0 0 48 48" fill="none" aria-hidden="true">
                                            <path d="M8 32c5-9 10-12 17-11-2 7-7 12-17 11Z" fill="#46634B"/>
                                            <path d="M40 35c-5-8-10-10-16-9 2 7 7 10 16 9Z" fill="#5D7654"/>
                                            <path d="M22 18c0-3 2-5 2-8 3 3 4 6 2 9" fill="#D98C43"/>
                                            <rect x="17" y="19" width="15" height="22" rx="3" fill="#F4E8D0"/>
                                            <path d="M20 24h9M20 27h9" stroke="#A98457" stroke-width="1.5" stroke-linecap="round"/>
                                            <path d="M17 41h15" stroke="#775638" stroke-width="2" stroke-linecap="round"/>
                                        </svg>
                                        Lihat Detail
                                    </a>
                                @else
                                    <a href="{{ route('pembeli.transaksi.show', $transaksi->id_transaksi) }}"
                                        class="inline-flex items-center gap-1 bg-white border border-gray-200 hover:border-[#8B1E1E] text-[#2C1810] px-4 py-2 rounded-md text-xs font-semibold transition flex-shrink-0">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        Lihat Detail
                                    </a>
                                @endif
                            </div>
                            <div class="flex-1">
                                <p class="text-[10px] font-semibold uppercase tracking-wider text-[#718078] mb-1">100% Natural Soy Wax</p>
                                <h3 class="font-display text-base font-bold text-[#2C1810]">{{ $detail->produk->nama_produk }}</h3>
                                <p class="text-xs text-[#718078] mt-1">Jumlah: {{ $detail->jumlah }} Pcs ({{ $detail->jumlah * 200 }} gr)</p>
                                <p class="text-xs text-[#718078]">Tanggal: {{ $transaksi->created_at->format('d F Y, H:i') }} WIB</p>
                            </div>
                        </div>
                        @endforeach

                        {{-- Metode Pembayaran --}}
                        <div class="transactions-payment px-6 py-4 bg-[#FAF9F6]">
                            <div class="flex items-center justify-between mb-2">
                                <p class="text-xs font-semibold text-[#718078]">Metode Pembayaran</p>
                                <p class="text-sm font-bold text-[#2C1810]">{{ $transaksi->metode_label }}</p>
                            </div>
                            @if(in_array($transaksi->metode_pembayaran, ['bca', 'mandiri']))
                            <div class="transactions-va mb-3">
                                <p class="text-xs text-[#718078] mb-1">Nomor Virtual Account</p>
                                <div class="flex items-center justify-between bg-white border border-gray-200 rounded-md px-4 py-2">
                                    <p class="font-mono text-lg font-bold text-[#8B1E1E] tracking-wider">8271 0812 3456 7890</p>
                                    <button @if (!$showDemoPreview) onclick="copyToClipboard('8271081234567890')" @else disabled @endif class="text-xs bg-[#8B1E1E] text-white px-3 py-1 rounded hover:bg-[#6B1515] transition">
                                        Salin
                                    </button>
                                </div>
                            </div>
                            @endif
                            <div class="flex items-center justify-between pt-3 border-t border-gray-200">
                                <p class="text-sm font-semibold text-[#718078]">Total Tagihan</p>
                                <p class="font-display text-2xl font-bold text-[#8B1E1E]">Rp{{ number_format($transaksi->pesanan->total_harga, 0, ',', '.') }}</p>
                            </div>
                        </div>

                        {{-- Footer --}}
                        <div class="transactions-card-footer px-6 py-3 border-t border-gray-100 flex gap-2">
                            @if ($showDemoPreview)
                            <a href="{{ route('pembeli.transaksi.index', ['demo_transaction' => $transaksi->id_transaksi]) }}" class="flex-1 inline-flex items-center justify-center gap-2 bg-white border border-gray-200 text-[#2C1810] px-4 py-2 rounded-md text-sm font-semibold hover:border-[#8B1E1E] transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                Lihat Detail
                            </a>
                            <button type="button" disabled class="flex-1 inline-flex items-center justify-center gap-2 bg-[#8B1E1E] text-white px-4 py-2 rounded-md text-sm font-semibold cursor-not-allowed">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                </svg>
                                Bayar Sekarang
                            </button>
                            @else
                            <a href="{{ route('pembeli.transaksi.show', $transaksi->id_transaksi) }}" class="flex-1 inline-flex items-center justify-center gap-2 bg-white border border-gray-200 hover:border-[#8B1E1E] text-[#2C1810] px-4 py-2 rounded-md text-sm font-semibold transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                Lihat Detail
                            </a>
                            <button onclick="scrollToKonfirmasi()" class="flex-1 inline-flex items-center justify-center gap-2 bg-[#8B1E1E] hover:bg-[#6B1515] text-white px-4 py-2 rounded-md text-sm font-semibold transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                </svg>
                                Bayar Sekarang
                            </button>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </section>
                @else
                <div class="transactions-empty bg-white rounded-lg shadow-sm border border-gray-200 p-12 text-center">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <p class="text-sm font-semibold text-[#2C1810] mb-1">Tidak ada transaksi berjalan</p>
                    <p class="text-xs text-[#718078]">Semua pembayaran Anda sudah selesai diproses.</p>
                </div>
                @endif

                {{-- KONFIRMASI PEMBAYARAN --}}
                @if($transaksiKonfirmasi || $showDemoPreview)
                <section id="section-konfirmasi">
                    <div class="transactions-confirmation bg-white rounded-lg shadow-sm border border-gray-200 p-6 sticky top-24">
                        <div class="transactions-confirmation-heading flex items-start justify-between mb-4">
                            <div>
                                <h2 class="font-display text-2xl font-bold text-[#2C1810]">Konfirmasi Pembayaran</h2>
                                <p class="text-xs text-[#718078] mt-1">Kirim bukti transfer bank bila sistem belum memperbarui status pesanan Anda secara otomatis.</p>
                            </div>
                        @endforelse
                    </div>
                </section>
            </div>

            {{-- Garansi Kesegaran Atsiri --}}
            <div class="transactions-guarantee bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-[#E8F5E9] rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-[#2E7D32]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-display text-lg font-bold text-[#2C1810] mb-2">Garansi Kesegaran Atsiri</h3>
                        <p class="text-sm text-[#718078] leading-relaxed">Lilin dikemas dengan lapisan kedap udara dan lilin kedelai organik murni langsung dari perkebunan apel Batu, Malang.</p>
                    </div>
                </div>
            </div>

            {{-- RIWAYAT TRANSAKSI --}}
            <section class="transactions-history bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <div class="transactions-history-heading px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                    <div>
                        <h2 class="font-display text-2xl font-bold text-[#2C1810]">Riwayat Transaksi</h2>
                        <p class="text-xs text-[#718078] mt-1">Semua catatan pembayaran pemesanan aroma apel NusaCandle.</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded-full">• {{ $displayTotalBerhasil }} Berhasil</span>
                        <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-3 py-1 rounded-full">• {{ $displayTotalMenunggu }} Menunggu Verifikasi</span>
                        <span class="bg-gray-100 text-gray-600 text-xs font-semibold px-3 py-1 rounded-full">• {{ $displayTotalDibatalkan }} Dibatalkan</span>
                    </div>
                </div>

                <div class="divide-y divide-gray-100">
                    @forelse($displayRiwayatTransaksi as $transaksi)
                    <div class="transactions-history-row px-6 py-4 flex items-center gap-4 hover:bg-[#FAF9F6] transition">
                        {{-- Icon Status --}}
                        <div class="transactions-history-icon w-10 h-10 rounded-full {{ $transaksi->status_pembayaran === 'berhasil' ? 'bg-green-100' : ($transaksi->status_pembayaran === 'menunggu' ? 'bg-amber-100' : 'bg-gray-100') }} flex items-center justify-center flex-shrink-0">
                            @if($transaksi->status_pembayaran === 'berhasil')
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            @elseif($transaksi->status_pembayaran === 'menunggu')
                                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            @else
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            @endif
                        </div>

                        {{-- Info Transaksi --}}
                        <div class="transactions-history-info flex-1 min-w-0">
                            <div class="flex items-center gap-2 mb-1">
                                <p class="font-mono font-bold text-[#2C1810]">TRX-{{ str_pad($transaksi->id_transaksi, 5, '0', STR_PAD_LEFT) }}</p>
                                <span class="text-xs text-[#718078]">•</span>
                                <p class="text-xs text-[#718078]">#NC-{{ $transaksi->pesanan->created_at->format('Y') }}-{{ str_pad($transaksi->pesanan->id_pesanan, 4, '0', STR_PAD_LEFT) }}</p>
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-semibold {{ $transaksi->status_pembayaran === 'berhasil' ? 'bg-green-100 text-green-700' : ($transaksi->status_pembayaran === 'menunggu' ? 'bg-amber-100 text-amber-700' : 'bg-gray-100 text-gray-600') }}">
                                    {{ $transaksi->status_label }}
                                </span>
                            </div>
                            <p class="text-sm text-[#2C1810] font-semibold truncate">
                                {{ $transaksi->pesanan->detailPesanan->first()?->produk->nama_produk ?? 'Produk' }} ({{ $transaksi->pesanan->detailPesanan->sum('jumlah') }} Pcs)
                            </p>
                            <p class="text-xs text-[#718078] mt-1">
                                Metode: {{ $transaksi->metode_label }} • {{ $transaksi->created_at->format('d M Y') }}
                            </p>
                        </div>

                        {{-- Total --}}
                        <div class="transactions-history-total text-right flex-shrink-0">
                            <p class="text-xs text-[#718078] mb-1">{{ $transaksi->status_pembayaran === 'gagal' ? 'Nilai Tagihan' : 'Total Dibayar' }}</p>
                            <p class="font-display text-lg font-bold {{ $transaksi->status_pembayaran === 'gagal' ? 'text-gray-500' : 'text-[#8B1E1E]' }}">
                                Rp{{ number_format($transaksi->pesanan->total_harga, 0, ',', '.') }}
                            </p>
                        </div>

                        {{-- Tombol --}}
                        @if ($showDemoPreview)
                        <a href="{{ route('pembeli.transaksi.index', ['demo_transaction' => $transaksi->id_transaksi]) }}" class="inline-flex items-center gap-1 bg-white border border-gray-200 text-[#2C1810] px-4 py-2 rounded-md text-xs font-semibold flex-shrink-0 hover:border-[#8B1E1E] transition">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            Lihat Detail
                        </a>
                        @else
                        <a href="{{ route('pembeli.transaksi.show', $transaksi->id_transaksi) }}" class="inline-flex items-center gap-1 bg-white border border-gray-200 hover:border-[#8B1E1E] text-[#2C1810] px-4 py-2 rounded-md text-xs font-semibold transition flex-shrink-0">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            Lihat Detail
                        </a>
                        @endif
                    </div>
                    @empty
                    <div class="transactions-empty px-6 py-12 text-center">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <p class="text-sm font-semibold text-[#2C1810] mb-1">Belum ada riwayat transaksi</p>
                        <p class="text-xs text-[#718078]">Transaksi yang sudah selesai akan muncul di sini.</p>
                    </div>
                    @endforelse
                </div>
            </section>
        </div>

        <script>
            function copyToClipboard(text) {
                navigator.clipboard.writeText(text).then(() => {
                    alert('Nomor VA berhasil disalin!');
                });
            }

            function scrollToKonfirmasi() {
                document.getElementById('section-konfirmasi').scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }

            function showFileName(input) {
                const fileName = input.files[0]?.name;
                const fileNameElement = document.getElementById('file-name');
                if (fileName) {
                    fileNameElement.textContent = 'File terpilih: ' + fileName;
                    fileNameElement.classList.remove('hidden');
                }
            }
        </script>
@endsection
