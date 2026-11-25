@extends('layouts.admin')

@section('title', 'Manajemen Pembayaran')
@section('page_title', 'Manajemen Pembayaran')

@section('content')
    <div
        class="-mx-4 -my-6 min-h-[calc(100vh_-_4rem)] bg-[#f7f4e9] px-4 py-6 sm:-mx-6 sm:-my-9 sm:px-6 sm:py-9 lg:-mx-8 lg:px-8 xl:-mx-12 xl:px-12">
        <div class="mb-5">
            <p class="text-[9px] font-semibold uppercase tracking-[0.16em] text-[#64835d]">Admin Ledger /</p>
            <h1 class="display-font mt-1 text-2xl font-semibold text-[#183b2c] sm:text-3xl">Manajemen Pembayaran</h1>
            <p class="mt-1.5 max-w-2xl text-sm leading-relaxed text-[#718078]">
                Pantau dan kelola pembayaran pesanan NusaCandle.
            </p>
        </div>

        <section class="mb-4 w-full rounded-md border border-[#e8dfd1] bg-[#fffdf7] p-4 shadow-sm">
            <div class="flex items-start justify-between gap-3">
                <div>
                    <p class="text-[9px] font-semibold uppercase tracking-[0.12em] text-[#718078]">Total Pendapatan</p>
                    <p class="display-font mt-1.5 text-2xl font-semibold leading-tight text-[#183b2c]">
                        Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                    </p>
                </div>
            </div>
        </section>

        <form id="payment-filters" method="GET" action="{{ route('admin.payments.index') }}"
            class="mb-3 flex flex-wrap items-center gap-2 rounded-md border border-[#e8dfd1] bg-[#fffdf7] p-2">
            <div class="relative min-w-[220px] flex-1">
                <svg class="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-[#87948b]" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari ID pembayaran, ID pesanan, atau nama pelanggan..."
                    class="w-full rounded-md border border-[#e8dfd1] bg-[#fbf9f2] py-2.5 pl-9 pr-3 text-xs text-[#30483a] outline-none placeholder:text-[#9a9a8f] focus:border-[#64835d] focus:ring-1 focus:ring-[#64835d]/20">
            </div>

            <select name="status" onchange="this.form.submit()" aria-label="Filter status pembayaran"
                class="min-w-[130px] rounded-md border border-[#e8dfd1] bg-[#fbf9f2] px-3 py-2.5 text-[10px] font-bold uppercase text-[#30483a] outline-none focus:border-[#64835d]">
                <option value="">Semua Status</option>
                <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu Pembayaran
                </option>
                <option value="berhasil" {{ request('status') == 'berhasil' ? 'selected' : '' }}>Berhasil</option>
                <option value="gagal" {{ request('status') == 'gagal' ? 'selected' : '' }}>Gagal</option>
            </select>

            <select name="metode" onchange="this.form.submit()" aria-label="Filter metode pembayaran"
                class="min-w-[130px] rounded-md border border-[#e8dfd1] bg-[#fbf9f2] px-3 py-2.5 text-[10px] font-bold uppercase text-[#30483a] outline-none focus:border-[#64835d]">
                <option value="">Semua Metode</option>
                <option value="bca" {{ request('metode') == 'bca' ? 'selected' : '' }}>BCA</option>
                <option value="mandiri" {{ request('metode') == 'mandiri' ? 'selected' : '' }}>Mandiri</option>
                <option value="gopay" {{ request('metode') == 'gopay' ? 'selected' : '' }}>GoPay</option>
                <option value="dana" {{ request('metode') == 'dana' ? 'selected' : '' }}>DANA</option>
                <option value="shopeepay" {{ request('metode') == 'shopeepay' ? 'selected' : '' }}>ShopeePay</option>
                <option value="cod" {{ request('metode') == 'cod' ? 'selected' : '' }}>COD</option>
            </select>

        </form>

        <section class="overflow-hidden rounded-md border border-[#e8dfd1] bg-[#fffdf7] shadow-sm">
            <div
                class="flex flex-wrap items-center justify-between gap-2 border-b border-[#e8dfd1] bg-[#f2ede1] px-3 py-3 sm:px-4">
                <div class="flex items-center gap-2">
                    <h2 class="display-font text-lg font-semibold text-[#2c1810]">Daftar Pembayaran Masuk</h2>
                    <select name="sort" form="payment-filters" onchange="this.form.submit()"
                        aria-label="Urutkan pembayaran"
                        class="rounded-sm border-0 bg-[#e8e2d5] px-2 py-1 text-[8px] font-bold uppercase tracking-[0.08em] text-[#71685a] outline-none focus:ring-1 focus:ring-[#64835d]">
                        <option value="terbaru" {{ request('sort', 'terbaru') == 'terbaru' ? 'selected' : '' }}>Terkini
                        </option>
                        <option value="terlama" {{ request('sort') == 'terlama' ? 'selected' : '' }}>Terlama</option>
                    </select>
                </div>
                <p class="text-[10px] text-[#71685a]">
                    Menampilkan {{ $transaksis->firstItem() ?? 0 }}–{{ $transaksis->lastItem() ?? 0 }} dari
                    {{ number_format($transaksis->total()) }} pembayaran
                </p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full min-w-[850px] text-left">
                    <thead
                        class="border-b border-[#e8dfd1] bg-[#f5f0e2] text-[9px] uppercase tracking-[0.08em] text-[#718078]">
                        <tr>
                            <th class="px-2.5 py-2.5 font-semibold">No. Pembayaran</th>
                            <th class="px-2.5 py-2.5 font-semibold">Pelanggan</th>
                            <th class="px-2.5 py-2.5 font-semibold">Produk</th>
                            <th class="px-2.5 py-2.5 font-semibold">Metode</th>
                            <th class="px-2.5 py-2.5 text-right font-semibold">Total Pembayaran</th>
                            <th class="px-2.5 py-2.5 font-semibold">Tanggal Pembayaran</th>
                            <th class="px-2.5 py-2.5 font-semibold">Status</th>
                            <th class="px-2.5 py-2.5 text-right font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#eee8dc]">
                        @forelse($transaksis as $transaksi)
                            @php
                                $pesanan = $transaksi->pesanan;
                                $pelanggan = $pesanan?->user;
                                $detailPesanan = $pesanan?->detailPesanan ?? collect();
                                $subtotalProduk = (int) $detailPesanan->sum(
                                    fn($detail) => $detail->harga_satuan * $detail->jumlah,
                                );
                                $detailPayload = [
                                    'id' => $transaksi->id_transaksi,
                                    'kodePesanan' =>
                                        '#NC-ORD-' .
                                        ($pesanan?->created_at?->format('Y') ?? now()->format('Y')) .
                                        '-' .
                                        str_pad($pesanan?->id_pesanan ?? 0, 4, '0', STR_PAD_LEFT),
                                    'pelanggan' => $pelanggan?->nama_lengkap ?? 'Unknown',
                                    'username' => $pelanggan?->username ?? '-',
                                    'telepon' => $pelanggan?->no_telepon ?? '-',
                                    'alamat' => $pelanggan?->alamat ?? '-',
                                    'metode' => $transaksi->metode_label,
                                    'total' => 'Rp ' . number_format($pesanan?->total_harga ?? 0, 0, ',', '.'),
                                    'totalAmount' => (int) ($pesanan?->total_harga ?? 0),
                                    'subtotalProduk' => $subtotalProduk,
                                    'biayaTambahan' => max(0, (int) ($pesanan?->total_harga ?? 0) - $subtotalProduk),
                                    'tanggal' => $transaksi->created_at->format('d M Y H:i') . ' WIB',
                                    'statusPembayaran' => $transaksi->status_pembayaran,
                                    'statusPembayaranLabel' => $transaksi->status_label,
                                    'statusPesanan' => $pesanan?->status_pesanan ?? '-',
                                    'statusPesananLabel' => $pesanan?->status_label ?? 'Tidak tersedia',
                                    'bukti' => $transaksi->bukti_pembayaran
                                        ? asset('storage/' . $transaksi->bukti_pembayaran)
                                        : null,
                                    'items' => $detailPesanan
                                        ->map(
                                            fn($detail) => [
                                                'nama' => $detail->produk?->nama_produk ?? 'Produk tidak tersedia',
                                                'jumlah' => (int) $detail->jumlah,
                                                'hargaSatuan' => (int) $detail->harga_satuan,
                                                'subtotal' => (int) $detail->harga_satuan * (int) $detail->jumlah,
                                                'gambar' => $detail->produk?->gambar
                                                    ? asset('storage/' . $detail->produk->gambar)
                                                    : null,
                                            ],
                                        )
                                        ->values()
                                        ->all(),
                                ];
                                $namaProduk = $detailPesanan
                                    ->map(fn($detail) => $detail->produk?->nama_produk)
                                    ->filter()
                                    ->values();
                                $statusPembayaranClasses = [
                                    'menunggu' => 'bg-[#f0eadb] text-[#78643a]',
                                    'berhasil' => 'bg-[#dff2e3] text-[#28633b]',
                                    'gagal' => 'bg-[#f8dddd] text-[#9b2727]',
                                ];
                            @endphp
                            <tr class="text-[10px] transition-colors hover:bg-[#f8f5ed]">
                                <td class="px-2.5 py-2">
                                    <p class="font-semibold text-[#30483a]">
                                        TRX-{{ str_pad($transaksi->id_transaksi, 6, '0', STR_PAD_LEFT) }}
                                    </p>
                                    <p class="mt-0.5 text-[9px] text-[#87948b]">
                                        #NC-ORD-{{ $pesanan?->created_at?->format('Y') ?? now()->format('Y') }}-{{ str_pad($transaksi->id_pesanan ?? 0, 4, '0', STR_PAD_LEFT) }}
                                    </p>
                                </td>
                                <td class="px-2.5 py-2">
                                    <p class="font-semibold text-[#30483a]">{{ $pelanggan?->nama_lengkap ?? 'Unknown' }}
                                    </p>
                                    <p class="mt-0.5 text-[9px] text-[#87948b]">{{ $pelanggan?->username ?? '-' }}</p>
                                </td>
                                <td class="max-w-[135px] px-2.5 py-2">
                                    <p class="truncate font-medium text-[#30483a]"
                                        title="{{ $namaProduk?->first() ?? 'Produk tidak tersedia' }}">
                                        {{ $namaProduk?->first() ?? 'Produk tidak tersedia' }}
                                    </p>
                                    @if ($namaProduk?->count() > 1)
                                        <p class="mt-0.5 text-[9px] text-[#87948b]">+{{ $namaProduk->count() - 1 }} produk
                                            lainnya</p>
                                    @endif
                                </td>
                                <td class="px-2.5 py-2">
                                    <span
                                        class="inline-flex whitespace-nowrap rounded-sm bg-[#eee9dc] px-1.5 py-1 text-[8px] font-semibold text-[#5b5549]">
                                        {{ $transaksi->metode_label }}
                                    </span>
                                </td>
                                <td class="px-2.5 py-2 text-right">
                                    <p class="whitespace-nowrap font-semibold text-[#183b2c]">
                                        Rp {{ number_format($pesanan?->total_harga ?? 0, 0, ',', '.') }}
                                    </p>
                                </td>
                                <td class="px-2.5 py-2">
                                    <p class="whitespace-nowrap text-[#30483a]">
                                        {{ $transaksi->created_at->format('d M Y') }}</p>
                                    <p class="mt-0.5 whitespace-nowrap text-[9px] text-[#87948b]">
                                        {{ $transaksi->created_at->format('H:i') }} WIB</p>
                                </td>
                                <td class="px-2.5 py-2">
                                    <span
                                        class="inline-flex whitespace-nowrap rounded-sm px-1.5 py-1 text-[8px] font-bold uppercase {{ $statusPembayaranClasses[$transaksi->status_pembayaran] ?? 'bg-gray-100 text-gray-800' }}">
                                        {{ $transaksi->status_label }}
                                    </span>
                                </td>
                                <td class="px-2.5 py-2">
                                    <div class="flex justify-end gap-1">
                                        <button type="button" data-payment-action="detail"
                                            data-payment="{{ json_encode($detailPayload, JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP) }}"
                                            class="rounded-sm border border-[#e8dfd1] bg-white px-2 py-1.5 text-[8px] font-semibold uppercase text-[#52645a] transition hover:border-[#64835d] hover:bg-[#f5f0e2]">
                                            Detail
                                        </button>
                                        <button type="button" data-payment-action="status"
                                            data-payment="{{ json_encode($detailPayload, JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP) }}"
                                            class="rounded-sm bg-[#103a2a] px-2 py-1.5 text-[8px] font-semibold uppercase text-white transition hover:bg-[#315d41]">
                                            Update Status
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-5 py-12 text-center">
                                    <p class="text-sm font-semibold text-[#30483a]">Tidak ada pembayaran ditemukan</p>
                                    <p class="mt-1 text-xs text-[#87948b]">Coba ubah kata pencarian atau filter.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="flex flex-wrap items-center justify-between gap-3 border-t border-[#e8dfd1] px-3 py-3 sm:px-4">
                <p class="text-[9px] text-[#718078]">
                    Menampilkan {{ $transaksis->firstItem() ?? 0 }}–{{ $transaksis->lastItem() ?? 0 }} dari
                    {{ number_format($transaksis->total()) }} pembayaran
                </p>
                <div class="flex items-center gap-1">
                    {{ $transaksis->links() }}
                </div>
            </div>
        </section>
    </div>

    <div id="payment-detail-modal" role="dialog" aria-modal="true" aria-labelledby="payment-detail-title"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-[#0b251b]/65 p-3 backdrop-blur-sm sm:p-5">
        <div
            class="flex max-h-[92vh] w-full max-w-4xl flex-col overflow-hidden rounded-xl border border-[#d9d4c6] bg-[#fffdf7] shadow-2xl">
            <header class="flex shrink-0 items-center justify-between gap-4 bg-[#103a2a] px-4 py-3.5 text-white sm:px-6">
                <div class="flex min-w-0 items-center gap-3">
                    <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-white/10 text-[#d3e6d6]">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8"
                            viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8 5H6a2 2 0 00-2 2v13h16V7a2 2 0 00-2-2h-2M8 5a2 2 0 002 2h4a2 2 0 002-2M8 5a2 2 0 012-2h4a2 2 0 012 2m-8 8h8m-8 4h5" />
                        </svg>
                    </span>
                    <div class="min-w-0">
                        <div class="flex flex-wrap items-center gap-2">
                            <h2 id="payment-detail-title" class="display-font text-base font-semibold sm:text-lg">Detail
                                Pembayaran</h2>
                            <span id="payment-modal-transaction-id"
                                class="rounded bg-[#d7bd58]/20 px-2 py-1 font-mono text-[9px] font-semibold text-[#f0df91]"></span>
                        </div>
                        <p class="mt-0.5 text-[9px] text-white/65 sm:text-[10px]">Verifikasi dan rekonsiliasi pembayaran
                            pesanan</p>
                    </div>
                </div>
                <div class="flex shrink-0 items-center gap-2">
                    <span id="payment-modal-status"
                        class="rounded-full border border-white/15 bg-white/10 px-2.5 py-1 text-[8px] font-bold uppercase tracking-wide text-white sm:text-[9px]"></span>
                    <button type="button" onclick="closePaymentDetailModal()" aria-label="Tutup detail pembayaran"
                        class="rounded px-1 text-2xl leading-none text-white/70 transition hover:bg-white/10 hover:text-white">&times;</button>
                </div>
            </header>

            <div class="payment-detail-scroll min-h-0 space-y-4 overflow-y-auto p-4 sm:p-5">
                <section>
                    <div class="mb-2 flex flex-wrap items-center justify-between gap-2">
                        <h3
                            class="flex items-center gap-1.5 text-[9px] font-bold uppercase tracking-[0.08em] text-[#315d41]">
                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="1.8"
                                viewBox="0 0 24 24" aria-hidden="true">
                                <circle cx="12" cy="12" r="9" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 11v5m0-8h.01" />
                            </svg>
                            Informasi Pembayaran
                        </h3>
                        <p id="payment-modal-date" class="text-[8px] text-[#948b80] sm:text-[9px]"></p>
                    </div>
                    <div class="grid grid-cols-1 gap-2 sm:grid-cols-2 lg:grid-cols-4">
                        <article class="rounded-lg border border-[#e8dfd1] bg-white p-3">
                            <p class="text-[7px] font-semibold uppercase tracking-[0.08em] text-[#a09586]">ID Pembayaran
                            </p>
                            <p id="payment-modal-id" class="mt-1 text-[10px] font-semibold text-[#315d41]"></p>
                            <p class="mt-1 text-[8px] text-[#948b80]">Ref: <span id="payment-modal-order-ref"></span></p>
                        </article>
                        <article class="rounded-lg border border-[#e8dfd1] bg-white p-3">
                            <p class="text-[7px] font-semibold uppercase tracking-[0.08em] text-[#a09586]">Pelanggan</p>
                            <p id="payment-modal-customer" class="mt-1 text-[10px] font-semibold text-[#37312b]"></p>
                            <p id="payment-modal-phone" class="mt-1 text-[8px] text-[#948b80]"></p>
                        </article>
                        <article class="rounded-lg border border-[#e8dfd1] bg-white p-3">
                            <p class="text-[7px] font-semibold uppercase tracking-[0.08em] text-[#a09586]">Metode
                                Pembayaran</p>
                            <p id="payment-modal-method" class="mt-1 text-[10px] font-semibold text-[#37312b]"></p>
                            <p id="payment-modal-order-status" class="mt-1 text-[8px] text-[#948b80]"></p>
                        </article>
                        <article class="rounded-lg border border-[#e8dfd1] bg-white p-3">
                            <p class="text-[7px] font-semibold uppercase tracking-[0.08em] text-[#a09586]">Total Pembayaran
                            </p>
                            <p id="payment-modal-total-card" class="mt-1 text-sm font-bold text-[#b8292e]"></p>
                            <p id="payment-modal-status-label" class="mt-1 text-[8px] font-bold uppercase text-[#94733c]">
                            </p>
                        </article>
                    </div>
                </section>

                <section>
                    <div class="mb-2 flex flex-wrap items-center justify-between gap-2">
                        <h3
                            class="flex items-center gap-1.5 text-[9px] font-bold uppercase tracking-[0.08em] text-[#315d41]">
                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="1.8"
                                viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 12h16M4 17h16" />
                            </svg>
                            Detail Pesanan &amp; Produk Lilin
                        </h3>
                        <span id="payment-modal-item-count" class="text-[8px] text-[#948b80]"></span>
                    </div>
                    <div class="overflow-hidden rounded-lg border border-[#e8dfd1] bg-white">
                        <ul id="payment-modal-items" class="divide-y divide-[#eee8dc]"></ul>
                        <div class="space-y-1.5 border-t border-[#e8dfd1] bg-[#f7f4e9] px-3 py-3 text-[9px] sm:px-4">
                            <div class="flex items-center justify-between gap-3 text-[#81786e]">
                                <span>Subtotal Produk</span>
                                <span id="payment-modal-subtotal" class="font-medium text-[#37312b]"></span>
                            </div>
                            <div class="flex items-center justify-between gap-3 text-[#81786e]">
                                <span>Biaya tambahan (pengiriman &amp; kemasan)</span>
                                <span id="payment-modal-additional" class="font-medium text-[#37312b]"></span>
                            </div>
                            <div
                                class="flex items-center justify-between gap-3 border-t border-[#e4ddcf] pt-2 text-[10px] font-bold text-[#315d41]">
                                <span>Total Pembayaran</span>
                                <span id="payment-modal-total-summary" class="text-sm text-[#b8292e]"></span>
                            </div>
                        </div>
                    </div>
                </section>

                <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                    <section class="rounded-lg border border-[#e8dfd1] bg-white p-3">
                        <div class="mb-2 flex items-center justify-between gap-2">
                            <h3
                                class="flex items-center gap-1.5 text-[9px] font-bold uppercase tracking-[0.08em] text-[#315d41]">
                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="1.8"
                                    viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 5h16v14H4zM8 9h8m-8 4h5" />
                                </svg>
                                Bukti Pembayaran
                            </h3>
                        </div>
                        <p id="payment-modal-proof-empty" class="text-[9px] leading-relaxed text-[#948b80]">Belum ada
                            bukti pembayaran yang diunggah.</p>
                        <a id="payment-modal-proof-link" href="#" target="_blank" rel="noopener noreferrer"
                            class="hidden text-[9px] font-semibold text-[#315d41] underline decoration-[#9eb49c] underline-offset-2 hover:text-[#103a2a]">
                            Lihat bukti pembayaran
                        </a>
                    </section>
                    <section class="rounded-lg border border-[#e8dfd1] bg-white p-3">
                        <div class="mb-2 flex items-center justify-between gap-2">
                            <h3
                                class="flex items-center gap-1.5 text-[9px] font-bold uppercase tracking-[0.08em] text-[#315d41]">
                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="1.8"
                                    viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Riwayat Status
                            </h3>
                        </div>
                        <p class="text-[9px] leading-relaxed text-[#948b80]">Riwayat perubahan status belum tersedia pada
                            sistem.</p>
                    </section>
                </div>
            </div>

            <footer
                class="payment-detail-print-hidden flex shrink-0 flex-wrap items-center justify-between gap-2 border-t border-[#e8dfd1] bg-[#fffdf7] px-4 py-3 sm:px-5">
                <button type="button" onclick="closePaymentDetailModal()"
                    class="rounded-md border border-[#d9d4c6] bg-[#f4f0e5] px-4 py-2 text-[9px] font-semibold uppercase text-[#52645a] transition hover:bg-[#eae5d8]">
                    Tutup
                </button>
                <div class="flex flex-wrap justify-end gap-2">
                    <button type="button" onclick="openPaymentUpdateModal()"
                        class="inline-flex items-center gap-1.5 rounded-md bg-[#103a2a] px-4 py-2 text-[9px] font-semibold uppercase text-white transition hover:bg-[#315d41]">
                        Update Status
                    </button>
                </div>
            </footer>
        </div>
    </div>

    <style>
        @media print {
            body * {
                visibility: hidden !important;
            }

            #payment-detail-modal,
            #payment-detail-modal * {
                visibility: visible !important;
            }

            #payment-detail-modal {
                position: absolute !important;
                inset: 0 !important;
                display: block !important;
                overflow: visible !important;
                padding: 0 !important;
                background: #fff !important;
            }

            #payment-detail-modal>div {
                max-width: none !important;
                max-height: none !important;
                overflow: visible !important;
                border: 0 !important;
                box-shadow: none !important;
            }

            #payment-detail-modal .payment-detail-scroll {
                max-height: none !important;
                overflow: visible !important;
            }

            .payment-detail-print-hidden {
                display: none !important;
            }
        }
    </style>

    <div id="status-modal" role="dialog" aria-modal="true" aria-labelledby="modal-mode-label"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-[#0b251b]/60 p-3 backdrop-blur-sm sm:p-5">
        <div
            class="flex max-h-[92vh] w-full max-w-xl flex-col overflow-hidden rounded-xl border border-[#d9d4c6] bg-[#fffdf7] shadow-2xl">
            <header class="flex shrink-0 items-center justify-between gap-4 bg-[#103a2a] px-4 py-3.5 text-white sm:px-5">
                <div class="flex min-w-0 items-center gap-3">
                    <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-white/10 text-[#d3e6d6]">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8"
                            viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8 5H6a2 2 0 00-2 2v13h16V7a2 2 0 00-2-2h-2M8 5a2 2 0 002 2h4a2 2 0 002-2M8 5a2 2 0 012-2h4a2 2 0 012 2m-8 8h8m-8 4h5" />
                        </svg>
                    </span>
                    <div class="min-w-0">
                        <h2 id="modal-mode-label" class="display-font text-base font-semibold sm:text-lg">Update Status
                            Pembayaran</h2>
                        <p class="mt-0.5 text-[8px] uppercase tracking-[0.08em] text-white/65 sm:text-[9px]">Verifikasi
                            &amp; otorisasi manual gateway pembayaran</p>
                    </div>
                </div>
                <button type="button" onclick="closeStatusModal()" aria-label="Tutup update status"
                    class="shrink-0 rounded px-1 text-2xl leading-none text-white/70 transition hover:bg-white/10 hover:text-white">&times;</button>
            </header>

            <form id="status-form" method="POST" class="flex min-h-0 flex-col overflow-hidden">
                @csrf
                @method('PATCH')

                <div class="min-h-0 flex-1 space-y-4 overflow-y-auto px-4 py-4 sm:px-5">
                    <section class="space-y-3 rounded-xl border border-[#e2dac7] bg-[#f7f4e9] p-3 sm:p-3.5">
                        <div class="flex flex-wrap items-center justify-between gap-2 border-b border-[#e7dfd0] pb-2">
                            <div class="flex flex-wrap items-center gap-2">
                                <span id="modal-transaksi-id"
                                    class="rounded bg-[#b8292e] px-2.5 py-1 font-mono text-[9px] font-bold tracking-wide text-white"></span>
                                <span class="text-[9px] text-[#776f63]">Order: <span id="modal-order-ref"
                                        class="font-semibold text-[#37312b]"></span></span>
                            </div>
                            <span id="modal-payment-status"
                                class="rounded-full border border-[#e8d18c] bg-[#fffaf0] px-2.5 py-1 text-[8px] font-bold uppercase tracking-wide text-[#a66a13]"></span>
                        </div>

                        <div class="grid grid-cols-1 gap-x-4 gap-y-3 sm:grid-cols-2">
                            <div>
                                <p class="text-[8px] font-medium uppercase tracking-wide text-[#9a847f]">Pelanggan</p>
                                <p id="modal-pelanggan" class="text-[10px] font-semibold text-[#37312b]"></p>
                                <p id="modal-username" class="text-[8px] text-[#948b80]"></p>
                            </div>
                            <div>
                                <p class="text-[8px] font-medium uppercase tracking-wide text-[#9a847f]">Produk Dipesan</p>
                                <p id="modal-produk" class="text-[10px] font-semibold text-[#315d41]"></p>
                                <p id="modal-jumlah-produk" class="text-[8px] text-[#948b80]"></p>
                            </div>
                            <div>
                                <p class="text-[8px] font-medium uppercase tracking-wide text-[#9a847f]">Metode Pembayaran
                                </p>
                                <p id="modal-metode" class="text-[9px] font-medium text-[#37312b]"></p>
                            </div>
                            <div>
                                <p class="text-[8px] font-medium uppercase tracking-wide text-[#9a847f]">Total Pembayaran
                                </p>
                                <p id="modal-total" class="text-base font-bold text-[#b8292e]"></p>
                            </div>
                        </div>

                        <div class="flex flex-wrap items-center justify-between gap-2 border-t border-[#e7dfd0] pt-2">
                            <p id="modal-tanggal" class="text-[8px] text-[#776f63]"></p>
                            <a id="modal-bukti-link" href="#" target="_blank" rel="noopener noreferrer"
                                class="hidden text-[8px] font-semibold text-[#315d41] underline underline-offset-2">Lihat
                                bukti pembayaran</a>
                        </div>
                    </section>

                    <section>
                        <label for="status_pembayaran"
                            class="mb-2 block text-[9px] font-bold uppercase tracking-[0.08em] text-[#37312b]">Pilih Status
                            Pembayaran Baru</label>
                        <select name="status_pembayaran" id="status_pembayaran" required
                            class="w-full rounded-xl border-2 border-[#c6cbb9] bg-[#fffdf7] px-3 py-3 text-[11px] text-[#37312b] outline-none transition focus:border-[#315d41] focus:ring-2 focus:ring-[#315d41]/10">
                            <option value="menunggu">Menunggu — pembayaran belum dikonfirmasi</option>
                            <option value="berhasil">Berhasil — pembayaran telah diverifikasi</option>
                            <option value="gagal">Gagal — pembayaran ditolak atau dibatalkan</option>
                        </select>
                        <p class="mt-1.5 text-[8px] text-[#948b80]">Hanya 3 pilihan status yang diizinkan untuk
                            sinkronisasi mutasi rekening.</p>
                        <p class="mt-1 text-[8px] text-red-700" data-validation-error="status_pembayaran"></p>
                    </section>

                </div>

                <footer class="flex shrink-0 justify-end border-t border-[#e2dac7] bg-[#f7f4e9] px-4 py-3 sm:px-5">
                    <button type="submit" id="modal-submit"
                        class="inline-flex items-center gap-1.5 rounded-lg bg-[#103a2a] px-4 py-2.5 text-[9px] font-semibold uppercase tracking-wide text-white shadow-sm transition hover:bg-[#315d41] focus:outline-none focus:ring-2 focus:ring-[#103a2a]/30">
                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        Simpan Perubahan
                    </button>
                </footer>
            </form>
        </div>
    </div>

    <script>
        let selectedPaymentData = null;

        function formatPaymentAmount(amount) {
            return `Rp ${Number(amount || 0).toLocaleString('id-ID')}`;
        }

        function openPaymentDetailModal(data) {
            selectedPaymentData = data;

            const transactionCode = `TRX-${String(data.id).padStart(6, '0')}`;
            document.getElementById('payment-modal-transaction-id').textContent = transactionCode;
            document.getElementById('payment-modal-id').textContent = transactionCode;
            document.getElementById('payment-modal-order-ref').textContent = data.kodePesanan;
            document.getElementById('payment-modal-date').textContent = `Dibuat: ${data.tanggal}`;
            document.getElementById('payment-modal-customer').textContent = data.pelanggan;
            document.getElementById('payment-modal-phone').textContent =
                data.telepon && data.telepon !== '-' ? data.telepon : 'Nomor telepon belum tersedia';
            document.getElementById('payment-modal-method').textContent = data.metode;
            document.getElementById('payment-modal-order-status').textContent =
                `Status pesanan: ${data.statusPesananLabel}`;
            document.getElementById('payment-modal-total-card').textContent = data.total;
            document.getElementById('payment-modal-status-label').textContent = data.statusPembayaranLabel;

            const statusClasses = {
                menunggu: 'border-amber-300/30 bg-amber-200/10 text-amber-100',
                berhasil: 'border-emerald-300/30 bg-emerald-200/10 text-emerald-100',
                gagal: 'border-red-300/30 bg-red-200/10 text-red-100',
            };
            const statusBadge = document.getElementById('payment-modal-status');
            statusBadge.className =
                `rounded-full border px-2.5 py-1 text-[8px] font-bold uppercase tracking-wide sm:text-[9px] ${statusClasses[data.statusPembayaran] || 'border-white/15 bg-white/10 text-white'}`;
            statusBadge.textContent = data.statusPembayaranLabel;

            const itemsList = document.getElementById('payment-modal-items');
            itemsList.replaceChildren();
            document.getElementById('payment-modal-item-count').textContent =
                `${data.items.length} item`;

            data.items.forEach(item => {
                const row = document.createElement('li');
                row.className = 'flex items-center gap-3 px-3 py-3 sm:px-4';

                const imageFrame = document.createElement('div');
                imageFrame.className =
                    'relative flex h-11 w-11 shrink-0 items-center justify-center overflow-hidden rounded-md border border-[#e8dfd1] bg-[#f1eee5]';
                const placeholder = document.createElement('span');
                placeholder.className = 'relative z-10 text-[8px] text-[#a09586]';
                placeholder.textContent = 'Produk';
                imageFrame.appendChild(placeholder);

                if (item.gambar) {
                    const image = document.createElement('img');
                    image.src = item.gambar;
                    image.alt = '';
                    image.className = 'absolute inset-0 h-full w-full object-cover';
                    image.addEventListener('load', () => placeholder.classList.add('hidden'), {
                        once: true
                    });
                    image.addEventListener('error', () => image.remove(), {
                        once: true
                    });
                    imageFrame.appendChild(image);
                }

                const productInfo = document.createElement('div');
                productInfo.className = 'min-w-0 flex-1';
                const productTitle = document.createElement('p');
                productTitle.className = 'break-words text-[10px] font-semibold text-[#37312b]';
                productTitle.textContent = item.nama;
                const productMeta = document.createElement('p');
                productMeta.className = 'mt-1 text-[8px] text-[#948b80]';
                productMeta.textContent = `${item.jumlah} pcs × ${formatPaymentAmount(item.hargaSatuan)}`;
                productInfo.append(productTitle, productMeta);

                const productSubtotal = document.createElement('p');
                productSubtotal.className = 'shrink-0 text-right text-[9px] font-semibold text-[#37312b]';
                productSubtotal.textContent = formatPaymentAmount(item.subtotal);

                row.append(imageFrame, productInfo, productSubtotal);
                itemsList.appendChild(row);
            });

            if (data.items.length === 0) {
                const emptyRow = document.createElement('li');
                emptyRow.className = 'px-4 py-5 text-center text-[9px] text-[#948b80]';
                emptyRow.textContent = 'Rincian produk pesanan tidak tersedia.';
                itemsList.appendChild(emptyRow);
            }

            document.getElementById('payment-modal-subtotal').textContent =
                formatPaymentAmount(data.subtotalProduk);
            document.getElementById('payment-modal-additional').textContent =
                formatPaymentAmount(data.biayaTambahan);
            document.getElementById('payment-modal-total-summary').textContent =
                formatPaymentAmount(data.totalAmount);

            const proofLink = document.getElementById('payment-modal-proof-link');
            const proofEmpty = document.getElementById('payment-modal-proof-empty');
            if (data.bukti) {
                proofLink.href = data.bukti;
                proofLink.classList.remove('hidden');
                proofEmpty.classList.add('hidden');
            } else {
                proofLink.removeAttribute('href');
                proofLink.classList.add('hidden');
                proofEmpty.classList.remove('hidden');
            }

            const modal = document.getElementById('payment-detail-modal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closePaymentDetailModal() {
            const modal = document.getElementById('payment-detail-modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function printPaymentDetail() {
            window.print();
        }

        function openPaymentUpdateModal() {
            if (selectedPaymentData) {
                closePaymentDetailModal();
                openPaymentStatusModal(selectedPaymentData);
            }
        }

        function openPaymentStatusModal(data) {
            const transactionCode = `TRX-NC-${String(data.id).padStart(4, '0')}`;
            document.getElementById('modal-transaksi-id').textContent = transactionCode;
            document.getElementById('modal-mode-label').textContent = 'Update Status Pembayaran';
            document.getElementById('modal-order-ref').textContent = data.kodePesanan;
            document.getElementById('modal-pelanggan').textContent = data.pelanggan;
            document.getElementById('modal-username').textContent = data.username && data.username !== '-' ? data.username :
                'Akun pelanggan';

            const paymentStatusBadge = document.getElementById('modal-payment-status');
            const paymentStatusClasses = {
                menunggu: 'border-[#e8d18c] bg-[#fffaf0] text-[#a66a13]',
                berhasil: 'border-[#bdd8bf] bg-[#eff8ef] text-[#28633b]',
                gagal: 'border-[#edc4c4] bg-[#fff1f1] text-[#9b2727]',
            };
            paymentStatusBadge.className =
                `rounded-full border px-2.5 py-1 text-[8px] font-bold uppercase tracking-wide ${paymentStatusClasses[data.statusPembayaran] || 'border-[#e8d18c] bg-[#fffaf0] text-[#a66a13]'}`;
            paymentStatusBadge.textContent = data.statusPembayaranLabel;

            const firstItem = data.items[0];
            document.getElementById('modal-produk').textContent = firstItem ? firstItem.nama :
                'Rincian produk tidak tersedia';
            document.getElementById('modal-jumlah-produk').textContent = firstItem ?
                `${firstItem.jumlah} pcs${data.items.length > 1 ? ` · ${data.items.length} jenis produk` : ''}` : '';
            document.getElementById('modal-metode').textContent = data.metode;
            document.getElementById('modal-total').textContent = data.total;
            document.getElementById('modal-tanggal').textContent = data.tanggal;

            const proofLink = document.getElementById('modal-bukti-link');
            if (data.bukti) {
                proofLink.href = data.bukti;
                proofLink.classList.remove('hidden');
            } else {
                proofLink.removeAttribute('href');
                proofLink.classList.add('hidden');
            }

            // ✅ Pastikan route-nya sesuai (transaksi, bukan pembayaran)
            document.getElementById('status-form').action = `/admin/transaksi/${data.id}/status`;

            const paymentStatusSelect = document.getElementById('status_pembayaran');
            paymentStatusSelect.value = data.statusPembayaran;

            // ✅ BARIS 'catatan_admin' SUDAH DIHAPUS DI SINI

            document.querySelectorAll('[data-validation-error]').forEach(error => {
                error.textContent = '';
            });

            document.getElementById('status-modal').classList.remove('hidden');
            document.getElementById('status-modal').classList.add('flex');
        }

        function closeStatusModal() {
            const modal = document.getElementById('status-modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        document.addEventListener('click', function(event) {
            const button = event.target.closest('[data-payment-action]');
            if (!button) {
                return;
            }

            const data = JSON.parse(button.dataset.payment);
            if (button.dataset.paymentAction === 'detail') {
                openPaymentDetailModal(data);
            } else if (button.dataset.paymentAction === 'status') {
                openPaymentStatusModal(data);
            }
        });

        document.getElementById('payment-detail-modal').addEventListener('click', function(e) {
            if (e.target === this) closePaymentDetailModal();
        });
        document.getElementById('status-modal').addEventListener('click', function(e) {
            if (e.target === this) closeStatusModal();
        });
    </script>
@endsection
