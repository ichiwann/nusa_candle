@extends('layouts.pembeli')

@section('title', $produk->nama_produk . ' - NusaCandle')

@section('content')
    {{-- Breadcrumb --}}
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center gap-2 text-sm">
                <a href="{{ route('home') }}" class="text-[#718078] hover:text-[#8B1E1E]">Beranda</a>
                <span class="text-[#718078]">/</span>
                <a href="{{ route('produk.index') }}" class="text-[#718078] hover:text-[#8B1E1E]">Produk</a>
                <span class="text-[#718078]">/</span>
                <span class="text-[#8B1E1E] font-semibold">{{ Str::limit($produk->nama_produk, 40) }}</span>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid lg:grid-cols-2 gap-8 mb-12">
            {{-- Kolom Kiri - Gambar Produk --}}
            <div>
                {{-- Gambar Utama --}}
                <div class="relative mb-4">
                    @if ($produk->gambar)
                        <img src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->nama_produk }}"
                            class="w-full h-[500px] object-cover rounded-lg">
                    @else
                        <div class="w-full h-[500px] bg-gray-200 rounded-lg flex items-center justify-center">
                            <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    @endif

                    {{-- Badge --}}
                    <div class="absolute top-4 left-4 flex flex-col gap-2">
                        <span
                            class="bg-[#8B1E1E] text-white text-xs font-semibold px-3 py-1 rounded-full flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                            Terlaris Musim Ini
                        </span>
                        <span
                            class="bg-[#2E7D32] text-white text-xs font-semibold px-3 py-1 rounded-full flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            100% Soy Wax Kedelai Alami
                        </span>
                    </div>

                    {{-- Badge Artisan --}}
                    <div
                        class="absolute bottom-4 right-4 bg-white/90 backdrop-blur px-3 py-1.5 rounded-full text-xs font-semibold text-[#2C1810] flex items-center gap-1">
                        <svg class="w-4 h-4 text-[#8B1E1E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Artisan Hand-Poured Malang
                    </div>
                </div>

                {{-- Gambar Utama (Full Size, Tanpa Thumbnail) --}}
                <div class="relative">
                    @if ($produk->gambar)
                        <img src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->nama_produk }}"
                            class="w-full h-[600px] object-cover rounded-lg">
                    @else
                        <div class="w-full h-[600px] bg-gray-200 rounded-lg flex items-center justify-center">
                            <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    @endif

                    {{-- Badge --}}
                    <div class="absolute top-4 left-4 flex flex-col gap-2">
                        <span
                            class="bg-[#8B1E1E] text-white text-xs font-semibold px-3 py-1 rounded-full flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                            Terlaris Musim Ini
                        </span>
                        <span
                            class="bg-[#2E7D32] text-white text-xs font-semibold px-3 py-1 rounded-full flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            100% Soy Wax Kedelai Alami
                        </span>
                    </div>

                    {{-- Badge Artisan --}}
                    <div
                        class="absolute bottom-4 right-4 bg-white/90 backdrop-blur px-3 py-1.5 rounded-full text-xs font-semibold text-[#2C1810] flex items-center gap-1">
                        <svg class="w-4 h-4 text-[#8B1E1E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Artisan Hand-Poured Malang
                    </div>
                </div>

                {{-- Profil Aroma --}}
                <div class="mt-6 bg-white border border-gray-200 rounded-lg p-6">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-12 h-12 bg-[#E8F5E9] rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-[#2E7D32]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-serif text-lg font-bold text-[#2C1810]">Profil Aroma Khas Batu & Malang</h3>
                            <p class="text-xs text-[#718078]">Top: Apel Malang Segar • Heart: Bunga Melati Putih • Base:
                                Vanili Lembut</p>
                        </div>
                        <span
                            class="ml-auto bg-[#E8F5E9] text-[#2E7D32] text-xs font-semibold px-3 py-1 rounded-full">Therapeutic
                            Grade</span>
                    </div>
                </div>
            </div>

            {{-- Kolom Kanan - Info Produk --}}
            <div>
                {{-- Badge --}}
                <div class="flex flex-wrap gap-2 mb-3">
                    <span class="bg-[#E8F5E9] text-[#2E7D32] text-xs font-semibold px-3 py-1 rounded-full">Original Khas
                        Malang</span>
                    <span class="bg-[#8B1E1E] text-white text-xs font-semibold px-3 py-1 rounded-full">Terlaris</span>
                    <span class="bg-gray-100 text-[#718078] text-xs font-semibold px-3 py-1 rounded-full">Batch
                        #MLG-084</span>
                </div>

                {{-- Judul --}}
                <h1 class="font-serif text-3xl lg:text-4xl font-bold text-[#2C1810] mb-3">{{ $produk->nama_produk }}</h1>

                {{-- Rating --}}
                <div class="flex items-center gap-3 mb-6">
                    <div class="flex items-center gap-1">
                        @for ($i = 1; $i <= 5; $i++)
                            <svg class="w-5 h-5 {{ $i <= 4 ? 'text-yellow-500' : 'text-gray-300' }}" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                        <span class="font-bold text-[#2C1810] ml-1">4.9</span>
                    </div>
                    <span class="text-sm text-[#718078]">•</span>
                    <span class="text-sm text-[#718078]">486 Ulasan</span>
                    <span class="text-sm text-[#718078]">•</span>
                    <span class="text-sm text-[#718078]">1.2k+ Terjual</span>
                </div>

                {{-- Harga --}}
                <div class="bg-[#FAF9F6] rounded-lg p-5 mb-6">
                    <div class="flex items-center justify-between mb-2">
                        <p class="text-xs font-semibold uppercase tracking-wider text-[#718078]">Harga Resmi Artisan</p>
                        <span class="bg-[#FCE4EC] text-[#8B1E1E] text-xs font-semibold px-2 py-1 rounded">Hemat 22%</span>
                    </div>
                    <div class="flex items-baseline gap-3">
                        <span class="font-serif text-4xl font-bold text-[#8B1E1E]">Rp
                            {{ number_format($produk->harga, 0, ',', '.') }}</span>
                        <span class="text-lg text-[#718078] line-through">Rp
                            {{ number_format($produk->harga + 25000, 0, ',', '.') }}</span>
                    </div>
                </div>

                {{-- Stok --}}
                <div class="bg-[#E8F5E9] border border-[#C8E6C9] rounded-lg p-3 mb-6 flex items-center gap-2">
                    <svg class="w-5 h-5 text-[#2E7D32]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    <p class="text-sm text-[#1B5E20]">
                        <strong>Ready Stock:</strong> {{ $produk->stok }} item tersedia di Studio Batu Malang
                    </p>
                </div>

                {{-- Tentang Produk --}}
                <div class="mb-6">
                    <h3 class="font-serif text-lg font-bold text-[#2C1810] mb-3">TENTANG PRODUK</h3>
                    <p class="text-sm text-[#718078] leading-relaxed">
                        Lilin aroma terapi NusaCandle dibuat secara artisanal menggunakan 100% lilin kedelai alami (soy wax)
                        dan minyak esensial apel khas perkebunan Malang. Menghadirkan aroma manis, segar, dan menenangkan
                        yang menyelimuti ruangan Anda, meredakan ketegangan setelah beraktivitas, serta menciptakan
                        kenyamanan tidur yang berkualitas.
                    </p>
                </div>

                {{-- Fitur Produk --}}
                <div class="grid grid-cols-3 gap-3 mb-6">
                    <div class="bg-[#FAF9F6] border border-gray-200 rounded-lg p-3 text-center">
                        <svg class="w-6 h-6 text-[#8B1E1E] mx-auto mb-1" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                        </svg>
                        <p class="text-xs font-semibold text-[#2C1810]">Berat Bersih</p>
                        <p class="text-[10px] text-[#718078]">220 gram</p>
                    </div>
                    <div class="bg-[#FAF9F6] border border-gray-200 rounded-lg p-3 text-center">
                        <svg class="w-6 h-6 text-[#8B1E1E] mx-auto mb-1" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-xs font-semibold text-[#2C1810]">Waktu Bakar</p>
                        <p class="text-[10px] text-[#718078]">~45 Jam</p>
                    </div>
                    <div class="bg-[#FAF9F6] border border-gray-200 rounded-lg p-3 text-center">
                        <svg class="w-6 h-6 text-[#8B1E1E] mx-auto mb-1" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-xs font-semibold text-[#2C1810]">Komposisi</p>
                        <p class="text-[10px] text-[#718078]">Non-Toxic</p>
                    </div>
                </div>

                {{-- Keunggulan --}}
                <ul class="space-y-2 mb-6">
                    <li class="flex items-start gap-2 text-sm text-[#718078]">
                        <svg class="w-5 h-5 text-[#2E7D32] flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Bebas dari parafin sintetis, timbal, dan zat phthalate.
                    </li>
                    <li class="flex items-start gap-2 text-sm text-[#718078]">
                        <svg class="w-5 h-5 text-[#2E7D32] flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Menggunakan sumbu ganda 100% katun murni tanpa jelaga hitam.
                    </li>
                    <li class="flex items-start gap-2 text-sm text-[#718078]">
                        <svg class="w-5 h-5 text-[#2E7D32] flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Bonus tatakan kayu jati mini & korek api kayu estetik di setiap paket.
                    </li>
                </ul>

                {{-- Jumlah Produk --}}
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-[#2C1810] mb-2">Jumlah Produk</label>
                    <div class="flex items-center gap-3">
                        <div class="flex items-center border border-gray-200 rounded-md">
                            <button class="px-4 py-2 text-[#718078] hover:bg-gray-100 transition">-</button>
                            <input type="number" value="1" min="1" max="{{ $produk->stok }}"
                                class="w-16 text-center border-x border-gray-200 py-2 text-sm font-semibold focus:outline-none">
                            <button class="px-4 py-2 text-[#718078] hover:bg-gray-100 transition">+</button>
                        </div>
                        <span class="text-xs text-[#718078]">Maks. {{ $produk->stok }} pcs</span>
                    </div>
                </div>

                <form action="{{ route('keranjang.store') }}" method="POST" id="form-keranjang">
                    @csrf
                    <input type="hidden" name="id_produk" value="{{ $produk->id_produk }}">

                    {{-- Jumlah Produk --}}
                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-[#2C1810] mb-2">Jumlah Produk</label>
                        <div class="flex items-center gap-3">
                            <div class="flex items-center border border-gray-200 rounded-md">
                                <button type="button" onclick="ubahJumlah(-1)"
                                    class="px-4 py-2 text-[#718078] hover:bg-gray-100 transition">-</button>
                                <input type="number" name="jumlah" id="input-jumlah" value="1" min="1"
                                    max="{{ $produk->stok }}"
                                    class="w-16 text-center border-x border-gray-200 py-2 text-sm font-semibold focus:outline-none"
                                    readonly>
                                <button type="button" onclick="ubahJumlah(1)"
                                    class="px-4 py-2 text-[#718078] hover:bg-gray-100 transition">+</button>
                            </div>
                            <span class="text-xs text-[#718078]">Maks. {{ $produk->stok }} pcs</span>
                        </div>
                    </div>

                    {{-- Tombol --}}
                    <div class="grid grid-cols-2 gap-3 mb-6">
                        <button type="submit"
                            class="border-2 border-[#8B1E1E] text-[#8B1E1E] hover:bg-[#8B1E1E] hover:text-white px-6 py-3 rounded-md font-semibold transition flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Tambah ke Keranjang
                        </button>
                        <button type="button"
                            class="bg-[#8B1E1E] hover:bg-[#6B1515] text-white px-6 py-3 rounded-md font-semibold transition flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            Beli Sekarang
                        </button>
                    </div>
                </form>

                {{-- Garansi --}}
                <div class="flex items-center gap-6 text-xs text-[#718078]">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#2E7D32]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        Garansi 100% Tukar Pecah
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#2E7D32]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                        </svg>
                        Pengiriman Ekstra Bubble
                    </div>
                </div>
            </div>
        </div>

        {{-- Panduan Perawatan --}}
        <section class="bg-[#FAF9F6] rounded-lg p-8 lg:p-12">
            <p class="text-xs font-semibold uppercase tracking-wider text-[#8B1E1E] mb-2">Panduan Perawatan</p>
            <h2 class="font-serif text-2xl font-bold text-[#2C1810] mb-4">Tips Menikmati Lilin Aromaterapi NusaCandle</h2>
            <p class="text-sm text-[#718078] leading-relaxed">
                Agar aroma buah apel Malang menguap optimal, biarkan lilin menyala selama minimal 2 jam pada pembakaran
                pertama hingga permukaan lilin mencair merata ke tepi wadah. Potong sumbu katun menjadi 5mm sebelum
                dinyalakan kembali.
            </p>
        </section>
    </div>

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
@endsection
