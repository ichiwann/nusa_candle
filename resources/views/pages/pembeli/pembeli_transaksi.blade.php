@extends('layouts.pembeli')

@section('title', request()->has('demo_transaction') ? 'Detail Pembayaran - NusaCandle' : 'Pembayaran Saya - NusaCandle')

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
        @include('pages.pembeli.partials.detail_transaksi_content', [
            'transaksi' => $demoDetailTransaksi,
            'isDemoPreview' => true,
        ])
    @else
        <div class="min-h-screen bg-[#f7f4eb] text-[#2c1810]">
            {{-- Header --}}
            <div class="border-0 bg-transparent">
                <div class="mx-auto w-[87.2vw] max-w-[90rem] px-0 pb-[0.45rem] pt-[1.2rem] max-[480px]:mx-[0.7rem] max-[480px]:w-[calc(100%_-_1.4rem)]">
                    <div class="flex flex-nowrap items-start justify-between gap-4 max-[480px]:flex-wrap max-[480px]:gap-[0.35rem]">
                        <div>
                            <div class="mb-[0.25rem] inline-flex items-center gap-2 rounded-full bg-[#E8F5E9] px-[0.4rem] py-[0.15rem]">
                                <svg class="w-4 h-4 text-[#2E7D32]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-xs font-semibold text-[#2E7D32]">Portal Pembayaran Pelanggan</span>
                            </div>
                            <h1 class="font-serif text-xl font-bold leading-[1.2] text-[#8b1e1e]">Pembayaran Saya</h1>
                            <p class="mt-[0.2rem] max-w-2xl text-xs leading-[1.4] text-[#718078]">Daftar riwayat pembayaran dan konfirmasi pembayaran
                                lilin aromaterapi Anda. Kelola tagihan aktif dengan verifikasi aman.</p>
                        </div>

                        {{-- Security Info --}}
                        <div class="flex items-center gap-2 rounded-full border border-[#e8dfcf] bg-white px-[0.55rem] py-[0.35rem] text-xs text-[#718078] max-[480px]:flex-wrap">
                            <div class="flex items-center gap-1">
                                <svg class="h-[0.65rem] w-[0.65rem] text-[#2E7D32]" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>Enkripsi 256-Bit</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <svg class="h-[0.65rem] w-[0.65rem] text-[#8B1E1E]" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                                <span>Verifikasi Otomatis</span>
                            </div>
                            @if ($showDemoPreview)
                                <span class="whitespace-nowrap rounded-full border border-[#e8dfcf] bg-white px-[0.35rem] py-[0.15rem] text-[0.48rem] font-bold tracking-[0.04em] text-[#806c54]">PRATINJAU DEMO</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="mx-auto w-[87.2vw] max-w-[90rem] px-0 pb-4 pt-[0.35rem] max-[480px]:mx-[0.7rem] max-[480px]:w-[calc(100%_-_1.4rem)]">

                <div class="grid grid-cols-1 gap-6 mb-2">
                    {{-- TRANSAKSI BERJALAN --}}
                    @if ($displayTransaksiBerjalan->count() > 0)
                        <section>
                            @foreach ($displayTransaksiBerjalan as $transaksi)
                                <div
                                    class="mb-2 overflow-hidden rounded-[0.45rem] border border-[#e8dfcf] bg-white shadow-sm">
                                    {{-- Header --}}
                                    <div
                                        class="flex items-center justify-between gap-2 border-b border-gray-100 bg-[#fbf8f0] px-[0.9rem] py-2">
                                        <div>
                                            <p class="mb-[0.1rem] text-[0.62rem] font-semibold uppercase tracking-wider text-[#718078]">
                                                Pembayaran Berjalan</p>
                                            <p class="text-xs font-mono font-bold text-[#2C1810]">
                                                TRX-{{ str_pad($transaksi->id_transaksi, 5, '0', STR_PAD_LEFT) }}</p>
                                            <p class="mt-[0.1rem] text-[0.65rem] text-[#718078]">Pesanan
                                                #NC-{{ $transaksi->pesanan->created_at->format('Y') }}-{{ str_pad($transaksi->pesanan->id_pesanan, 4, '0', STR_PAD_LEFT) }}
                                            </p>
                                        </div>
                                        <span
                                            class="inline-flex shrink-0 items-center gap-1 whitespace-nowrap rounded-full bg-[#FCE4EC] px-[0.35rem] py-[0.15rem] text-[0.62rem] font-semibold text-[#8B1E1E]">
                                            <span class="w-2 h-2 rounded-full bg-[#8B1E1E]"></span>
                                            Menunggu Pembayaran
                                        </span>
                                    </div>

                                    {{-- Produk --}}
                                    @foreach ($transaksi->pesanan->detailPesanan as $detail)
                                        <div class="flex gap-[0.45rem] border-b border-gray-100 px-[0.9rem] py-2">
                                            <div class="flex-shrink-0">
                                                @if ($showDemoPreview)
                                                    <div class="grid h-16 w-14 place-items-center overflow-hidden rounded-md bg-[linear-gradient(145deg,#72806b,#d6c6a5_52%,#efe3cd)]"
                                                        aria-label="Ilustrasi lilin aroma apel">
                                                        <svg class="h-8 w-8" viewBox="0 0 48 48" fill="none" aria-hidden="true">
                                                            <path d="M8 32c5-9 10-12 17-11-2 7-7 12-17 11Z"
                                                                fill="#46634B" />
                                                            <path d="M40 35c-5-8-10-10-16-9 2 7 7 10 16 9Z"
                                                                fill="#5D7654" />
                                                            <path d="M22 18c0-3 2-5 2-8 3 3 4 6 2 9" fill="#D98C43" />
                                                            <rect x="17" y="19" width="15" height="22" rx="3"
                                                                fill="#F4E8D0" />
                                                            <path d="M20 24h9M20 27h9" stroke="#A98457" stroke-width="1.5"
                                                                stroke-linecap="round" />
                                                            <path d="M17 41h15" stroke="#775638" stroke-width="2"
                                                                stroke-linecap="round" />
                                                        </svg>
                                                    </div>
                                                @elseif($detail->produk->gambar)
                                                    <img src="{{ asset('storage/' . $detail->produk->gambar) }}"
                                                        alt="{{ $detail->produk->nama_produk }}"
                                                        class="h-16 w-14 rounded-md object-cover">
                                                @else
                                                    <div
                                                        class="flex h-16 w-14 items-center justify-center rounded-md bg-gray-200">
                                                        <svg class="h-6 w-6 text-gray-400" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="flex-1">
                                                <p
                                                    class="mb-1 text-[0.65rem] font-semibold uppercase leading-[1.35] tracking-wider text-[#718078]">
                                                    100% Natural Soy Wax</p>
                                                <h3 class="font-serif text-[0.78rem] font-bold leading-[1.25] text-[#2C1810]">
                                                    {{ $detail->produk->nama_produk }}</h3>
                                                <p class="mt-1 text-[0.65rem] leading-[1.35] text-[#718078]">Jumlah: {{ $detail->jumlah }} Pcs
                                                    ({{ $detail->jumlah * 200 }} gr)</p>
                                                <p class="text-[0.65rem] leading-[1.35] text-[#718078]">Tanggal:
                                                    {{ $transaksi->created_at->format('d F Y, H:i') }} WIB</p>
                                            </div>
                                        </div>
                                    @endforeach

                                    {{-- Metode Pembayaran --}}
                                    <div class="bg-[#fbf8f0] px-[0.9rem] py-2">
                                        <div class="flex items-center justify-between mb-2">
                                            <p class="text-[0.68rem] font-semibold text-[#718078]">Metode Pembayaran</p>
                                            <p class="text-[0.68rem] font-bold text-[#2C1810]">{{ $transaksi->metode_label }}</p>
                                        </div>
                                        @if (in_array($transaksi->metode_pembayaran, ['bca', 'mandiri']))
                                            <div class="mb-[0.4rem]">
                                                <p class="mb-1 text-[0.68rem] text-[#718078]">Nomor Virtual Account</p>
                                                <div
                                                    class="flex items-center justify-between rounded-md border border-gray-200 bg-white px-[0.4rem] py-1">
                                                    <p class="font-mono text-[0.78rem] font-bold tracking-wider text-[#8B1E1E]">
                                                        8271 0812 3456 7890</p>
                                                    <button
                                                        @if (!$showDemoPreview) onclick="copyToClipboard('8271081234567890')" @else disabled @endif
                                                        class="rounded bg-[#8B1E1E] px-[0.4rem] py-[0.2rem] text-[0.62rem] text-white transition hover:bg-[#6B1515]">
                                                        Salin
                                                    </button>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="flex items-center justify-between border-t border-gray-200 pt-[0.4rem]">
                                            <p class="text-[0.68rem] font-semibold text-[#718078]">Total Tagihan</p>
                                            <p class="font-serif text-[1.05rem] font-bold text-[#8B1E1E]">
                                                Rp{{ number_format($transaksi->pesanan->total_harga, 0, ',', '.') }}</p>
                                        </div>
                                    </div>

                                    {{-- Footer --}}
                                    <div class="flex gap-[0.35rem] border-t border-gray-100 px-[0.8rem] py-[0.4rem] max-[480px]:flex-col">
                                        @if ($showDemoPreview)
                                            <a href="{{ route('pembeli.transaksi.index', ['demo_transaction' => $transaksi->id_transaksi]) }}"
                                                class="flex-1 inline-flex items-center justify-center gap-[0.25rem] rounded-md border border-gray-200 bg-white px-[0.45rem] py-[0.35rem] text-[0.66rem] font-semibold text-[#2C1810] transition hover:border-[#8B1E1E] max-[480px]:w-full">
                                                <svg class="h-[0.65rem] w-[0.65rem]" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                Lihat Detail
                                            </a>
                                            <button type="button" disabled
                                                class="flex-1 inline-flex items-center justify-center gap-[0.25rem] rounded-md bg-[#bf3833] px-[0.45rem] py-[0.35rem] text-[0.66rem] font-semibold text-white cursor-not-allowed max-[480px]:w-full">
                                                <svg class="h-[0.65rem] w-[0.65rem]" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                                </svg>
                                                Bayar Sekarang
                                            </button>
                                        @else
                                            <a href="{{ route('pembeli.transaksi.show', $transaksi->id_transaksi) }}"
                                                class="flex-1 inline-flex items-center justify-center gap-[0.25rem] rounded-md border border-gray-200 bg-white px-[0.45rem] py-[0.35rem] text-[0.66rem] font-semibold text-[#2C1810] transition hover:border-[#8B1E1E] max-[480px]:w-full">
                                                <svg class="h-[0.65rem] w-[0.65rem]" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                Lihat Detail
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </section>
                    @else
                        <div
                            class="rounded-[0.45rem] border border-[#e8dfcf] bg-white px-3 py-[1.4rem] text-center shadow-sm">
                            <svg class="mx-auto mb-[0.35rem] h-10 w-10 text-gray-300" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <p class="mb-1 text-xs font-semibold text-[#2C1810]">Tidak ada pembayaran berjalan</p>
                            <p class="text-[0.68rem] text-[#718078]">Semua pembayaran Anda sudah selesai diproses.</p>
                        </div>
                    @endif
                </div>

                {{-- Garansi Kesegaran Atsiri --}}
                <div class="hidden rounded-[0.45rem] border border-[#e8dfcf] bg-white p-6 mb-8 shadow-sm">
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
                <section class="overflow-hidden rounded-[0.45rem] border border-[#e8dfcf] bg-white shadow-sm">
                    <div
                        class="flex items-center justify-between gap-2 border-b border-gray-200 px-4 py-2 max-[480px]:items-start max-[480px]:flex-col">
                        <div>
                            <h2 class="font-serif text-base font-bold text-[#2C1810]">Riwayat Pembayaran</h2>
                            <p class="mt-1 text-[0.62rem] text-[#718078]">Semua catatan pembayaran pemesanan aroma apel
                                NusaCandle.</p>
                        </div>
                        <div class="flex items-center gap-[0.2rem]">
                            <span class="whitespace-nowrap rounded-full bg-green-100 px-[0.3rem] py-[0.15rem] text-[0.6rem] font-semibold text-green-800">•
                                {{ $displayTotalBerhasil }} Berhasil</span>
                            <span class="whitespace-nowrap rounded-full bg-yellow-100 px-[0.3rem] py-[0.15rem] text-[0.6rem] font-semibold text-yellow-800">•
                                {{ $displayTotalMenunggu }} Menunggu Verifikasi</span>
                            <span class="whitespace-nowrap rounded-full bg-[#f3f0e9] px-[0.3rem] py-[0.15rem] text-[0.6rem] font-semibold text-[#6b6258]">
                                {{ $displayTotalDibatalkan }} Dibatalkan</span>
                        </div>
                    </div>

                    <div class="divide-y divide-gray-100">
                        @forelse($displayRiwayatTransaksi as $transaksi)
                            <div
                                class="mx-[0.6rem] my-[0.35rem] flex items-center gap-[0.45rem] rounded-[0.4rem] border border-[#eee6d4] bg-[#fbf8f0] px-[0.75rem] py-[0.45rem] transition hover:bg-[#FAF9F6] max-[480px]:flex-wrap">
                                {{-- Icon Status --}}
                                <div
                                    class="flex h-[1.7rem] w-[1.7rem] flex-shrink-0 items-center justify-center rounded-full {{ $transaksi->status_pembayaran === 'berhasil' ? 'bg-green-100' : ($transaksi->status_pembayaran === 'menunggu' ? 'bg-amber-100' : 'bg-gray-100') }}">
                                    @if ($transaksi->status_pembayaran === 'berhasil')
                                        <svg class="h-[0.9rem] w-[0.9rem] text-green-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                    @elseif($transaksi->status_pembayaran === 'menunggu')
                                        <svg class="h-[0.9rem] w-[0.9rem] text-amber-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    @else
                                        <svg class="h-[0.9rem] w-[0.9rem] text-gray-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    @endif
                                </div>

                                {{-- Info Pembayaran --}}
                                <div class="min-w-0 flex-1 max-[480px]:basis-[calc(100%_-_2rem)]">
                                    <div class="mb-[0.1rem] flex flex-wrap items-center gap-[0.2rem]">
                                        <p class="font-mono text-[0.66rem] font-bold text-[#2C1810]">
                                            TRX-{{ str_pad($transaksi->id_transaksi, 5, '0', STR_PAD_LEFT) }}</p>
                                        <span class="text-xs text-[#718078]">•</span>
                                        <p class="text-[0.68rem] text-[#718078]">
                                            #NC-{{ $transaksi->pesanan->created_at->format('Y') }}-{{ str_pad($transaksi->pesanan->id_pesanan, 4, '0', STR_PAD_LEFT) }}
                                        </p>
                                        <span
                                            class="inline-flex items-center rounded px-2 py-0.5 text-[0.58rem] font-semibold {{ $transaksi->status_pembayaran === 'berhasil' ? 'bg-green-100 text-green-700' : ($transaksi->status_pembayaran === 'menunggu' ? 'bg-amber-100 text-amber-700' : 'bg-gray-100 text-gray-600') }}">
                                            {{ $transaksi->status_label }}
                                        </span>
                                    </div>
                                    <p class="truncate text-[0.68rem] font-semibold text-[#2C1810]">
                                        {{ $transaksi->pesanan->detailPesanan->first()?->produk->nama_produk ?? 'Produk' }}
                                        ({{ $transaksi->pesanan->detailPesanan->sum('jumlah') }} Pcs)
                                    </p>
                                    <p class="mt-1 text-[0.6rem] text-[#718078]">
                                        Metode: {{ $transaksi->metode_label }} •
                                        {{ $transaksi->created_at->format('d M Y') }}
                                    </p>
                                </div>

                                {{-- Total --}}
                                <div class="ml-0 flex-shrink-0 text-right max-[480px]:ml-8">
                                    <p class="mb-1 text-[0.6rem] text-[#718078]">
                                        {{ $transaksi->status_pembayaran === 'gagal' ? 'Nilai Tagihan' : 'Total Dibayar' }}
                                    </p>
                                    <p
                                        class="font-serif text-[0.86rem] font-bold {{ $transaksi->status_pembayaran === 'gagal' ? 'text-gray-500' : 'text-[#8B1E1E]' }}">
                                        Rp{{ number_format($transaksi->pesanan->total_harga, 0, ',', '.') }}
                                    </p>
                                </div>

                                {{-- Tombol --}}
                                @if ($showDemoPreview)
                                    <a href="{{ route('pembeli.transaksi.index', ['demo_transaction' => $transaksi->id_transaksi]) }}"
                                        class="ml-0 inline-flex flex-shrink-0 items-center gap-[0.2rem] rounded-md border border-gray-200 bg-white px-[0.4rem] py-[0.3rem] text-[0.64rem] font-semibold text-[#2C1810] transition hover:border-[#8B1E1E] max-[480px]:ml-auto">
                                        <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        Lihat Detail
                                    </a>
                                @else
                                    <a href="{{ route('pembeli.transaksi.show', $transaksi->id_transaksi) }}"
                                        class="ml-0 inline-flex flex-shrink-0 items-center gap-[0.2rem] rounded-md border border-gray-200 bg-white px-[0.4rem] py-[0.3rem] text-[0.64rem] font-semibold text-[#2C1810] transition hover:border-[#8B1E1E] max-[480px]:ml-auto">
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
                        @empty
                            <div class="px-3 py-[1.2rem] text-center">
                                <svg class="mx-auto mb-[0.35rem] h-10 w-10 text-gray-300" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <p class="mb-1 text-xs font-semibold text-[#2C1810]">Belum ada riwayat pembayaran</p>
                                <p class="text-[0.68rem] text-[#718078]">Pembayaran yang sudah selesai akan muncul di sini.</p>
                            </div>
                        @endforelse
                    </div>
                </section>
            </div>
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
    @endif
@endsection
