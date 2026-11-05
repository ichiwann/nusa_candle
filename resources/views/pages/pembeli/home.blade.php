@extends('layouts.pembeli')

@section('title', 'NusaCandle - Lilin Aroma Terapi Khas Malang')

@section('content')
    {{-- Hero Section --}}
    <section class="bg-[#FAF9F6] py-12 lg:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-8 items-center">
                <!-- Left Content -->
                <div>
                    <div class="inline-flex items-center gap-2 bg-[#E8F5E9] px-3 py-1.5 rounded-full mb-6">
                        <svg class="w-4 h-4 text-[#2E7D32]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-xs font-semibold text-[#2E7D32] uppercase tracking-wider">Authentic Malang Botanical Harvest</span>
                    </div>

                    <h1 class="font-serif text-5xl lg:text-6xl font-bold text-[#8B1E1E] mb-2">NusaCandle</h1>
                    <h2 class="font-serif text-3xl lg:text-4xl font-semibold text-[#2C1810] mb-4">Khas Malang</h2>
                    <p class="text-lg text-[#2E7D32] mb-6">Aroma Apel • Relaksasi Setiap Hari</p>
                    
                    <p class="text-[#718078] leading-relaxed mb-8 max-w-lg">
                        Lilin aromaterapi premium berbahan lilin kedelai alami dengan ekstrak apel segar khas perkebunan Malang. Ciptakan ketenangan dan kehangatan di setiap sudut rumah Anda.
                    </p>

                    <div class="flex flex-wrap gap-4 mb-8">
                        <a href="#" class="bg-[#8B1E1E] hover:bg-[#6B1515] text-white px-6 py-3 rounded-md font-semibold transition flex items-center gap-2">
                            Belanja Sekarang
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </a>
                        <a href="#" class="text-[#2E7D32] hover:text-[#1B5E20] font-medium flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                            Pelajari Aroma Apel Malang
                        </a>
                    </div>

                    <!-- Stats -->
                    <div class="grid grid-cols-3 gap-4">
                        <div class="bg-white p-4 rounded-lg shadow-sm">
                            <p class="font-serif text-2xl font-bold text-[#8B1E1E]">100%</p>
                            <p class="text-xs text-[#718078] mt-1">Kedelai Alami</p>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow-sm">
                            <p class="font-serif text-2xl font-bold text-[#8B1E1E]">2-3 Jam</p>
                            <p class="text-xs text-[#718078] mt-1">Durasi Bakar</p>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow-sm">
                            <p class="font-serif text-2xl font-bold text-[#8B1E1E]">0%</p>
                            <p class="text-xs text-[#718078] mt-1">Parafin & Toksin</p>
                        </div>
                    </div>
                </div>

                <!-- Right Image -->
                <div class="relative">
                    <div class="bg-white rounded-2xl shadow-xl p-4">
                        <img src="https://images.unsplash.com/photo-1602607616966-7f0e93f4e2e0?w=600&h=600&fit=crop" alt="Lilin NusaCandle" class="w-full h-96 object-cover rounded-lg">
                        <div class="mt-4">
                            <p class="text-xs text-[#718078] uppercase tracking-wider mb-1">Kota Wisata Batu • Malang</p>
                            <h3 class="font-serif text-xl font-semibold text-[#2C1810]">Purity from Mountain Orchards</h3>
                            <div class="flex items-center justify-between mt-3">
                                <div class="flex items-center gap-2">
                                    <span class="h-2 w-2 rounded-full bg-[#2E7D32]"></span>
                                    <span class="text-xs text-[#718078]">Kelompok 2 - SMKN 6 Malang</span>
                                </div>
                                <span class="text-xs text-[#718078]">Dituang Tangan di Malang</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Produk Unggulan --}}
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <p class="text-xs font-semibold uppercase tracking-wider text-[#718078] mb-2">Produk Ikonik Tunggal</p>
                <h2 class="font-serif text-4xl font-bold text-[#2C1810] mb-4">Karya Masterpiece Kami</h2>
                <p class="text-[#718078] max-w-2xl mx-auto">Satu formula sempurna yang kami sempurnakan dari sari apel manalagi dan apel anna Malang pilihan.</p>
            </div>

            @if($produkUnggulan)
            <div class="bg-[#FAF9F6] rounded-2xl p-8 lg:p-12">
                <div class="grid lg:grid-cols-2 gap-8 items-center">
                    <!-- Image -->
                    <div class="relative">
                        <div class="absolute top-4 left-4 bg-[#8B1E1E] text-white text-xs font-semibold px-3 py-1 rounded-full">
                            Hemat Rp 20.000
                        </div>
                        @if($produkUnggulan->gambar)
                            <img src="{{ asset('storage/' . $produkUnggulan->gambar) }}" alt="{{ $produkUnggulan->nama_produk }}" class="w-full h-96 object-cover rounded-lg">
                        @else
                            <div class="w-full h-96 bg-gray-200 rounded-lg flex items-center justify-center">
                                <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        @endif
                    </div>

                    <!-- Content -->
                    <div>
                        <div class="inline-flex items-center gap-2 bg-[#E8F5E9] px-3 py-1.5 rounded-full mb-4">
                            <svg class="w-4 h-4 text-[#2E7D32]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="text-xs font-semibold text-[#2E7D32]">100% Kedelai Alami & Ekstrak Apel Malang</span>
                        </div>

                        <h3 class="font-serif text-3xl font-bold text-[#2C1810] mb-4">{{ $produkUnggulan->nama_produk }}</h3>

                        <div class="flex items-center gap-4 mb-6">
                            <div class="flex items-center gap-1">
                                <svg class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <span class="font-semibold text-[#2C1810]">4.9</span>
                                <span class="text-sm text-[#718078]">(480+ ulasan)</span>
                            </div>
                            <span class="text-[#718078]">•</span>
                            <div class="flex items-center gap-1">
                                <span class="h-2 w-2 rounded-full bg-[#2E7D32]"></span>
                                <span class="text-sm text-[#2E7D32] font-medium">Tersedia (Ready Stock)</span>
                            </div>
                        </div>

                        <div class="bg-white p-4 rounded-lg mb-6">
                            <p class="text-xs font-semibold uppercase tracking-wider text-[#718078] mb-2">Profil Keharuman Botanical:</p>
                            <p class="text-sm text-[#2C1810]">
                                <strong>Top:</strong> Irisan Apel Segar Malang, Embun Pagi • 
                                <strong>Heart:</strong> Bunga Apel • 
                                <strong>Base:</strong> Kayu Manis Lembut & Kedelai Hangat
                            </p>
                        </div>

                        <div class="flex items-baseline gap-3 mb-6">
                            <p class="font-serif text-4xl font-bold text-[#8B1E1E]">Rp {{ number_format($produkUnggulan->harga, 0, ',', '.') }}</p>
                            <p class="text-lg text-[#718078] line-through">Rp {{ number_format($produkUnggulan->harga + 20000, 0, ',', '.') }}</p>
                            <span class="bg-[#E8F5E9] text-[#2E7D32] text-xs font-semibold px-2 py-1 rounded">Promo Panen Raya</span>
                        </div>

                        <div class="flex gap-3">
                            <button class="flex-1 bg-[#8B1E1E] hover:bg-[#6B1515] text-white px-6 py-3 rounded-md font-semibold transition flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                </svg>
                                Beli Sekarang
                            </button>
                            <button class="border-2 border-[#8B1E1E] text-[#8B1E1E] hover:bg-[#8B1E1E] hover:text-white px-4 py-3 rounded-md font-semibold transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </button>
                        </div>

                        <button class="mt-4 text-sm text-[#718078] hover:text-[#8B1E1E] flex items-center gap-1 mx-auto">
                            Lihat Detail & Panduan Pembakaran
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </section>

    {{-- Keunggulan --}}
    <section class="py-16 bg-[#FAF9F6]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-8 mb-12">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-[#718078] mb-2">Mengapa NusaCandle?</p>
                    <h2 class="font-serif text-4xl font-bold text-[#2C1810]">Keaslian Dari Alam Pegunungan Malang</h2>
                </div>
                <div class="flex items-end">
                    <p class="text-[#718078] leading-relaxed">Dirancang teliti dari perkebunan dataran tinggi Jawa Timur untuk kenyamanan dan kesehatan keluarga Anda.</p>
                </div>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Card 1 -->
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <div class="w-12 h-12 bg-[#E8F5E9] rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-[#2E7D32]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                        </svg>
                    </div>
                    <h3 class="font-serif text-xl font-semibold text-[#2C1810] mb-2">Aroma Alami</h3>
                    <p class="text-sm text-[#718078] leading-relaxed mb-4">Ekstrak buah apel Malang murni tanpa bahan kimia sintetis keras. Menghadirkan kesegaran kebun apel Batu yang otentik langsung ke ruangan Anda.</p>
                    <p class="text-xs text-[#2E7D32] font-medium flex items-center gap-1">
                        Ekstrak Organik Murni
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </p>
                </div>

                <!-- Card 2 -->
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <div class="w-12 h-12 bg-[#FCE4EC] rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-[#C2185B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-serif text-xl font-semibold text-[#2C1810] mb-2">Relaksasi Maksimal</h3>
                    <p class="text-sm text-[#718078] leading-relaxed mb-4">Wangi menenangkan terbukti membantu mengurangi stres harian, melegakan pernapasan, serta memperbaiki kualitas tidur Anda secara bertahap.</p>
                    <p class="text-xs text-[#C2185B] font-medium flex items-center gap-1">
                        Uji Nyaman Aromaterapi
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </p>
                </div>

                <!-- Card 3 -->
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <div class="w-12 h-12 bg-[#F5F5F5] rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-[#424242]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                        </svg>
                    </div>
                    <h3 class="font-serif text-xl font-semibold text-[#2C1810] mb-2">Produk Berkualitas</h3>
                    <p class="text-sm text-[#718078] leading-relaxed mb-4">Hand-poured 100% natural soy wax murni dengan sumbu katun bebas timbal, menghasilkan nyala bersih tanpa asap hitam dan residu kimia berbahaya.</p>
                    <p class="text-xs text-[#424242] font-medium flex items-center gap-1">
                        Zero Lead Cotton Wick
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </p>
                </div>

                <!-- Card 4 -->
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <div class="w-12 h-12 bg-[#E8F5E9] rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-[#2E7D32]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                        </svg>
                    </div>
                    <h3 class="font-serif text-xl font-semibold text-[#2C1810] mb-2">Penggunaan Sehari-hari</h3>
                    <p class="text-sm text-[#718078] leading-relaxed mb-4">Ketahanan bakar hingga 45 jam penuh. Sangat aman dihidupkan untuk menemani waktu santai di kamar tidur, ruang kerja, hingga sesi meditasi.</p>
                    <p class="text-xs text-[#2E7D32] font-medium flex items-center gap-1">
                        Aman untuk Ruang Tertutup
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Program Loyalitas --}}
    @auth
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-[#FAF9F6] rounded-2xl p-8 lg:p-12 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-[#8B1E1E]/5 rounded-full -mr-32 -mt-32"></div>
                
                <div class="relative grid lg:grid-cols-2 gap-8 items-center">
                    <div>
                        <div class="inline-flex items-center gap-2 bg-[#FCE4EC] px-3 py-1.5 rounded-full mb-4">
                            <svg class="w-4 h-4 text-[#C2185B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/>
                            </svg>
                            <span class="text-xs font-semibold text-[#C2185B]">Program Komunitas NusaCare</span>
                        </div>

                        <h2 class="font-serif text-3xl lg:text-4xl font-bold text-[#2C1810] mb-4">Kumpulkan 70 Poin untuk Klaim Refill Lilin Aroma Apel Gratis</h2>
                        
                        <p class="text-[#718078] leading-relaxed mb-6">
                            Setiap pembelian Rp 10.000 bernilai 1 Poin Aromaterapi. Raih 70 poin dan tukarkan dengan 1 toples refill lilin kedelai aroma apel segar tanpa biaya kirim.
                        </p>

                        <div class="bg-white p-4 rounded-lg mb-6">
                            <div class="flex items-center justify-between mb-2">
                                <p class="text-sm font-semibold text-[#2C1810]">Poin Anda Saat Ini: <span class="text-[#8B1E1E]">{{ number_format($poinUser) }} Poin</span></p>
                                <p class="text-xs text-[#718078]">Kurang {{ max(0, 70 - $poinUser) }} Poin menuju Hadiah Gratis</p>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                <div class="bg-gradient-to-r from-[#8B1E1E] to-[#2E7D32] h-2.5 rounded-full" style="width: {{ min(100, ($poinUser / 70) * 100) }}%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center lg:text-right">
                        <a href="#" class="inline-flex items-center gap-2 bg-[#8B1E1E] hover:bg-[#6B1515] text-white px-6 py-3 rounded-md font-semibold transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Kunjungi Poin Saya
                        </a>
                        <p class="text-xs text-[#718078] mt-3">Otomatis terhubung dengan nomor akun Anda</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endauth
@endsection