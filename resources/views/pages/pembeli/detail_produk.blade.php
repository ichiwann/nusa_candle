@extends('layouts.pembeli')

@section('title',
    ($isPreview ?? false ? 'NusaCandle - Lilin Aroma Terapi Aroma Apel' : $produk->nama_produk) .
    ' -
    NusaCandle')

@section('content')
    <style>
        body>nav {
            background-color: #faf7ed !important;
            border-top: 3px solid #8b1e1e;
            box-shadow: none !important;
        }

        body>main {
            background-color: #faf7ed;
        }

        body>footer {
            background-color: #f5f0e2 !important;
            border-top-color: #e8dfcd !important;
        }

        /* Sembunyikan spinner input number agar angka terlihat bersih */
        #input-jumlah::-webkit-outer-spin-button,
        #input-jumlah::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        #input-jumlah {
            -moz-appearance: textfield;
            appearance: textfield;
        }
    </style>

    {{-- Breadcrumb --}}
    <div class="bg-[#faf7ed]">
        <div class="mx-auto max-w-6xl px-4 py-3 sm:px-6 lg:px-8">
            <div class="flex flex-wrap items-center gap-2 text-[10px] text-[#796d5d] sm:text-xs">
                <a href="{{ route('home') }}" class="transition hover:text-[#8B1E1E]">Beranda</a>
                <span>/</span>
                <a href="{{ route('produk.index') }}" class="transition hover:text-[#8B1E1E]">Produk</a>
                <span>/</span>
                <span
                    class="font-semibold text-[#8B1E1E]">{{ Str::limit($isPreview ?? false ? 'NusaCandle - Lilin Aroma Terapi Aroma Apel' : $produk->nama_produk, 48) }}</span>
            </div>
        </div>
    </div>

    <div class="mx-auto max-w-6xl bg-[#faf7ed] px-4 pb-10 pt-2 sm:px-6 lg:px-8">
        <div
            class="mb-10 grid grid-cols-1 items-start gap-6 min-[480px]:grid-cols-[1.15fr_0.85fr] min-[480px]:gap-5 lg:gap-8">
            {{-- Kolom Kiri - Gambar Produk --}}
            <div class="min-w-0">
                {{-- Gambar Utama --}}
                <div
                    class="relative mb-3 aspect-[1.44] overflow-hidden rounded-xl border border-[#e6ddcd] bg-[#e8dfd0] shadow-sm">
                    @if ($produk->gambar)
                        <img src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->nama_produk }}"
                            class="absolute inset-0 h-full w-full object-cover">
                    @else
                        <svg class="absolute inset-0 h-full w-full" viewBox="0 0 720 500" role="img"
                            aria-label="Lilin aromaterapi NusaCandle dengan apel dan bunga">
                            <defs>
                                <linearGradient id="scene-wall" x1="0" y1="0" x2="1" y2="1">
                                    <stop offset="0" stop-color="#b9a98d" />
                                    <stop offset=".5" stop-color="#eee3cf" />
                                    <stop offset="1" stop-color="#89745c" />
                                </linearGradient>
                                <linearGradient id="scene-table" x1="0" y1="0" x2="0"
                                    y2="1">
                                    <stop offset="0" stop-color="#b28b5e" />
                                    <stop offset="1" stop-color="#624937" />
                                </linearGradient>
                                <linearGradient id="scene-glass" x1="0" y1="0" x2="1"
                                    y2="0">
                                    <stop offset="0" stop-color="#263d2d" stop-opacity=".92" />
                                    <stop offset=".24" stop-color="#66734a" stop-opacity=".9" />
                                    <stop offset=".76" stop-color="#303d2d" stop-opacity=".97" />
                                    <stop offset="1" stop-color="#17271f" stop-opacity=".94" />
                                </linearGradient>
                                <radialGradient id="scene-glow">
                                    <stop offset="0" stop-color="#fff5c3" stop-opacity=".9" />
                                    <stop offset="1" stop-color="#f8a84a" stop-opacity="0" />
                                </radialGradient>
                                <filter id="scene-blur">
                                    <feGaussianBlur stdDeviation="13" />
                                </filter>
                                <filter id="scene-shadow">
                                    <feGaussianBlur stdDeviation="12" />
                                </filter>
                            </defs>
                            <rect width="720" height="500" fill="url(#scene-wall)" />
                            <g opacity=".58" filter="url(#scene-blur)">
                                <rect x="28" y="35" width="220" height="215" rx="18" fill="#eee7d9" />
                                <rect x="58" y="55" width="86" height="177" fill="#b9c3aa" />
                                <rect x="154" y="55" width="66" height="177" fill="#d3c7b1" />
                                <circle cx="545" cy="111" r="95" fill="#f3e6cf" />
                                <circle cx="610" cy="190" r="81" fill="#75815b" opacity=".7" />
                                <circle cx="95" cy="287" r="75" fill="#738359" opacity=".8" />
                            </g>
                            <path d="M0 338c126-24 220-5 346-18 122-13 253-3 374-26v206H0z" fill="url(#scene-table)" />
                            <path d="M0 371c168-26 277-6 420-21 124-13 212-5 300-25" fill="none" stroke="#d3b184"
                                stroke-opacity=".38" stroke-width="5" />
                            <g fill="none" stroke="#506342" stroke-linecap="round" stroke-width="8" opacity=".82">
                                <path
                                    d="M34 347c36-68 53-116 41-183m1 121c-31-7-48-25-57-52m62 9c30-13 48-36 53-68m457 172c-3-69 20-119 68-157m-47 99c-31-8-48-29-53-57m76 22c28-9 45-28 55-58" />
                            </g>
                            <g fill="#e5e0d0" stroke="#c7b99d" stroke-width="2">
                                <circle cx="52" cy="171" r="17" />
                                <circle cx="79" cy="161" r="16" />
                                <circle cx="68" cy="190" r="17" />
                                <circle cx="640" cy="197" r="15" />
                                <circle cx="667" cy="185" r="17" />
                                <circle cx="655" cy="215" r="16" />
                            </g>
                            <g fill="#d7bb75">
                                <circle cx="68" cy="178" r="5" />
                                <circle cx="655" cy="199" r="5" />
                            </g>
                            <ellipse cx="360" cy="425" rx="184" ry="24" fill="#34281e"
                                opacity=".38" filter="url(#scene-shadow)" />
                            <ellipse cx="360" cy="185" rx="105" ry="27"
                                fill="url(#scene-glow)" />
                            <path d="M360 104c-23 32-19 48 0 59 19-12 23-28 0-59z" fill="#f69b35" />
                            <path d="M360 119c-11 17-9 26 0 32 9-7 11-15 0-32z" fill="#fff3bc" />
                            <path d="M356 158h8v42h-8z" fill="#473329" />
                            <rect x="258" y="191" width="204" height="220" rx="34" fill="url(#scene-glass)"
                                stroke="#d7c9a8" stroke-width="5" />
                            <ellipse cx="360" cy="198" rx="99" ry="21" fill="#d6c9aa"
                                stroke="#f4ead4" stroke-width="4" />
                            <ellipse cx="360" cy="198" rx="83" ry="13" fill="#a88e64" />
                            <path d="M276 220v150m16-145v119m136-117v154" stroke="#e9e3ce" stroke-opacity=".44"
                                stroke-width="8" />
                            <rect x="288" y="285" width="144" height="79" rx="5" fill="#e7dfc9"
                                stroke="#b6a581" stroke-width="3" />
                            <path d="M302 301h116" stroke="#75834f" stroke-width="4" />
                            <text x="360" y="326" text-anchor="middle" fill="#4a5739" font-family="Georgia,serif"
                                font-size="17" font-weight="bold">NUSACANDLE</text>
                            <text x="360" y="348" text-anchor="middle" fill="#74664d" font-family="Arial,sans-serif"
                                font-size="11" letter-spacing="2">ARTISAN MALANG</text>
                            <path d="M130 403c18-29 54-35 77-11 23 25 4 57-28 63-32 6-65-22-49-52z" fill="#b73a32" />
                            <path d="M150 390c8-13 19-18 31-15-5 11-13 17-26 20z" fill="#536c3d" />
                            <path d="M507 400c21-26 57-28 76-2 18 26-4 56-36 59-34 2-59-29-40-57z" fill="#718247" />
                            <path d="M529 386c7-12 19-17 31-13-5 10-13 16-26 18z" fill="#425d34" />
                            <path d="M0 468c145-30 277-7 405-16 121-9 215-3 315-26v74H0z" fill="#49372a" opacity=".34" />
                        </svg>
                    @endif

                    {{-- Badge --}}
                    <div class="absolute left-3 top-3">
                        <span
                            class="flex items-center gap-1.5 rounded-full bg-[#2e713f] px-2.5 py-1 text-[9px] font-semibold text-white shadow-sm sm:text-[10px]">
                            <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                            100% Lilin Kedelai Alami
                        </span>
                    </div>
                    <span
                        class="absolute right-3 top-3 rounded-full bg-[#8B1E1E] px-3 py-1 text-[9px] font-semibold text-white shadow-sm sm:text-[10px]">Terlaris</span>

                    {{-- Badge Artisan --}}
                    <div
                        class="absolute bottom-3 right-3 flex items-center gap-1.5 rounded-full bg-white/90 px-2.5 py-1.5 text-[9px] font-semibold text-[#2C1810] shadow-sm backdrop-blur sm:text-[10px]">
                        <svg class="h-3.5 w-3.5 text-[#8B1E1E]" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Dibuat dengan Tangan di Malang
                    </div>
                </div>

                {{-- Product image gallery --}}
                <div class="mb-4 grid grid-cols-4 gap-2">
                    @foreach ([0, 1, 2, 3] as $thumbnail)
                        <div
                            class="aspect-[2.1] overflow-hidden rounded-lg border {{ $thumbnail === 0 ? 'border-[#a75a3b] ring-1 ring-[#a75a3b]' : 'border-[#e5dccb]' }} bg-[#eee5d4]">
                            @if ($produk->gambar)
                                <img src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->nama_produk }}"
                                    class="h-full w-full object-cover {{ $thumbnail === 0 ? 'object-center' : ($thumbnail === 1 ? 'object-left' : ($thumbnail === 2 ? 'object-right' : 'object-[center_30%]')) }}">
                            @else
                                <div
                                    class="flex h-full items-center justify-center {{ ['bg-[#e2d7c2]', 'bg-[#f0e9dc]', 'bg-[#cfc2aa]', 'bg-[#e8dec9]'][$thumbnail] }}">
                                    <svg class="h-full w-full" viewBox="0 0 80 50" role="img"
                                        aria-label="Detail lilin aromaterapi">
                                        <rect width="80" height="50" fill="transparent" />
                                        <path d="M0 39c20-5 46-2 80-7v18H0z"
                                            fill="{{ ['#9d805e', '#c8b89b', '#a58a69', '#b69b76'][$thumbnail] }}" />
                                        <ellipse cx="40" cy="41" rx="17" ry="3"
                                            fill="#493a2b" opacity=".28" />
                                        <path d="M40 8c-5 7-4 10 0 13 4-3 5-6 0-13z" fill="#e99b43" />
                                        <rect x="27" y="19" width="26" height="22" rx="5"
                                            fill="{{ ['#47563d', '#dfd7c6', '#8e7958', '#555e45'][$thumbnail] }}"
                                            stroke="#d6c8a9" stroke-width="1.5" />
                                        <ellipse cx="40" cy="20" rx="11" ry="2.5"
                                            fill="#e8ddc8" />
                                        <rect x="31" y="27" width="18" height="8" rx="1"
                                            fill="#e8dfc9" />
                                        <path d="M34 30h12" stroke="#75834f" stroke-width="1" />
                                        <circle cx="17" cy="34" r="5"
                                            fill="{{ $thumbnail === 1 ? '#eee5d4' : '#b83b32' }}" />
                                        <circle cx="63" cy="35" r="4" fill="#718247" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>

                {{-- Profil Aroma --}}
                <div class="rounded-xl border border-[#e6ddcd] bg-[#f7f3e8] p-3 sm:p-4">
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[#d9efcf]">
                            <svg class="h-5 w-5 text-[#2E7D32]" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-serif text-[12px] font-bold text-[#2C1810] sm:text-sm">Profil Aroma Khas Batu &
                                Malang</h3>
                            <p class="text-[9px] leading-snug text-[#718078] sm:text-[10px]">Awal: Apel Malang Segar •
                                Tengah: Bunga Melati Putih • Dasar:
                                Vanili Lembut</p>
                        </div>
                        <span
                            class="ml-auto whitespace-nowrap rounded-full bg-[#dff0d8] px-2.5 py-1.5 text-[8px] font-semibold text-[#2E7D32]">Mutu
                            Terapi</span>
                    </div>
                </div>
            </div>

            {{-- Kolom Kanan - Info Produk --}}
            <div class="min-w-0">
                {{-- Badge --}}
                <div class="mb-2 flex flex-wrap gap-2">
                    <span
                        class="rounded-full bg-[#dff0d8] px-2.5 py-1 text-[9px] font-semibold text-[#2E7D32] sm:text-[10px]">Asli
                        Khas
                        Malang</span>
                    <span
                        class="rounded-full bg-[#8B1E1E] px-2.5 py-1 text-[9px] font-semibold text-white sm:text-[10px]">Terlaris</span>
                </div>

                {{-- Judul --}}
                <h1 class="mb-2 font-serif text-[21px] font-bold leading-[1.15] text-[#2C1810] sm:text-2xl">
                    {{ $isPreview ?? false ? 'NusaCandle - Lilin Aroma Terapi Aroma Apel' : $produk->nama_produk }}
                </h1>

                {{-- Rating --}}
                <div class="mb-4 flex flex-wrap items-center gap-1.5 text-[10px]">
                    <div class="flex items-center gap-1.5">
                        @for ($i = 1; $i <= 5; $i++)
                            <svg class="h-3 w-3 text-[#e77a18]" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                        <span class="ml-0.5 font-bold text-[#2C1810]">4.9</span>
                    </div>
                    <span class="text-[#718078]">•</span>
                    <span class="font-medium text-[#8B1E1E]">486 Ulasan</span>
                    <span class="text-[#718078]">•</span>
                    <span class="text-[#718078]">1.2k+ Terjual</span>
                </div>

                {{-- Harga --}}
                <div class="mb-3 rounded-xl border border-[#eee5d7] bg-[#f7f3e8] p-3 sm:p-4">
                    <div class="mb-1.5 flex items-center justify-between">
                        <p class="text-[9px] font-semibold uppercase tracking-wider text-[#796d5d]">Harga Resmi Perajin</p>
                        <span class="rounded bg-[#FCE4EC] px-2 py-1 text-[9px] font-semibold text-[#8B1E1E]">Hemat
                            22%</span>
                    </div>
                    <div class="flex flex-wrap items-baseline gap-2">
                        <span class="font-serif text-2xl font-bold text-[#8B1E1E] sm:text-3xl">Rp
                            {{ number_format($produk->harga, 0, ',', '.') }}</span>
                        <span class="text-[11px] text-[#8f8374] line-through">Rp
                            {{ number_format($produk->harga + ($isPreview ?? false ? 26000 : 25000), 0, ',', '.') }}</span>
                    </div>
                </div>

                {{-- Stok --}}
                <div class="mb-3 flex items-center gap-2 rounded-md border border-[#d4e8ce] bg-[#e5f3df] p-2">
                    <svg class="h-4 w-4 shrink-0 text-[#2E7D32]" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    <p class="text-[9px] text-[#1B5E20] sm:text-[10px]">
                        <strong>Stok Tersedia:</strong> {{ $produk->stok }} item di Studio Batu Malang
                    </p>
                </div>

                {{-- Tentang Produk --}}
                <div class="mb-3">
                    <h3 class="mb-1.5 font-serif text-[10px] font-bold tracking-wide text-[#2C1810]">TENTANG PRODUK</h3>
                    <p class="text-[10px] leading-[1.5] text-[#625b50]">
                        Lilin aroma terapi NusaCandle dibuat dengan tangan menggunakan 100% lilin kedelai alami
                        dan minyak esensial apel khas perkebunan Malang. Menghadirkan aroma manis, segar, dan menenangkan
                        yang menyelimuti ruangan Anda, meredakan ketegangan setelah beraktivitas, serta menciptakan
                        kenyamanan tidur yang berkualitas.
                    </p>
                </div>

                {{-- Fitur Produk --}}
                <div class="mb-3 grid grid-cols-3 gap-2">
                    <div class="rounded-lg border border-[#e9dfcf] bg-[#f7f3e8] p-2.5 text-center">
                        <svg class="mx-auto mb-1 h-4 w-4 text-[#8B1E1E]" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                        </svg>
                        <p class="text-[9px] font-semibold text-[#2C1810]">Berat Bersih</p>
                        <p class="text-[9px] text-[#718078]">220 gram</p>
                    </div>
                    <div class="rounded-lg border border-[#e9dfcf] bg-[#f7f3e8] p-2.5 text-center">
                        <svg class="mx-auto mb-1 h-4 w-4 text-[#8B1E1E]" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-[9px] font-semibold text-[#2C1810]">Waktu Bakar</p>
                        <p class="text-[9px] text-[#718078]">~45 Jam</p>
                    </div>
                    <div class="rounded-lg border border-[#e9dfcf] bg-[#f7f3e8] p-2.5 text-center">
                        <svg class="mx-auto mb-1 h-4 w-4 text-[#8B1E1E]" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-[9px] font-semibold text-[#2C1810]">Komposisi</p>
                        <p class="text-[9px] text-[#718078]">Tidak Beracun</p>
                    </div>
                </div>

                {{-- Keunggulan --}}
                <ul class="mb-3 space-y-2">
                    <li class="flex items-start gap-2 text-[9px] leading-snug text-[#625b50]">
                        <svg class="h-3.5 w-3.5 flex-shrink-0 text-[#2E7D32]" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Bebas dari parafin sintetis, timbal, dan zat phthalate.
                    </li>
                    <li class="flex items-start gap-2 text-[9px] leading-snug text-[#625b50]">
                        <svg class="h-3.5 w-3.5 flex-shrink-0 text-[#2E7D32]" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Menggunakan sumbu ganda 100% katun murni tanpa jelaga hitam.
                    </li>
                    <li class="flex items-start gap-2 text-[9px] leading-snug text-[#625b50]">
                        <svg class="h-3.5 w-3.5 flex-shrink-0 text-[#2E7D32]" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Bonus tatakan kayu jati mini & korek api kayu estetik di setiap paket.
                    </li>
                </ul>

                {{-- Jumlah Produk --}}
                @if ($isPreview ?? false)
                    <div class="mb-3" role="group" aria-label="Jumlah dan pembelian produk pratinjau">
                        <div class="mb-2 flex flex-wrap items-center gap-2">
                            <span class="text-[10px] font-semibold text-[#2C1810]">Jumlah Produk</span>
                            <div class="flex items-center overflow-hidden rounded-md border border-[#ddd4c6] bg-white">
                                <button type="button" disabled aria-label="Kurangi jumlah"
                                    class="px-3 py-1.5 text-sm text-[#9b9184]">−</button>
                                <span
                                    class="border-x border-[#eee8dc] px-3 py-1.5 text-center text-[10px] font-semibold">1</span>
                                <button type="button" disabled aria-label="Tambah jumlah"
                                    class="px-3 py-1.5 text-sm text-[#9b9184]">+</button>
                            </div>
                            <span class="text-[9px] text-[#718078]">Maks. {{ $produk->stok }} pcs</span>
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <button type="button" disabled title="Produk pratinjau belum dapat dibeli"
                                class="flex items-center justify-center gap-2 rounded-md bg-[#f3efe6] px-2 py-2 text-[9px] font-semibold text-[#8B1E1E] sm:text-[10px]">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                Tambah ke Keranjang
                            </button>
                            <button type="button" disabled title="Produk pratinjau belum dapat dibeli"
                                class="flex items-center justify-center gap-2 rounded-md bg-[#8B1E1E] px-2 py-2 text-[9px] font-semibold text-white sm:text-[10px]">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                                Beli Sekarang
                            </button>
                        </div>
                    </div>
                @else
                    <form action="{{ route('keranjang.store') }}" method="POST" id="form-keranjang" class="mb-3">
                        @csrf
                        <input type="hidden" name="id_produk" value="{{ $produk->id_produk }}">
                        <div class="mb-2 flex flex-wrap items-center gap-2">
                            <label for="input-jumlah" class="text-[10px] font-semibold text-[#2C1810]">Jumlah
                                Produk</label>
                            <div class="flex items-center overflow-hidden rounded-md border border-[#ddd4c6] bg-white">
                                <button type="button" onclick="ubahJumlah(-1)" aria-label="Kurangi jumlah"
                                    class="px-3 py-1.5 text-sm text-[#718078] transition hover:bg-gray-100">−</button>
                                <input type="number" name="jumlah" id="input-jumlah" value="1" min="1"
                                    max="{{ $produk->stok }}"
                                    class="w-12 border-x border-[#eee8dc] bg-white py-1.5 text-center text-xs font-bold text-[#2C1810] focus:outline-none"
                                    readonly>
                                <button type="button" onclick="ubahJumlah(1)" aria-label="Tambah jumlah"
                                    class="px-3 py-1.5 text-sm text-[#718078] transition hover:bg-gray-100">+</button>
                            </div>
                            <span class="text-[9px] text-[#718078]">Maks. {{ $produk->stok }} pcs</span>
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <button type="submit"
                                class="flex items-center justify-center gap-2 rounded-md bg-[#f3efe6] px-2 py-2 text-[9px] font-semibold text-[#8B1E1E] transition hover:bg-[#e9e1d3] sm:text-[10px]">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                Tambah ke Keranjang
                            </button>
                            <button type="button"
                                class="flex items-center justify-center gap-2 rounded-md bg-[#8B1E1E] px-2 py-2 text-[9px] font-semibold text-white transition hover:bg-[#6B1515] sm:text-[10px]">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                                Beli Sekarang
                            </button>
                        </div>
                    </form>
                @endif

                {{-- Garansi --}}
                <div class="flex flex-wrap items-center gap-3 text-[9px] text-[#718078]">
                    <div class="flex items-center gap-1.5">
                        <svg class="h-4 w-4 text-[#2E7D32]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        Garansi 100% Tukar Pecah
                    </div>
                    <div class="flex items-center gap-1.5">
                        <svg class="h-4 w-4 text-[#2E7D32]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                        </svg>
                        Pengiriman Ekstra Bubble
                    </div>
                </div>
            </div>
        </div>

        {{-- Panduan Perawatan --}}
        <section class="rounded-xl border border-[#eee5d7] bg-[#f7f3e8] p-5 sm:p-7">
            <p class="mb-2 text-[9px] font-semibold uppercase tracking-[0.16em] text-[#8B1E1E]">Panduan Perawatan</p>
            <h2 class="mb-2 font-serif text-lg font-bold text-[#2C1810] sm:text-xl">Tips Menikmati Lilin Aromaterapi
                NusaCandle</h2>
            <p class="max-w-4xl text-[10px] leading-relaxed text-[#625b50] sm:text-[11px]">
                Agar aroma buah apel Malang menguap optimal, biarkan lilin menyala selama minimal 2 jam pada pembakaran
                pertama hingga permukaan lilin mencair merata ke tepi wadah. Potong sumbu katun menjadi 5mm sebelum
                dinyalakan kembali.
            </p>
        </section>
    </div>

    @unless ($isPreview ?? false)
        <script>
            function ubahJumlah(delta) {
                const input = document.getElementById('input-jumlah');
                const max = {{ $produk->stok }};
                let nilai = parseInt(input.value) + delta;

                if (nilai < 1) nilai = 1;
                if (nilai > max) nilai = max;

                input.value = nilai;
            }
        </script>
    @endunless
@endsection
