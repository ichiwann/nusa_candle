@extends('layouts.admin')

@section('title', 'Kelola Hadiah & Poin Loyalitas')
@section('page_title', 'Kelola Hadiah')

@section('content')
    @php
        $showSampleStats = $daftarHadiah->isEmpty() && $daftarPenukaran->isEmpty();
        $displayStokProduk = $showSampleStats ? 64 : $totalStokProduk;
        $displayPenukaranPending = $showSampleStats ? 82 : $penukaranPending;
        $displayTotalPenukaran = $showSampleStats ? 28 : $totalPenukaran;
    @endphp

    <div class="-mx-4 -my-6 min-h-[calc(100vh_-_4rem)] bg-[#f7f4e9] px-4 py-6 sm:-mx-6 sm:-my-9 sm:px-6 sm:py-9 lg:-mx-8 lg:px-8 xl:-mx-12 xl:px-12">
        <header class="mb-5 flex flex-wrap items-center justify-between gap-3">
            <div>
                <p class="text-[9px] font-semibold uppercase tracking-[0.16em] text-[#64835d]">Admin Ledger /</p>
                <h1 class="display-font mt-1 text-2xl font-semibold text-[#183b2c] sm:text-3xl">Kelola Hadiah &amp; Poin Loyalitas</h1>
                <p class="mt-1.5 max-w-2xl text-xs leading-relaxed text-[#718078]">
                    Program apresiasi resmi NusaCandle. Kumpulkan 70 poin untuk mendapatkan 1x refill lilin aroma apel gratis.
                </p>
            </div>
            <button type="button" onclick="openAddRewardModal()"
                class="inline-flex shrink-0 items-center gap-1 rounded-sm bg-[#103a2a] px-2 py-1 text-[9px] font-semibold text-white transition hover:bg-[#315d41]">
                <svg class="h-3 w-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" d="M12 5v14m7-7H5" />
                </svg>
                Tambah Hadiah
            </button>
        </header>

        <section class="mb-4 grid grid-cols-1 gap-3 sm:grid-cols-3">
            <article class="border border-[#e8dfd1] bg-white px-3 py-2.5 shadow-sm">
                <p class="text-[8px] font-semibold uppercase tracking-[0.12em] text-[#718078]">Stok Produk</p>
                <p class="mt-1 flex items-baseline gap-1.5">
                    <span class="display-font text-xl font-semibold leading-none text-[#b8292e]">{{ number_format($displayStokProduk) }}</span>
                    <span class="text-[9px] text-[#655c54]">unit tersedia di katalog</span>
                </p>
            </article>
            <article class="border border-[#e8dfd1] bg-white px-3 py-2.5 shadow-sm">
                <p class="text-[8px] font-semibold uppercase tracking-[0.12em] text-[#718078]">Penukaran Pending</p>
                <p class="mt-1 flex items-baseline gap-1.5">
                    <span class="display-font text-xl font-semibold leading-none text-[#3d7951]">{{ number_format($displayPenukaranPending) }}</span>
                    <span class="text-[9px] text-[#655c54]">menunggu persetujuan</span>
                </p>
            </article>
            <article class="border border-[#e8dfd1] bg-white px-3 py-2.5 shadow-sm">
                <p class="text-[8px] font-semibold uppercase tracking-[0.12em] text-[#718078]">Total Penukaran</p>
                <p class="mt-1 flex items-baseline gap-1.5">
                    <span class="display-font text-xl font-semibold leading-none text-[#183b2c]">{{ number_format($displayTotalPenukaran) }}</span>
                    <span class="text-[9px] text-[#655c54]">klaim masuk</span>
                </p>
            </article>
        </section>

        <section class="mb-4 overflow-hidden rounded-sm border border-[#e8dfd1] bg-white shadow-sm">
            <div class="flex flex-wrap items-center justify-between gap-3 border-b border-[#e8dfd1] bg-[#fffdf7] px-3 py-3 sm:px-4">
                <div>
                    <h2 class="display-font text-base font-semibold text-[#183b2c]">Daftar Hadiah</h2>
                    <p class="mt-0.5 text-[10px] text-[#718078]">Kelola inventaris dan parameter hadiah loyalitas eksklusif NusaCandle.</p>
                </div>
                <span class="rounded-sm bg-[#f0eee8] px-2 py-1 text-[8px] font-semibold text-[#655c54]">
                    +{{ $daftarHadiah->isEmpty() ? 1 : $totalHadiah }} Item Aktif Terdaftar
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full min-w-[690px] text-left">
                    <thead class="border-b border-[#e8dfd1] bg-[#f5f0e2] text-[10px] uppercase tracking-[0.08em] text-[#718078]">
                        <tr>
                            <th class="px-3 py-2 font-semibold">Produk Hadiah</th>
                            <th class="px-3 py-2 font-semibold">Stok Tersedia</th>
                            <th class="px-3 py-2 font-semibold">Poin Dibutuhkan</th>
                            <th class="px-3 py-2 font-semibold">Tanggal Ditambahkan</th>
                            <th class="px-3 py-2 font-semibold">Catatan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#eee8dc]">
                        @forelse($daftarHadiah as $hadiah)
                            <tr class="group text-xs transition-colors hover:bg-[#fbf9f2]">
                                <td class="px-3 py-2">
                                    <div class="flex items-center gap-2">
                                        @if ($hadiah->produk?->gambar)
                                            <img src="{{ asset('storage/' . $hadiah->produk->gambar) }}"
                                                alt="{{ $hadiah->produk->nama_produk }}"
                                                class="h-9 w-9 shrink-0 rounded-sm border border-[#e8dfd1] object-cover">
                                        @else
                                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-sm bg-[#f1eee5] text-[#87948b]">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6a2 2 0 012-2h12a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm3 10 3-3 2 2 3-4 3 5H7z" />
                                                </svg>
                                            </div>
                                        @endif
                                        <div class="min-w-0">
                                            <p class="font-semibold text-[#30483a]">{{ $hadiah->produk?->nama_produk ?? 'Produk tidak tersedia' }}</p>
                                            <p class="mt-0.5 text-[9px] text-[#87948b]">Hadiah loyalitas · ID #{{ $hadiah->id_produk }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-3 py-2">
                                    <span class="font-semibold text-[#30483a]">{{ number_format($hadiah->produk?->stok ?? 0) }} pcs</span>
                                    <p class="text-[9px] text-[#87948b]">tersedia di katalog</p>
                                </td>
                                <td class="px-3 py-2">
                                    <span class="inline-flex rounded-sm bg-[#fce4ec] px-2 py-1 text-[10px] font-bold text-[#8b1e1e]">
                                        {{ number_format($hadiah->poin_dibutuhkan) }} Poin
                                    </span>
                                </td>
                                <td class="px-3 py-2 text-[#52645a]">
                                    {{ $hadiah->created_at->format('d M Y') }}
                                    <p class="text-[9px] text-[#87948b]">{{ $hadiah->created_at->format('H:i') }}</p>
                                </td>
                                <td class="px-3 py-2">
                                    <div class="flex items-start justify-between gap-2">
                                        <p class="max-w-[200px] text-[9px] leading-relaxed text-[#655c54]">Hadiah loyalitas eksklusif untuk pelanggan NusaCandle.</p>
                                        <form action="{{ route('admin.hadiah.destroy', $hadiah->id_hadiah) }}" method="POST"
                                            onsubmit="return confirm('Hapus hadiah ini?')"
                                            class="shrink-0 opacity-100 transition group-hover:opacity-100 focus-within:opacity-100 sm:opacity-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" aria-label="Hapus {{ $hadiah->produk?->nama_produk ?? 'hadiah' }}"
                                                class="rounded-sm p-1 text-[#a09586] transition hover:bg-red-50 hover:text-red-700">
                                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16m-10 4v6m4-6v6M5 7l1 14h12l1-14M9 7V4h6v3" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="px-3 py-2">
                                    <div class="flex items-center gap-2">
                                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-sm bg-[#f1eee5] text-[#87948b]">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6a2 2 0 012-2h12a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm3 10 3-3 2 2 3-4 3 5H7z" />
                                            </svg>
                                        </div>
                                        <div class="min-w-0">
                                            <p class="font-semibold text-[#30483a]">Refill Lilin Aromaterapi Aroma Apel</p>
                                            <p class="mt-0.5 text-[9px] text-[#87948b]">Eco Refill Wax Bar 200g</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-3 py-2">
                                    <span class="font-semibold text-[#30483a]">450 pcs</span>
                                    <p class="text-[9px] text-[#87948b]">tersedia di katalog</p>
                                </td>
                                <td class="px-3 py-2">
                                    <span class="inline-flex rounded-sm bg-[#fce4ec] px-2 py-1 text-[10px] font-bold text-[#8b1e1e]">70 Poin</span>
                                </td>
                                <td class="px-3 py-2 text-[#52645a]">
                                    15 Jan 2024
                                    <p class="text-[9px] text-[#87948b]">10:30</p>
                                </td>
                                <td class="px-3 py-2">
                                    <p class="max-w-[200px] text-[9px] leading-relaxed text-[#655c54]">Gratis refill lilin aroma apel setelah mengumpulkan 70 poin. Maksimal satu refill per klaim.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        @php
            $contohPenukaran = [
                [
                    'is_preview' => true,
                    'id_penukaran' => 1001,
                    'nama_user' => 'Maya Anggraini',
                    'username' => 'maya_anggraini',
                    'poin_sekarang' => 85,
                    'poin_saat_klaim' => 85,
                    'poin_dibutuhkan' => 70,
                    'nama_produk' => 'Refill Lilin Aromaterapi Aroma Apel',
                    'poin_ditukar' => 70,
                    'status_klaim' => 'pending',
                    'catatan' => 'Permintaan klaim menunggu konfirmasi admin.',
                    'tanggal' => Illuminate\Support\Carbon::parse('2024-01-15 10:30:00'),
                ],
                [
                    'is_preview' => true,
                    'id_penukaran' => 1002,
                    'nama_user' => 'Rian Kusuma',
                    'username' => 'rian_kusuma',
                    'poin_sekarang' => 120,
                    'poin_saat_klaim' => 120,
                    'poin_dibutuhkan' => 70,
                    'nama_produk' => 'Refill Lilin Aromaterapi Aroma Apel',
                    'poin_ditukar' => 70,
                    'status_klaim' => 'memenuhi_syarat',
                    'catatan' => 'Poin telah cukup untuk mengklaim hadiah.',
                    'tanggal' => Illuminate\Support\Carbon::parse('2024-01-14 15:10:00'),
                ],
                [
                    'is_preview' => true,
                    'id_penukaran' => 1003,
                    'nama_user' => 'Dewi Lestari',
                    'username' => 'dewi_lestari',
                    'poin_sekarang' => 70,
                    'poin_saat_klaim' => 70,
                    'poin_dibutuhkan' => 70,
                    'nama_produk' => 'Refill Lilin Aromaterapi Aroma Apel',
                    'poin_ditukar' => 70,
                    'status_klaim' => 'disetujui',
                    'catatan' => 'Klaim selesai dan hadiah siap diserahkan.',
                    'tanggal' => Illuminate\Support\Carbon::parse('2024-01-13 11:20:00'),
                ],
                [
                    'is_preview' => true,
                    'id_penukaran' => 1004,
                    'nama_user' => 'Bagus Satrio',
                    'username' => 'bagus_satrio',
                    'poin_sekarang' => 95,
                    'poin_saat_klaim' => 95,
                    'poin_dibutuhkan' => 70,
                    'nama_produk' => 'Refill Lilin Aromaterapi Aroma Apel',
                    'poin_ditukar' => 70,
                    'status_klaim' => 'memenuhi_syarat',
                    'catatan' => 'Poin telah cukup untuk mengklaim hadiah.',
                    'tanggal' => Illuminate\Support\Carbon::parse('2024-01-12 08:45:00'),
                ],
                [
                    'is_preview' => true,
                    'id_penukaran' => 1005,
                    'nama_user' => 'Fajar Nugraha',
                    'username' => 'fajar_nugraha',
                    'poin_sekarang' => 45,
                    'poin_saat_klaim' => 45,
                    'poin_dibutuhkan' => 70,
                    'nama_produk' => 'Refill Lilin Aromaterapi Aroma Apel',
                    'poin_ditukar' => 70,
                    'status_klaim' => 'belum_memenuhi_syarat',
                    'catatan' => 'Kurang 25 poin lagi untuk klaim hadiah.',
                    'tanggal' => Illuminate\Support\Carbon::parse('2024-01-11 13:15:00'),
                ],
            ];
            $penukaranUntukDitampilkan = $daftarPenukaran->isEmpty()
                ? collect($contohPenukaran)
                : $daftarPenukaran;
        @endphp

        <section class="overflow-hidden rounded-sm border border-[#e8dfd1] bg-white shadow-sm">
            <div class="flex flex-wrap items-center justify-between gap-3 border-b border-[#e8dfd1] bg-[#fffdf7] px-3 py-3 sm:px-4">
                <div>
                    <h2 class="display-font text-base font-semibold text-[#183b2c]">Data Poin Pengguna</h2>
                    <p class="mt-0.5 text-[10px] text-[#718078]">Pantau poin dan status klaim hadiah pelanggan</p>
                </div>
                <label class="relative w-full sm:max-w-[230px]">
                    <span class="sr-only">Cari nama pelanggan</span>
                    <svg class="absolute left-2.5 top-1/2 h-3 w-3 -translate-y-1/2 text-[#87948b]" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <circle cx="11" cy="11" r="7" stroke-width="1.8" />
                        <path stroke-linecap="round" stroke-width="1.8" d="m16 16 4 4" />
                    </svg>
                    <input id="redemption-search" type="search" placeholder="Cari nama pelanggan..."
                        class="w-full rounded-sm border border-[#e8dfd1] bg-[#fbf9f2] py-2.5 pl-8 pr-3 text-[10px] text-[#30483a] outline-none placeholder:text-[#9a9a8f] focus:border-[#64835d] focus:ring-1 focus:ring-[#64835d]/20">
                </label>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full min-w-[980px] text-left">
                    <thead class="border-b border-[#e8dfd1] bg-[#f5f0e2] text-[9px] uppercase tracking-[0.07em] text-[#718078]">
                        <tr>
                            <th class="px-2.5 py-2 font-semibold">Nama Pengguna</th>
                            <th class="px-2.5 py-2 font-semibold">Jumlah Poin</th>
                            <th class="px-2.5 py-2 font-semibold">
                                Progress Poin
                                @if ($daftarPenukaran->isEmpty())
                                    (Target 70 Poin)
                                @endif
                            </th>
                            <th class="px-2.5 py-2 font-semibold">Produk Hadiah</th>
                            <th class="px-2.5 py-2 font-semibold">Status Klaim</th>
                            <th class="px-2.5 py-2 font-semibold">Catatan</th>
                            <th class="px-2.5 py-2 text-center font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#eee8dc]">
                        @forelse($penukaranUntukDitampilkan as $penukaran)
                            @php
                                $targetPoin = max(1, $penukaran['poin_dibutuhkan']);
                                $poinSaatKlaim = $penukaran['poin_saat_klaim'];
                                $progressPoin = min(100, ($poinSaatKlaim / $targetPoin) * 100);
                                $memenuhiSyarat = $poinSaatKlaim >= $targetPoin;
                                $statusConfig = [
                                    'pending' => ['label' => 'Klaim Dilakukan', 'class' => 'bg-[#c9e8b7] text-[#30483a]'],
                                    'memenuhi_syarat' => ['label' => 'Memenuhi Syarat', 'class' => 'bg-[#c9e8b7] text-[#30483a]'],
                                    'disetujui' => ['label' => 'Selesai Diklaim', 'class' => 'bg-[#315d41] text-white'],
                                    'ditolak' => ['label' => 'Ditolak', 'class' => 'bg-[#f8dddd] text-[#9b2727]'],
                                    'belum_memenuhi_syarat' => ['label' => 'Belum Memenuhi Syarat', 'class' => 'bg-[#eee9dc] text-[#71685a]'],
                                ];
                                $config = $statusConfig[$penukaran['status_klaim']] ?? [
                                    'label' => $penukaran['status_klaim'],
                                    'class' => 'bg-gray-100 text-gray-800',
                                ];
                            @endphp
                            <tr data-redemption-row class="text-[10px] transition-colors hover:bg-[#fbf9f2]">
                                <td class="px-2.5 py-2">
                                    <div class="flex items-center gap-1.5">
                                        <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-sm bg-[#e6eee5] text-[10px] font-bold text-[#315d41]">
                                            {{ mb_substr($penukaran['nama_user'], 0, 1) }}
                                        </span>
                                        <div class="min-w-0">
                                            <p class="truncate font-semibold text-[#30483a]">{{ $penukaran['nama_user'] }}</p>
                                            <p class="truncate text-[9px] text-[#87948b]">{{ $penukaran['username'] }} · #{{ str_pad($penukaran['id_penukaran'], 4, '0', STR_PAD_LEFT) }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-2.5 py-2 whitespace-nowrap">
                                    <span class="font-bold text-[#183b2c]">{{ number_format($penukaran['poin_sekarang']) }}</span>
                                    <span class="text-[9px] text-[#718078]">Poin</span>
                                </td>
                                <td class="px-2.5 py-2">
                                    <div class="min-w-[130px]">
                                        <div class="mb-1 flex items-center justify-between gap-1 text-[8px]">
                                            <span class="font-semibold {{ $memenuhiSyarat ? 'text-[#28633b]' : 'text-[#b8292e]' }}">
                                                {{ number_format($progressPoin) }}% {{ $memenuhiSyarat ? 'Tercapai' : 'Terkumpul' }}
                                            </span>
                                            <span class="whitespace-nowrap text-[#52645a]">{{ number_format($poinSaatKlaim) }} / {{ number_format($targetPoin) }} Poin</span>
                                        </div>
                                        <div class="h-1 overflow-hidden rounded-full bg-[#e9e6de]">
                                            <div class="h-full rounded-full {{ $memenuhiSyarat ? 'bg-[#315d41]' : 'bg-[#b8292e]' }}" style="width: {{ number_format($progressPoin, 2, '.', '') }}%"></div>
                                        </div>
                                        @unless ($memenuhiSyarat)
                                            <p class="mt-1 text-[7px] font-semibold text-[#b8292e]">Kurang {{ number_format(max(0, $targetPoin - $poinSaatKlaim)) }} Poin lagi</p>
                                        @endunless
                                    </div>
                                </td>
                                <td class="px-2.5 py-2">
                                    <p class="max-w-[130px] font-semibold leading-snug text-[#30483a]">{{ $penukaran['nama_produk'] }}</p>
                                    <p class="mt-0.5 text-[9px] text-[#8b1e1e]">-{{ number_format($penukaran['poin_ditukar']) }} Poin</p>
                                </td>
                                <td class="px-2.5 py-2">
                                    <span class="inline-flex w-[76px] items-center justify-center gap-1 rounded-sm px-1.5 py-1 text-center text-[7px] font-semibold uppercase leading-tight {{ $config['class'] }}">
                                        @if ($penukaran['status_klaim'] === 'pending')
                                            <svg class="h-3 w-3 shrink-0" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M20 12v9H4v-9m18-5H2v5h20V7Zm-10 5v9m0-14H8a2.5 2.5 0 1 1 2.5-2.5C10.5 4.9 12 7 12 7Zm0 0h4a2.5 2.5 0 1 0-2.5-2.5C13.5 4.9 12 7 12 7Z" />
                                            </svg>
                                        @elseif ($penukaran['status_klaim'] === 'memenuhi_syarat')
                                            <svg class="h-3 w-3 shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                                                <circle cx="12" cy="12" r="9" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m8 12 2.5 2.5L16 9" />
                                            </svg>
                                        @elseif ($penukaran['status_klaim'] === 'disetujui')
                                            <svg class="h-3 w-3 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m5 12 4 4L19 6" />
                                            </svg>
                                        @elseif ($penukaran['status_klaim'] === 'belum_memenuhi_syarat')
                                            <svg class="h-3 w-3 shrink-0" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 3h10M7 21h10M8 3c0 5 8 5 8 9s-8 4-8 9" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 7h6m-6 10h6" />
                                            </svg>
                                        @endif
                                        <span>{{ $config['label'] }}</span>
                                    </span>
                                    <p class="mt-1 text-[9px] text-[#87948b]">{{ $penukaran['tanggal']->format('d M Y') }}</p>
                                </td>
                                <td class="px-2.5 py-2">
                                    @if ($penukaran['catatan'])
                                        <p class="max-w-[120px] leading-relaxed text-[#52645a]">{{ Str::limit($penukaran['catatan'], 50) }}</p>
                                    @else
                                        <span class="text-[9px] italic text-[#9a9a8f]">Tidak ada catatan</span>
                                    @endif
                                </td>
                                <td class="px-2.5 py-2">
                                    <div class="flex w-full justify-center gap-1">
                                        @if ($penukaran['is_preview'] ?? false)
                                            @if ($penukaran['status_klaim'] === 'ditolak')
                                                <button type="button"
                                                    onclick="openRejectionDetails({{ Illuminate\Support\Js::from($penukaran['nama_user']) }}, {{ Illuminate\Support\Js::from($penukaran['catatan'] ?? 'Tidak ada alasan tercatat.') }})"
                                                    class="flex min-h-8 w-[82px] items-center justify-center rounded-sm bg-[#e8e4da] px-1.5 py-1 text-center text-[8px] font-bold uppercase leading-tight text-[#655c54] transition hover:bg-[#ded8ca]">
                                                    Detail Penolakan
                                                </button>
                                            @elseif ($penukaran['status_klaim'] === 'belum_memenuhi_syarat')
                                                <button type="button" disabled
                                                    class="flex min-h-8 w-[82px] items-center justify-center gap-1 rounded-sm bg-[#eeeae0] px-1.5 py-1 text-center text-[7px] font-bold uppercase leading-tight text-[#746e64]">
                                                    <svg class="h-3 w-3 shrink-0" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24" aria-hidden="true">
                                                        <circle cx="12" cy="12" r="9" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 7v5l3 2" />
                                                    </svg>
                                                    <span>Belum Memenuhi Syarat</span>
                                                </button>
                                            @elseif ($penukaran['status_klaim'] === 'disetujui')
                                                <button type="button" disabled
                                                    class="flex min-h-8 w-[82px] items-center justify-center gap-1 rounded-sm bg-[#e6ede1] px-1.5 py-1 text-center text-[7px] font-bold uppercase leading-tight text-[#45634d]">
                                                    <svg class="h-3 w-3 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m5 12 4 4L19 6" />
                                                    </svg>
                                                    <span>Klaim Selesai</span>
                                                </button>
                                            @else
                                                <button type="button" disabled
                                                    class="flex min-h-8 w-[82px] items-center justify-center gap-1 rounded-sm bg-[#174b33] px-1.5 py-1 text-center text-[7px] font-bold uppercase leading-tight text-white">
                                                    <svg class="h-3 w-3 shrink-0" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24" aria-hidden="true">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 8h16v12H4zM2 5h20v3H2zm10 3v12m0-15H8a2 2 0 1 1 2-2c0 1 2 2 2 2Zm0 0h4a2 2 0 1 0-2-2c0 1-2 2-2 2Z" />
                                                    </svg>
                                                    <span>Konfirmasi Klaim</span>
                                                </button>
                                            @endif
                                        @elseif ($penukaran['status_klaim'] === 'pending')
                                            <div class="flex w-full flex-col items-center gap-1">
                                                <form action="{{ route('admin.hadiah.approve', $penukaran['id_penukaran']) }}" method="POST" class="flex w-full justify-center">
                                                    @csrf
                                                    <button type="submit" onclick="return confirm('Setujui klaim hadiah ini?')"
                                                        class="flex min-h-8 w-[82px] items-center justify-center gap-1 rounded-sm bg-[#174b33] px-1.5 py-1 text-center text-[7px] font-bold uppercase leading-tight text-white transition hover:bg-[#234b31]">
                                                        <svg class="h-3 w-3 shrink-0" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24" aria-hidden="true">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 8h16v12H4zM2 5h20v3H2zm10 3v12m0-15H8a2 2 0 1 1 2-2c0 1 2 2 2 2Zm0 0h4a2 2 0 1 0-2-2c0 1-2 2-2 2Z" />
                                                        </svg>
                                                        <span>Konfirmasi Klaim</span>
                                                    </button>
                                                </form>
                                                <button type="button"
                                                    onclick="openRejectModal({{ $penukaran['id_penukaran'] }}, {{ Illuminate\Support\Js::from($penukaran['nama_user']) }})"
                                                    class="text-[7px] font-semibold uppercase tracking-wide text-[#9b2727] underline decoration-[#d9a6a6] underline-offset-2 hover:text-[#7d1d1d]">
                                                    Tolak
                                                </button>
                                            </div>
                                        @elseif($penukaran['status_klaim'] === 'disetujui')
                                            <button type="button" disabled
                                                class="flex min-h-8 w-[82px] items-center justify-center gap-1 rounded-sm bg-[#e6ede1] px-1.5 py-1 text-center text-[7px] font-bold uppercase leading-tight text-[#45634d]">
                                                <svg class="h-3 w-3 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m5 12 4 4L19 6" />
                                                </svg>
                                                <span>Klaim Selesai</span>
                                            </button>
                                        @elseif($penukaran['status_klaim'] === 'ditolak')
                                            <button type="button"
                                                onclick="openRejectionDetails({{ Illuminate\Support\Js::from($penukaran['nama_user']) }}, {{ Illuminate\Support\Js::from($penukaran['catatan'] ?? 'Tidak ada alasan tercatat.') }})"
                                                class="flex min-h-8 w-[82px] items-center justify-center rounded-sm bg-[#e8e4da] px-1.5 py-1 text-center text-[8px] font-bold uppercase leading-tight text-[#655c54] transition hover:bg-[#ded8ca]">
                                                Detail Penolakan
                                            </button>
                                        @else
                                            <button type="button" disabled
                                                class="flex min-h-8 w-[82px] items-center justify-center gap-1 rounded-sm bg-[#eeeae0] px-1.5 py-1 text-center text-[7px] font-bold uppercase leading-tight text-[#746e64]">
                                                <svg class="h-3 w-3 shrink-0" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24" aria-hidden="true">
                                                    <circle cx="12" cy="12" r="9" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 7v5l3 2" />
                                                </svg>
                                                <span>Belum Memenuhi Syarat</span>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-3 py-8 text-center">
                                    <p class="text-[9px] font-semibold text-[#30483a]">Belum ada klaim hadiah masuk</p>
                                    <p class="mt-1 text-[10px] text-[#87948b]">Klaim pelanggan akan muncul di sini.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <p id="redemption-no-results" class="hidden px-3 py-6 text-center text-[10px] text-[#87948b]">Tidak ada pengguna yang cocok dengan pencarian.</p>
            </div>
        </section>
    </div>
    <div id="add-reward-modal"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-[#0b251b]/60 p-4 backdrop-blur-sm">
        <div role="dialog" aria-modal="true" aria-labelledby="add-reward-title"
            class="flex max-h-[90vh] min-h-[248px] w-full max-w-[454px] flex-col overflow-y-auto rounded-lg border border-[#d6d1c5] bg-[#f7f4e9] shadow-2xl">
            <div class="border-b border-[#315d41] bg-[#103a2a] px-4 py-3">
                <h2 id="add-reward-title" class="display-font text-base font-medium text-[#fffdf7]">Tambah Hadiah</h2>
            </div>

            <form action="{{ route('admin.hadiah.store') }}" method="POST" class="flex min-h-[198px] flex-col gap-3 px-4 py-3">
                @csrf
                <div>
                    <label for="reward-product" class="mb-1 block text-[8px] font-semibold uppercase tracking-[0.08em] text-[#52645a]">
                        Nama Produk<span class="text-[#b8292e]">*</span>
                    </label>
                    <select id="reward-product" name="id_produk" required
                        class="w-full rounded-md border border-[#e8dfd1] bg-white px-2.5 py-2 text-[10px] uppercase text-[#30483a] outline-none focus:border-[#64835d] focus:ring-1 focus:ring-[#64835d]/20"
                        @disabled($produkTersedia->isEmpty())>
                        <option value="">
                            {{ $produkTersedia->isEmpty() ? 'Belum ada produk yang tersedia' : 'Pilih produk untuk hadiah' }}
                        </option>
                        @foreach ($produkTersedia as $produk)
                            <option value="{{ $produk->id_produk }}" @selected(old('id_produk') == $produk->id_produk)>
                                {{ $produk->nama_produk }} ({{ number_format($produk->stok) }} pcs)
                            </option>
                        @endforeach
                    </select>
                    @error('id_produk')
                        <p class="mt-1 text-[9px] text-red-700">{{ $message }}</p>
                    @enderror
                    @if ($produkTersedia->isEmpty())
                        <p class="mt-1 text-[9px] text-[#87948b]">Tambahkan produk di Manajemen Produk sebelum menjadikannya hadiah.</p>
                    @endif
                </div>

                <div>
                    <label for="reward-points" class="mb-1 block text-[8px] font-semibold uppercase tracking-[0.08em] text-[#b8292e]">
                        Poin yang Dibutuhkan<span>*</span>
                    </label>
                    <input id="reward-points" name="poin_dibutuhkan" type="number" min="1" step="1"
                        value="{{ old('poin_dibutuhkan', 70) }}" required
                        class="w-full rounded-md border border-[#e8dfd1] bg-white px-2 py-2 text-[10px] text-[#30483a] outline-none focus:border-[#64835d] focus:ring-1 focus:ring-[#64835d]/20"
                        placeholder="Contoh: 70">
                    @error('poin_dibutuhkan')
                        <p class="mt-1 text-[9px] text-red-700">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-1 flex justify-end gap-2 border-t border-[#e8dfd1] pt-2">
                    <button type="button" onclick="closeAddRewardModal()"
                        class="min-w-[68px] rounded-md border border-[#d9d4c6] bg-[#fffdf7] px-3 py-2 text-[9px] font-semibold uppercase text-[#52645a] transition hover:bg-[#f5f0e2]">
                        Batal
                    </button>
                    <button type="submit" @disabled($produkTersedia->isEmpty())
                        class="inline-flex min-w-[94px] items-center justify-center gap-1 rounded-md bg-[#103a2a] px-3 py-2 text-[9px] font-semibold uppercase text-white transition hover:bg-[#315d41] disabled:cursor-not-allowed disabled:opacity-50">
                        <svg class="h-2.5 w-2.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m5 12 4 4L19 6" />
                        </svg>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div id="rejection-detail-modal"
        class="hidden fixed inset-0 z-50 flex items-center justify-center bg-[#0b251b]/60 p-4 backdrop-blur-sm">
        <div class="w-full max-w-md rounded-lg bg-white shadow-2xl">
            <div class="flex items-center justify-between border-b border-[#edf0eb] px-5 py-4">
                <div>
                    <p class="text-[9px] font-semibold uppercase tracking-[0.17em] text-[#64835d]">Riwayat Klaim</p>
                    <h2 class="display-font mt-1 text-xl font-semibold text-[#183b2c]">Detail Penolakan</h2>
                </div>
                <button type="button" aria-label="Tutup detail penolakan" onclick="closeRejectionDetails()"
                    class="text-2xl text-[#718078] transition hover:text-[#30483a]">&times;</button>
            </div>
            <div class="space-y-2 px-5 py-4">
                <p id="rejection-detail-user" class="text-sm font-semibold text-[#30483a]"></p>
                <p id="rejection-detail-reason" class="text-xs leading-relaxed text-[#655c54]"></p>
            </div>
            <div class="flex justify-end border-t border-[#edf0eb] px-5 py-3">
                <button type="button" onclick="closeRejectionDetails()"
                    class="rounded-sm bg-[#103a2a] px-4 py-2 text-xs font-semibold text-white transition hover:bg-[#315d41]">Tutup</button>
            </div>
        </div>
    </div>
    {{-- Modal Tolak Klaim --}}
    <div id="reject-modal"
        class="hidden fixed inset-0 z-50 flex items-center justify-center bg-[#0b251b]/60 p-4 backdrop-blur-sm">
        <div class="w-full max-w-md bg-white rounded-lg shadow-2xl">
            <div class="border-b border-[#edf0eb] px-6 py-4 flex items-center justify-between">
                <div>
                    <p class="text-[9px] font-semibold uppercase tracking-[0.17em] text-[#64835d]">Tolak Klaim Hadiah</p>
                    <h2 class="display-font mt-1 text-xl font-semibold text-[#183b2c]">Tolak Klaim <span
                            id="reject-user-name"></span></h2>
                </div>
                <button onclick="closeRejectModal()"
                    class="text-2xl text-[#718078] hover:text-[#30483a] transition">&times;</button>
            </div>

            <form id="reject-form" method="POST" class="p-6 space-y-4">
                @csrf
                @method('POST')

                <div>
                    <label class="block text-[10px] font-semibold uppercase tracking-[0.15em] text-[#64835d] mb-1.5">Alasan
                        Penolakan</label>
                    <textarea name="alasan_tolak" rows="3" placeholder="Contoh: Alamat tidak lengkap, stok habis, dll..."
                        class="w-full px-3 py-2.5 bg-[#f9fcf9] border border-[#dce7dc] rounded-md text-sm focus:border-[#103a2a] focus:ring-1 focus:ring-[#103a2a]/20 outline-none resize-none"></textarea>
                    <p class="mt-1 text-[10px] text-[#87948b]">⚠️ Poin user akan dikembalikan jika klaim ditolak.</p>
                </div>

                <div class="flex justify-end gap-2 border-t border-[#edf0eb] pt-4">
                    <button type="button" onclick="closeRejectModal()"
                        class="border border-[#dce7dc] px-4 py-2 text-sm text-[#52645a] hover:bg-[#f7faf7] rounded-md transition">Batal</button>
                    <button type="submit"
                        class="bg-red-600 px-5 py-2 text-sm font-semibold text-white hover:bg-red-700 rounded-md transition">Tolak
                        Klaim</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openAddRewardModal() {
            document.getElementById('add-reward-modal').classList.remove('hidden');
            document.getElementById('add-reward-modal').classList.add('flex');
        }

        function closeAddRewardModal() {
            document.getElementById('add-reward-modal').classList.add('hidden');
            document.getElementById('add-reward-modal').classList.remove('flex');
        }

        document.getElementById('add-reward-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeAddRewardModal();
            }
        });

        @if ($errors->has('id_produk') || $errors->has('poin_dibutuhkan'))
            openAddRewardModal();
        @endif

        function openRejectModal(id, userName) {
            document.getElementById('reject-user-name').textContent = userName;
            document.getElementById('reject-form').action = `/admin/hadiah/${id}/reject`;
            document.getElementById('reject-modal').classList.remove('hidden');
        }

        function closeRejectModal() {
            document.getElementById('reject-modal').classList.add('hidden');
            document.querySelector('#reject-form textarea').value = '';
        }

        document.getElementById('reject-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeRejectModal();
            }
        });

        function openRejectionDetails(userName, reason) {
            document.getElementById('rejection-detail-user').textContent = userName;
            document.getElementById('rejection-detail-reason').textContent = reason;
            document.getElementById('rejection-detail-modal').classList.remove('hidden');
        }

        function closeRejectionDetails() {
            document.getElementById('rejection-detail-modal').classList.add('hidden');
        }

        document.getElementById('rejection-detail-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeRejectionDetails();
            }
        });

        const redemptionSearch = document.getElementById('redemption-search');
        const redemptionRows = document.querySelectorAll('[data-redemption-row]');
        const noRedemptionResults = document.getElementById('redemption-no-results');

        redemptionSearch.addEventListener('input', function() {
            const query = this.value.trim().toLowerCase();
            let visibleRows = 0;

            redemptionRows.forEach(function(row) {
                const matches = row.textContent.toLowerCase().includes(query);
                row.classList.toggle('hidden', !matches);

                if (matches) {
                    visibleRows += 1;
                }
            });

            noRedemptionResults.classList.toggle('hidden', visibleRows > 0 || redemptionRows.length === 0);
        });
    </script>
@endsection
