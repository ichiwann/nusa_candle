@extends('layouts.pembeli')

@section('title', 'Detail Pesanan #' . str_pad($pesanan->id_pesanan, 4, '0', STR_PAD_LEFT) . ' - NusaCandle')

@section('content')
    @php
        $isPreview = $isPreview ?? false;
        $transaksi = $pesanan->transaksi->first();
        $totalHargaProduk = $pesanan->detailPesanan->sum(fn($detail) => $detail->harga_satuan * $detail->jumlah);
        $totalItem = $pesanan->detailPesanan->sum('jumlah');
        $progressIndex = match ($pesanan->status_pesanan) {
            'menunggu_pembayaran' => 1,
            'diproses' => 2,
            'dikirim' => 3,
            'selesai' => 4,
            default => -1,
        };
        $progressSteps = [
            [
                'label' => 'Pesanan Dibuat',
                'description' => $pesanan->created_at->locale('id')->translatedFormat('d M Y, H:i'),
            ],
            [
                'label' => 'Pembayaran',
                'description' => $transaksi?->status_label ?? 'Belum ada informasi pembayaran',
            ],
            [
                'label' => 'Dalam Proses',
                'description' => 'Pesanan disiapkan perajin',
            ],
            [
                'label' => 'Pesanan Dikirim',
                'description' => 'Menunggu informasi pengiriman',
            ],
            [
                'label' => 'Pesanan Selesai',
                'description' => 'Pesanan diterima',
            ],
        ];
    @endphp
    <div class="bg-[#faf7ed]">
        <div class="mx-auto max-w-7xl px-4 pb-8 pt-3 sm:px-6 lg:px-8">
            <nav aria-label="Jejak halaman" class="mb-3 flex items-center gap-2 text-[8px] text-[#796d5d] sm:text-[9px]">
                <a href="{{ route('pembeli.pesanan.index') }}"
                    class="inline-flex items-center gap-1 transition hover:text-[#8B1E1E]">
                    <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Pesanan
                </a>
                <span aria-hidden="true">/</span>
                <span class="font-semibold text-[#8B1E1E]">Detail Pesanan</span>
            </nav>

            <header class="mb-4 flex flex-wrap items-end justify-between gap-3">
                <div>
                    <p class="mb-1 text-[7px] font-semibold uppercase tracking-[0.16em] text-[#2E7D32] sm:text-[8px]">
                        NusaCandle · Lilin Aroma Terapi Apel
                    </p>
                    <h1 class="font-display text-xl font-bold leading-tight text-[#2C1810] sm:text-2xl">Detail Pesanan</h1>
                    <p class="mt-1 text-[8px] text-[#796d5d] sm:text-[9px]">
                        #NC-{{ $pesanan->created_at->format('Y') }}-{{ str_pad($pesanan->id_pesanan, 4, '0', STR_PAD_LEFT) }}
                        <span class="px-1" aria-hidden="true">·</span>
                        Dibuat {{ $pesanan->created_at->locale('id')->translatedFormat('d F Y, H:i') }} WIB
                    </p>
                </div>
                <span
                    class="inline-flex items-center gap-1 rounded-full px-2.5 py-1 text-[8px] font-semibold sm:text-[9px] {{ $pesanan->status_color }}">
                    <span class="h-1.5 w-1.5 rounded-full bg-current" aria-hidden="true"></span>
                    {{ $pesanan->status_label }}
                </span>
            </header>

            @if ($isPreview)
                <div class="mb-3 rounded-lg border border-[#eddfb8] bg-[#fff9e8] px-3 py-2 text-[8px] text-[#796d5d] sm:text-[9px]"
                    role="note">
                    Ini pratinjau pesanan contoh. Informasi ini tidak tersimpan dan bukan pesanan untuk pembayaran.
                </div>
            @endif

            @if ($pesanan->status_pesanan === 'dibatalkan')
                <div class="mb-3 rounded-lg border border-[#edcaca] bg-[#fff1f1] px-3 py-2 text-[9px] text-[#8B1E1E]"
                    role="status">
                    Pesanan ini dibatalkan. Hubungi penjual jika Anda memerlukan bantuan.
                </div>
            @endif

            <section class="mb-4 rounded-xl border border-[#e8dfcf] bg-white p-4 shadow-sm sm:p-5"
                aria-labelledby="order-progress-title">
                <div class="mb-7 flex flex-wrap items-end justify-between gap-3">
                    <div>
                        <p class="mb-1 text-[7px] font-bold uppercase tracking-[0.16em] text-[#47784a] sm:text-[8px]">
                            Perjalanan Lilin Anda</p>
                        <h2 id="order-progress-title" class="font-display text-sm font-bold text-[#2C1810] sm:text-base">
                            Status Pengiriman Terkini</h2>
                    </div>
                </div>
                <div class="overflow-x-auto pb-1">
                    <ol class="relative grid min-w-[700px] grid-cols-5">
                        <li aria-hidden="true"
                            class="absolute left-[10%] right-[10%] top-3.5 h-0.5 rounded-full bg-[#ece8df]">
                            @php
                                $orderProgressWidths = ['w-0', 'w-1/4', 'w-1/2', 'w-3/4', 'w-full'];
                                $orderProgressWidth = $orderProgressWidths[min(4, max(0, $progressIndex))];
                            @endphp
                            <span
                                class="absolute left-0 top-0 h-full rounded-full bg-[#47784a] {{ $orderProgressWidth }}"></span>
                        </li>
                        @foreach ($progressSteps as $index => $step)
                            @php
                                $isComplete =
                                    $index === 0 ||
                                    $pesanan->status_pesanan === 'selesai' ||
                                    ($pesanan->status_pesanan !== 'dibatalkan' && $index < $progressIndex);
                                $isCurrent =
                                    !in_array($pesanan->status_pesanan, ['dibatalkan', 'selesai']) &&
                                    $index === $progressIndex;
                                $stepClasses = $isComplete
                                    ? 'bg-[#47784a] text-white'
                                    : ($isCurrent
                                        ? 'bg-[#a51f24] text-white'
                                        : 'bg-[#f4f1eb] text-[#b8b0a4]');
                            @endphp
                            <li class="relative z-10 flex min-w-0 flex-col items-center px-1 text-center">
                                <span
                                    class="flex h-7 w-7 items-center justify-center rounded-full ring-4 ring-white {{ $stepClasses }}">
                                    @if ($index === 0 || ($index === 1 && $isComplete))
                                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                    @elseif ($index === 1)
                                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            aria-hidden="true">
                                            <rect x="3" y="5" width="18" height="14" rx="2"
                                                stroke-width="2" />
                                            <path stroke-linecap="round" stroke-width="2" d="M3 10h18" />
                                        </svg>
                                    @elseif ($index === 2)
                                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16V8zM3.3 7l8.7 5 8.7-5M12 22V12" />
                                        </svg>
                                    @elseif ($index === 3)
                                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 7h11v10H3zM14 10h4l3 3v4h-7z" />
                                            <circle cx="7.5" cy="18" r="1.5" stroke-width="2" />
                                            <circle cx="17.5" cy="18" r="1.5" stroke-width="2" />
                                        </svg>
                                    @else
                                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 10.5L12 3l9 7.5M5 9v11h14V9M9 20v-6h6v6" />
                                        </svg>
                                    @endif
                                </span>
                                <span
                                    class="mt-2 block text-[8px] font-semibold leading-snug {{ $isCurrent ? 'text-[#a51f24]' : ($isComplete ? 'text-[#2C1810]' : 'text-[#8f877c]') }} sm:text-[9px]">
                                    {{ $step['label'] }}
                                </span>
                                <span
                                    class="mt-1 block max-w-32 text-[7px] leading-snug text-[#796d5d] sm:text-[8px]">{{ $step['description'] }}</span>
                            </li>
                        @endforeach
                    </ol>
                </div>
            </section>

            <div class="grid grid-cols-1 items-start gap-4 lg:grid-cols-[minmax(0,1.7fr)_minmax(250px,0.8fr)]">
                <div class="min-w-0 space-y-4">
                    <section class="rounded-lg border border-[#e8dfcf] bg-white p-3 shadow-sm sm:p-4">
                        <div class="mb-3 flex items-center justify-between gap-2 border-b border-[#f1ece2] pb-2">
                            <h2 class="font-display text-[11px] font-bold text-[#2C1810] sm:text-xs">Produk dalam Pesanan
                            </h2>
                            <span
                                class="rounded-full bg-[#e8f2e2] px-2 py-0.5 text-[7px] font-semibold text-[#2E7D32] sm:text-[8px]">
                                {{ $totalItem }} Barang
                            </span>
                        </div>

                        <div class="space-y-2.5">
                            @foreach ($pesanan->detailPesanan as $detail)
                                <article
                                    class="flex items-center gap-2.5 border-b border-[#f1ece2] pb-2.5 last:border-0 last:pb-0 sm:gap-3">
                                    @if ($detail->produk->gambar)
                                        <img src="{{ asset('storage/' . $detail->produk->gambar) }}"
                                            alt="{{ $detail->produk->nama_produk }}"
                                            class="h-12 w-12 shrink-0 rounded-md border border-[#eee5d7] object-cover sm:h-14 sm:w-14">
                                    @else
                                        <div
                                            class="flex h-12 w-12 shrink-0 items-center justify-center rounded-md border border-[#eee5d7] bg-[#f3eddf] sm:h-14 sm:w-14">
                                            <svg class="h-8 w-8" viewBox="0 0 64 64" role="img"
                                                aria-label="Lilin aromaterapi">
                                                <ellipse cx="32" cy="55" rx="21" ry="4"
                                                    fill="#604a35" opacity=".22" />
                                                <path d="M32 6c-7 10-5 15 0 18 5-3 7-8 0-18z" fill="#e99b43" />
                                                <path d="M32 11c-3 5-2 8 0 10 2-2 3-5 0-10z" fill="#fff1bc" />
                                                <rect x="14" y="23" width="36" height="31" rx="7"
                                                    fill="#536044" stroke="#ded2b6" stroke-width="2" />
                                                <ellipse cx="32" cy="24" rx="17" ry="4"
                                                    fill="#e9dfc9" />
                                                <rect x="19" y="34" width="26" height="11" rx="2"
                                                    fill="#e9dfc9" />
                                                <path d="M23 38h18" stroke="#8b7658" stroke-width="1.5" />
                                            </svg>
                                        </div>
                                    @endif

                                    <div class="min-w-0 flex-1">
                                        <span
                                            class="mb-1 inline-flex rounded-full bg-[#e8f2e2] px-1.5 py-0.5 text-[6px] font-semibold text-[#2E7D32] sm:text-[7px]">NusaCandle
                                            · Lilin Alami</span>
                                        <h3
                                            class="font-display text-[9px] font-bold leading-snug text-[#2C1810] sm:text-[10px]">
                                            {{ $detail->produk->nama_produk }}
                                        </h3>
                                        <p class="mt-1 text-[7px] text-[#796d5d] sm:text-[8px]">
                                            Jumlah: {{ $detail->jumlah }} pcs
                                            <span class="px-1" aria-hidden="true">·</span>
                                            Harga satuan: Rp{{ number_format($detail->harga_satuan, 0, ',', '.') }}
                                        </p>
                                    </div>

                                    <p class="shrink-0 text-right text-[9px] font-bold text-[#8B1E1E] sm:text-[10px]">
                                        Rp{{ number_format($detail->harga_satuan * $detail->jumlah, 0, ',', '.') }}
                                    </p>
                                </article>
                            @endforeach
                        </div>
                    </section>
                </div>

                <aside class="min-w-0 space-y-3">
                    <section class="rounded-lg border border-[#e8dfcf] bg-white p-3 shadow-sm sm:p-4">
                        <div class="mb-2 flex items-center justify-between gap-2 border-b border-[#f1ece2] pb-2">
                            <h2 class="font-display text-[11px] font-bold text-[#2C1810] sm:text-xs">Informasi Pesanan</h2>
                            <svg class="h-3.5 w-3.5 text-[#8B1E1E]" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <dl class="space-y-2 text-[7px] sm:text-[8px]">
                            <div class="flex justify-between gap-2">
                                <dt class="text-[#796d5d]">Nomor Pesanan</dt>
                                <dd class="text-right font-mono font-semibold text-[#2C1810]">
                                    #NC-{{ $pesanan->created_at->format('Y') }}-{{ str_pad($pesanan->id_pesanan, 4, '0', STR_PAD_LEFT) }}
                                </dd>
                            </div>
                            <div class="flex justify-between gap-2">
                                <dt class="text-[#796d5d]">Tanggal Pesanan</dt>
                                <dd class="text-right font-medium text-[#2C1810]">
                                    {{ $pesanan->created_at->locale('id')->translatedFormat('d F Y') }}</dd>
                            </div>
                            <div class="flex justify-between gap-2">
                                <dt class="text-[#796d5d]">Status Pesanan</dt>
                                <dd class="text-right font-semibold text-[#2C1810]">{{ $pesanan->status_label }}</dd>
                            </div>
                            @if ($transaksi)
                                <div class="flex justify-between gap-2">
                                    <dt class="text-[#796d5d]">Metode Pembayaran</dt>
                                    <dd class="text-right font-semibold text-[#2C1810]">{{ $transaksi->metode_label }}
                                    </dd>
                                </div>
                                <div class="flex justify-between gap-2">
                                    <dt class="text-[#796d5d]">Status Pembayaran</dt>
                                    <dd class="text-right font-semibold text-[#2C1810]">{{ $transaksi->status_label }}
                                    </dd>
                                </div>
                            @endif
                        </dl>

                        @if (
                            $transaksi &&
                                $pesanan->status_pesanan === 'menunggu_pembayaran' &&
                                in_array($transaksi->metode_pembayaran, ['bca', 'mandiri']))
                            <div class="mt-3 rounded-md border border-[#e8dfcf] bg-[#faf7ed] p-2.5">
                                <p class="mb-1 text-[7px] text-[#796d5d]">Nomor Virtual Account / Rekening Tujuan</p>
                                <div class="flex items-center justify-between gap-2">
                                    <p id="nomor-va"
                                        class="font-mono text-[10px] font-bold tracking-wide text-[#8B1E1E] sm:text-xs">
                                        {{ $transaksi->metode_pembayaran === 'bca' ? '8271 0812 3456 7890' : '130 00 1234567 8' }}
                                    </p>
                                    <button type="button" onclick="copyVA()"
                                        class="rounded bg-[#8B1E1E] px-2 py-1 text-[7px] font-semibold text-white transition hover:bg-[#6B1515] sm:text-[8px]">
                                        Salin
                                    </button>
                                </div>
                            </div>
                        @endif

                        @if ($transaksi && $transaksi->metode_pembayaran === 'cod')
                            <div class="mt-3 rounded-md border border-[#cfe3c7] bg-[#edf6e9] p-2.5">
                                <p class="text-[8px] font-semibold text-[#276236]">Pembayaran di Tempat (COD)</p>
                                <p class="mt-0.5 text-[7px] leading-relaxed text-[#47784a]">Siapkan pembayaran saat pesanan
                                    diterima.</p>
                            </div>
                        @endif
                    </section>

                    <section class="rounded-lg border border-[#e8dfcf] bg-white p-3 shadow-sm sm:p-4">
                        <h2 class="mb-2 font-display text-[11px] font-bold text-[#2C1810] sm:text-xs">Ringkasan Pembayaran
                        </h2>
                        <div class="space-y-1.5 border-b border-[#f1ece2] pb-2 text-[7px] sm:text-[8px]">
                            <div class="flex justify-between gap-2">
                                <span class="text-[#796d5d]">Total Harga Produk</span>
                                <span
                                    class="font-semibold text-[#2C1810]">Rp{{ number_format($totalHargaProduk, 0, ',', '.') }}</span>
                            </div>
                            @unless ($isPreview)
                                <div class="flex justify-between gap-2">
                                    <span class="text-[#796d5d]">Ongkos Kirim</span>
                                    <span class="font-semibold text-[#2C1810]">Rp15.000</span>
                                </div>
                                <div class="flex justify-between gap-2">
                                    <span class="text-[#796d5d]">Kemasan & Pelindung</span>
                                    <span class="font-semibold text-[#2C1810]">Rp5.000</span>
                                </div>
                            @endunless
                        </div>
                        <div class="flex items-center justify-between gap-2 pt-2">
                            <span class="text-[8px] font-semibold text-[#796d5d] sm:text-[9px]">Total Tagihan</span>
                            <span
                                class="font-display text-sm font-bold text-[#8B1E1E] sm:text-base">Rp{{ number_format($pesanan->total_harga, 0, ',', '.') }}</span>
                        </div>
                    </section>

                                        <section class="rounded-lg border border-[#e8dfcf] bg-white p-3 shadow-sm sm:p-4">
                        <h2 class="mb-2 font-display text-[11px] font-bold text-[#2C1810] sm:text-xs">Tindakan Pesanan</h2>
                        <div class="space-y-1.5">
                            @if ($isPreview)
                                <p
                                    class="rounded-md bg-[#faf7ed] px-2.5 py-2 text-[8px] leading-relaxed text-[#796d5d] sm:text-[9px]">
                                    Tindakan pembayaran tidak tersedia untuk pesanan contoh.
                                </p>
                            @else
                                @if ($pesanan->status_pesanan === 'menunggu_pembayaran' && $transaksi)
                                    <a href="{{ route('pembeli.transaksi.show', $transaksi->id_transaksi) }}"
                                        class="flex w-full items-center justify-center gap-1.5 rounded-md bg-[#8B1E1E] px-2.5 py-2 text-[8px] font-semibold text-white transition hover:bg-[#6B1515] sm:text-[9px]">
                                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                        </svg>
                                        Upload Bukti Pembayaran
                                    </a>

                                @elseif ($pesanan->status_pesanan === 'dikirim')
                                    <div class="rounded-md border border-[#cfe3c7] bg-[#edf6e9] p-2.5">
                                        <p class="text-[8px] font-semibold text-[#276236]">Pesanan sedang dalam perjalanan
                                            🚚</p>
                                        <p class="mt-0.5 text-[7px] leading-relaxed text-[#47784a]">Kalau lilin sudah
                                            sampai dan sesuai, selesaikan pesanan lewat tombol di bawah.</p>
                                    </div>
                                    <form action="{{ route('pembeli.pesanan.selesai', $pesanan->id_pesanan) }}"
                                        method="POST"
                                        onsubmit="return confirm('Pastikan pesanan sudah benar-benar diterima. Selesaikan pesanan ini?')">
                                        @csrf
                                        <button type="submit"
                                            class="flex w-full items-center justify-center gap-1.5 rounded-md bg-[#2E7D32] px-2.5 py-2 text-[8px] font-semibold text-white transition hover:bg-[#256428] sm:text-[9px]">
                                            ✓ Konfirmasi Pesanan Diterima
                                        </button>
                                    </form>
                                    @if ($transaksi && $transaksi->metode_pembayaran === 'cod')
                                        <p class="text-[7px] leading-relaxed text-[#796d5d]">COD: pastikan Anda sudah
                                            membayar tunai ke kurir sebelum menyelesaikan pesanan.</p>
                                    @endif

                                @elseif ($pesanan->status_pesanan === 'diproses')
                                    {{-- ✅ Layout sesuai desain untuk status DIPROSES --}}
                                    <form action="{{ route('pembeli.pesanan.selesai', $pesanan->id_pesanan) }}"
                                        method="POST"
                                        onsubmit="return confirm('Pastikan pesanan sudah benar-benar diterima. Selesaikan pesanan ini?')">
                                        @csrf
                                        <button type="submit"
                                            class="flex w-full items-center justify-center gap-1.5 rounded-md bg-[#8B1E1E] px-2.5 py-2.5 text-[8px] font-semibold text-white transition hover:bg-[#6B1515] sm:text-[9px]">
                                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                            </svg>
                                            Konfirmasi Pesanan Diterima
                                        </button>
                                    </form>

                                    <a href="https://wa.me/6281234567890" target="_blank" rel="noopener noreferrer"
                                        class="flex w-full items-center justify-center gap-1.5 rounded-md border border-[#e5dccb] bg-[#f5f0e5] px-2.5 py-2 text-[8px] font-semibold text-[#276236] transition hover:bg-[#ece5d6] sm:text-[9px]">
                                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                        </svg>
                                        Hubungi Penjual via WhatsApp
                                    </a>

                                    <button type="button" disabled
                                        class="flex w-full cursor-not-allowed items-center justify-center gap-1.5 rounded-md px-2.5 py-2 text-[8px] font-semibold text-[#a99c8b] sm:text-[9px]">
                                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Batalkan Pesanan
                                    </button>
                                    <p class="text-center text-[7px] leading-relaxed text-[#796d5d] sm:text-[8px]">
                                        *Pesanan tidak dapat dibatalkan karena paket sudah diproses dan diserahkan ke
                                        pihak ekspedisi J&amp;T.
                                    </p>
                                @endif

                                {{-- ✅ Batalkan aktif HANYA saat menunggu pembayaran --}}
                                @if ($pesanan->status_pesanan === 'menunggu_pembayaran')
                                    <form action="{{ route('pembeli.pesanan.batalkan', $pesanan->id_pesanan) }}"
                                        method="POST"
                                        onsubmit="return confirm('Batalkan pesanan ini? Stok akan dikembalikan dan pesanan tidak dapat dipulihkan.')">
                                        @csrf
                                        <button type="submit"
                                            class="flex w-full items-center justify-center gap-1.5 rounded-md border border-[#edcaca] bg-[#fff1f1] px-2.5 py-2 text-[8px] font-semibold text-[#8B1E1E] transition hover:bg-[#fbe3e3] sm:text-[9px]">
                                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                            Batalkan Pesanan
                                        </button>
                                    </form>
                                    <p class="text-[7px] leading-relaxed text-[#796d5d]">
                                        Pesanan hanya dapat dibatalkan selagi belum dikonfirmasi / diproses penjual.
                                    </p>
                                @endif

                                {{-- ✅ WhatsApp umum (diproses sudah punya sendiri di atas, jadi skip) --}}
                                @if ($pesanan->status_pesanan !== 'diproses')
                                    <a href="https://wa.me/6281234567890" target="_blank" rel="noopener noreferrer"
                                        class="flex w-full items-center justify-center gap-1.5 rounded-md border border-[#cfe3c7] bg-[#edf6e9] px-2.5 py-2 text-[8px] font-semibold text-[#276236] transition hover:bg-[#e2f0dc] sm:text-[9px]">
                                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                        </svg>
                                        Hubungi Penjual via WhatsApp
                                    </a>
                                @endif
                            @endif

                            <a href="{{ route('pembeli.pesanan.index') }}"
                                class="flex w-full items-center justify-center gap-1.5 rounded-md border border-[#e7dfd1] bg-white px-2.5 py-2 text-[8px] font-semibold text-[#796d5d] transition hover:border-[#8B1E1E] hover:text-[#8B1E1E] sm:text-[9px]">
                                Kembali ke Daftar Pesanan
                            </a>
                        </div>
                    </section>

                    <div class="rounded-lg border border-[#e8dfcf] bg-[#f5f0e5] p-3">
                        <p class="mb-1 text-[8px] font-semibold text-[#2C1810]">Tips Perawatan Perajin</p>
                        <p class="text-[7px] leading-relaxed text-[#796d5d]">
                            Potong sumbu sekitar 5 mm sebelum digunakan dan letakkan lilin di permukaan rata agar nyala
                            tetap stabil.
                        </p>
                    </div>
                </aside>
            </div>
        </div>
    </div>

    <script>
        function copyVA() {
            const vaElement = document.getElementById('nomor-va');
            if (!vaElement || !navigator.clipboard) {
                alert('Nomor rekening tidak dapat disalin dari perangkat ini.');
                return;
            }

            navigator.clipboard.writeText(vaElement.textContent.trim())
                .then(() => alert('Nomor rekening berhasil disalin.'))
                .catch(() => alert('Nomor rekening gagal disalin. Silakan salin secara manual.'));
        }
    </script>
@endsection
