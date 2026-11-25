@extends('layouts.admin')

@section('title', 'Manajemen Produk')
@section('page_title', 'Manajemen Produk')

@section('content')
    <div
        class="-mx-4 -my-6 min-h-[calc(100vh_-_4rem)] bg-[#f7f4e9] px-4 py-6 sm:-mx-6 sm:-my-9 sm:px-6 sm:py-9 lg:-mx-8 lg:px-8 xl:-mx-12 xl:px-12">
        <div class="mb-5 flex flex-wrap items-end justify-between gap-6 border border-[#eee8dc] bg-white px-6 py-6 sm:px-7">
            <div class="max-w-2xl">
                <p class="flex items-center gap-1.5 text-[10px] font-semibold uppercase tracking-[0.12em] text-[#64835d]">
                    <span class="h-2.5 w-2.5 bg-[#b8292e]"></span>
                    Koleksi Signature Edition · 10 Seri Ilustrasi Malang
                </p>
                <h1 class="display-font mt-1.5 text-3xl font-semibold leading-tight text-[#231b17] sm:text-4xl">Manajemen
                    Produk</h1>
                <p class="mt-1.5 max-w-xl text-sm leading-relaxed text-[#71685a]">
                    Koleksi 10 desain kemasan gelas khas Malang — lilin aromaterapi aroma apel (Signature Edition).
                    Formulasi murni minyak atsiri apel Malang dengan sentuhan soy wax nabati dan kemasan gelas artistik.
                </p>
            </div>
            <button type="button" onclick="openTambahModal()"
                class="inline-flex min-h-14 min-w-44 items-center justify-center gap-3 bg-[#103a2a] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#315d41]">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"
                    aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Produk
            </button>
        </div>

        <section class="mb-5 grid gap-3 sm:grid-cols-3">
            <article class="min-h-[84px] border border-[#eee8dc] bg-white p-3">
                <div class="flex items-center justify-between gap-2">
                    <p class="text-[9px] font-semibold uppercase tracking-[0.08em] text-[#655c54]">Total Produk</p>
                    <svg class="h-4 w-4 text-[#3d7951]" fill="none" stroke="currentColor" stroke-width="1.8"
                        viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 3c-3 3-5 5.5-5 9a5 5 0 0010 0c0-3.5-2-6-5-9z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 14c.5 1.5 1.5 2 3 2" />
                    </svg>
                </div>
                <p class="mt-1 flex items-baseline gap-2 text-[#25211e]">
                    <span class="text-2xl font-bold leading-none">{{ number_format($totalProduk) }}</span>
                    <span class="text-[10px] font-semibold tracking-wide text-[#3d7951]">Desain</span>
                </p>
            </article>
            <article class="min-h-[84px] border border-[#eee8dc] bg-white p-3">
                <div class="flex items-center justify-between gap-2">
                    <p class="text-[9px] font-semibold uppercase tracking-[0.08em] text-[#655c54]">Stok Aroma Apel</p>
                    <svg class="h-4 w-4 text-[#3d7951]" fill="none" stroke="currentColor" stroke-width="1.8"
                        viewBox="0 0 24 24" aria-hidden="true">
                        <rect x="4" y="4" width="16" height="16" rx="1" />
                        <path stroke-linecap="round" d="M8 8h8M8 12h8M8 16h4" />
                    </svg>
                </div>
                <p class="mt-1 flex items-baseline gap-2 text-[#25211e]">
                    <span class="text-2xl font-bold leading-none">{{ number_format($totalStok) }}</span>
                    <span class="text-[10px] text-[#655c54]">Pcs Total</span>
                </p>
            </article>
            <article class="min-h-[84px] border border-[#eee8dc] bg-white p-3">
                <div class="flex items-center justify-between gap-2">
                    <p class="text-[9px] font-semibold uppercase tracking-[0.08em] text-[#655c54]">Produk Terjual</p>
                    <svg class="h-4 w-4 text-[#3d7951]" fill="none" stroke="currentColor" stroke-width="1.8"
                        viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 17l6-6 4 4 8-9" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 6h6v6" />
                    </svg>
                </div>
                <p class="mt-1 flex items-baseline gap-2 text-[#25211e]">
                    <span class="text-2xl font-bold leading-none">{{ number_format($produkTerjual) }}</span>
                    <span class="text-[10px] text-[#3d7951]">Pcs Terjual</span>
                </p>
            </article>
        </section>

        <form method="GET" action="{{ route('admin.products.index') }}"
            class="mb-4 flex flex-wrap items-center gap-3 border border-[#eee8dc] bg-white p-4">
            <div class="relative min-w-[260px] flex-1">
                <svg class="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-[#87948b]" fill="none"
                    stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari berdasarkan ID Produk atau Nama Desain Kemasan..."
                    class="w-full border border-[#e7e2d9] bg-[#fbfaf7] py-3 pl-10 pr-12 text-xs text-[#30483a] outline-none transition placeholder:text-[#9a9a8f] focus:border-[#64835d] focus:ring-1 focus:ring-[#64835d]/20">
                <button type="submit" aria-label="Cari produk"
                    class="absolute right-1 top-1/2 flex h-9 w-9 -translate-y-1/2 items-center justify-center bg-[#f0eee8] text-[#61584f] transition hover:bg-[#e8e4da]">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"
                        aria-hidden="true">
                        <circle cx="11" cy="11" r="7" />
                        <path stroke-linecap="round" d="m16 16 4 4" />
                    </svg>
                </button>
            </div>

            <label class="flex min-w-[190px] items-center border border-[#e7e2d9] bg-[#fbfaf7] px-3 py-3">
                <select name="theme" onchange="this.form.submit()" aria-label="Filter tema produk"
                    class="min-w-0 flex-1 border-0 bg-transparent py-0 pl-0 pr-6 text-xs font-semibold text-[#51483f] outline-none focus:ring-0">
                    <option value="" {{ request('theme') === null || request('theme') === '' ? 'selected' : '' }}>
                        Semua Tema Malang</option>
                    <option value="apel_malang" {{ request('theme') === 'apel_malang' ? 'selected' : '' }}>Apel Malang
                    </option>
                </select>
            </label>

            <label class="flex min-w-[170px] items-center border border-[#e7e2d9] bg-[#fbfaf7] px-3 py-3">
                <select name="stock_status" onchange="this.form.submit()" aria-label="Filter status stok"
                    class="min-w-0 flex-1 border-0 bg-transparent py-0 pl-0 pr-6 text-xs font-semibold text-[#51483f] outline-none focus:ring-0">
                    <option value=""
                        {{ request('stock_status') === null || request('stock_status') === '' ? 'selected' : '' }}>Semua
                        Status</option>
                    <option value="tersedia" {{ request('stock_status') === 'tersedia' ? 'selected' : '' }}>Stok Tersedia
                    </option>
                    <option value="habis" {{ request('stock_status') === 'habis' ? 'selected' : '' }}>Stok Habis</option>
                </select>
            </label>

            <div class="flex flex-1 items-center justify-end gap-3 border-l border-[#eee8dc] pl-4">
                <div class="text-right">
                    <p class="text-[9px] font-semibold uppercase tracking-[0.12em] text-[#8c8378]">Tampilan Aktif</p>
                    <p class="mt-1 whitespace-nowrap text-xs font-semibold text-[#51483f]">
                        {{ request()->filled('search') || request()->filled('theme') || request()->filled('stock_status') ? 'Hasil Filter' : 'Semua' }}
                        <span
                            class="ml-1 inline-flex min-w-7 items-center justify-center rounded-full bg-[#f3f0e9] px-2 py-1 text-[10px] text-[#61584f]">{{ number_format($produks->total()) }}
                            Produk</span>
                    </p>
                </div>
                <a href="{{ route('admin.products.index') }}"
                    class="inline-flex items-center gap-2 whitespace-nowrap border border-[#e7e2d9] px-3 py-3 text-[10px] font-semibold text-[#b8292e] transition hover:bg-[#fbf5f3]">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v6h6M5.5 15a7 7 0 101.7-7.3L4 10" />
                    </svg>
                    Reset Filter
                </a>
            </div>
        </form>

        <section class="overflow-hidden border border-[#eee8dc] bg-white">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[760px] text-left">
                    <thead
                        class="border-b border-[#eee8dc] bg-[#fbfaf7] text-[10px] font-semibold uppercase tracking-[0.1em] text-[#81786e]">
                        <tr>
                            <th class="px-5 py-4">ID Produk</th>
                            <th class="px-5 py-4">Nama Produk</th>
                            <th class="px-5 py-4">Stok</th>
                            <th class="px-5 py-4">Harga</th>
                            <th class="px-5 py-4">Gambar</th>
                            <th class="px-5 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#f0ede7]">
                        @forelse($produks as $produk)
                            <tr class="text-xs transition-colors hover:bg-[#fdfcf9]">
                                <td class="px-5 py-4">
                                    <span class="font-mono text-[11px] font-semibold text-[#625a51]">
                                        #{{ $produk->id_produk }}
                                    </span>
                                </td>
                                <td class="px-5 py-4">
                                    <p class="max-w-[320px] truncate text-xs font-semibold text-[#29241f]">
                                        {{ $produk->nama_produk }}</p>
                                </td>
                                <td class="px-5 py-4">
                                    <span class="font-semibold text-[#37312b]">{{ number_format($produk->stok) }}</span>
                                    <span class="ml-1 text-[10px] text-[#948b80]">Pcs</span>
                                </td>
                                <td class="px-5 py-4">
                                    <p class="whitespace-nowrap font-semibold text-[#37312b]">
                                        Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                    </p>
                                </td>
                                <td class="px-5 py-4">
                                    @if ($produk->gambar)
                                        <img src="{{ asset('storage/' . $produk->gambar) }}"
                                            alt="Gambar {{ $produk->nama_produk }}"
                                            class="h-10 w-10 border border-[#eee8dc] object-cover">
                                    @else
                                        <span
                                            class="flex h-10 w-10 items-center justify-center border border-[#eee8dc] bg-[#fbfaf7] text-[#a49b8f]"
                                            aria-label="Gambar belum tersedia">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.6"
                                                viewBox="0 0 24 24" aria-hidden="true">
                                                <rect x="3" y="4" width="18" height="16" rx="1" />
                                                <circle cx="8.5" cy="9" r="1.5" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m21 15-5-5L5 20" />
                                            </svg>
                                        </span>
                                    @endif
                                </td>
                                <td class="px-5 py-4">
                                    <div class="flex items-center justify-center gap-1.5">
                                        <button type="button" onclick='lihatProduk(@json($produk))'
                                            class="inline-flex h-8 w-8 items-center justify-center rounded-md border border-[#e7e2d9] bg-[#f5f1e7] text-[#61584f] transition hover:bg-[#ebe5d7] focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#a51f27]"
                                            aria-label="Lihat {{ $produk->nama_produk }}" title="Lihat produk">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8"
                                                viewBox="0 0 24 24" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                <circle cx="12" cy="12" r="3" />
                                            </svg>
                                        </button>
                                        <button type="button" onclick='editProduk(@json($produk))'
                                            class="inline-flex h-8 items-center gap-1.5 rounded-md bg-[#103a2a] px-2.5 text-[10px] font-semibold text-white transition hover:bg-[#315d41] focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#a51f27]"
                                            aria-label="Update {{ $produk->nama_produk }}" title="Update produk">
                                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor"
                                                stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16.862 4.487l2.651 2.651M8 16l8.862-8.862a1.875 1.875 0 112.652 2.652L10.65 18.65a4 4 0 01-1.697 1.01L6 20l.34-2.953A4 4 0 018 16z" />
                                            </svg>
                                            Update
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-5 py-14 text-center">
                                    <p class="text-sm font-semibold text-[#51483f]">Tidak ada produk ditemukan</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($produks->hasPages())
                <div class="flex items-center justify-between border-t border-[#eee8dc] px-5 py-4">
                    <p class="text-xs text-[#718078]">
                        Menampilkan {{ $produks->firstItem() }}-{{ $produks->lastItem() }} dari {{ $produks->total() }}
                        produk
                    </p>
                    <!-- Link Pagination Laravel -->
                    <div class="flex items-center gap-1">
                        {{ $produks->links() }}
                    </div>
                </div>
            @endif
        </section>

        <div id="detail-produk-modal"
            class="fixed inset-0 z-50 hidden items-center justify-center bg-[#103a2a]/50 p-3 backdrop-blur-sm sm:p-6"
            onclick="if (event.target === this) tutupDetailProduk()" role="dialog" aria-modal="true"
            aria-labelledby="detail-produk-title">
            <div
                class="flex max-h-[90vh] w-full max-w-5xl flex-col overflow-hidden rounded-xl border border-[#e8dfcd] bg-[#fffdf7] shadow-2xl">
                <header class="flex shrink-0 items-center justify-between gap-4 bg-[#103a2a] px-5 py-3 text-white sm:px-6">
                    <div class="min-w-0">
                        <h2 id="detail-produk-title" class="display-font text-base font-semibold">Detail Produk</h2>
                        <p id="detail-produk-id" class="mt-0.5 truncate text-[10px] text-[#d4e2d5]"></p>
                    </div>
                    <button type="button" onclick="tutupDetailProduk()" aria-label="Tutup detail produk"
                        class="grid h-8 w-8 shrink-0 place-items-center rounded-full bg-white/10 text-lg leading-none text-white transition hover:bg-white/20">&times;</button>
                </header>

                <div
                    class="grid min-h-0 flex-1 grid-cols-1 gap-4 overflow-y-auto p-4 sm:p-5 lg:grid-cols-[minmax(0,0.82fr)_minmax(0,1.18fr)]">
                    <div class="space-y-4">
                        <section class="overflow-hidden rounded-lg border border-[#e8dfd1] bg-[#f2efe5]">
                            <div class="relative grid aspect-[4/3] place-items-center">
                                <span
                                    class="absolute left-3 top-3 z-10 rounded bg-[#103a2a] px-2.5 py-1 text-[8px] font-semibold uppercase tracking-wide text-white">
                                    Jar Kaca Amber · 250 g
                                </span>
                                <img id="detail-produk-gambar" src="" alt=""
                                    class="hidden h-full w-full object-contain p-4">
                                <div id="detail-produk-image-placeholder"
                                    class="flex flex-col items-center gap-2 text-[#a49b8f]">
                                    <svg class="h-12 w-12" fill="none" stroke="currentColor" stroke-width="1.2"
                                        viewBox="0 0 24 24" aria-hidden="true">
                                        <rect x="3" y="4" width="18" height="16" rx="1" />
                                        <circle cx="8.5" cy="9" r="1.5" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 15-5-5L5 20" />
                                    </svg>
                                    <span class="text-[10px]">Foto produk belum tersedia</span>
                                </div>
                            </div>
                        </section>

                        <div class="grid grid-cols-3 gap-2" aria-label="Galeri produk">
                            <div class="overflow-hidden rounded-md border border-[#64835d] bg-white p-1">
                                <div class="grid h-12 place-items-center bg-[#f2efe5]">
                                    <svg class="h-5 w-5 text-[#8b9789]" fill="none" stroke="currentColor"
                                        stroke-width="1.3" viewBox="0 0 24 24" aria-hidden="true">
                                        <rect x="7" y="5" width="10" height="15" rx="2" />
                                        <path stroke-linecap="round" d="M10 8h4" />
                                    </svg>
                                </div>
                                <p class="mt-1 text-center text-[8px] font-medium text-[#52645a]">Depan</p>
                            </div>
                            <div class="overflow-hidden rounded-md border border-[#e8dfd1] bg-white p-1">
                                <div class="grid h-12 place-items-center bg-[#f7f4ec]">
                                    <svg class="h-5 w-5 text-[#b3aa9b]" fill="none" stroke="currentColor"
                                        stroke-width="1.3" viewBox="0 0 24 24" aria-hidden="true">
                                        <rect x="7" y="5" width="10" height="15" rx="2" />
                                        <path stroke-linecap="round" d="M10 8h4" />
                                    </svg>
                                </div>
                                <p class="mt-1 text-center text-[8px] font-medium text-[#81786e]">Belakang</p>
                            </div>
                            <div class="overflow-hidden rounded-md border border-[#e8dfd1] bg-white p-1">
                                <div class="grid h-12 place-items-center bg-[#f7f4ec]">
                                    <svg class="h-5 w-5 text-[#b3aa9b]" fill="none" stroke="currentColor"
                                        stroke-width="1.3" viewBox="0 0 24 24" aria-hidden="true">
                                        <rect x="7" y="5" width="10" height="15" rx="2" />
                                        <path stroke-linecap="round" d="M10 8h4" />
                                    </svg>
                                </div>
                                <p class="mt-1 text-center text-[8px] font-medium text-[#81786e]">Samping</p>
                            </div>
                        </div>

                        <section class="rounded-lg border border-[#e8dfd1] bg-white p-3">
                            <h3
                                class="mb-2 flex items-center gap-1.5 text-[10px] font-semibold uppercase tracking-[0.1em] text-[#64835d]">
                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="1.7"
                                    viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18m9-9H3" />
                                </svg>
                                Spesifikasi Fisik Botani
                            </h3>
                            <dl class="grid grid-cols-2 gap-2">
                                <div class="rounded bg-[#f7f4ec] px-2.5 py-2">
                                    <dt class="text-[8px] uppercase text-[#948b80]">Netto / Bobot</dt>
                                    <dd class="mt-0.5 text-[10px] font-semibold text-[#37312b]">250 Gram</dd>
                                </div>
                                <div class="rounded bg-[#f7f4ec] px-2.5 py-2">
                                    <dt class="text-[8px] uppercase text-[#948b80]">Waktu Bakar</dt>
                                    <dd class="mt-0.5 text-[10px] font-semibold text-[#37312b]">~45 Jam Efektif</dd>
                                </div>
                                <div class="rounded bg-[#f7f4ec] px-2.5 py-2">
                                    <dt class="text-[8px] uppercase text-[#948b80]">Bahan</dt>
                                    <dd class="mt-0.5 text-[10px] font-semibold text-[#37312b]">100% Soy Wax</dd>
                                </div>
                                <div class="rounded bg-[#f7f4ec] px-2.5 py-2">
                                    <dt class="text-[8px] uppercase text-[#948b80]">Aroma</dt>
                                    <dd class="mt-0.5 text-[10px] font-semibold text-[#37312b]">Apel Malang</dd>
                                </div>
                            </dl>
                        </section>
                    </div>

                    <div class="space-y-3">
                        <section
                            class="flex items-center justify-between gap-4 rounded-lg border border-[#e8dfd1] bg-[#faf7ed] p-3.5">
                            <div>
                                <p class="text-[8px] font-semibold uppercase tracking-[0.12em] text-[#81786e]">Harga Satuan
                                </p>
                                <p id="detail-produk-harga" class="mt-0.5 text-base font-bold text-[#b8292e]"></p>
                            </div>
                            <span class="h-8 border-l border-[#e8dfd1]" aria-hidden="true"></span>
                            <div class="text-right">
                                <p class="text-[8px] font-semibold uppercase tracking-[0.12em] text-[#81786e]">Stok
                                    Tersedia</p>
                                <p id="detail-produk-stok" class="mt-0.5 text-sm font-bold text-[#174c36]"></p>
                            </div>
                        </section>

                        <section class="overflow-hidden rounded-lg border border-[#e8dfd1] bg-white">
                            <div class="flex items-center justify-between gap-3 bg-[#f7f4ec] px-3 py-2">
                                <h3
                                    class="flex items-center gap-1.5 text-[9px] font-semibold uppercase tracking-[0.08em] text-[#64835d]">
                                    <svg class="h-3 w-3" fill="none" stroke="currentColor" stroke-width="1.8"
                                        viewBox="0 0 24 24" aria-hidden="true">
                                        <circle cx="12" cy="12" r="9" />
                                        <path stroke-linecap="round" d="M12 11v5m0-8h.01" />
                                    </svg>
                                    Atribut &amp; Master Data Produk
                                </h3>
                                <span id="detail-produk-kode"
                                    class="shrink-0 rounded bg-[#f2efe5] px-2 py-1 font-mono text-[8px] font-semibold text-[#51483f]">
                                    NUSA CANDLE
                                </span>
                            </div>
                            <dl class="grid grid-cols-1 gap-x-4 gap-y-3 p-3 sm:grid-cols-2">
                                <div class="min-w-0">
                                    <dt class="text-[8px] text-[#948b80]">Nama Produk</dt>
                                    <dd id="detail-produk-nama"
                                        class="mt-0.5 break-words text-[10px] font-semibold text-[#37312b]"></dd>
                                </div>
                                <div>
                                    <dt class="text-[8px] text-[#948b80]">Kategori Katalog</dt>
                                    <dd class="mt-0.5 text-[10px] font-semibold text-[#37312b]">Lilin Aromaterapi</dd>
                                </div>
                                <div>
                                    <dt class="text-[8px] text-[#948b80]">Varian Aroma</dt>
                                    <dd class="mt-0.5 text-[10px] font-semibold text-[#64835d]">Aroma Apel Malang</dd>
                                </div>
                                <div>
                                    <dt class="text-[8px] text-[#948b80]">Desain Stiker Label</dt>
                                    <dd class="mt-0.5 text-[10px] font-semibold text-[#37312b]">Signature Edition</dd>
                                </div>
                                <div>
                                    <dt class="text-[8px] text-[#948b80]">Jenis Kemasan</dt>
                                    <dd class="mt-0.5 text-[10px] font-semibold text-[#37312b]">Jar Kaca Amber</dd>
                                </div>
                                <div class="sm:col-span-2">
                                    <dt class="text-[8px] text-[#948b80]">Waktu Input &amp; Update</dt>
                                    <dd class="mt-0.5 text-[9px] text-[#625a51]">
                                        <span id="detail-produk-dibuat"></span>
                                        <span class="mx-1 text-[#b3aa9b]">•</span>
                                        <span id="detail-produk-diubah"></span>
                                    </dd>
                                </div>
                            </dl>
                        </section>

                        <section class="rounded-lg border border-[#e8dfd1] bg-[#faf7ed] p-3">
                            <h3
                                class="mb-1.5 flex items-center gap-1.5 text-[9px] font-semibold uppercase tracking-[0.08em] text-[#64835d]">
                                <svg class="h-3 w-3" fill="none" stroke="currentColor" stroke-width="1.8"
                                    viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 3l1.9 5.8L20 11l-6.1 2.2L12 19l-1.9-5.8L4 11l6.1-2.2L12 3z" />
                                </svg>
                                Kurasi &amp; Deskripsi Produk
                            </h3>
                            <p class="text-[9px] leading-relaxed text-[#625a51]">
                                Diramu dari 100% soy wax nabati murni dan minyak atsiri apel segar panen petani lokal
                                Bumiaji,
                                Kota Batu. Bebas jelaga hitam dan menenangkan saluran pernapasan.
                            </p>
                        </section>
                    </div>
                </div>

                <footer
                    class="flex shrink-0 items-center justify-end gap-3 border-t border-[#eee8dc] bg-[#faf7ed] px-4 py-2.5 sm:px-5">
                    <button type="button" onclick="tutupDetailProduk()"
                        class="rounded-md border border-[#103a2a] bg-white px-4 py-2 text-[10px] font-semibold text-[#103a2a] transition hover:bg-[#103a2a] hover:text-white">
                        Tutup
                    </button>
                </footer>
            </div>
        </div>
    </div>

    {{-- Modal Tambah/Edit Produk --}}
    <div id="produk-modal"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-[#0b251b]/55 p-4 backdrop-blur-sm">
        <div
            class="max-h-[90vh] w-full max-w-2xl overflow-y-auto rounded-xl border border-[#e8dfcd] bg-[#fffdf7] shadow-2xl">
            <div
                class="sticky top-0 z-10 flex items-start justify-between gap-4 border-b border-[#eee8dc] bg-[#fffdf7] px-7 py-5">
                <div class="min-w-0">
                    <p
                        class="flex items-center gap-1.5 text-[10px] font-semibold uppercase tracking-[0.16em] text-[#64835d]">
                        <span class="h-1.5 w-1.5 rounded-sm bg-[#b8292e]"></span>
                        Katalog Eksklusif Apel
                    </p>
                    <h2 id="modal-title" class="display-font mt-1 text-2xl font-semibold leading-tight text-[#2c1810]">
                        Tambah Produk
                    </h2>
                </div>
                <div class="flex shrink-0 items-center gap-2">
                    <span id="edit-mode-badge"
                        class="hidden rounded-full bg-[#e8f5e9] px-2.5 py-1.5 text-[10px] font-semibold text-[#2e7d32]">
                        Formulir Edit
                    </span>
                    <button type="button" onclick="closeModal()" aria-label="Tutup modal"
                        class="rounded p-1 text-xl leading-none text-[#718078] transition hover:bg-[#f5f0e2] hover:text-[#30483a]">&times;</button>
                </div>
            </div>

            <form id="produk-form" method="POST" enctype="multipart/form-data" class="space-y-5 px-7 py-6">
                @csrf
                <input type="hidden" name="_method" id="form-method" value="POST">

                <div>
                    <label for="gambar"
                        class="mb-2 block text-[11px] font-semibold uppercase tracking-[0.13em] text-[#52645a]">
                        Foto Produk Lilin
                    </label>
                    <label for="gambar"
                        class="flex min-h-[88px] cursor-pointer items-center gap-4 rounded-lg border border-dashed border-[#cfc9b7] bg-[#f7f4e9] px-4 py-3.5 transition hover:border-[#64835d] hover:bg-[#f3f0e4]">
                        <span id="preview-container" class="hidden shrink-0">
                            <img id="preview-image" src="" alt="Foto produk"
                                class="h-14 w-14 rounded-md border border-[#e8dfcd] object-cover">
                        </span>
                        <span id="upload-placeholder" class="flex min-w-0 items-center gap-3 text-[#64835d]">
                            <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.8"
                                viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="min-w-0">
                                <span class="block text-xs font-semibold">Unggah Foto Master Produk</span>
                                <span class="mt-1 block text-[10px] text-[#87948b]">JPG, PNG, atau WebP · Maks. 2 MB ·
                                    Rasio 1:1 disarankan</span>
                            </span>
                        </span>
                        <input type="file" name="gambar" id="gambar" accept=".jpg,.jpeg,.png,.webp"
                            class="sr-only" onchange="previewImage(this)">
                    </label>
                </div>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label for="nama_produk"
                            class="mb-1.5 block text-[11px] font-semibold uppercase tracking-[0.13em] text-[#52645a]">Nama
                            Produk</label>
                        <input type="text" name="nama_produk" id="nama_produk" required
                            class="w-full rounded-md border border-[#d9d4c6] bg-[#f7f4e9] px-3 py-2.5 text-sm text-[#2c1810] outline-none transition placeholder:text-[#9b9485] focus:border-[#64835d] focus:ring-1 focus:ring-[#64835d]/20"
                            placeholder="NusaCandle - Lilin Aroma Terapi...">
                    </div>
                    <div>
                        <label for="sku-display"
                            class="mb-1.5 block text-[11px] font-semibold uppercase tracking-[0.13em] text-[#52645a]">Kode
                            Produk (SKU)</label>
                        <input type="text" id="sku-display" readonly value="Dibuat otomatis saat disimpan"
                            class="w-full rounded-md border border-[#e5dfd1] bg-[#f2efe5] px-3 py-2.5 text-sm text-[#718078] outline-none">
                    </div>
                    <div>
                        <label for="harga"
                            class="mb-1.5 block text-[11px] font-semibold uppercase tracking-[0.13em] text-[#52645a]">Harga
                            Satuan (IDR)</label>
                        <input type="number" name="harga" id="harga" required min="0"
                            class="w-full rounded-md border border-[#d9d4c6] bg-[#f7f4e9] px-3 py-2.5 text-sm text-[#2c1810] outline-none transition placeholder:text-[#9b9485] focus:border-[#64835d] focus:ring-1 focus:ring-[#64835d]/20"
                            placeholder="125000">
                    </div>
                    <div>
                        <label for="stok"
                            class="mb-1.5 block text-[11px] font-semibold uppercase tracking-[0.13em] text-[#52645a]">Stok
                            Fisik</label>
                        <input type="number" name="stok" id="stok" required min="0"
                            class="w-full rounded-md border border-[#d9d4c6] bg-[#f7f4e9] px-3 py-2.5 text-sm text-[#2c1810] outline-none transition placeholder:text-[#9b9485] focus:border-[#64835d] focus:ring-1 focus:ring-[#64835d]/20"
                            placeholder="150">
                    </div>
                    <div>
                        <label for="ukuran-display"
                            class="mb-1.5 block text-[11px] font-semibold uppercase tracking-[0.13em] text-[#52645a]">Ukuran
                            / Format Kemasan</label>
                        <input type="text" id="ukuran-display" readonly value="Jar Kaca Amber 250g (~45 Jam)"
                            class="w-full rounded-md border border-[#e5dfd1] bg-[#f2efe5] px-3 py-2.5 text-sm text-[#52645a] outline-none">
                    </div>
                    <div>
                        <p class="mb-1.5 block text-[11px] font-semibold uppercase tracking-[0.13em] text-[#52645a]">Aroma
                            Botani (Terkunci)</p>
                        <div class="flex h-[42px] items-center gap-2 rounded-md border border-[#e5dfd1] bg-[#f2efe5] px-3">
                            <span id="aroma-display" class="min-w-0 flex-1 text-sm font-medium text-[#52645a]">Aroma
                                Apel</span>
                            <span class="shrink-0 rounded bg-[#e0eee2] px-2 py-1 text-[9px] font-bold text-[#3d7951]">KHAS
                                APEL MALANG</span>
                        </div>
                    </div>
                </div>

                <div>
                    <label for="deskripsi-display"
                        class="mb-1.5 block text-[11px] font-semibold uppercase tracking-[0.13em] text-[#52645a]">Deskripsi
                        Produk Resmi</label>
                    <textarea id="deskripsi-display" readonly rows="3"
                        class="w-full resize-none rounded-md border border-[#e5dfd1] bg-[#f2efe5] px-3 py-2.5 text-xs leading-relaxed text-[#52645a] outline-none">Diramu dari 100% soy wax nabati murni dan minyak atsiri apel segar panen petani lokal Bumiaji Kota Batu. Bebas jelaga hitam dan menenangkan saluran pernapasan.</textarea>
                </div>

                <div class="flex justify-end gap-3 pt-1">
                    <button type="button" onclick="closeModal()"
                        class="rounded-md border border-[#e5dfd1] bg-[#f5f1e7] px-5 py-2.5 text-xs font-semibold text-[#52645a] transition hover:bg-[#ebe5d7]">Batal</button>
                    <button type="submit"
                        class="inline-flex items-center gap-2 rounded-md bg-[#103a2a] px-5 py-2.5 text-xs font-semibold text-white transition hover:bg-[#315d41]">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8"
                            viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span id="submit-button-label">Simpan Produk</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openTambahModal() {
            document.getElementById('modal-title').textContent = 'Tambah Produk';
            document.getElementById('produk-form').action = "{{ route('admin.products.store') }}";
            const form = document.getElementById('produk-form');
            form.reset();
            document.getElementById('form-method').value = 'POST';
            document.getElementById('sku-display').value = 'Dibuat otomatis saat disimpan';
            document.getElementById('edit-mode-badge').classList.add('hidden');
            document.getElementById('submit-button-label').textContent = 'Simpan Produk';
            document.getElementById('preview-container').classList.add('hidden');
            document.getElementById('upload-placeholder').classList.remove('hidden');
            document.getElementById('preview-image').removeAttribute('src');
            document.getElementById('produk-modal').classList.remove('hidden');
            document.getElementById('produk-modal').classList.add('flex');
        }

        function editProduk(produk) {
            document.getElementById('modal-title').textContent = 'Update Produk';
            document.getElementById('produk-form').action = `/admin/produk/${produk.id_produk}`;
            document.getElementById('produk-form').reset();
            document.getElementById('form-method').value = 'PUT';

            document.getElementById('nama_produk').value = produk.nama_produk;
            document.getElementById('stok').value = produk.stok;
            document.getElementById('harga').value = produk.harga;
            document.getElementById('sku-display').value = `ID Produk #${produk.id_produk}`;
            document.getElementById('edit-mode-badge').classList.remove('hidden');
            document.getElementById('submit-button-label').textContent = 'Simpan';

            if (produk.gambar) {
                document.getElementById('preview-image').src = '/storage/' + produk.gambar;
                document.getElementById('preview-container').classList.remove('hidden');
                document.getElementById('upload-placeholder').classList.add('hidden');
            } else {
                document.getElementById('preview-container').classList.add('hidden');
                document.getElementById('upload-placeholder').classList.remove('hidden');
            }

            document.getElementById('produk-modal').classList.remove('hidden');
            document.getElementById('produk-modal').classList.add('flex');
        }

        function lihatProduk(produk) {
            document.getElementById('detail-produk-nama').textContent = produk.nama_produk;
            document.getElementById('detail-produk-id').textContent =
                `ID Produk: #${produk.id_produk} · ${produk.nama_produk}`;
            document.getElementById('detail-produk-kode').textContent = `#${produk.id_produk}`;
            document.getElementById('detail-produk-harga').textContent =
                `Rp ${Number(produk.harga).toLocaleString('id-ID')} / pcs`;
            document.getElementById('detail-produk-stok').textContent =
                `${Number(produk.stok).toLocaleString('id-ID')} pcs`;
            const formatTanggal = (tanggal) => {
                if (!tanggal) {
                    return '-';
                }

                const date = new Date(tanggal);
                return Number.isNaN(date.getTime()) ?
                    '-' :
                    date.toLocaleString('id-ID', {
                        day: '2-digit',
                        month: 'short',
                        year: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit',
                    });
            };
            document.getElementById('detail-produk-dibuat').textContent = formatTanggal(produk.created_at);
            document.getElementById('detail-produk-diubah').textContent = formatTanggal(produk.updated_at);

            const image = document.getElementById('detail-produk-gambar');
            const imagePlaceholder = document.getElementById('detail-produk-image-placeholder');
            if (produk.gambar) {
                image.src = `/storage/${produk.gambar}`;
                image.alt = `Gambar ${produk.nama_produk}`;
                image.onerror = () => {
                    image.classList.add('hidden');
                    imagePlaceholder.classList.remove('hidden');
                };
                image.classList.remove('hidden');
                imagePlaceholder.classList.add('hidden');
            } else {
                image.removeAttribute('src');
                image.alt = '';
                image.classList.add('hidden');
                imagePlaceholder.classList.remove('hidden');
            }

            const modal = document.getElementById('detail-produk-modal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function tutupDetailProduk() {
            const modal = document.getElementById('detail-produk-modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function closeModal() {
            document.getElementById('produk-modal').classList.add('hidden');
            document.getElementById('produk-modal').classList.remove('flex');
        }

        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview-image').src = e.target.result;
                    document.getElementById('preview-container').classList.remove('hidden');
                    document.getElementById('upload-placeholder').classList.add('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
