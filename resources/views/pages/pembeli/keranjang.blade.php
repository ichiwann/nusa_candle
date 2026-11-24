@extends('layouts.pembeli')

@section('title', 'Keranjang Belanja Anda - NusaCandle')

@section('content')
    <style>
        body > nav { background-color: #faf7ed !important; border-top: 3px solid #8b1e1e; box-shadow: none !important; }
        body > main { background-color: #faf7ed; }
        body > footer { background-color: #f5f0e2 !important; border-top-color: #e8dfcd !important; }
        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }
        input[type="number"] { -moz-appearance: textfield; appearance: textfield; }

        /* Layout dua kolom. Ringkasan di kanan bersifat statis (tidak sticky),
           sehingga saat halaman di-scroll ia tidak ikut turun / menempel. */
        .cart-grid { display: grid; grid-template-columns: 1fr; gap: 1.25rem; align-items: start; }
        @media (min-width: 1024px) {
            .cart-grid { grid-template-columns: minmax(0, 1.7fr) minmax(320px, 1fr); gap: 1.5rem; }
        }
    </style>

    <div class="bg-[#faf7ed]">
        <div class="mx-auto max-w-7xl px-4 pb-12 pt-4 sm:px-6 lg:px-8">

            {{-- Header --}}
            <header class="mb-6">
                <h1 class="font-serif text-3xl font-bold leading-tight text-[#8B1E1E] sm:text-4xl">Keranjang Belanja Anda</h1>
                <p class="mt-1 text-xs text-[#796d5d] sm:text-sm">
                    Periksa kembali pilihan lilin aromaterapi sari apel Malang sebelum melanjutkan pemesanan.
                </p>
            </header>

            <div class="cart-grid">

                {{-- ================= KOLOM KIRI ================= --}}
                <div class="min-w-0 space-y-5">

                    {{-- Daftar Item --}}
                    <section class="rounded-xl border border-[#e8dfcf] bg-[#fffdf7] p-3 shadow-sm sm:p-5">
                        <div class="mb-3 flex items-center gap-2 border-b border-[#eee8dc] pb-3">
                            <input type="checkbox" id="select-all" onchange="toggleSelectAll(this)"
                                class="h-4 w-4 rounded border-[#c9bda9] bg-white text-[#8B1E1E] focus:ring-[#8B1E1E] cursor-pointer">
                            <label for="select-all" class="text-[10px] font-semibold text-[#2C1810] sm:text-xs">
                                Pilih Semua ({{ $keranjang->count() }} Produk)
                            </label>
                        </div>

                        @forelse ($keranjang as $item)
                            <article class="relative border-b border-[#eee8dc] py-4 last:border-0 last:pb-0"
                                data-harga="{{ $item->produk->harga }}" data-jumlah="{{ $item->jumlah }}">
                                <div class="flex gap-3 sm:gap-4">
                                    <input type="checkbox" name="selected[]" value="{{ $item->id_keranjang }}"
                                        form="checkout-form" onchange="syncSelectAll()"
                                        class="mt-1 h-4 w-4 shrink-0 rounded border-[#c9bda9] bg-white text-[#8B1E1E] focus:ring-[#8B1E1E] cursor-pointer">

                                    <div class="h-20 w-20 shrink-0 overflow-hidden rounded-lg border border-[#eee5d7] bg-[#f3eddf] sm:h-24 sm:w-24">
                                        @if ($item->produk->gambar)
                                            <img src="{{ asset('storage/' . $item->produk->gambar) }}"
                                                alt="{{ $item->produk->nama_produk }}" class="h-full w-full object-cover">
                                        @else
                                            <div class="flex h-full w-full items-center justify-center bg-gradient-to-br from-[#e7decb] to-[#cbb99d]">
                                                <svg class="h-12 w-12" viewBox="0 0 64 64" role="img" aria-label="Lilin">
                                                    <path d="M32 5c-6 8-4 12 0 15 4-3 6-7 0-15Z" fill="#E99B43" />
                                                    <path d="M32 10c-2 3-2 5 0 7 2-2 2-4 0-7Z" fill="#FFF1BC" />
                                                    <path d="M17 25h30l-3 29a5 5 0 01-5 5H25a5 5 0 01-5-5l-3-29Z" fill="#536044" stroke="#ded2b6" stroke-width="2" />
                                                    <ellipse cx="32" cy="25" rx="15" ry="4" fill="#e9dfc9" stroke="#ded2b6" stroke-width="2" />
                                                </svg>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="min-w-0 flex-1">
                                        <div class="flex items-start justify-between gap-2">
                                            <div class="min-w-0">
                                                <span class="mb-1.5 inline-block rounded-full bg-[#f8e6e5] px-2 py-0.5 text-[8px] font-semibold text-[#8B1E1E]">Khas Malang</span>
                                                <h3 class="font-serif text-sm font-bold leading-snug text-[#2C1810] sm:text-base">
                                                    {{ $item->produk->nama_produk }}
                                                </h3>
                                                <p class="mt-0.5 text-[9px] text-[#796d5d] sm:text-[10px]">Varian: Apel Manalagi 220g</p>
                                            </div>
                                            <form action="{{ route('keranjang.destroy', $item->id_keranjang) }}" method="POST"
                                                onsubmit="return confirm('Hapus produk ini?')" class="shrink-0">
                                                @csrf @method('DELETE')
                                                <button type="submit" aria-label="Hapus {{ $item->produk->nama_produk }}"
                                                    class="rounded p-1 text-[#a99c8b] transition hover:bg-[#faeeee] hover:text-[#8B1E1E]">
                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>

                                        <div class="mt-3 flex flex-wrap items-center justify-between gap-3">
                                            <div>
                                                <p class="text-[8px] text-[#796d5d] sm:text-[9px]">Harga Satuan</p>
                                                <p class="text-[10px] font-semibold text-[#2C1810] sm:text-xs">
                                                    Rp {{ number_format($item->produk->harga, 0, ',', '.') }}
                                                </p>
                                            </div>

                                            <div class="flex items-center gap-1.5">
                                                <button type="button" onclick="updateQty({{ $item->id_keranjang }}, {{ $item->jumlah - 1 }})"
                                                    aria-label="Kurangi jumlah"
                                                    class="flex h-7 w-7 items-center justify-center rounded border border-[#e5dccb] bg-white text-sm text-[#796d5d] transition hover:bg-[#f5f0e5] disabled:cursor-not-allowed disabled:opacity-40"
                                                    {{ $item->jumlah <= 1 ? 'disabled' : '' }}>−</button>
                                                <span class="w-8 text-center text-[10px] font-semibold text-[#2C1810] sm:text-xs">{{ $item->jumlah }}</span>
                                                <button type="button" onclick="updateQty({{ $item->id_keranjang }}, {{ $item->jumlah + 1 }})"
                                                    aria-label="Tambah jumlah"
                                                    class="flex h-7 w-7 items-center justify-center rounded border border-[#e5dccb] bg-white text-sm text-[#796d5d] transition hover:bg-[#f5f0e5] disabled:cursor-not-allowed disabled:opacity-40"
                                                    {{ $item->jumlah >= $item->produk->stok ? 'disabled' : '' }}>+</button>
                                            </div>

                                            <div class="text-right">
                                                <p class="text-[8px] text-[#796d5d] sm:text-[9px]">Subtotal</p>
                                                <p data-subtotal class="text-[11px] font-bold text-[#8B1E1E] sm:text-sm">
                                                    Rp {{ number_format($item->produk->harga * $item->jumlah, 0, ',', '.') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @empty
                            <div class="py-10 text-center">
                                <p class="mb-1 font-serif text-base font-bold text-[#2C1810]">Keranjang Anda Kosong</p>
                                <p class="mb-4 text-xs text-[#796d5d]">Mulai belanja untuk menambahkan produk ke keranjang.</p>
                                <a href="{{ route('produk.index') }}" class="inline-flex items-center rounded-md bg-[#8B1E1E] px-5 py-2.5 text-xs font-semibold text-white transition hover:bg-[#6B1515]">Belanja Sekarang</a>
                            </div>
                        @endforelse
                    </section>

                    {{-- Metode Pembayaran --}}
                    @if ($keranjang->count() > 0)
                        <form id="checkout-form" action="{{ route('pembeli.checkout.store') }}" method="POST">
                            @csrf
                    @endif

                    <section class="rounded-xl border border-[#e8dfcf] bg-[#fffdf7] p-4 shadow-sm sm:p-5">
                        <div class="mb-4 flex items-start gap-3 border-b border-[#eee8dc] pb-3">
                            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-[#f8e6e5] text-[#8B1E1E]">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M5 7l1 13h12l1-13M9 7V5a3 3 0 016 0v2" />
                                </svg>
                            </span>
                            <div>
                                <h2 class="font-serif text-base font-bold text-[#2C1810] sm:text-lg">Pilih Metode Pembayaran</h2>
                                <p class="text-[9px] text-[#796d5d] sm:text-[10px]">Pilih cara pembayaran pesanan Anda.</p>
                            </div>
                        </div>

                        {{-- Transfer Bank --}}
                        <div class="mb-2 flex flex-wrap items-center gap-2">
                            <h3 class="text-[9px] font-bold uppercase tracking-wide text-[#2E7D32]">Transfer Bank / Virtual Account</h3>
                            <span class="rounded bg-[#f5f0e5] px-2 py-0.5 text-[7px] text-[#796d5d]">Verifikasi Otomatis</span>
                        </div>
                        <div class="mb-4 grid grid-cols-1 gap-2 sm:grid-cols-2">
                            <label class="flex cursor-pointer items-center gap-2.5 rounded-lg border border-[#8B1E1E] bg-[#fff8f6] p-2.5 transition has-[:checked]:border-[#8B1E1E] has-[:checked]:bg-[#fff8f6]">
                                <input type="radio" name="metode_pembayaran" value="bca" checked class="h-3.5 w-3.5 accent-[#8B1E1E]" onchange="updateMetodeTerpilih(this.value)">
                                <span class="flex h-6 w-8 shrink-0 items-center justify-center rounded bg-[#edf3ff] text-[8px] font-bold text-[#17549b]">BCA</span>
                                <span class="min-w-0 text-[10px] font-semibold text-[#2C1810]">BCA Virtual Account</span>
                            </label>
                            <label class="flex cursor-pointer items-center gap-2.5 rounded-lg border border-[#e5dccb] bg-white p-2.5 transition has-[:checked]:border-[#8B1E1E] has-[:checked]:bg-[#fff8f6]">
                                <input type="radio" name="metode_pembayaran" value="mandiri" class="h-3.5 w-3.5 accent-[#8B1E1E]" onchange="updateMetodeTerpilih(this.value)">
                                <span class="flex h-6 w-8 shrink-0 items-center justify-center rounded bg-[#fff3df] text-[8px] font-bold text-[#8a5a16]">MDR</span>
                                <span class="min-w-0 text-[10px] font-semibold text-[#2C1810]">Mandiri Virtual Account</span>
                            </label>
                            <label class="flex cursor-not-allowed items-center gap-2.5 rounded-lg border border-[#e5dccb] bg-white p-2.5 opacity-60" title="Belum tersedia">
                                <input type="radio" name="metode_pembayaran" value="bri" disabled class="h-3.5 w-3.5 accent-[#8B1E1E]">
                                <span class="flex h-6 w-8 shrink-0 items-center justify-center rounded bg-[#fff0e8] text-[8px] font-bold text-[#c33b35]">BRI</span>
                                <span class="min-w-0 text-[10px] font-semibold text-[#2C1810]">BRI Virtual Account</span>
                            </label>
                            <label class="flex cursor-not-allowed items-center gap-2.5 rounded-lg border border-[#e5dccb] bg-white p-2.5 opacity-60" title="Belum tersedia">
                                <input type="radio" name="metode_pembayaran" value="bni" disabled class="h-3.5 w-3.5 accent-[#8B1E1E]">
                                <span class="flex h-6 w-8 shrink-0 items-center justify-center rounded bg-[#fff5e5] text-[8px] font-bold text-[#e37d22]">BNI</span>
                                <span class="min-w-0 text-[10px] font-semibold text-[#2C1810]">BNI Virtual Account</span>
                            </label>
                        </div>

                        {{-- COD --}}
                        <div class="mb-2 flex flex-wrap items-center gap-2">
                            <h3 class="text-[9px] font-bold uppercase tracking-wide text-[#2E7D32]">COD (Bayar di Tempat)</h3>
                            <span class="rounded bg-[#e8f2e2] px-1.5 py-0.5 text-[7px] font-medium text-[#2E7D32]">Rekomendasi Nyaman</span>
                        </div>
                        <label class="mb-4 flex cursor-pointer items-center gap-2.5 rounded-lg border border-[#e5dccb] bg-white p-2.5 transition has-[:checked]:border-[#8B1E1E] has-[:checked]:bg-[#fff8f6]">
                            <input type="radio" name="metode_pembayaran" value="cod" class="h-3.5 w-3.5 accent-[#8B1E1E]" onchange="updateMetodeTerpilih('cod')">
                            <span class="flex h-6 w-8 shrink-0 items-center justify-center rounded bg-[#edf6e9] text-[#2E7D32]">
                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h13v10H3zM16 10h3l2 3v4h-5zM7 20a2 2 0 100-4 2 2 0 000 4zm10 0a2 2 0 100-4 2 2 0 000 4z" />
                                </svg>
                            </span>
                            <span class="text-[10px] font-semibold text-[#2C1810]">COD (Bayar Tunai saat Kurir Tiba)</span>
                        </label>

                        {{-- E-Wallet --}}
                        <div class="mb-2 flex flex-wrap items-center gap-2">
                            <h3 class="text-[9px] font-bold uppercase tracking-wide text-[#2E7D32]">E-Wallet Digital</h3>
                            <span class="rounded bg-[#f5f0e5] px-1.5 py-0.5 text-[7px] text-[#796d5d]">Scan QRIS / Direct</span>
                        </div>
                        <div class="grid grid-cols-1 gap-2 sm:grid-cols-3">
                            <label class="flex cursor-pointer items-center gap-2.5 rounded-lg border border-[#e5dccb] bg-white p-2.5 transition has-[:checked]:border-[#8B1E1E] has-[:checked]:bg-[#fff8f6]">
                                <input type="radio" name="metode_pembayaran" value="gopay" class="h-3.5 w-3.5 accent-[#8B1E1E]" onchange="updateMetodeTerpilih(this.value)">
                                <span class="flex h-6 w-8 shrink-0 items-center justify-center rounded bg-[#e8f6ff] text-[7px] font-bold text-[#0788c7]">GP</span>
                                <span class="text-[10px] font-semibold text-[#2C1810]">GoPay</span>
                            </label>
                            <label class="flex cursor-pointer items-center gap-2.5 rounded-lg border border-[#e5dccb] bg-white p-2.5 transition has-[:checked]:border-[#8B1E1E] has-[:checked]:bg-[#fff8f6]">
                                <input type="radio" name="metode_pembayaran" value="dana" class="h-3.5 w-3.5 accent-[#8B1E1E]" onchange="updateMetodeTerpilih(this.value)">
                                <span class="flex h-6 w-8 shrink-0 items-center justify-center rounded bg-[#e8f3ff] text-[7px] font-bold text-[#1681d5]">DN</span>
                                <span class="text-[10px] font-semibold text-[#2C1810]">DANA</span>
                            </label>
                            <label class="flex cursor-not-allowed items-center gap-2.5 rounded-lg border border-[#e5dccb] bg-white p-2.5 opacity-60" title="Belum tersedia">
                                <input type="radio" name="metode_pembayaran" value="ovo" disabled class="h-3.5 w-3.5 accent-[#8B1E1E]">
                                <span class="flex h-6 w-8 shrink-0 items-center justify-center rounded bg-[#f1effb] text-[7px] font-bold text-[#5745a7]">OVO</span>
                                <span class="text-[10px] font-semibold text-[#2C1810]">OVO</span>
                            </label>
                        </div>
                    </section>

                    @if ($keranjang->count() > 0)
                        </form>
                    @endif
                </div>

                {{-- ================= KOLOM KANAN: RINGKASAN (statis, tidak ikut scroll) ================= --}}
                <aside class="min-w-0">
                    <section class="rounded-xl border border-[#e8dfcf] bg-[#fffdf7] p-4 shadow-sm sm:p-5">
                        <div class="mb-4 flex items-center justify-between">
                            <h2 class="font-serif text-base font-bold text-[#2C1810] sm:text-lg">Ringkasan Belanja</h2>
                            <svg class="h-4 w-4 text-[#8B1E1E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5m1.6 8l-1.2 2.2a1 1 0 00.9 1.5H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>

                        <div class="space-y-2.5 border-b border-[#eee8dc] pb-3 text-[10px] sm:text-xs">
                            <div class="flex justify-between gap-2">
                                <span class="text-[#796d5d]">Total Harga (<span id="summary-quantity">{{ $totalItem }}</span> Item)</span>
                                <span id="summary-product-total" class="font-semibold text-[#2C1810]">Rp {{ number_format($totalHarga, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between gap-2">
                                <span class="text-[#796d5d]">Biaya Pengiriman (Jawa Timur)</span>
                                <span class="font-semibold text-[#2C1810]">Rp {{ number_format($ongkir, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between gap-2">
                                <span class="text-[#796d5d]">Biaya Layanan &amp; Penanganan <span title="Biaya pengemasan kayu & sertifikasi batch" class="text-[#a99c8b]">ⓘ</span></span>
                                <span class="font-semibold text-[#2C1810]">Rp {{ number_format($packaging, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        {{-- Metode terpilih --}}
                        <div class="mt-3 flex items-center justify-between gap-2 rounded-lg border border-[#e5dccb] bg-[#faf7ed] px-3 py-2.5">
                            <div class="min-w-0">
                                <p class="text-[8px] font-semibold uppercase tracking-wide text-[#796d5d]">Metode Pembayaran</p>
                                <p id="metode-terpilih" class="truncate text-[10px] font-semibold text-[#2C1810]">BCA Virtual Account</p>
                            </div>
                            <span id="badge-verifikasi" class="shrink-0 rounded-full bg-[#e8f2e2] px-2 py-0.5 text-[8px] font-semibold text-[#2E7D32]">Terverifikasi</span>
                        </div>

                        {{-- Potensi poin --}}
                        <div class="mt-3 flex items-center gap-2.5 rounded-lg border border-[#d6e8d0] bg-[#edf6e9] px-3 py-2.5">
                            <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-[#d7ebcf] text-[#2E7D32]">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v8m-4-4h8m5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </span>
                            <div class="min-w-0 flex-1">
                                <p class="text-[9px] font-semibold text-[#276236]">Potensi Poin Didapat</p>
                                <p id="summary-poin" class="text-[8px] text-[#47784a]">+{{ number_format(floor($totalHarga / 10000)) }} Poin NusaCandle</p>
                            </div>
                            <a href="{{ route('poin.index') }}" class="shrink-0 text-[9px] font-semibold text-[#2E7D32] underline underline-offset-2">Detail</a>
                        </div>

                        {{-- Total --}}
                        <div class="mt-4 border-t border-[#eee8dc] pt-3">
                            <div class="flex items-start justify-between gap-2">
                                <div>
                                    <p class="text-[10px] font-semibold text-[#2C1810] sm:text-xs">Total Pembayaran</p>
                                    <p class="text-[8px] text-[#796d5d]">Termasuk PPN &amp; Sertifikat Batch</p>
                                </div>
                                <p id="summary-grand-total" class="font-serif text-xl font-bold text-[#8B1E1E] sm:text-2xl">
                                    Rp {{ number_format($totalBelanja, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>

                        <button type="submit" form="checkout-form" {{ $keranjang->count() === 0 ? 'disabled' : '' }}
                            class="mt-4 flex w-full items-center justify-center gap-2 rounded-md bg-[#b83232] px-4 py-3 text-[10px] font-semibold text-white transition hover:bg-[#8B1E1E] disabled:cursor-not-allowed disabled:opacity-50 sm:text-xs">
                            Lanjutkan Pembayaran
                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7-7l7 7-7 7" />
                            </svg>
                        </button>

                        <a href="{{ route('produk.index') }}" class="mt-3 flex w-full items-center justify-center gap-1 text-[9px] font-semibold text-[#47784a] transition hover:text-[#2E7D32] sm:text-[10px]">
                            <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m7 7l-7-7 7-7" />
                            </svg>
                            Lanjut Belanja
                        </a>
                    </section>
                </aside>
            </div>
        </div>
    </div>

    <script>
        const ONGKIR = {{ $ongkir }};
        const PACKAGING = {{ $packaging }};
        const namaMetode = {
            bca: 'BCA Virtual Account', mandiri: 'Mandiri Virtual Account',
            bri: 'BRI Virtual Account', bni: 'BNI Virtual Account',
            gopay: 'GoPay', dana: 'DANA', ovo: 'OVO',
            shopeepay: 'ShopeePay', cod: 'COD (Bayar di Tempat)'
        };

        function toggleSelectAll(source) {
            document.querySelectorAll('input[name="selected[]"]').forEach(cb => cb.checked = source.checked);
            updateRingkasanBelanja();
        }

        function syncSelectAll() {
            const boxes = document.querySelectorAll('input[name="selected[]"]');
            const all = document.getElementById('select-all');
            if (all && boxes.length > 0) {
                all.checked = Array.from(boxes).every(cb => cb.checked);
            }
            updateRingkasanBelanja();
        }

        function updateMetodeTerpilih(value) {
            document.getElementById('metode-terpilih').textContent = namaMetode[value] || value;
            document.getElementById('badge-verifikasi').classList.remove('hidden');
        }

        function updateRingkasanBelanja() {
            const checkboxes = document.querySelectorAll('input[name="selected[]"]');
            if (checkboxes.length === 0) return;

            let totalQty = 0, subtotal = 0;

            checkboxes.forEach(cb => {
                const article = cb.closest('article');
                if (!article) return;
                const harga = parseInt(article.dataset.harga) || 0;
                const qty = parseInt(article.dataset.jumlah) || 0;
                const subEl = article.querySelector('[data-subtotal]');

                if (cb.checked) {
                    totalQty += qty;
                    subtotal += harga * qty;
                    if (subEl) {
                        subEl.textContent = 'Rp ' + (harga * qty).toLocaleString('id-ID');
                        subEl.classList.remove('text-gray-400', 'line-through');
                        subEl.classList.add('text-[#8B1E1E]');
                    }
                } else if (subEl) {
                    subEl.textContent = 'Rp 0';
                    subEl.classList.add('text-gray-400', 'line-through');
                    subEl.classList.remove('text-[#8B1E1E]');
                }
            });

            const total = totalQty > 0 ? subtotal + ONGKIR + PACKAGING : 0;

            document.getElementById('summary-quantity').textContent = totalQty;
            document.getElementById('summary-product-total').textContent = 'Rp ' + subtotal.toLocaleString('id-ID');
            document.getElementById('summary-grand-total').textContent = 'Rp ' + total.toLocaleString('id-ID');
            document.getElementById('summary-poin').textContent = '+' + Math.floor(subtotal / 10000) + ' Poin NusaCandle';

            const btn = document.querySelector('button[form="checkout-form"]');
            if (btn) btn.disabled = totalQty === 0;
        }

        document.addEventListener('DOMContentLoaded', function () {
            const all = document.getElementById('select-all');
            if (all) all.checked = true;
            document.querySelectorAll('input[name="selected[]"]').forEach(cb => cb.checked = true);
            updateRingkasanBelanja();

            document.querySelectorAll('input[name="selected[]"]').forEach(cb => {
                cb.addEventListener('change', updateRingkasanBelanja);
            });
        });

        function updateQty(id, qty) {
            if (qty < 1) return;
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/keranjang/${id}`;
            const fields = { _token: document.querySelector('meta[name="csrf-token"]').content, _method: 'PUT', jumlah: qty };
            Object.entries(fields).forEach(([name, value]) => {
                const input = document.createElement('input');
                input.type = 'hidden'; input.name = name; input.value = value;
                form.appendChild(input);
            });
            document.body.appendChild(form);
            form.submit();
        }
    </script>
@endsection