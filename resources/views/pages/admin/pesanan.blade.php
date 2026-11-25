@extends('layouts.admin')

@section('title', 'Manajemen Pesanan')
@section('page_title', 'Manajemen Pesanan')

@section('content')
    <div
        class="-mx-4 -my-6 min-h-[calc(100vh_-_4rem)] bg-[#f7f4e9] px-4 py-6 sm:-mx-6 sm:-my-9 sm:px-6 sm:py-9 lg:-mx-8 lg:px-8 xl:-mx-12 xl:px-12">
        <div class="mb-5">
            <p class="text-[9px] font-semibold uppercase tracking-[0.16em] text-[#64835d]">Admin Ledger / Operasional</p>
            <h1 class="display-font mt-1 text-2xl font-semibold text-[#183b2c] sm:text-3xl">Manajemen Pesanan</h1>
            <p class="mt-1.5 max-w-2xl text-sm leading-relaxed text-[#718078]">
                Kelola pesanan pelanggan, verifikasi pembayaran, dan pantau status pengiriman.
            </p>
        </div>

        <!-- Stats Cards -->
        <section class="mb-4 grid grid-cols-2 gap-2 sm:grid-cols-3 lg:grid-cols-6">
            <article class="min-w-0 rounded-md border border-[#e8dfd1] bg-[#fffdf7] p-3 shadow-sm">
                <div class="flex items-center justify-between gap-1">
                    <p class="text-[10px] font-semibold uppercase tracking-[0.08em] text-[#718078]">Total Pesanan</p>
                    <svg class="h-4 w-4 shrink-0 text-[#64835d]" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 7h6m-6 4h6" />
                    </svg>
                </div>
                <p class="display-font mt-2 text-3xl font-semibold leading-none text-[#183b2c]">
                    {{ number_format($totalPesanan) }}</p>
            </article>

            <article class="min-w-0 rounded-md border border-[#e8dfd1] bg-[#fffdf7] p-3 shadow-sm">
                <div class="flex items-center justify-between gap-1">
                    <p class="text-[10px] font-semibold uppercase tracking-[0.08em] text-[#718078]">Menunggu</p>
                    <svg class="h-4 w-4 shrink-0 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M12 8v4l2.5 2.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <p class="display-font mt-2 text-3xl font-semibold leading-none text-red-700">{{ number_format($menunggu) }}
                </p>
            </article>

            <article class="min-w-0 rounded-md border border-[#e8dfd1] bg-[#fffdf7] p-3 shadow-sm">
                <div class="flex items-center justify-between gap-1">
                    <p class="text-[10px] font-semibold uppercase tracking-[0.08em] text-[#718078]">Diproses</p>
                    <svg class="h-4 w-4 shrink-0 text-[#3d7951]" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M12 3l2.3 2.3 3.2-.1.1 3.2L20 11l-2.4 2.6.1 3.2-3.2.1L12 19l-2.5-2.1-3.2.1-.1-3.2L4 11l2.2-2.5-.1-3.2 3.2-.1L12 3z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M9.5 11.5l1.7 1.7 3.5-3.5" />
                    </svg>
                </div>
                <p class="display-font mt-2 text-3xl font-semibold leading-none text-[#3d7951]">
                    {{ number_format($diproses) }}</p>
            </article>

            <article class="min-w-0 rounded-md border border-[#e8dfd1] bg-[#fffdf7] p-3 shadow-sm">
                <div class="flex items-center justify-between gap-1">
                    <p class="text-[10px] font-semibold uppercase tracking-[0.08em] text-[#718078]">Dikirim</p>
                    <svg class="h-4 w-4 shrink-0 text-[#3d7951]" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M3 7h11v10H3zM14 10h4l3 3v4h-7z" />
                        <circle cx="7.5" cy="18" r="1.5" stroke-width="1.8" />
                        <circle cx="17.5" cy="18" r="1.5" stroke-width="1.8" />
                    </svg>
                </div>
                <p class="display-font mt-2 text-3xl font-semibold leading-none text-[#3d7951]">
                    {{ number_format($dikirim) }}</p>
            </article>

            <article class="min-w-0 rounded-md border border-[#e8dfd1] bg-[#fffdf7] p-3 shadow-sm">
                <div class="flex items-center justify-between gap-1">
                    <p class="text-[10px] font-semibold uppercase tracking-[0.08em] text-[#718078]">Selesai</p>
                    <svg class="h-4 w-4 shrink-0 text-[#3d7951]" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        aria-hidden="true">
                        <circle cx="12" cy="12" r="9" stroke-width="1.8" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 12l2.5 2.5L16 9" />
                    </svg>
                </div>
                <p class="display-font mt-2 text-3xl font-semibold leading-none text-[#3d7951]">
                    {{ number_format($selesai) }}</p>
            </article>

            <article class="min-w-0 rounded-md border border-[#e8dfd1] bg-[#fffdf7] p-3 shadow-sm">
                <div class="flex items-center justify-between gap-1">
                    <p class="text-[10px] font-semibold uppercase tracking-[0.08em] text-[#718078]">Dibatalkan</p>
                    <svg class="h-4 w-4 shrink-0 text-red-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        aria-hidden="true">
                        <circle cx="12" cy="12" r="9" stroke-width="1.8" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 9l6 6m0-6l-6 6" />
                    </svg>
                </div>
                <p class="display-font mt-2 text-3xl font-semibold leading-none text-red-700">
                    {{ number_format($dibatalkan) }}</p>
            </article>
        </section>

        <!-- Search & Filter Bar -->
        <form method="GET" action="{{ route('admin.orders.index') }}"
            class="mb-3 flex flex-wrap items-center gap-2 rounded-md border border-[#e8dfd1] bg-[#fffdf7] p-2">
            <div class="relative min-w-[240px] flex-1">
                <svg class="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-[#87948b]" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari berdasarkan ID Pesanan atau nama pelanggan..."
                    class="w-full rounded-md border border-[#e8dfd1] bg-[#fbf9f2] py-2.5 pl-9 pr-3 text-xs text-[#30483a] outline-none placeholder:text-[#9a9a8f] focus:border-[#64835d] focus:ring-1 focus:ring-[#64835d]/20">
            </div>

            <label
                class="flex min-w-[150px] items-center gap-2 rounded-md border border-[#e8dfd1] bg-[#fbf9f2] px-3 py-1.5">
                <span class="text-[10px] font-bold uppercase tracking-[0.08em] text-[#87948b]">Status</span>
                <select name="status" onchange="this.form.submit()" aria-label="Filter status pesanan"
                    class="min-w-0 flex-1 border-0 bg-transparent py-0 pl-0 pr-5 text-xs font-semibold text-[#30483a] outline-none focus:ring-0">
                    <option value="">Semua ({{ number_format($totalPesanan) }})</option>
                    <option value="menunggu_pembayaran" {{ request('status') == 'menunggu_pembayaran' ? 'selected' : '' }}>
                        Menunggu ({{ number_format($menunggu) }})</option>
                    <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>
                        Diproses ({{ number_format($diproses) }})</option>
                    <option value="dikirim" {{ request('status') == 'dikirim' ? 'selected' : '' }}>
                        Dikirim ({{ number_format($dikirim) }})</option>
                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>
                        Selesai ({{ number_format($selesai) }})</option>
                    <option value="dibatalkan" {{ request('status') == 'dibatalkan' ? 'selected' : '' }}>
                        Dibatalkan ({{ number_format($dibatalkan) }})</option>
                </select>
            </label>
        </form>

                <section class="overflow-hidden rounded-md border border-[#e8dfd1] bg-[#fffdf7] shadow-sm">
            <div
                class="flex flex-wrap items-center justify-between gap-3 border-b border-[#e8dfd1] bg-[#f2ede1] px-4 py-4">
                <div class="flex items-center gap-2.5">
                    <h2 class="display-font text-xl font-semibold text-[#2c1810]">Daftar Pesanan Masuk</h2>
                    <span
                        class="rounded-sm bg-[#e8e2d5] px-2 py-1 text-[9px] font-bold uppercase tracking-[0.08em] text-[#71685a]">
                        Terkini
                    </span>
                </div>
                <p class="text-xs text-[#71685a]">
                    Menampilkan <span class="font-semibold">{{ $pesanans->count() }}</span> dari
                    <span class="font-semibold">{{ number_format($pesanans->total()) }}</span> data pesanan
                </p>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full min-w-[1120px] text-left">
                    <thead
                        class="border-b border-[#e8dfd1] bg-[#f5f0e2] text-[11px] uppercase tracking-[0.1em] text-[#718078]">
                        <tr>
                            <th class="px-3 py-3 font-semibold">ID Transaksi</th>
                            <th class="px-3 py-3 font-semibold">ID Pesanan</th>
                            <th class="px-3 py-3 font-semibold">Pelanggan</th>
                            <th class="px-3 py-3 font-semibold">Metode Pembayaran</th>
                            <th class="px-3 py-3 text-right font-semibold">Total Pembayaran</th>
                            <th class="px-3 py-3 font-semibold">Tanggal Transaksi</th>
                            <th class="px-3 py-3 font-semibold">Status Pesanan</th>
                            <th class="px-5 py-3 text-right font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#eee8dc]">
                        @forelse($pesanans as $pesanan)
                            @php
                                $transaksi = $pesanan->transaksi->first();
                                $orderStatusColors = [
                                    'menunggu_pembayaran' => 'bg-amber-100 text-amber-800',
                                    'diproses' => 'bg-blue-100 text-blue-800',
                                    'dikirim' => 'bg-purple-100 text-purple-800',
                                    'selesai' => 'bg-emerald-100 text-emerald-800',
                                    'dibatalkan' => 'bg-red-100 text-red-800',
                                ];
                                $transactionDate = $transaksi?->created_at ?? $pesanan->created_at;
                            @endphp
                            <tr class="text-xs transition-colors hover:bg-[#f8f5ed]">
                                <td class="px-3 py-2.5">
                                    <p class="font-semibold text-[#30483a]">
                                        {{ $transaksi ? 'TRX-' . str_pad($transaksi->id_transaksi, 6, '0', STR_PAD_LEFT) : '-' }}
                                    </p>
                                </td>
                                <td class="px-3 py-2.5">
                                    <p class="font-semibold text-[#30483a]">
                                        #NC-ORD-{{ $pesanan->created_at->format('Y') }}-{{ str_pad($pesanan->id_pesanan, 4, '0', STR_PAD_LEFT) }}
                                    </p>
                                </td>
                                <td class="px-3 py-2.5">
                                    <p class="font-semibold text-[#30483a]">
                                        {{ $pesanan->user->nama_lengkap ?? 'Unknown' }}</p>
                                    <p class="mt-0.5 text-[10px] text-[#87948b]">{{ $pesanan->user->username ?? '-' }}</p>
                                </td>
                                <td class="px-3 py-2.5">
                                    <p class="max-w-[190px] text-[#30483a]">
                                        {{ $transaksi?->metode_label ?? 'Belum ada transaksi' }}
                                    </p>
                                </td>
                                <td class="px-3 py-2.5 text-right">
                                    <p class="whitespace-nowrap font-semibold text-[#183b2c]">Rp
                                        {{ number_format($pesanan->total_harga, 0, ',', '.') }}</p>
                                </td>
                                <td class="px-3 py-2.5">
                                    <p class="whitespace-nowrap text-[#30483a]">{{ $transactionDate->format('d M Y') }}
                                    </p>
                                    <p class="mt-0.5 text-[10px] text-[#87948b]">{{ $transactionDate->format('H:i') }} WIB
                                    </p>
                                </td>
                                <td class="px-3 py-2.5">
                                    <span
                                        class="inline-block whitespace-nowrap rounded px-2 py-1 text-[10px] font-bold uppercase tracking-[0.03em] {{ $orderStatusColors[$pesanan->status_pesanan] ?? 'bg-gray-100 text-gray-800' }}">
                                        {{ $pesanan->status_label }}
                                    </span>
                                </td>
                                <td class="px-3 py-2.5">
                                    <div class="flex justify-end gap-1.5">
                                        @php
                                            $productSubtotal = (int) $pesanan->detailPesanan->sum(
                                                fn($detail) => $detail->harga_satuan * $detail->jumlah,
                                            );
                                            $detailPayload = [
                                                'id' => $pesanan->id_pesanan,
                                                'kode_pesanan' =>
                                                    '#NC-ORD-' .
                                                    $pesanan->created_at->format('Y') .
                                                    '-' .
                                                    str_pad($pesanan->id_pesanan, 4, '0', STR_PAD_LEFT),
                                                'pelanggan' => $pesanan->user->nama_lengkap ?? 'Unknown',
                                                'username' => $pesanan->user->username ?? '-',
                                                'telepon' => $pesanan->user->no_telepon ?? '-',
                                                'alamat' => $pesanan->user->alamat ?? '-',
                                                'tanggal' => $pesanan->created_at->format('d M Y, H:i') . ' WIB',
                                                'total' => 'Rp ' . number_format($pesanan->total_harga, 0, ',', '.'),
                                                'total_amount' => (int) $pesanan->total_harga,
                                                'product_subtotal' => $productSubtotal,
                                                'additional_amount' => max(
                                                    0,
                                                    (int) $pesanan->total_harga - $productSubtotal,
                                                ),
                                                'status' => $pesanan->status_pesanan,
                                                'status_label' => $pesanan->status_label,
                                                'metode' => $transaksi?->metode_label ?? '-',
                                                'status_pembayaran' => $transaksi?->status_pembayaran ?? 'menunggu',
                                                'status_pembayaran_label' =>
                                                    $transaksi?->status_label ?? 'Belum Dibayar',
                                                'items' => $pesanan->detailPesanan
                                                    ->map(
                                                        fn($d) => [
                                                            'nama' =>
                                                                $d->produk->nama_produk ?? 'Produk tidak tersedia',
                                                            'jumlah' => $d->jumlah,
                                                            'harga_satuan' => (int) $d->harga_satuan,
                                                            'subtotal' => (int) $d->harga_satuan * (int) $d->jumlah,
                                                            'gambar' => $d->produk?->gambar
                                                                ? asset('storage/' . $d->produk->gambar)
                                                                : null,
                                                        ],
                                                    )
                                                    ->values()
                                                    ->all(),
                                            ];
                                        @endphp
                                        <button type="button"
                                            onclick='openOrderDetailModal(@json($detailPayload))'
                                            class="inline-flex items-center gap-1 rounded border border-[#e8dfd1] px-2.5 py-2 text-[10px] font-semibold uppercase tracking-[0.03em] text-[#52645a] transition hover:border-[#64835d] hover:bg-[#f5f0e2]">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            Detail
                                        </button>
                                        <button type="button"
                                            onclick='openDetailModal(@json($detailPayload), true)'
                                            class="rounded bg-[#103a2a] px-2.5 py-2 text-[10px] font-semibold uppercase leading-tight tracking-[0.03em] text-white transition hover:bg-[#315d41]">
                                            Update<br>Status
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-5 py-12 text-center">
                                    <span
                                        class="mx-auto flex h-10 w-10 items-center justify-center rounded-full bg-[#f5f0e2] text-[#87948b]">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 12h6m-6 4h6" />
                                        </svg>
                                    </span>
                                    <p class="mt-3 text-sm font-semibold text-[#30483a]">Tidak ada pesanan ditemukan</p>
                                    <p class="mt-1 text-xs text-[#87948b]">Coba ubah kata pencarian atau filter status.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($pesanans->hasPages())
                <div class="flex items-center justify-between border-t border-[#eee8dc] px-5 py-4">
                    <p class="text-xs text-[#718078]">
                        Menampilkan {{ $pesanans->firstItem() }}-{{ $pesanans->lastItem() }} dari
                        {{ $pesanans->total() }}
                        pesanan terdaftar
                    </p>
                    <div class="flex items-center gap-1">
                        {{ $pesanans->links() }}
                    </div>
                </div>
            @endif
        </section>

    </div>

    <div id="order-detail-modal"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-[#0b251b]/60 p-3 backdrop-blur-sm sm:p-5"
        role="dialog" aria-modal="true" aria-labelledby="order-detail-title">
        <div
            class="flex max-h-[92vh] w-full max-w-3xl flex-col overflow-hidden rounded-xl border border-[#e8dfd1] bg-[#fffdf7] shadow-2xl">
            <header class="shrink-0 bg-[#103a2a] px-4 py-3 text-white sm:px-5">
                <div class="flex items-start justify-between gap-4">
                    <div class="min-w-0">
                        <span id="order-detail-status"
                            class="inline-flex rounded-full bg-[#dff2e3] px-2.5 py-1 text-[8px] font-bold uppercase tracking-[0.08em] text-[#28633b]"></span>
                        <h2 id="order-detail-title"
                            class="display-font mt-1 text-base font-semibold leading-tight sm:text-lg"></h2>
                    </div>
                    <button type="button" onclick="closeOrderDetailModal()" aria-label="Tutup detail pesanan"
                        class="shrink-0 rounded px-1 text-xl leading-none text-white/70 transition hover:bg-white/10 hover:text-white">&times;</button>
                </div>
            </header>

            <div class="min-h-0 flex-1 space-y-3 overflow-y-auto p-4 sm:p-5">
                <section class="grid grid-cols-1 gap-3 rounded-lg border border-[#e8dfd1] bg-[#f7f4e9] p-3 sm:grid-cols-3">
                    <div>
                        <p class="text-[8px] font-semibold uppercase tracking-[0.1em] text-[#87948b]">ID Pesanan</p>
                        <p id="order-detail-code" class="mt-1 font-mono text-[10px] font-bold text-[#3d7951]"></p>
                    </div>
                    <div>
                        <p class="text-[8px] font-semibold uppercase tracking-[0.1em] text-[#87948b]">Pelanggan &amp; ID
                        </p>
                        <p id="order-detail-customer" class="mt-1 text-[10px] font-semibold text-[#30483a]"></p>
                        <p id="order-detail-username" class="mt-0.5 text-[8px] text-[#87948b]"></p>
                    </div>
                    <div>
                        <p class="text-[8px] font-semibold uppercase tracking-[0.1em] text-[#87948b]">Waktu Pesanan</p>
                        <p id="order-detail-date" class="mt-1 text-[10px] font-semibold text-[#30483a]"></p>
                    </div>
                </section>

                <section>
                    <h3
                        class="mb-2 flex items-center gap-1.5 text-[9px] font-bold uppercase tracking-[0.08em] text-[#37312b]">
                        <svg class="h-3.5 w-3.5 text-[#64835d]" fill="none" stroke="currentColor" stroke-width="1.7"
                            viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 4h12v16H6zM9 8h6m-6 4h6m-6 4h3" />
                        </svg>
                        Detail Produk yang Dipesan
                        <span class="font-normal text-[#87948b]">(<span id="order-detail-item-count">0</span> item)</span>
                    </h3>
                    <ul id="order-detail-items" class="space-y-2"></ul>
                </section>

                <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                    <section class="rounded-lg border border-[#e8dfd1] bg-[#f7f4e9] p-3">
                        <h3
                            class="mb-2 flex items-center gap-1.5 border-b border-[#e8dfd1] pb-2 text-[9px] font-bold uppercase tracking-[0.08em] text-[#52645a]">
                            <svg class="h-3.5 w-3.5 text-[#64835d]" fill="none" stroke="currentColor"
                                stroke-width="1.7" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 7h11v10H3zM14 10h4l3 3v4h-7z" />
                                <circle cx="7" cy="18" r="1.5" />
                                <circle cx="17" cy="18" r="1.5" />
                            </svg>
                            Informasi Pengiriman
                        </h3>
                        <dl class="space-y-1.5 text-[9px]">
                            <div class="flex justify-between gap-2">
                                <dt class="text-[#948b80]">Penerima</dt>
                                <dd id="order-detail-recipient" class="text-right font-semibold text-[#37312b]"></dd>
                            </div>
                            <div class="flex justify-between gap-2">
                                <dt class="text-[#948b80]">Kurir</dt>
                                <dd class="text-right font-semibold text-[#64835d]">Belum ditentukan</dd>
                            </div>
                            <div class="flex justify-between gap-2">
                                <dt class="text-[#948b80]">No. Resi</dt>
                                <dd class="text-right font-semibold text-[#37312b]">Belum tersedia</dd>
                            </div>
                            <div class="border-t border-[#e8dfd1] pt-1.5">
                                <dt class="text-[#948b80]">Alamat Lengkap</dt>
                                <dd id="order-detail-address" class="mt-0.5 break-words leading-relaxed text-[#37312b]">
                                </dd>
                            </div>
                        </dl>
                    </section>

                    <section class="rounded-lg border border-[#e8dfd1] bg-[#f7f4e9] p-3">
                        <h3
                            class="mb-2 flex items-center gap-1.5 border-b border-[#e8dfd1] pb-2 text-[9px] font-bold uppercase tracking-[0.08em] text-[#52645a]">
                            <svg class="h-3.5 w-3.5 text-[#64835d]" fill="none" stroke="currentColor"
                                stroke-width="1.7" viewBox="0 0 24 24" aria-hidden="true">
                                <rect x="3" y="5" width="18" height="14" rx="2" />
                                <path stroke-linecap="round" d="M3 10h18" />
                            </svg>
                            Rincian Pembayaran
                        </h3>
                        <dl class="space-y-1.5 text-[9px]">
                            <div class="flex justify-between gap-2">
                                <dt class="text-[#948b80]">Total Harga Produk</dt>
                                <dd id="order-detail-product-total" class="font-semibold text-[#37312b]"></dd>
                            </div>
                            <div class="flex justify-between gap-2">
                                <dt class="text-[#948b80]">Biaya Pengiriman &amp; Kemasan</dt>
                                <dd id="order-detail-additional" class="font-semibold text-[#37312b]"></dd>
                            </div>
                            <div class="flex items-center justify-between gap-2 border-t border-[#e8dfd1] pt-2">
                                <dt class="text-[10px] font-bold text-[#37312b]">Total Pembayaran</dt>
                                <dd id="order-detail-total" class="text-sm font-bold text-[#b8292e]"></dd>
                            </div>
                            <div class="flex justify-between gap-2 pt-1">
                                <dt class="text-[#948b80]">Metode</dt>
                                <dd id="order-detail-method" class="text-right font-semibold text-[#37312b]"></dd>
                            </div>
                            <div class="flex justify-between gap-2">
                                <dt class="text-[#948b80]">Status Pembayaran</dt>
                                <dd id="order-detail-payment-status" class="text-right font-semibold text-[#28633b]"></dd>
                            </div>
                        </dl>
                    </section>
                </div>
            </div>

            <footer class="flex shrink-0 justify-end border-t border-[#e8dfd1] bg-[#faf7ed] px-4 py-2.5 sm:px-5">
                <button type="button" onclick="closeOrderDetailModal()"
                    class="rounded-md border border-[#103a2a] bg-white px-4 py-2 text-[10px] font-semibold text-[#103a2a] transition hover:bg-[#103a2a] hover:text-white">
                    Tutup
                </button>
            </footer>
        </div>
    </div>

    <div id="status-modal"
        class="fixed inset-0 z-50 hidden flex items-center justify-center bg-[#0b251b]/60 p-3 backdrop-blur-sm sm:p-4"
        role="dialog" aria-modal="true" aria-labelledby="status-modal-title">
        <div
            class="flex max-h-[92vh] w-full max-w-xl flex-col overflow-hidden rounded-xl border border-[#d9d4c6] bg-[#fffdf7] shadow-2xl">
            <header class="flex shrink-0 items-center justify-between gap-3 bg-[#103a2a] px-5 py-4 text-white sm:px-6">
                <div class="flex min-w-0 items-center gap-3">
                    <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-md bg-white/10 text-[#cce5d2]">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8"
                            viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8 5H6a2 2 0 00-2 2v13h16V7a2 2 0 00-2-2h-2M8 5a2 2 0 002 2h4a2 2 0 002-2M8 5a2 2 0 012-2h4a2 2 0 012 2m-8 8h8m-8 4h5" />
                        </svg>
                    </span>
                    <div class="min-w-0">
                        <h2 id="status-modal-title" class="display-font truncate text-base font-semibold">Update Status
                            Pesanan</h2>
                        <p id="status-modal-description" class="mt-1 text-[10px] leading-relaxed text-white/70">
                            Perbarui status pesanan dan informasi pengiriman.
                        </p>
                    </div>
                </div>
                <button type="button" onclick="closeStatusModal()" aria-label="Tutup popup"
                    class="shrink-0 rounded px-1 text-2xl leading-none text-white/70 transition hover:bg-white/10 hover:text-white">&times;</button>
            </header>

            <div class="min-h-0 space-y-4 overflow-y-auto px-5 py-5 sm:px-6">
                <section class="rounded-lg border border-[#e8dfd1] bg-[#f7f4e9] p-4">
                    <div class="flex items-center justify-between gap-3 border-b border-[#e8dfd1] pb-3">
                        <div class="flex min-w-0 items-center gap-1.5">
                            <span class="text-[9px] font-semibold uppercase tracking-[0.08em] text-[#87948b]">Nomor
                                Pesanan</span>
                            <span id="modal-pesanan-id"
                                class="rounded bg-[#b8292e] px-2 py-1 font-mono text-[10px] font-bold text-white"></span>
                        </div>
                        <span id="modal-status-label"
                            class="shrink-0 rounded bg-[#ccebd8] px-2.5 py-1.5 text-[9px] font-bold uppercase text-[#28633b]"></span>
                    </div>

                    <div class="grid grid-cols-1 gap-4 py-3 sm:grid-cols-2">
                        <div class="min-w-0">
                            <p class="text-[9px] font-semibold uppercase tracking-[0.08em] text-[#87948b]">ID Pelanggan
                                &amp; Nama</p>
                            <p class="mt-1.5 break-words text-xs font-semibold leading-tight text-[#37312b]">
                                <span id="modal-username"></span><span class="text-[#948b80]"> — </span><span
                                    id="modal-pelanggan"></span>
                            </p>
                            <p id="modal-alamat" class="mt-1 break-words text-[10px] leading-relaxed text-[#81786e]"></p>
                        </div>
                        <div class="min-w-0">
                            <p class="text-[9px] font-semibold uppercase tracking-[0.08em] text-[#87948b]">Produk Terpesan
                            </p>
                            <ul id="modal-items" class="mt-1.5 space-y-1.5 text-[10px] text-[#37312b]"></ul>
                        </div>
                    </div>

                    <div class="flex items-center justify-between gap-3 border-t border-[#e8dfd1] pt-3 text-[10px]">
                        <p class="text-[#81786e]">Jumlah: <span id="modal-total-quantity"
                                class="font-semibold text-[#37312b]"></span></p>
                        <p class="text-right text-[#81786e]">Total Tagihan: <span id="modal-total"
                                class="text-sm font-bold text-[#b8292e]"></span></p>
                    </div>
                </section>

                <form id="status-form" method="POST" class="space-y-4">
                    @csrf
                    @method('PATCH')
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <label for="status_pesanan"
                                class="mb-1.5 block text-[9px] font-bold uppercase tracking-[0.06em] text-[#37312b]">
                                Pilih Status Baru Pesanan <span class="text-red-600">*</span>
                            </label>
                            <select name="status_pesanan" id="status_pesanan" required
                                class="w-full rounded-md border border-[#d9d4c6] bg-[#fffdf7] px-3 py-3 text-xs text-[#30483a] outline-none focus:border-[#64835d] focus:ring-1 focus:ring-[#64835d]/20">
                                <option value="menunggu_pembayaran">Menunggu Pembayaran</option>
                                <option value="diproses">Diproses</option>
                                <option value="dikirim">Dikirim (Siap / Dalam Perjalanan)</option>
                            </select>
                        </div>
                        <div>
                            <label for="status-tracking"
                                class="mb-1.5 block text-[9px] font-bold uppercase tracking-[0.06em] text-[#37312b]">
                                Nomor Resi / Pelacakan Kurir
                            </label>
                            <input id="status-tracking" type="text" placeholder="Masukkan nomor resi"
                                class="w-full rounded-md border border-[#d9d4c6] bg-[#fffdf7] px-3 py-3 text-xs text-[#30483a] outline-none placeholder:text-[#948b80] focus:border-[#64835d] focus:ring-1 focus:ring-[#64835d]/20">
                        </div>
                    </div>

                    <div
                        class="flex items-start gap-2 rounded-md bg-[#f2efe4] px-3 py-3 text-[9px] leading-relaxed text-[#81786e]">
                        <svg class="mt-0.5 h-3.5 w-3.5 shrink-0 text-[#64835d]" fill="none" stroke="currentColor"
                            stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                            <circle cx="12" cy="12" r="9" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 11v5m0-8h.01" />
                        </svg>
                        <p id="status-note"></p>
                    </div>

                    <p class="text-[9px] leading-relaxed text-[#87948b]">
                        Kolom nomor resi hanya untuk tampilan dan belum disimpan ke database.
                    </p>

                    <div class="flex justify-end gap-2 border-t border-[#e8dfd1] pt-3">
                        <button type="button" onclick="closeStatusModal()"
                            class="rounded-md border border-[#d9d4c6] bg-transparent px-5 py-2.5 text-xs font-semibold text-[#52645a] transition hover:bg-[#f7f4e9]">
                            Batal
                        </button>
                        <button type="submit" id="status-submit"
                            class="inline-flex items-center gap-1.5 rounded-md bg-[#103a2a] px-5 py-2.5 text-xs font-semibold text-white shadow-sm transition hover:bg-[#315d41]">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8"
                                viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                <circle cx="12" cy="12" r="10" />
                            </svg>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openOrderDetailModal(data) {
            const formatRupiah = (amount) => `Rp ${Number(amount || 0).toLocaleString('id-ID')}`;
            const statusClasses = {
                menunggu_pembayaran: 'bg-amber-100 text-amber-800',
                diproses: 'bg-emerald-100 text-emerald-800',
                dikirim: 'bg-sky-100 text-sky-800',
                selesai: 'bg-emerald-100 text-emerald-800',
                dibatalkan: 'bg-red-100 text-red-800',
            };
            const paymentStatusClasses = {
                menunggu: 'text-amber-700',
                berhasil: 'text-emerald-700',
                gagal: 'text-red-700',
            };

            const statusBadge = document.getElementById('order-detail-status');
            statusBadge.textContent = data.status_label;
            statusBadge.className =
                `inline-flex rounded-full px-2.5 py-1 text-[8px] font-bold uppercase tracking-[0.08em] ${statusClasses[data.status] || 'bg-gray-100 text-gray-800'}`;

            document.getElementById('order-detail-title').textContent = `Detail Pesanan ${data.kode_pesanan}`;
            document.getElementById('order-detail-code').textContent = data.kode_pesanan;
            document.getElementById('order-detail-customer').textContent = data.pelanggan;
            document.getElementById('order-detail-username').textContent =
                data.username && data.username !== '-' ? `@${data.username}` : '-';
            document.getElementById('order-detail-date').textContent = data.tanggal;
            document.getElementById('order-detail-recipient').textContent =
                data.telepon && data.telepon !== '-' ? `${data.pelanggan} (${data.telepon})` : data.pelanggan;
            document.getElementById('order-detail-address').textContent = data.alamat || 'Alamat belum tersedia.';
            document.getElementById('order-detail-product-total').textContent = formatRupiah(data.product_subtotal);
            document.getElementById('order-detail-additional').textContent = formatRupiah(data.additional_amount);
            document.getElementById('order-detail-total').textContent = formatRupiah(data.total_amount);
            document.getElementById('order-detail-method').textContent = data.metode;

            const paymentStatus = document.getElementById('order-detail-payment-status');
            paymentStatus.textContent = data.status_pembayaran_label;
            paymentStatus.className =
                `text-right font-semibold ${paymentStatusClasses[data.status_pembayaran] || 'text-[#52645a]'}`;

            const itemsEl = document.getElementById('order-detail-items');
            itemsEl.replaceChildren();
            document.getElementById('order-detail-item-count').textContent = data.items.length;

            if (data.items.length === 0) {
                const emptyItem = document.createElement('li');
                emptyItem.className =
                    'rounded-lg border border-[#e8dfd1] bg-white px-3 py-4 text-center text-[10px] text-[#87948b]';
                emptyItem.textContent = 'Tidak ada rincian produk pada pesanan ini.';
                itemsEl.appendChild(emptyItem);
            }

            data.items.forEach(item => {
                const listItem = document.createElement('li');
                listItem.className =
                    'grid grid-cols-[48px_minmax(0,1fr)_auto] items-center gap-2 rounded-lg border border-[#e8dfd1] bg-white p-2 sm:grid-cols-[52px_minmax(0,1fr)_auto] sm:gap-3 sm:p-2.5';

                const imageContainer = document.createElement('div');
                imageContainer.className =
                    'grid h-12 w-12 place-items-center overflow-hidden rounded-md border border-[#eee8dc] bg-[#f7f4e9] sm:h-14 sm:w-14';

                if (item.gambar) {
                    const image = document.createElement('img');
                    image.src = item.gambar;
                    image.alt = `Gambar ${item.nama}`;
                    image.className = 'h-full w-full object-cover';
                    image.onerror = () => {
                        const placeholder = document.createElement('span');
                        placeholder.className = 'px-1 text-center text-[7px] text-[#87948b]';
                        placeholder.textContent = 'Foto tidak tersedia';
                        image.replaceWith(placeholder);
                    };
                    imageContainer.appendChild(image);
                } else {
                    const placeholder = document.createElement('span');
                    placeholder.className = 'px-1 text-center text-[7px] text-[#87948b]';
                    placeholder.textContent = 'Foto produk';
                    imageContainer.appendChild(placeholder);
                }

                const productInfo = document.createElement('div');
                productInfo.className = 'min-w-0';

                const productName = document.createElement('p');
                productName.className = 'break-words text-[10px] font-semibold text-[#29241f] sm:text-xs';
                productName.textContent = item.nama;

                const productEdition = document.createElement('p');
                productEdition.className = 'mt-0.5 text-[8px] text-[#64835d]';
                productEdition.textContent = 'Signature Edition · Malang';
                productInfo.append(productName, productEdition);

                const itemSummary = document.createElement('div');
                itemSummary.className = 'text-right';

                const itemPrice = document.createElement('p');
                itemPrice.className = 'whitespace-nowrap text-[10px] font-bold text-[#37312b] sm:text-xs';
                itemPrice.textContent = formatRupiah(item.harga_satuan);

                const itemQuantity = document.createElement('p');
                itemQuantity.className = 'mt-0.5 whitespace-nowrap text-[8px] text-[#948b80]';
                itemQuantity.textContent = `Qty: ${item.jumlah} pcs`;

                const itemSubtotal = document.createElement('p');
                itemSubtotal.className = 'mt-0.5 whitespace-nowrap text-[8px] font-semibold text-[#3d7951]';
                itemSubtotal.textContent = `Subtotal: ${formatRupiah(item.subtotal)}`;
                itemSummary.append(itemPrice, itemQuantity, itemSubtotal);

                listItem.append(imageContainer, productInfo, itemSummary);
                itemsEl.appendChild(listItem);
            });

            const modal = document.getElementById('order-detail-modal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeOrderDetailModal() {
            const modal = document.getElementById('order-detail-modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function openDetailModal(data, focusStatus = false) {
            document.getElementById('modal-pesanan-id').textContent = data.kode_pesanan;
            document.getElementById('modal-status-label').textContent = data.status_label;
            document.getElementById('modal-pelanggan').textContent = data.pelanggan;
            document.getElementById('modal-username').textContent =
                data.username && data.username !== '-' ? data.username : 'Pelanggan';
            document.getElementById('modal-alamat').textContent =
                data.alamat && data.alamat !== '-' ? data.alamat : 'Alamat belum tersedia';
            document.getElementById('modal-total').textContent = data.total;
            document.getElementById('status-modal-title').textContent =
                focusStatus ? 'Update Status Pesanan' : 'Detail Pesanan';
            document.getElementById('status-modal-description').textContent = focusStatus ?
                'Perbarui status pesanan dan informasi pengiriman.' :
                'Periksa detail pelanggan, produk, dan pembayaran pesanan.';

            const itemsEl = document.getElementById('modal-items');
            itemsEl.replaceChildren();
            let totalQuantity = 0;

            data.items.forEach(item => {
                const li = document.createElement('li');
                li.className = 'flex items-start justify-between gap-2';
                const name = document.createElement('span');
                name.className = 'min-w-0 break-words font-medium';
                name.textContent = item.nama;

                const details = document.createElement('span');
                details.className = 'shrink-0 text-right text-[9px] text-[#81786e]';
                details.textContent =
                    `${item.jumlah} pcs @ Rp ${Number(item.harga_satuan || 0).toLocaleString('id-ID')}`;

                totalQuantity += Number(item.jumlah || 0);
                li.append(name, details);
                itemsEl.appendChild(li);
            });

            if (data.items.length === 0) {
                const emptyItem = document.createElement('li');
                emptyItem.className = 'text-[9px] text-[#81786e]';
                emptyItem.textContent = 'Tidak ada rincian produk.';
                itemsEl.appendChild(emptyItem);
            }

            document.getElementById('modal-total-quantity').textContent = `${totalQuantity} pcs`;
            document.getElementById('status-form').action = `/admin/pesanan/${data.id}/status`;
            document.getElementById('status-tracking').value = '';

            const allowed = ['menunggu_pembayaran', 'diproses', 'dikirim'];
            const locked = !allowed.includes(data.status);
            const select = document.getElementById('status_pesanan');
            const submitBtn = document.getElementById('status-submit');

            select.value = locked ? 'diproses' : data.status;
            select.disabled = locked;
            submitBtn.disabled = locked;
            submitBtn.classList.toggle('opacity-50', locked);
            submitBtn.classList.toggle('cursor-not-allowed', locked);

            document.getElementById('status-note').textContent = locked ?
                'Pesanan sudah selesai/dibatalkan — status tidak dapat diubah.' :
                'Admin hanya dapat mengubah status sampai "Dikirim". Status "Selesai" dikonfirmasi pembeli saat barang tiba atau melalui halaman Transaksi.';

            document.getElementById('status-modal').classList.remove('hidden');
            if (focusStatus) {
                document.getElementById('status_pesanan').focus();
            }
        }

        function closeStatusModal() {
            document.getElementById('status-modal').classList.add('hidden');
        }

        document.getElementById('status-modal').addEventListener('click', function(e) {
            if (e.target === this) closeStatusModal();
        });
        document.getElementById('order-detail-modal').addEventListener('click', function(e) {
            if (e.target === this) closeOrderDetailModal();
        });
    </script>
@endsection
