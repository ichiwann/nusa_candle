<nav class="sticky top-0 z-50 border-t-[3px] border-[#8b1e1e] bg-[#faf7ed] shadow-none print:hidden">
    <div @class([
        'max-w-7xl mx-auto px-4 sm:px-6 lg:px-8',
        'min-[500px]:max-[767px]:max-w-none min-[500px]:max-[767px]:px-2' => request()->routeIs('pembeli.transaksi.index'),
    ])>
        <div @class([
            'flex justify-between items-center h-16',
            'min-[500px]:max-[767px]:h-10 min-[500px]:max-[767px]:gap-1' => request()->routeIs('pembeli.transaksi.index'),
        ])>
            <!-- Logo -->
            <a href="{{ route('home') }}" @class([
                'flex items-center gap-3',
                'min-[500px]:max-[767px]:gap-1' => request()->routeIs('pembeli.transaksi.index'),
            ])>
                <img src="{{ asset('images/logo-nusacandle.png') }}" alt="NusaCandle" @class([
                    'h-10 w-10 object-contain',
                    'min-[500px]:max-[767px]:h-[1.6rem] min-[500px]:max-[767px]:w-[1.6rem]' => request()->routeIs('pembeli.transaksi.index'),
                ])
                    onerror="this.classList.add('hidden')">
                <div>
                    <h1 @class([
                        'font-display text-xl font-bold text-[#8B1E1E]',
                        'min-[500px]:max-[767px]:text-xs min-[500px]:max-[767px]:leading-[1.1]' => request()->routeIs('pembeli.transaksi.index'),
                    ])>NusaCandle</h1>
                    <p @class([
                        'text-[9px] text-[#718078] uppercase tracking-wider',
                        'min-[500px]:max-[767px]:text-[0.35rem]' => request()->routeIs('pembeli.transaksi.index'),
                    ])>Malang Botanical Artisan</p>
                </div>
            </a>

            <!-- Menu Desktop -->
            <div @class([
                'hidden md:flex items-center gap-1',
                'min-[500px]:max-[767px]:flex min-[500px]:max-[767px]:gap-0' => request()->routeIs('pembeli.transaksi.index'),
            ])>
                <a href="{{ route('home') }}"
                    @class([
                        'rounded-md px-4 py-2 text-sm font-medium',
                        'min-[500px]:max-[767px]:px-[0.2rem] min-[500px]:max-[767px]:py-1 min-[500px]:max-[767px]:text-[0.5rem]' => request()->routeIs('pembeli.transaksi.index'),
                        request()->routeIs('home') ? 'bg-[#8B1E1E] text-white' : 'text-[#2C1810] hover:bg-gray-100',
                    ])>Beranda</a>
                <a href="{{ route('produk.index') }}"
                    @class([
                        'rounded-md px-4 py-2 text-sm font-medium',
                        'min-[500px]:max-[767px]:px-[0.2rem] min-[500px]:max-[767px]:py-1 min-[500px]:max-[767px]:text-[0.5rem]' => request()->routeIs('pembeli.transaksi.index'),
                        request()->routeIs('produk.*') ? 'bg-[#8B1E1E] text-white' : 'text-[#2C1810] hover:bg-gray-100',
                    ])>Produk</a>
                <a href="{{ route('pembeli.pesanan.index') }}"
                    @class([
                        'rounded-md px-4 py-2 text-sm font-medium',
                        'min-[500px]:max-[767px]:px-[0.2rem] min-[500px]:max-[767px]:py-1 min-[500px]:max-[767px]:text-[0.5rem]' => request()->routeIs('pembeli.transaksi.index'),
                        request()->routeIs('pembeli.pesanan.*') ? 'bg-[#8B1E1E] text-white' : 'text-[#2C1810] hover:bg-gray-100',
                    ])>Pesanan</a>
                <a href="{{ route('pembeli.transaksi.index') }}"
                    @class([
                        'rounded-md px-4 py-2 text-sm font-medium',
                        'min-[500px]:max-[767px]:px-[0.2rem] min-[500px]:max-[767px]:py-1 min-[500px]:max-[767px]:text-[0.5rem]' => request()->routeIs('pembeli.transaksi.index'),
                        request()->routeIs('pembeli.transaksi.index') ? 'bg-[#a92f2d] text-white' : (request()->routeIs('pembeli.transaksi.show') ? 'bg-[#8B1E1E] text-white' : 'text-[#2C1810] hover:bg-gray-100'),
                    ])>Pembayaran</a>
                <a href="{{ route('poin.index') }}"
                    @class([
                        'rounded-md px-4 py-2 text-sm font-medium',
                        'min-[500px]:max-[767px]:px-[0.2rem] min-[500px]:max-[767px]:py-1 min-[500px]:max-[767px]:text-[0.5rem]' => request()->routeIs('pembeli.transaksi.index'),
                        request()->routeIs('poin.index') ? 'bg-[#8B1E1E] text-white' : 'text-[#2C1810] hover:bg-gray-100',
                    ])>Poin Saya</a>
            </div>

            <!-- Icon Actions -->
            <div @class([
                'flex items-center gap-3',
                'min-[500px]:max-[767px]:gap-[0.2rem]' => request()->routeIs('pembeli.transaksi.index'),
            ])>
                <!-- Cart Icon -->
                <a href="{{ route('keranjang.index') }}" @class([
                    'relative p-2 rounded-md transition',
                    'bg-[#FCE4EC] border border-[#8B1E1E] text-[#8B1E1E]' => request()->routeIs(
                        'keranjang.*'),
                    'text-[#2C1810] hover:bg-gray-100 border border-transparent' => !request()->routeIs(
                        'keranjang.*'),
                ])>
                    <svg @class([
                        'h-5 w-5',
                        'min-[500px]:max-[767px]:h-[0.8rem] min-[500px]:max-[767px]:w-[0.8rem]' => request()->routeIs('pembeli.transaksi.index'),
                    ]) fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                        {{-- ✅ Avatar bulat: klik langsung ke halaman profil --}}
                        <a href="{{ route('profil.index') }}" title="Profil Saya" aria-label="Profil Saya"
                            @class([
                                'flex h-8 w-8 items-center justify-center rounded-full bg-[#8B1E1E] text-sm font-semibold text-white transition hover:opacity-90',
                                'min-[500px]:max-[767px]:h-[1.1rem] min-[500px]:max-[767px]:w-[1.1rem] min-[500px]:max-[767px]:text-[0.6rem]' => request()->routeIs('pembeli.transaksi.index'),
                                request()->routeIs('profil.*') ? 'ring-2 ring-[#8B1E1E] ring-offset-2' : '',
                            ])>
                            {{ mb_substr(auth()->user()->nama_lengkap, 0, 1) }}
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" @class([
                                'rounded-md p-2 text-[#2C1810] hover:bg-gray-100',
                                'min-[500px]:max-[767px]:px-[0.2rem] min-[500px]:max-[767px]:py-1' => request()->routeIs('pembeli.transaksi.index'),
                            ]) title="Logout">
                                <svg @class([
                                    'h-5 w-5',
                                    'min-[500px]:max-[767px]:h-[0.8rem] min-[500px]:max-[767px]:w-[0.8rem]' => request()->routeIs('pembeli.transaksi.index'),
                                ]) fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
