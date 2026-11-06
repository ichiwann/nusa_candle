@extends('layouts.pembeli')

@section('title', 'Koleksi Produk Eksklusif - NusaCandle')

@section('content')
    {{-- Hero Section --}}
    <section class="bg-[#FAF9F6] py-12 lg:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="inline-flex items-center gap-2 bg-[#E8F5E9] px-4 py-1.5 rounded-full mb-6">
                <svg class="w-4 h-4 text-[#2E7D32]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-xs font-semibold text-[#2E7D32] uppercase tracking-wider">100% Minyak Atsiri Apel Malang
                    Asli</span>
            </div>

            <h1 class="font-serif text-4xl lg:text-5xl font-bold text-[#2C1810] mb-4">
                Koleksi Produk Eksklusif <span class="text-[#8B1E1E]">NusaCandle</span>
            </h1>
            <p class="text-[#718078] max-w-3xl mx-auto leading-relaxed">
                Didedikasikan secara tunggal untuk kesempurnaan. Kami memusatkan seluruh dedikasi artisan pada satu
                mahakarya aromaterapi: keaslian wangi kebun apel lereng Gunung Panderman yang menenangkan raga dan
                menjernihkan pikiran.
            </p>
        </div>
    </section>

    {{-- Search & Filter Bar --}}
    <section class="bg-white border-b border-gray-200 py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap items-center gap-4">
                {{-- Search --}}
                <form action="{{ route('produk.index') }}" method="GET" class="flex-1 min-w-[300px] relative">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-[#718078]" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari produk atau aroma (contoh: apel, lilin, malang)..."
                        class="w-full pl-10 pr-4 py-2.5 bg-[#FAF9F6] border border-gray-200 rounded-md text-sm focus:border-[#8B1E1E] focus:ring-1 focus:ring-[#8B1E1E]/20 outline-none">
                    <button type="submit"
                        class="absolute right-2 top-1/2 -translate-y-1/2 bg-[#8B1E1E] hover:bg-[#6B1515] text-white px-4 py-1.5 rounded text-xs font-semibold transition">
                        Cari
                    </button>
                </form>

                {{-- Filter Status --}}
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-[#718078]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                    <span class="text-sm text-[#718078]">Filter Status:</span>
                    <div class="flex gap-2">
                        <a href="{{ route('produk.index', ['status' => 'ready']) }}"
                            class="px-3 py-1.5 rounded text-xs font-semibold transition {{ request('status') == 'ready' ? 'bg-[#8B1E1E] text-white' : 'bg-gray-100 text-[#718078] hover:bg-gray-200' }}">
                            ● Semua (Ready)
                        </a>
                        <a href="{{ route('produk.index', ['status' => 'preorder']) }}"
                            class="px-3 py-1.5 rounded text-xs font-semibold transition {{ request('status') == 'preorder' ? 'bg-[#8B1E1E] text-white' : 'bg-gray-100 text-[#718078] hover:bg-gray-200' }}">
                            Pre-order
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Produk Utama --}}
    @if ($produkUtama)
        <section class="bg-[#FAF9F6] py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="grid lg:grid-cols-2">
                        {{-- Gambar Produk --}}
                        <div class="relative">
                            @if ($produkUtama->gambar)
                                <img src="{{ asset('storage/' . $produkUtama->gambar) }}"
                                    alt="{{ $produkUtama->nama_produk }}" class="w-full h-[500px] object-cover">
                            @else
                                <div class="w-full h-[500px] bg-gray-200 flex items-center justify-center">
                                    <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                            <div
                                class="absolute top-4 left-4 bg-white/90 backdrop-blur px-3 py-1 rounded text-xs font-semibold text-[#2C1810]">
                                hand-poured soy candle
                            </div>
                            <div class="absolute bottom-4 left-4 right-4 flex justify-between text-xs text-white">
                                <span class="bg-black/50 backdrop-blur px-3 py-1 rounded">Netto: 220 gr / 7.7 oz</span>
                                <span class="bg-black/50 backdrop-blur px-3 py-1 rounded">🕐 45+ Jam Bakar</span>
                            </div>
                        </div>

                        {{-- Info Produk --}}
                        <div class="p-8 lg:p-12">
                            {{-- Rating & Stok --}}
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center gap-2">
                                    <div class="flex items-center gap-1">
                                        <svg class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <span class="font-bold text-[#2C1810]">4.9</span>
                                        <span class="text-sm text-[#718078]">| 520 ulasan pembeli</span>
                                    </div>
                                </div>
                                @if ($produkUtama->stok > 0)
                                    <span
                                        class="bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded-full flex items-center gap-1">
                                        <span class="w-2 h-2 rounded-full bg-green-600"></span>
                                        Tersedia: {{ $produkUtama->stok }} pcs siap kirim
                                    </span>
                                @else
                                    <span
                                        class="bg-orange-100 text-orange-800 text-xs font-semibold px-3 py-1 rounded-full">
                                        Pre-order
                                    </span>
                                @endif
                            </div>

                            {{-- Nama Produk --}}
                            <h2 class="font-serif text-3xl font-bold text-[#2C1810] mb-4">{{ $produkUtama->nama_produk }}
                            </h2>

                            {{-- Karakter Aroma --}}
                            <div class="mb-4">
                                <p class="text-xs font-semibold uppercase tracking-wider text-[#718078] mb-2">🌿 Karakter
                                    Aroma: Sari Apel Manalagi & Anna Malang Segar Berbalut Rempah Lembut</p>
                                <p class="text-sm text-[#718078] leading-relaxed">
                                    Edisi murni varietas Apel Manalagi Malang yang dipadukan dengan lilin kedelai bebas
                                    racun. Dituang tangan secara seksama oleh artisan lokal Kota Batu untuk menghadirkan
                                    atmosfer ketenangan alami.
                                </p>
                            </div>

                            {{-- Profil Aroma --}}
                            <div class="mb-6">
                                <p class="text-[10px] font-semibold uppercase tracking-wider text-[#718078] mb-2">Profil
                                    Aroma Bertingkat (Olfactive Pyramid)</p>
                                <div class="flex flex-wrap gap-2">
                                    <span
                                        class="bg-[#E8F5E9] text-[#2E7D32] text-xs font-semibold px-3 py-1 rounded-full">🍃
                                        Crisp Green & Red Apple</span>
                                    <span
                                        class="bg-[#FFF3E0] text-[#E65100] text-xs font-semibold px-3 py-1 rounded-full">🌸
                                        Subtle Cinnamon Warmth</span>
                                    <span
                                        class="bg-[#E8F5E9] text-[#2E7D32] text-xs font-semibold px-3 py-1 rounded-full">🌿
                                        Fresh Botanic Leaves</span>
                                </div>
                            </div>

                            {{-- Fitur Produk --}}
                            <div class="grid grid-cols-3 gap-3 mb-6">
                                <div class="bg-[#FAF9F6] p-3 rounded border border-gray-200">
                                    <p class="text-xs font-semibold text-[#2C1810]">100% Soy Wax</p>
                                    <p class="text-[10px] text-[#718078]">Bebas Parafin</p>
                                </div>
                                <div class="bg-[#FAF9F6] p-3 rounded border border-gray-200">
                                    <p class="text-xs font-semibold text-[#2C1810]">Clean Burn</p>
                                    <p class="text-[10px] text-[#718078]">Sumbu Katun Murni</p>
                                </div>
                                <div class="bg-[#FAF9F6] p-3 rounded border border-gray-200">
                                    <p class="text-xs font-semibold text-[#2C1810]">Grade Ekspor</p>
                                    <p class="text-[10px] text-[#718078]">Keramik Kasongan</p>
                                </div>
                            </div>

                            {{-- Harga --}}
                            <div class="mb-6">
                                <div class="flex items-baseline gap-3">
                                    <span class="font-serif text-4xl font-bold text-[#8B1E1E]">Rp
                                        {{ number_format($produkUtama->harga, 0, ',', '.') }}</span>
                                    <span class="text-lg text-[#718078] line-through">Rp
                                        {{ number_format($produkUtama->harga + 20000, 0, ',', '.') }}</span>
                                    <span class="bg-[#FCE4EC] text-[#8B1E1E] text-xs font-semibold px-2 py-1 rounded">Hemat
                                        18%</span>
                                </div>
                            </div>

                            {{-- Tombol --}}
                            <div class="flex gap-3">
                                <form action="{{ route('keranjang.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id_produk" value="{{ $produkUtama->id_produk }}">
                                    <input type="hidden" name="jumlah" value="1">
                                    <button type="submit"
                                        class="flex-1 border-2 border-[#8B1E1E] text-[#8B1E1E] hover:bg-[#8B1E1E] hover:text-white px-6 py-3 rounded-md font-semibold transition flex items-center justify-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        Tambah ke Keranjang
                                    </button>
                                </form>
                                <a href="{{ route('produk.show', $produkUtama->id_produk) }}"
                                    class="flex-1 bg-[#8B1E1E] hover:bg-[#6B1515] text-white px-6 py-3 rounded-md font-semibold transition flex items-center justify-center gap-2">
                                    Lihat Detail
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- Produk Lainnya (Segera Hadir) --}}
    <section class="bg-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-3 gap-6">
                @forelse($produkLainnya as $produk)
                    <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition">
                        <div class="flex items-center justify-between mb-3">
                            <span class="bg-[#E8F5E9] text-[#2E7D32] text-[10px] font-semibold px-2 py-1 rounded">SEGERA
                                HADIR</span>
                            <svg class="w-5 h-5 text-[#718078]" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="font-serif text-xl font-bold text-[#2C1810] mb-2">{{ $produk->nama_produk }}</h3>
                        <p class="text-sm text-[#718078] leading-relaxed mb-4">
                            Aroma khas {{ $produk->nama_produk }} yang menenangkan, diproduksi dengan bahan alami 100% dari
                            lereng gunung Malang.
                        </p>
                        <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                            <span class="text-xs text-[#718078]">Musim Panen 2025</span>
                            <span class="text-xs font-semibold text-[#8B1E1E]">Edisi Terbatas</span>
                        </div>
                    </div>
                @empty
                    <div class="md:col-span-3 text-center py-12">
                        <p class="text-sm text-[#718078]">Belum ada produk lainnya.</p>
                    </div>
                @endforelse

                {{-- Card Custom Souvenir --}}
                <div class="border border-gray-200 rounded-lg p-6 bg-[#FAF9F6]">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 rounded-full bg-[#8B1E1E] flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="font-serif text-xl font-bold text-[#2C1810] mb-2">Pesanan Khusus / Custom Souvenir</h3>
                    <p class="text-sm text-[#718078] leading-relaxed mb-4">
                        Hadirkan aroma khas apel Malang untuk pernikahan, hampers perusahaan, atau momen berharga Anda
                        dengan wadah keramik berukir nama khusus.
                    </p>
                    <a href="#"
                        class="text-sm font-semibold text-[#8B1E1E] hover:text-[#6B1515] flex items-center gap-1">
                        Hubungi Konsultan Kami
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Jaminan Keamanan --}}
    <section class="bg-[#FAF9F6] py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8">
                <p class="text-xs font-semibold uppercase tracking-wider text-[#718078] mb-2">Standard Pengiriman
                    NusaCandle</p>
                <h2 class="font-serif text-3xl font-bold text-[#2C1810]">Jaminan Keamanan Hingga Meja Anda</h2>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <div class="w-12 h-12 bg-[#FCE4EC] rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-[#8B1E1E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="font-serif text-xl font-semibold text-[#2C1810] mb-2">Proteksi Honeycomb Wrap</h3>
                    <p class="text-sm text-[#718078] leading-relaxed mb-3">
                        Setiap toples lilin dilapisi kemasan honeycomb kraft paper tebal 3 lapis ramah lingkungan plus
                        bantalan busa teruji jatuh. Garansi toples pecah kami ganti baru 100% gratis.
                    </p>
                    <p class="text-xs text-[#2E7D32] font-semibold flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Bebas Plastik Sekali Pakai
                    </p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <div class="w-12 h-12 bg-[#E8F5E9] rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-[#2E7D32]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <h3 class="font-serif text-xl font-semibold text-[#2C1810] mb-2">Jaminan Aroma Tahan Lama</h3>
                    <p class="text-sm text-[#718078] leading-relaxed mb-3">
                        Menggunakan konsentrasi fragrance load optimal 10% grade terapeutik. Aroma menyebar rata ke seluruh
                        ruangan tanpa menyebabkan sakit kepala atau rasa enek.
                    </p>
                    <p class="text-xs text-[#2E7D32] font-semibold flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Sertifikasi Formula Aman
                    </p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <div class="w-12 h-12 bg-[#E8F5E9] rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-[#2E7D32]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="font-serif text-xl font-semibold text-[#2C1810] mb-2">Batch Segar Kota Malang</h3>
                    <p class="text-sm text-[#718078] leading-relaxed mb-3">
                        Diproduksi dalam kelompok kecil (small-batch) maksimal 50 toples per proses tuang untuk menjaga
                        kepadatan lilin soy dan kestabilan wangi atsiri apel segar.
                    </p>
                    <p class="text-xs text-[#2E7D32] font-semibold flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Pengiriman Reguler & Same-day
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Mengapa Satu Varian --}}
    <section class="bg-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-[#FAF9F6] rounded-lg p-8 lg:p-12">
                <div class="grid lg:grid-cols-2 gap-8 items-center">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-[#8B1E1E] mb-2">🕯️ Ritual Nyala
                            NusaCandle</p>
                        <h2 class="font-serif text-3xl font-bold text-[#2C1810] mb-4">Mengapa Kami Hanya Merilis Satu
                            Varian?</h2>
                        <p class="text-[#718078] leading-relaxed">
                            Kami percaya pada kesempurnaan fokus. Alih-alih menduplikasi aroma sintetis pasaran, kami
                            menyempurnakan ekstraksi apel khas Malang hingga tercipta aroma hangat yang tidak dapat ditiru
                            lilin manapun di Nusantara.
                        </p>
                    </div>
                    <div class="flex items-center justify-center gap-6">
                        <div class="text-center">
                            <p class="font-serif text-4xl font-bold text-[#8B1E1E]">{{ $totalStok }} Pcs</p>
                            <p class="text-sm text-[#718078]">Stok Batch Tersedia</p>
                        </div>
                        <a href="#"
                            class="bg-white border border-gray-200 hover:border-[#8B1E1E] px-6 py-3 rounded-md font-semibold transition flex items-center gap-2">
                            <svg class="w-5 h-5 text-[#8B1E1E]" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            Riwayat Pembelian
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
