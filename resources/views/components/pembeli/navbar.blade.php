<nav class="bg-white border-b border-stone-200 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center space-x-2">
                <img src="{{ asset('images/logo-nusacandle.png') }}" alt="Logo" class="w-9 h-9 object-contain" onerror="this.style.display='none'">
                <div>
                    <h1 class="text-xl font-serif font-bold text-emerald-900">NusaCandle</h1>
                    <p class="text-[9px] text-stone-500 uppercase tracking-widest -mt-1">Artisanal Botanical Scent</p>
                </div>
            </a>

            <!-- Menu Tengah -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}" class="text-sm font-medium text-stone-700 hover:text-emerald-900 transition">Beranda</a>
                <a href="#" class="text-sm font-medium text-stone-700 hover:text-emerald-900 transition">Produk</a>
                <a href="#" class="text-sm font-medium text-stone-700 hover:text-emerald-900 transition">Tentang Kami</a>
            </div>

            <!-- Menu Kanan (Dinamis: Login vs Tamu) -->
            <div class="flex items-center space-x-3">
                @auth
                    {{-- JIKA SUDAH LOGIN --}}
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-emerald-100 rounded-full flex items-center justify-center text-emerald-900 font-semibold text-xs">
                            {{ strtoupper(substr(auth()->user()->nama_lengkap, 0, 1)) }}
                        </div>
                        <span class="text-sm font-medium text-stone-700 hidden sm:block">{{ auth()->user()->nama_lengkap }}</span>
                    </div>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-sm font-medium text-stone-600 hover:text-red-600 transition">Keluar</button>
                    </form>
                @else
                    {{-- JIKA BELUM LOGIN (TAMU) --}}
                    <a href="{{ route('login') }}" class="text-sm font-medium text-stone-700 hover:text-emerald-900 transition">Masuk</a>
                    <a href="{{ route('register') }}" class="bg-emerald-900 hover:bg-emerald-800 text-white text-sm font-medium px-4 py-2 rounded-lg transition">Daftar</a>
                @endauth
            </div>
        </div>
    </div>
</nav>