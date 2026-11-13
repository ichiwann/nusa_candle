@extends('layouts.pembeli')

@section('title', 'Keranjang Belanja Anda - NusaCandle')

@section('content')
    <style>
        body > nav {
            background-color: #faf7ed !important;
            border-top: 3px solid #8b1e1e;
            box-shadow: none !important;
        }

        body > main {
            background-color: #faf7ed;
        }

        body > footer {
            background-color: #f5f0e2 !important;
            border-top-color: #e8dfcd !important;
        }
    </style>

    <div class="bg-[#faf7ed]">
        <div class="mx-auto max-w-7xl px-4 pb-10 pt-2 sm:px-6 lg:px-8">
            <nav aria-label="Jejak halaman" class="mb-5 flex items-center gap-2 text-[10px] text-[#796d5d] sm:text-xs">
                <a href="{{ route('home') }}" class="transition hover:text-[#8B1E1E]">Beranda</a>
                <span>/</span>
                <span class="font-semibold text-[#8B1E1E]">Keranjang Belanja Anda</span>
            </nav>

            <header class="mb-6">
                <p class="mb-1 flex items-center gap-2 text-[9px] font-semibold uppercase tracking-[0.16em] text-[#2E7D32] sm:text-[10px]">
                    <span aria-hidden="true">✦</span>
                    Perajin Lilin Alami Malang
                </p>
                <h1 class="mb-1 font-serif text-2xl font-bold leading-tight text-[#8B1E1E] sm:text-3xl">Keranjang Belanja Anda</h1>
                <p class="text-[10px] text-[#796d5d] sm:text-xs">
                    Periksa kembali pilihan lilin aromaterapi apel Malang sebelum melanjutkan pemesanan.
                </p>
            </header>

            @if (session('success'))
                <div class="mb-4 rounded-lg border border-[#cfe3c7] bg-[#edf6e9] px-4 py-3 text-xs text-[#276236]" role="status">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 rounded-lg border border-[#edcaca] bg-[#fff1f1] px-4 py-3 text-xs text-[#8B1E1E]" role="alert">
                    <ul class="list-inside list-disc space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 items-start gap-5 lg:grid-cols-[minmax(0,1.9fr)_minmax(290px,0.9fr)] lg:gap-6">
                <div class="min-w-0 space-y-5">
                    <section class="rounded-xl border border-[#e8dfcf] bg-[#fffefa] p-3 shadow-sm sm:p-5">
                        <div class="mb-4 flex flex-wrap items-center justify-between gap-3 border-b border-[#eee8dc] pb-3">
                            <div class="flex items-center gap-2">
                                <span class="flex h-4 w-4 items-center justify-center rounded border border-[#c9bda9] bg-white" aria-hidden="true"></span>
                                <h2 id="cart-product-count" class="text-[10px] font-semibold text-[#2C1810] sm:text-xs">
                                    Pilih Semua (<span data-cart-quantity>{{ $totalItem }}</span> Produk)
                                </h2>
                            </div>
                            @if ($keranjang->count() > 0)
                                <form action="{{ route('keranjang.clear') }}" method="POST"
                                    onsubmit="return confirm('Kosongkan semua keranjang?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-[9px] font-semibold text-[#8B1E1E] transition hover:text-[#6B1515] sm:text-[10px]">
                                        Hapus Semua
                                    </button>
                                </form>
                            @endif
                            <button id="demo-cart-clear" type="button" hidden
                                class="text-[9px] font-semibold text-[#8B1E1E] transition hover:text-[#6B1515] sm:text-[10px]">
                                Hapus Semua
                            </button>
                        </div>

                        @forelse ($keranjang as $item)
                            <article class="border-b border-[#eee8dc] py-3 last:border-0 last:pb-0">
                                <div class="flex flex-col gap-3 sm:flex-row">
                                    <div class="h-20 w-20 shrink-0 overflow-hidden rounded-lg border border-[#eee5d7] bg-[#f3eddf] sm:h-24 sm:w-24">
                                        @if ($item->produk->gambar)
                                            <img src="{{ asset('storage/' . $item->produk->gambar) }}"
                                                alt="{{ $item->produk->nama_produk }}" class="h-full w-full object-cover">
                                        @else
                                            <div class="flex h-full w-full items-center justify-center bg-gradient-to-br from-[#e7decb] to-[#cbb99d]">
                                                <svg class="h-12 w-12" viewBox="0 0 64 64" role="img" aria-label="Lilin aromaterapi">
                                                    <ellipse cx="32" cy="55" rx="21" ry="4" fill="#604a35" opacity=".22" />
                                                    <path d="M32 6c-7 10-5 15 0 18 5-3 7-8 0-18z" fill="#e99b43" />
                                                    <path d="M32 11c-3 5-2 8 0 10 2-2 3-5 0-10z" fill="#fff1bc" />
                                                    <rect x="14" y="23" width="36" height="31" rx="7" fill="#536044" stroke="#ded2b6" stroke-width="2" />
                                                    <ellipse cx="32" cy="24" rx="17" ry="4" fill="#e9dfc9" />
                                                    <rect x="19" y="34" width="26" height="11" rx="2" fill="#e9dfc9" />
                                                    <path d="M23 38h18" stroke="#8b7658" stroke-width="1.5" />
                                                </svg>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="min-w-0 flex-1">
                                        <div class="flex items-start justify-between gap-2">
                                            <div class="min-w-0">
                                                <div class="mb-1 flex flex-wrap items-center gap-1.5">
                                                    <span class="rounded-full bg-[#f8e6e5] px-2 py-0.5 text-[8px] font-semibold text-[#8B1E1E]">Khas Malang</span>
                                                    <span class="rounded-full bg-[#e8f2e2] px-2 py-0.5 text-[8px] font-semibold text-[#2E7D32]">Stok Tersedia</span>
                                                </div>
                                                <h3 class="font-serif text-[11px] font-bold leading-snug text-[#2C1810] sm:text-sm">
                                                    {{ $item->produk->nama_produk }}
                                                </h3>
                                                <p class="mt-1 text-[8px] text-[#796d5d] sm:text-[10px]">Varian: Apel Manalagi 220 g • Mutu C1</p>
                                            </div>

                                            <form action="{{ route('keranjang.destroy', $item->id_keranjang) }}" method="POST"
                                                onsubmit="return confirm('Hapus produk ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" aria-label="Hapus {{ $item->produk->nama_produk }}"
                                                    class="rounded p-1 text-[#a99c8b] transition hover:bg-[#faeeee] hover:text-[#8B1E1E]">
                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>

                                        <div class="mt-3 flex flex-wrap items-end justify-between gap-3">
                                            <div>
                                                <p class="mb-0.5 text-[8px] text-[#796d5d] sm:text-[9px]">Harga Satuan</p>
                                                <p class="text-[10px] font-semibold text-[#2C1810] sm:text-xs">
                                                    Rp {{ number_format($item->produk->harga, 0, ',', '.') }}
                                                </p>
                                            </div>

                                            <form action="{{ route('keranjang.update', $item->id_keranjang) }}" method="POST"
                                                class="flex items-center gap-1.5">
                                                @csrf
                                                @method('PUT')
                                                <button type="button"
                                                    onclick="updateQty({{ $item->id_keranjang }}, {{ $item->jumlah - 1 }})"
                                                    aria-label="Kurangi jumlah"
                                                    class="flex h-7 w-7 items-center justify-center rounded border border-[#e5dccb] bg-white text-sm text-[#796d5d] transition hover:bg-[#f5f0e5] disabled:cursor-not-allowed disabled:opacity-40"
                                                    {{ $item->jumlah <= 1 ? 'disabled' : '' }}>−</button>
                                                <input type="number" name="jumlah" value="{{ $item->jumlah }}" min="1"
                                                    max="{{ $item->produk->stok }}" aria-label="Jumlah produk"
                                                    class="h-7 w-9 rounded border border-[#e5dccb] bg-white text-center text-[10px] font-semibold text-[#2C1810]"
                                                    onchange="this.form.submit()">
                                                <button type="button"
                                                    onclick="updateQty({{ $item->id_keranjang }}, {{ $item->jumlah + 1 }})"
                                                    aria-label="Tambah jumlah"
                                                    class="flex h-7 w-7 items-center justify-center rounded border border-[#e5dccb] bg-white text-sm text-[#796d5d] transition hover:bg-[#f5f0e5] disabled:cursor-not-allowed disabled:opacity-40"
                                                    {{ $item->jumlah >= $item->produk->stok ? 'disabled' : '' }}>+</button>
                                            </form>

                                            <div class="text-right">
                                                <p class="mb-0.5 text-[8px] text-[#796d5d] sm:text-[9px]">Subtotal</p>
                                                <p class="text-[11px] font-bold text-[#8B1E1E] sm:text-sm">
                                                    Rp {{ number_format($item->produk->harga * $item->jumlah, 0, ',', '.') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @empty
                            <div id="cart-empty-state" class="py-10 text-center">
                                <svg class="mx-auto mb-3 h-14 w-14 text-[#b8aa96]" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5m1.6 8l-1.2 2.2a1 1 0 00.9 1.5H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                <p class="mb-1 font-serif text-base font-bold text-[#2C1810]">Keranjang Anda Kosong</p>
                                <p class="mb-4 text-xs text-[#796d5d]">Mulai belanja untuk menambahkan produk ke keranjang.</p>
                                <a href="{{ route('produk.index') }}"
                                    class="inline-flex items-center rounded-md bg-[#8B1E1E] px-5 py-2.5 text-xs font-semibold text-white transition hover:bg-[#6B1515]">
                                    Belanja Sekarang
                                </a>
                            </div>
                        @endforelse

                        <div id="demo-cart-items" class="hidden"></div>
                        <p id="demo-cart-notice" hidden
                            class="mt-3 rounded-lg border border-[#e8dfcf] bg-[#f5f0e5] px-3 py-2 text-[9px] leading-relaxed text-[#796d5d]">
                            Ini keranjang pratinjau. Produk demo tersimpan hanya di browser ini dan belum dapat dipesan.
                        </p>

                        <template id="demo-cart-item-template">
                            <article class="border-b border-[#eee8dc] py-3 last:border-0 last:pb-0" data-demo-cart-item>
                                <div class="flex flex-col gap-3 sm:flex-row">
                                    <div class="flex h-20 w-20 shrink-0 items-center justify-center overflow-hidden rounded-lg border border-[#eee5d7] bg-gradient-to-br from-[#e7decb] to-[#cbb99d] sm:h-24 sm:w-24">
                                        <svg class="h-12 w-12" viewBox="0 0 64 64" aria-hidden="true">
                                            <ellipse cx="32" cy="55" rx="21" ry="4" fill="#604a35" opacity=".22" />
                                            <path d="M32 6c-7 10-5 15 0 18 5-3 7-8 0-18z" fill="#e99b43" />
                                            <path d="M32 11c-3 5-2 8 0 10 2-2 3-5 0-10z" fill="#fff1bc" />
                                            <rect x="14" y="23" width="36" height="31" rx="7" fill="#536044" stroke="#ded2b6" stroke-width="2" />
                                            <ellipse cx="32" cy="24" rx="17" ry="4" fill="#e9dfc9" />
                                            <rect x="19" y="34" width="26" height="11" rx="2" fill="#e9dfc9" />
                                            <path d="M23 38h18" stroke="#8b7658" stroke-width="1.5" />
                                        </svg>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <div class="flex items-start justify-between gap-2">
                                            <div class="min-w-0">
                                                <span class="mb-1 inline-flex rounded-full bg-[#f8e6e5] px-2 py-0.5 text-[8px] font-semibold text-[#8B1E1E]">Khas Malang</span>
                                                <h3 data-demo-name class="font-serif text-[11px] font-bold leading-snug text-[#2C1810] sm:text-sm"></h3>
                                                <p class="mt-1 text-[8px] text-[#796d5d] sm:text-[10px]">Produk pratinjau • Aroma apel</p>
                                            </div>
                                            <button type="button" data-demo-remove aria-label="Hapus produk demo"
                                                class="rounded p-1 text-[#a99c8b] transition hover:bg-[#faeeee] hover:text-[#8B1E1E]">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="mt-3 flex flex-wrap items-end justify-between gap-3">
                                            <div>
                                                <p class="mb-0.5 text-[8px] text-[#796d5d] sm:text-[9px]">Harga Satuan</p>
                                                <p data-demo-price class="text-[10px] font-semibold text-[#2C1810] sm:text-xs"></p>
                                            </div>
                                            <div class="flex items-center gap-1.5">
                                                <button type="button" data-demo-quantity-minus aria-label="Kurangi jumlah"
                                                    class="flex h-7 w-7 items-center justify-center rounded border border-[#e5dccb] bg-white text-sm text-[#796d5d]">−</button>
                                                <span data-demo-quantity class="min-w-6 text-center text-[10px] font-semibold text-[#2C1810]"></span>
                                                <button type="button" data-demo-quantity-plus aria-label="Tambah jumlah"
                                                    class="flex h-7 w-7 items-center justify-center rounded border border-[#e5dccb] bg-white text-sm text-[#796d5d]">+</button>
                                            </div>
                                            <div class="text-right">
                                                <p class="mb-0.5 text-[8px] text-[#796d5d] sm:text-[9px]">Subtotal</p>
                                                <p data-demo-subtotal class="text-[11px] font-bold text-[#8B1E1E] sm:text-sm"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </template>
                    </section>

                    @if ($keranjang->count() > 0)
                        <form id="checkout-form" action="{{ route('pembeli.checkout.store') }}" method="POST">
                            @csrf
                    @else
                        <div id="demo-payment-preview" hidden>
                    @endif
                            <section class="rounded-xl border border-[#e8dfcf] bg-[#fffefa] p-3 shadow-sm sm:p-5">
                                <div class="mb-4 flex items-center justify-between gap-3 border-b border-[#eee8dc] pb-3">
                                    <div class="flex items-center gap-2">
                                        <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-[#f8e6e5] text-[#8B1E1E]" aria-hidden="true">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 7h18M5 7l1 13h12l1-13M9 7V5a3 3 0 016 0v2" />
                                            </svg>
                                        </span>
                                        <div>
                                            <h2 class="font-serif text-sm font-bold text-[#2C1810] sm:text-base">Pilih Metode Pembayaran</h2>
                                            <p class="text-[8px] text-[#796d5d] sm:text-[9px]">Pilih cara pembayaran pesanan Anda.</p>
                                        </div>
                                    </div>
                                    <span class="shrink-0 rounded-full bg-[#e8f2e2] px-2 py-1 text-[8px] font-semibold text-[#2E7D32] sm:text-[9px]">Aman 100%</span>
                                </div>

                                <div class="mb-2 flex items-center justify-between gap-2">
                                    <h3 class="text-[9px] font-bold uppercase tracking-wide text-[#2E7D32]">Transfer Bank / Virtual Account</h3>
                                    <span class="rounded bg-[#f5f0e5] px-2 py-0.5 text-[7px] text-[#796d5d]">Verifikasi otomatis</span>
                                </div>

                                <div class="mb-3 grid grid-cols-1 gap-1.5 sm:grid-cols-2">
                                    <label class="flex cursor-pointer items-center gap-2 rounded-lg border border-[#e5dccb] bg-white p-2 transition hover:border-[#8B1E1E] has-[:checked]:border-[#8B1E1E] has-[:checked]:bg-[#fff8f6]">
                                        <input type="radio" name="metode_pembayaran" value="bca"
                                            {{ $keranjang->count() > 0 ? 'required' : '' }}
                                            class="h-3 w-3 accent-[#8B1E1E]" onchange="showRekening('bca')">
                                        <span class="flex h-6 w-8 items-center justify-center rounded bg-[#edf3ff] text-[8px] font-bold text-[#17549b]">BCA</span>
                                        <span class="min-w-0 flex-1">
                                            <span class="block text-[8px] font-semibold text-[#2C1810]">BCA Virtual Account</span>
                                            <span class="block text-[7px] text-[#796d5d]">Verifikasi otomatis</span>
                                        </span>
                                    </label>

                                    <label class="flex cursor-pointer items-center gap-2 rounded-lg border border-[#e5dccb] bg-white p-2 transition hover:border-[#8B1E1E] has-[:checked]:border-[#8B1E1E] has-[:checked]:bg-[#fff8f6]">
                                        <input type="radio" name="metode_pembayaran" value="mandiri"
                                            class="h-3 w-3 accent-[#8B1E1E]" onchange="showRekening('mandiri')">
                                        <span class="flex h-6 w-8 items-center justify-center rounded bg-[#fff3df] text-[7px] font-bold text-[#8a5a16]">MANDIRI</span>
                                        <span class="min-w-0 flex-1">
                                            <span class="block text-[8px] font-semibold text-[#2C1810]">Mandiri Virtual Account</span>
                                            <span class="block text-[7px] text-[#796d5d]">Livin' & ATM Mandiri</span>
                                        </span>
                                    </label>

                                    <label title="{{ $keranjang->count() > 0 ? 'Belum tersedia untuk checkout nyata' : 'Pilih metode pembayaran demo' }}"
                                        class="flex items-center gap-2 rounded-lg border border-[#e5dccb] bg-white p-2 transition hover:border-[#8B1E1E] has-[:checked]:border-[#8B1E1E] has-[:checked]:bg-[#fff8f6] {{ $keranjang->count() > 0 ? 'cursor-not-allowed opacity-60' : 'cursor-pointer' }}">
                                        <input type="radio" name="metode_pembayaran" value="bri"
                                            {{ $keranjang->count() > 0 ? 'disabled' : '' }}
                                            aria-label="BRI Virtual Account"
                                            onchange="showRekening('bri')"
                                            class="h-3 w-3 accent-[#8B1E1E]">
                                        <span class="flex h-6 w-8 items-center justify-center rounded bg-[#fff0e8] text-[8px] font-bold text-[#c33b35]">BRI</span>
                                        <span class="min-w-0 flex-1">
                                            <span class="block text-[8px] font-semibold text-[#2C1810]">BRI Virtual Account</span>
                                            <span class="block text-[7px] text-[#796d5d]">{{ $keranjang->count() > 0 ? 'Belum tersedia' : 'Pratinjau' }}</span>
                                        </span>
                                    </label>

                                    <label title="{{ $keranjang->count() > 0 ? 'Belum tersedia untuk checkout nyata' : 'Pilih metode pembayaran demo' }}"
                                        class="flex items-center gap-2 rounded-lg border border-[#e5dccb] bg-white p-2 transition hover:border-[#8B1E1E] has-[:checked]:border-[#8B1E1E] has-[:checked]:bg-[#fff8f6] {{ $keranjang->count() > 0 ? 'cursor-not-allowed opacity-60' : 'cursor-pointer' }}">
                                        <input type="radio" name="metode_pembayaran" value="bni"
                                            {{ $keranjang->count() > 0 ? 'disabled' : '' }}
                                            aria-label="BNI Virtual Account"
                                            onchange="showRekening('bni')"
                                            class="h-3 w-3 accent-[#8B1E1E]">
                                        <span class="flex h-6 w-8 items-center justify-center rounded bg-[#fff5e5] text-[8px] font-bold text-[#e37d22]">BNI</span>
                                        <span class="min-w-0 flex-1">
                                            <span class="block text-[8px] font-semibold text-[#2C1810]">BNI Virtual Account</span>
                                            <span class="block text-[7px] text-[#796d5d]">{{ $keranjang->count() > 0 ? 'Belum tersedia' : 'Pratinjau' }}</span>
                                        </span>
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <div class="mb-1.5 flex flex-wrap items-center gap-1.5">
                                        <h3 class="text-[9px] font-bold uppercase tracking-wide text-[#2E7D32]">COD (Bayar di Tempat)</h3>
                                        <span class="rounded bg-[#e8f2e2] px-1.5 py-0.5 text-[7px] font-medium text-[#2E7D32]">Rekomendasi Nyaman</span>
                                    </div>
                                    <label class="flex cursor-pointer items-center gap-2 rounded-lg border border-[#e5dccb] bg-white p-2 transition hover:border-[#8B1E1E] has-[:checked]:border-[#8B1E1E] has-[:checked]:bg-[#fff8f6]">
                                        <input type="radio" name="metode_pembayaran" value="cod"
                                            class="h-3 w-3 accent-[#8B1E1E]" onchange="showRekening('cod')">
                                        <span class="flex h-6 w-8 items-center justify-center rounded bg-[#edf6e9] text-[#2E7D32]" aria-hidden="true">
                                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 7h13v10H3zM16 10h3l2 3v4h-5zM7 20a2 2 0 100-4 2 2 0 000 4zm10 0a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </span>
                                        <span class="min-w-0 flex-1">
                                            <span class="block text-[8px] font-semibold text-[#2C1810]">Bayar saat pesanan diterima</span>
                                            <span class="block text-[7px] text-[#796d5d]">Garansi cek toples sebelum serah terima uang</span>
                                        </span>
                                    </label>
                                </div>

                                <div>
                                    <div class="mb-1.5 flex flex-wrap items-center gap-1.5">
                                        <h3 class="text-[9px] font-bold uppercase tracking-wide text-[#2E7D32]">E-Wallet Digital</h3>
                                        <span class="rounded bg-[#f5f0e5] px-1.5 py-0.5 text-[7px] text-[#796d5d]">Scan QRIS / Direct</span>
                                    </div>
                                    <div class="grid grid-cols-1 gap-1.5 sm:grid-cols-3">
                                        <label class="flex cursor-pointer items-center gap-2 rounded-lg border border-[#e5dccb] bg-white p-2 transition hover:border-[#8B1E1E] has-[:checked]:border-[#8B1E1E] has-[:checked]:bg-[#fff8f6]">
                                            <input type="radio" name="metode_pembayaran" value="gopay"
                                                class="h-3 w-3 accent-[#8B1E1E]" onchange="showRekening('gopay')">
                                            <span class="flex h-6 w-8 items-center justify-center rounded bg-[#e8f6ff] text-[7px] font-bold text-[#0788c7]">GOPAY</span>
                                            <span class="min-w-0">
                                                <span class="block text-[8px] font-semibold text-[#2C1810]">GoPay</span>
                                                <span class="block text-[7px] text-[#796d5d]">QRIS / Link</span>
                                            </span>
                                        </label>
                                        <label class="flex cursor-pointer items-center gap-2 rounded-lg border border-[#e5dccb] bg-white p-2 transition hover:border-[#8B1E1E] has-[:checked]:border-[#8B1E1E] has-[:checked]:bg-[#fff8f6]">
                                            <input type="radio" name="metode_pembayaran" value="dana"
                                                class="h-3 w-3 accent-[#8B1E1E]" onchange="showRekening('dana')">
                                            <span class="flex h-6 w-8 items-center justify-center rounded bg-[#e8f3ff] text-[7px] font-bold text-[#1681d5]">DANA</span>
                                            <span class="min-w-0">
                                                <span class="block text-[8px] font-semibold text-[#2C1810]">DANA</span>
                                                <span class="block text-[7px] text-[#796d5d]">QRIS / Saldo</span>
                                            </span>
                                        </label>
                                        <label title="{{ $keranjang->count() > 0 ? 'Belum tersedia untuk checkout nyata' : 'Pilih metode pembayaran demo' }}"
                                            class="flex items-center gap-2 rounded-lg border border-[#e5dccb] bg-white p-2 transition hover:border-[#8B1E1E] has-[:checked]:border-[#8B1E1E] has-[:checked]:bg-[#fff8f6] {{ $keranjang->count() > 0 ? 'cursor-not-allowed opacity-60' : 'cursor-pointer' }}">
                                            <input type="radio" name="metode_pembayaran" value="ovo"
                                                {{ $keranjang->count() > 0 ? 'disabled' : '' }}
                                                aria-label="OVO"
                                                onchange="showRekening('ovo')"
                                                class="h-3 w-3 accent-[#8B1E1E]">
                                            <span class="flex h-6 w-8 items-center justify-center rounded bg-[#f1effb] text-[7px] font-bold text-[#5745a7]">OVO</span>
                                            <span class="min-w-0">
                                                <span class="block text-[8px] font-semibold text-[#2C1810]">OVO</span>
                                                <span class="block text-[7px] text-[#796d5d]">{{ $keranjang->count() > 0 ? 'Belum tersedia' : 'Pratinjau' }}</span>
                                            </span>
                                        </label>
                                    </div>
                                </div>

                                <div id="rekening-info" class="mt-3 hidden rounded-lg border border-[#e5dccb] bg-[#faf7ed] p-3">
                                    <p id="label-rekening" class="mb-1 text-[8px] text-[#796d5d]">Nomor pembayaran</p>
                                    <div class="flex items-center justify-between gap-2">
                                        <p id="nomor-rekening" class="font-mono text-sm font-bold tracking-wide text-[#8B1E1E]"></p>
                                        <button type="button" onclick="copyRekening()"
                                            class="rounded bg-[#8B1E1E] px-3 py-1.5 text-[9px] font-semibold text-white transition hover:bg-[#6B1515]">Salin</button>
                                    </div>
                                    <p class="mt-1 text-[8px] text-[#796d5d]">Ikuti petunjuk pembayaran untuk melanjutkan pesanan.</p>
                                </div>
                            </section>
                    @if ($keranjang->count() > 0)
                        </form>
                    @else
                        </div>
                    @endif

                    <section class="flex items-start gap-3 rounded-xl border border-[#e8dfcf] bg-[#f5f0e5] p-3 sm:p-4">
                        <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-[#f8e6e5] text-[#8B1E1E]" aria-hidden="true">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 3v2m6.364.636l-1.414 1.414M21 12h-2M5 12H3m3.05-6.95l1.414 1.414M12 8a4 4 0 100 8 4 4 0 000-8zm0 8v5m-4-1h8" />
                            </svg>
                        </span>
                        <div>
                            <h2 class="mb-1 font-serif text-[10px] font-bold text-[#2C1810] sm:text-xs">Sentuhan Tangan Perajin Khas Apel</h2>
                            <p class="text-[8px] leading-relaxed text-[#796d5d] sm:text-[9px]">
                                Lilin Anda dibuat perlahan menggunakan minyak atsiri murni dari perkebunan lokal Batu.
                                Ramah lingkungan dan tidak meninggalkan jelaga hitam.
                            </p>
                        </div>
                    </section>
                </div>

                <aside class="min-w-0">
                    <section class="rounded-xl border border-[#e8dfcf] bg-[#fffefa] p-3 shadow-sm sm:sticky sm:top-24 sm:p-4">
                        <div class="mb-4 flex items-center justify-between gap-2">
                            <h2 class="font-serif text-sm font-bold text-[#2C1810] sm:text-base">Ringkasan Belanja</h2>
                            <svg class="h-4 w-4 text-[#8B1E1E]" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5m1.6 8l-1.2 2.2a1 1 0 00.9 1.5H17" />
                            </svg>
                        </div>

                        <div class="space-y-2.5 border-b border-[#eee8dc] pb-3">
                            <div class="flex justify-between gap-2 text-[9px] sm:text-[10px]">
                                <span class="text-[#796d5d]">Total Harga (<span id="summary-quantity">{{ $totalItem }}</span> item)</span>
                                <span id="summary-product-total" class="text-right font-semibold text-[#2C1810]">Rp {{ number_format($totalHarga, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between gap-2 text-[9px] sm:text-[10px]">
                                <span class="text-[#796d5d]">Ongkos Kirim (Malang & Sekitarnya)</span>
                                <span class="text-right font-semibold text-[#2C1810]">Rp {{ number_format($ongkir, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between gap-2 text-[9px] sm:text-[10px]">
                                <span class="text-[#796d5d]">Kemasan Kayu & Pelindung</span>
                                <span class="text-right font-semibold text-[#2C1810]">Rp {{ number_format($packaging, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between gap-2 text-[9px] sm:text-[10px]">
                                <span class="text-[#796d5d]">Potongan Harga</span>
                                <span class="text-right font-semibold text-[#2E7D32]">−Rp 0</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between gap-2 py-3">
                            <span class="text-[9px] text-[#796d5d] sm:text-[10px]">Metode Pembayaran</span>
                            <span id="metode-terpilih" class="text-right text-[8px] font-semibold text-[#2C1810] sm:text-[9px]">Pilih di bagian kiri</span>
                        </div>

                        <div class="mb-3 flex items-center gap-2 rounded-lg border border-[#d6e8d0] bg-[#edf6e9] p-2">
                            <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-[#d7ebcf] text-[#2E7D32]" aria-hidden="true">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v8m-4-4h8m5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </span>
                            <p class="text-[8px] leading-snug text-[#276236] sm:text-[9px]">
                                Poin loyalitas akan ditambahkan setelah pesanan berhasil.
                            </p>
                        </div>

                        <div class="mb-3 border-t border-[#eee8dc] pt-3">
                            <div class="flex items-start justify-between gap-2">
                                <span class="pt-1 text-[9px] text-[#796d5d] sm:text-[10px]">Total Belanja</span>
                                <div class="text-right">
                                    <p id="summary-grand-total" class="font-serif text-xl font-bold text-[#8B1E1E] sm:text-2xl">Rp {{ number_format($totalBelanja, 0, ',', '.') }}</p>
                                    <p class="text-[8px] text-[#796d5d]">Termasuk biaya lokal</p>
                                </div>
                            </div>
                        </div>

                        <button type="submit" form="checkout-form" {{ $keranjang->count() === 0 ? 'disabled' : '' }}
                            class="mb-2 flex w-full items-center justify-center gap-2 rounded-md bg-[#b83232] px-4 py-2.5 text-[10px] font-semibold text-white transition hover:bg-[#8B1E1E] disabled:cursor-not-allowed disabled:opacity-50 sm:text-xs">
                            Lanjutkan Pembayaran
                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7-7l7 7-7 7" />
                            </svg>
                        </button>
                        <p id="demo-checkout-note" hidden class="mb-2 text-center text-[8px] leading-relaxed text-[#796d5d]">
                            Checkout demo belum tersedia. Tambahkan produk nyata untuk membuat pesanan.
                        </p>

                        <a href="{{ route('produk.index') }}"
                            class="flex w-full items-center justify-center gap-1 py-1.5 text-[9px] font-medium text-[#47784a] transition hover:text-[#2E7D32] sm:text-[10px]">
                            <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m7 7l-7-7 7-7" />
                            </svg>
                            Lanjut Belanja
                        </a>

                        <div class="mt-3 grid grid-cols-2 gap-2 border-t border-[#eee8dc] pt-3">
                            <div class="flex items-center justify-center gap-1 rounded bg-[#f5f0e5] px-1.5 py-2 text-[8px] text-[#796d5d]">
                                <svg class="h-3 w-3 text-[#47784a]" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8" />
                                </svg>
                                Antar ke Alamat
                            </div>
                            <div class="flex items-center justify-center gap-1 rounded bg-[#f5f0e5] px-1.5 py-2 text-[8px] text-[#796d5d]">
                                <svg class="h-3 w-3 text-[#47784a]" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Pembayaran Aman
                            </div>
                        </div>
                    </section>
                </aside>
            </div>
        </div>
    </div>

    <script>
        (() => {
            const cartKey = 'nusacandle-demo-cart';
            const serverCartCount = {{ $keranjang->count() }};
            const emptyState = document.getElementById('cart-empty-state');
            const demoCartItems = document.getElementById('demo-cart-items');
            const demoCartTemplate = document.getElementById('demo-cart-item-template');
            const demoCartNotice = document.getElementById('demo-cart-notice');
            const demoPaymentPreview = document.getElementById('demo-payment-preview');
            const clearDemoCartButton = document.getElementById('demo-cart-clear');
            const checkoutNote = document.getElementById('demo-checkout-note');
            const shipping = {{ $ongkir }};
            const packaging = {{ $packaging }};

            if (serverCartCount > 0 || !emptyState || !demoCartItems || !demoCartTemplate) {
                return;
            }

            const formatPrice = (price) => `Rp ${price.toLocaleString('id-ID')}`;

            const readDemoCart = () => {
                const rawCart = localStorage.getItem(cartKey);
                const cart = rawCart ? JSON.parse(rawCart) : [];
                const validItem = (item) => item
                    && typeof item.id === 'string'
                    && typeof item.name === 'string'
                    && Number.isSafeInteger(item.price)
                    && item.price >= 0
                    && Number.isSafeInteger(item.quantity)
                    && item.quantity > 0;

                if (!Array.isArray(cart) || !cart.every(validItem)) {
                    throw new Error('Data keranjang demo tidak valid.');
                }

                return cart;
            };

            const renderDemoCart = (cart) => {
                demoCartItems.replaceChildren();
                let totalQuantity = 0;
                let productTotal = 0;

                cart.forEach((item) => {
                    const row = demoCartTemplate.content.firstElementChild.cloneNode(true);
                    row.dataset.demoId = item.id;
                    row.querySelector('[data-demo-name]').textContent = item.name;
                    row.querySelector('[data-demo-price]').textContent = formatPrice(item.price);
                    row.querySelector('[data-demo-quantity]').textContent = String(item.quantity);
                    row.querySelector('[data-demo-subtotal]').textContent = formatPrice(item.price * item.quantity);
                    demoCartItems.append(row);
                    totalQuantity += item.quantity;
                    productTotal += item.price * item.quantity;
                });

                const hasDemoItems = cart.length > 0;
                emptyState.hidden = hasDemoItems;
                demoCartItems.classList.toggle('hidden', !hasDemoItems);
                demoCartNotice.hidden = !hasDemoItems;
                demoPaymentPreview.hidden = !hasDemoItems;
                clearDemoCartButton.hidden = !hasDemoItems;
                checkoutNote.hidden = !hasDemoItems;
                document.querySelector('[data-cart-quantity]').textContent = String(totalQuantity);
                document.getElementById('summary-quantity').textContent = String(totalQuantity);
                document.getElementById('summary-product-total').textContent = formatPrice(productTotal);
                document.getElementById('summary-grand-total').textContent = formatPrice(productTotal + shipping + packaging);
                document.getElementById('metode-terpilih').textContent = hasDemoItems
                    ? 'Pilih metode di bawah (pratinjau)'
                    : 'Pilih di bagian kiri';
            };

            demoCartItems.addEventListener('click', (event) => {
                if (!(event.target instanceof Element)) {
                    return;
                }

                const button = event.target.closest('button');
                const itemRow = button?.closest('[data-demo-cart-item]');
                if (!button || !itemRow) {
                    return;
                }

                const cart = readDemoCart();
                const itemIndex = cart.findIndex((item) => item.id === itemRow.dataset.demoId);
                if (itemIndex === -1) {
                    return;
                }

                if (button.hasAttribute('data-demo-remove')) {
                    cart.splice(itemIndex, 1);
                } else if (button.hasAttribute('data-demo-quantity-plus')) {
                    cart[itemIndex].quantity += 1;
                } else if (button.hasAttribute('data-demo-quantity-minus')) {
                    cart[itemIndex].quantity = Math.max(1, cart[itemIndex].quantity - 1);
                } else {
                    return;
                }

                if (cart.length > 0) {
                    localStorage.setItem(cartKey, JSON.stringify(cart));
                } else {
                    localStorage.removeItem(cartKey);
                }
                renderDemoCart(cart);
            });

            clearDemoCartButton.addEventListener('click', () => {
                localStorage.removeItem(cartKey);
                renderDemoCart([]);
            });

            try {
                renderDemoCart(readDemoCart());
            } catch (error) {
                console.error('Keranjang pratinjau gagal dimuat.', error);
                alert('Keranjang demo tidak dapat dimuat dari penyimpanan browser.');
            }
        })();

        function updateQty(id, qty) {
            if (qty < 1) return;

            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/keranjang/${id}`;

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = csrfToken;
            form.appendChild(csrfInput);

            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'PUT';
            form.appendChild(methodInput);

            const qtyInput = document.createElement('input');
            qtyInput.type = 'hidden';
            qtyInput.name = 'jumlah';
            qtyInput.value = qty;
            form.appendChild(qtyInput);

            document.body.appendChild(form);
            form.submit();
        }

        const rekeningData = {
            bca: '8271 0812 3456 7890',
            mandiri: '130 00 1234567 8',
            cod: 'Bayar di tempat saat barang diterima',
            gopay: 'Lanjutkan pembayaran GoPay setelah pesanan dibuat.',
            dana: 'Lanjutkan pembayaran DANA setelah pesanan dibuat.',
            shopeepay: 'Lanjutkan pembayaran ShopeePay setelah pesanan dibuat.'
        };

        function showRekening(metode) {
            const infoDiv = document.getElementById('rekening-info');
            const nomorText = document.getElementById('nomor-rekening');
            const labelRekening = document.getElementById('label-rekening');
            const metodeTerpilih = document.getElementById('metode-terpilih');
            const namaMetode = {
                bca: 'BCA Virtual Account',
                mandiri: 'Mandiri Virtual Account',
                cod: 'Bayar di Tempat',
                gopay: 'GoPay',
                dana: 'DANA',
                shopeepay: 'ShopeePay',
                bri: 'BRI Virtual Account',
                bni: 'BNI Virtual Account',
                ovo: 'OVO'
            };

            const demoPaymentPreview = document.getElementById('demo-payment-preview');
            if (demoPaymentPreview && !demoPaymentPreview.hidden) {
                infoDiv.classList.add('hidden');
                metodeTerpilih.textContent = `${namaMetode[metode]} (pratinjau)`;
                return;
            }

            infoDiv.classList.remove('hidden');
            nomorText.textContent = rekeningData[metode];
            metodeTerpilih.textContent = namaMetode[metode];
            labelRekening.textContent = ['bca', 'mandiri'].includes(metode)
                ? 'Nomor pembayaran'
                : 'Petunjuk pembayaran';
        }

        function copyRekening() {
            const nomor = document.getElementById('nomor-rekening').textContent;
            navigator.clipboard.writeText(nomor).then(() => {
                alert('Nomor pembayaran berhasil disalin.');
            });
        }
    </script>
@endsection
