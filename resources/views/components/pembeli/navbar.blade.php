<nav class="sticky top-0 z-50 border-t-[3px] border-[#8b1e1e] bg-[#faf7ed] shadow-none print:hidden">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between gap-2">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex shrink-0 items-center gap-2">
                <img src="{{ asset('images/logo-nusacandle.png') }}" alt="NusaCandle"
                    class="h-9 w-9 object-contain sm:h-10 sm:w-10"
                    onerror="this.classList.add('hidden')">
                <div class="min-w-0">
                    <h1 class="font-display text-lg font-bold leading-tight text-[#8B1E1E] sm:text-xl">NusaCandle</h1>
                    <p class="hidden text-[8px] uppercase tracking-wider text-[#718078] sm:block">Malang Botanical Artisan</p>
                </div>
            </a>

            {{-- Menu Desktop (md ke atas) --}}
            <div class="hidden items-center gap-1 md:flex">
                <a href="{{ route('home') }}"
                    class="rounded-md px-4 py-2 text-sm font-medium transition {{ request()->routeIs('home') ? 'bg-[#8B1E1E] text-white' : 'text-[#2C1810] hover:bg-gray-100' }}">
                    Beranda
                </a>
                <a href="{{ route('produk.index') }}"
                    class="rounded-md px-4 py-2 text-sm font-medium transition {{ request()->routeIs('produk.*') ? 'bg-[#8B1E1E] text-white' : 'text-[#2C1810] hover:bg-gray-100' }}">
                    Produk
                </a>
                <a href="{{ route('pembeli.pesanan.index') }}"
                    class="rounded-md px-4 py-2 text-sm font-medium transition {{ request()->routeIs('pembeli.pesanan.*') ? 'bg-[#8B1E1E] text-white' : 'text-[#2C1810] hover:bg-gray-100' }}">
                    Pesanan
                </a>
                <a href="{{ route('pembeli.transaksi.index') }}"
                    class="rounded-md px-4 py-2 text-sm font-medium transition {{ request()->routeIs('pembeli.transaksi.index') ? 'bg-[#a92f2d] text-white' : (request()->routeIs('pembeli.transaksi.show') ? 'bg-[#8B1E1E] text-white' : 'text-[#2C1810] hover:bg-gray-100') }}">
                    Pembayaran
                </a>
                <a href="{{ route('poin.index') }}"
                    class="rounded-md px-4 py-2 text-sm font-medium transition {{ request()->routeIs('poin.index') ? 'bg-[#8B1E1E] text-white' : 'text-[#2C1810] hover:bg-gray-100' }}">
                    Poin Saya
                </a>
            </div>

                        {{-- Icon Actions --}}
            <div class="flex items-center gap-1.5 sm:gap-2">

                {{-- Cart Icon (selalu tampil) --}}
                @php
                    $jumlahKeranjang = auth()->check()
                        ? \App\Models\Keranjang::where('id_user', auth()->id())->sum('jumlah')
                        : 0;
                @endphp
                <a href="{{ route('keranjang.index') }}"
                    class="relative rounded-md border p-2 transition {{ request()->routeIs('keranjang.*') ? 'border-[#8B1E1E] bg-[#FCE4EC] text-[#8B1E1E]' : 'border-transparent text-[#2C1810] hover:bg-gray-100' }}">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    @if ($jumlahKeranjang > 0)
                        <span class="absolute -right-1 -top-1 flex h-5 w-5 items-center justify-center rounded-full bg-[#8B1E1E] text-[10px] font-bold text-white ring-2 ring-white">
                            {{ $jumlahKeranjang > 99 ? '99+' : $jumlahKeranjang }}
                        </span>
                    @endif
                </a>

                @auth
                    {{-- ✅ Avatar Profil: TAMPIL SEMUA UKURAN (fix: dulu hidden di mobile) --}}
                    <a href="{{ route('profil.index') }}" title="Profil Saya" aria-label="Profil Saya"
                        class="flex h-8 w-8 items-center justify-center rounded-full bg-[#8B1E1E] text-sm font-semibold text-white transition hover:opacity-90 {{ request()->routeIs('profil.*') ? 'ring-2 ring-[#8B1E1E] ring-offset-2' : '' }}">
                        {{ mb_substr(auth()->user()->nama_lengkap, 0, 1) }}
                    </a>

                    {{-- Logout (desktop only, di mobile sudah ada di menu hamburger) --}}
                    <form action="{{ route('logout') }}" method="POST" class="hidden md:inline">
                        @csrf
                        <button type="submit" class="rounded-md p-2 text-[#2C1810] transition hover:bg-gray-100" title="Logout">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </button>
                    </form>
                @else
                    {{-- Masuk (desktop only, di mobile sudah ada di menu hamburger) --}}
                    <a href="{{ route('login') }}"
                        class="hidden rounded-md bg-[#8B1E1E] px-4 py-2 text-sm font-medium text-white transition hover:bg-[#6B1515] md:inline-block">
                        Masuk
                    </a>
                @endauth

                {{-- Hamburger (mobile only, untuk SEMUA guest & login) --}}
                <button type="button" id="mobile-menu-toggle" aria-label="Buka menu" aria-expanded="false"
                    class="flex h-9 w-9 items-center justify-center rounded-md border border-[#e5dccb] text-[#2C1810] transition hover:bg-gray-100 md:hidden">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- Menu Mobile (slide down, untuk SEMUA guest & login) --}}
        <div id="mobile-menu" class="hidden overflow-hidden border-t border-[#e5dccb] md:hidden">
            <div class="space-y-1 px-2 py-3">
                <a href="{{ route('home') }}"
                    class="block rounded-md px-3 py-2 text-sm font-medium {{ request()->routeIs('home') ? 'bg-[#8B1E1E] text-white' : 'text-[#2C1810] hover:bg-gray-100' }}">
                    Beranda
                </a>
                <a href="{{ route('produk.index') }}"
                    class="block rounded-md px-3 py-2 text-sm font-medium {{ request()->routeIs('produk.*') ? 'bg-[#8B1E1E] text-white' : 'text-[#2C1810] hover:bg-gray-100' }}">
                    Produk
                </a>
                <a href="{{ route('pembeli.pesanan.index') }}"
                    class="block rounded-md px-3 py-2 text-sm font-medium {{ request()->routeIs('pembeli.pesanan.*') ? 'bg-[#8B1E1E] text-white' : 'text-[#2C1810] hover:bg-gray-100' }}">
                    Pesanan
                </a>
                <a href="{{ route('pembeli.transaksi.index') }}"
                    class="block rounded-md px-3 py-2 text-sm font-medium {{ request()->routeIs('pembeli.transaksi.*') ? 'bg-[#8B1E1E] text-white' : 'text-[#2C1810] hover:bg-gray-100' }}">
                    Pembayaran
                </a>
                <a href="{{ route('poin.index') }}"
                    class="block rounded-md px-3 py-2 text-sm font-medium {{ request()->routeIs('poin.index') ? 'bg-[#8B1E1E] text-white' : 'text-[#2C1810] hover:bg-gray-100' }}">
                    Poin Saya
                </a>

                {{-- Divider + CTA (Logout untuk login, Masuk untuk guest) --}}
                <div class="border-t border-[#e5dccb] pt-2">
                    @auth
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm font-medium text-[#8B1E1E] transition hover:bg-[#FCE4EC]">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                            class="block rounded-md bg-[#8B1E1E] px-3 py-2 text-center text-sm font-semibold text-white transition hover:bg-[#6B1515]">
                            Masuk
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</nav>

<script>
    (function() {
        const toggleBtn = document.getElementById('mobile-menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        if (!toggleBtn || !mobileMenu) return;

        toggleBtn.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
            toggleBtn.setAttribute('aria-expanded', !mobileMenu.classList.contains('hidden'));
        });

        // Tutup menu saat klik link
        mobileMenu.querySelectorAll('a').forEach(el => {
            el.addEventListener('click', function() {
                mobileMenu.classList.add('hidden');
            });
        });
    })();
</script>