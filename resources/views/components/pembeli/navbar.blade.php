<nav class="bg-white shadow-sm sticky top-0 z-50">
    <div class="w-full px-4 sm:px-6 lg:px-8 xl:px-12">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <img src="{{ asset('images/logo-nusacandle.png') }}" alt="NusaCandle" class="h-10 w-10 object-contain"
                    onerror="this.style.display='none'">
                <div>
                    <h1 class="font-serif text-xl font-bold text-[#8B1E1E]">NusaCandle</h1>
                    <p class="text-[9px] text-[#718078] uppercase tracking-wider">Malang Botanical Artisan</p>
                </div>
            </a>

            <!-- Menu Desktop -->
            <div class="hidden md:flex items-center gap-1">
                <a href="{{ route('home') }}"
                    class="px-4 py-2 rounded-md text-sm font-medium {{ request()->routeIs('home') ? 'bg-[#8B1E1E] text-white' : 'text-[#2C1810] hover:bg-gray-100' }}">Beranda</a>
                <a href="{{ route('produk.index') }}"
                    class="px-4 py-2 rounded-md text-sm font-medium {{ request()->routeIs('produk.*') ? 'bg-[#8B1E1E] text-white' : 'text-[#2C1810] hover:bg-gray-100' }}">Produk</a>
                <a href="{{ route('pembeli.pesanan.index') }}"
                    class="px-4 py-2 rounded-md text-sm font-medium {{ request()->routeIs('pembeli.pesanan.*') ? 'bg-[#8B1E1E] text-white' : 'text-[#2C1810] hover:bg-gray-100' }}">Pesanan</a>
                <a href="{{ route('pembeli.transaksi.index') }}"
                    class="px-4 py-2 rounded-md text-sm font-medium {{ request()->routeIs('pembeli.transaksi.*') ? 'bg-[#8B1E1E] text-white' : 'text-[#2C1810] hover:bg-gray-100' }}">Transaksi</a>
                <a href="{{ route('poin.index') }}"
                    class="px-4 py-2 rounded-md text-sm font-medium {{ request()->routeIs('poin.index') ? 'bg-[#8B1E1E] text-white' : 'text-[#2C1810] hover:bg-gray-100' }}">Poin
                    Saya</a>
                <a href="{{ route('profil.index') }}"
                    class="px-4 py-2 rounded-md text-sm font-medium {{ request()->routeIs('profil.index') ? 'bg-[#8B1E1E] text-white' : 'text-[#2C1810] hover:bg-gray-100' }}">Profil</a>
            </div>

            <!-- Icon Actions -->
            <div class="flex items-center gap-3">
                <!-- Cart Icon -->
                <a href="{{ route('keranjang.index') }}" @class([
                    'relative p-2 rounded-md transition',
                    'bg-[#FCE4EC] border border-[#8B1E1E] text-[#8B1E1E]' => request()->routeIs(
                        'keranjang.*'),
                    'text-[#2C1810] hover:bg-gray-100 border border-transparent' => !request()->routeIs(
                        'keranjang.*'),
                ])>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>

                    @php
                        $jumlahKeranjang = auth()->check()
                            ? \App\Models\Keranjang::where('id_user', auth()->id())->sum('jumlah')
                            : 0;
                    @endphp

                    @if ($jumlahKeranjang > 0)
                        <span
                            class="absolute -top-1 -right-1 bg-[#8B1E1E] text-white text-[10px] font-bold rounded-full h-5 w-5 flex items-center justify-center ring-2 ring-white">
                            {{ $jumlahKeranjang }}
                        </span>
                    @endif
                </a>

                @auth
                    <div class="flex items-center gap-2">
                        <div
                            class="h-8 w-8 rounded-full bg-[#8B1E1E] text-white flex items-center justify-center text-sm font-semibold">
                            {{ mb_substr(auth()->user()->nama_lengkap, 0, 1) }}
                        </div>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="p-2 text-[#2C1810] hover:bg-gray-100 rounded-md" title="Logout">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                            </button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 bg-[#8B1E1E] text-white text-sm font-medium rounded-md hover:bg-[#6B1515] transition">Masuk</a>
                @endauth
            </div>
        </div>
    </div>
</nav>
