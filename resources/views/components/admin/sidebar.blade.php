<aside class="flex flex-col bg-[#103a2a] px-5 py-5 text-white lg:min-h-screen">
    <!-- Logo dengan Gambar -->
    <a href="{{ route('admin.dashboard') }}" class="flex flex-col items-center border-b border-white/10 pb-6">
        <img src="{{ asset('images/logo-nusacandle.png') }}" alt="NusaCandle" class="w-16 h-16 object-contain mb-3"
            onerror="this.style.display='none'">
        <span class="display-font block text-xl font-bold text-white">NusaCandle</span>
        <span class="block text-[9px] uppercase tracking-[0.18em] text-emerald-100/60 mt-1">LILIN AROMA TERAPI</span>
    </a>

    <!-- Navigasi -->
    <nav class="mt-7 flex-1 space-y-7" aria-label="Navigasi admin">
        <!-- Dashboard -->
        <div>
            <p class="mb-2 px-2 text-[9px] font-semibold uppercase tracking-[0.18em] text-emerald-100/45">Dashboard</p>
            <a href="{{ route('admin.dashboard') }}" @class([
                'flex items-center gap-3 rounded-sm px-3 py-2.5 text-sm transition hover:bg-white/10 hover:text-white',
                'bg-[#315d41] text-white' => request()->routeIs('admin.dashboard'),
                'text-emerald-50/75' => !request()->routeIs('admin.dashboard'),
            ])>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
                Dashboard
            </a>
        </div>

        <!-- Manajemen -->
        <div>
            <p class="mb-2 px-2 text-[9px] font-semibold uppercase tracking-[0.18em] text-emerald-100/45">Manajemen</p>
            <div class="space-y-1 text-sm text-emerald-50/75">
                <a href="{{ route('admin.products.index') }}" @class([
                    'flex items-center gap-3 rounded-sm px-3 py-2 transition hover:bg-white/10 hover:text-white',
                    'bg-[#315d41] text-white' => request()->routeIs('admin.products.*'),
                    'text-emerald-50/75' => !request()->routeIs('admin.products.*'),
                ])>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    Manajemen Produk
                </a>
                <a href="{{ route('admin.orders.index') }}" @class([
                    'flex items-center gap-3 rounded-sm px-3 py-2 transition hover:bg-white/10 hover:text-white',
                    'bg-[#315d41] text-white' => request()->routeIs('admin.orders.*'),
                    'text-emerald-50/75' => !request()->routeIs('admin.orders.*'),
                ])>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    Pesanan
                </a>
                <a href="{{ route('admin.transactions.index') }}" @class([
                    'flex items-center gap-3 rounded-sm px-3 py-2 transition hover:bg-white/10 hover:text-white',
                    'bg-[#315d41] text-white' => request()->routeIs('admin.transactions.*'),
                    'text-emerald-50/75' => !request()->routeIs('admin.transactions.*'),
                ])>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                    </svg>
                    Transaksi
                </a>

                <!-- AKTIF - Sudah ada halaman -->
                <a href="{{ route('admin.hadiah.index') }}" @class([
                    'flex items-center gap-3 rounded-sm px-3 py-2 transition hover:bg-white/10 hover:text-white',
                    'bg-[#315d41] text-white' => request()->routeIs('admin.hadiah.*'),
                    'text-emerald-50/75' => !request()->routeIs('admin.hadiah.*'),
                ])>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
                    </svg>
                    Kelola Hadiah
                </a>

                <!-- DISABLED - Belum ada halaman -->
                <a href="{{ route('admin.kodeRedeem.index') }}" @class([
                    'flex items-center gap-3 rounded-sm px-3 py-2 transition hover:bg-white/10 hover:text-white',
                    'bg-[#315d41] text-white' => request()->routeIs('admin.kodeRedeem.*'),
                    'text-emerald-50/75' => !request()->routeIs('admin.kodeRedeem.*'),
                ])>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                    </svg>
                    Redeem Code
                </a>
            </div>
        </div>

        <!-- Pengaturan -->
        <div>
            <p class="mb-2 px-2 text-[9px] font-semibold uppercase tracking-[0.18em] text-emerald-100/45">Settings</p>
            <a href="{{ route('admin.settings.edit') }}" @class([
                'flex items-center gap-3 rounded-sm px-3 py-2 text-sm transition hover:bg-white/10 hover:text-white',
                'bg-[#315d41] text-white' => request()->routeIs('admin.settings.*'),
                'text-emerald-50/75' => !request()->routeIs('admin.settings.*'),
            ])>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Pengaturan Admin
            </a>
        </div>
    </nav>

    <!-- Logout -->
    <div class="mt-6 border-t border-white/10 pt-4">
        <p class="mb-2 px-2 text-[9px] font-semibold uppercase tracking-[0.18em] text-emerald-100/45">Account</p>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                class="flex w-full items-center gap-2 px-3 py-2 text-sm text-emerald-50/80 transition hover:text-white hover:bg-white/5 rounded-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                Logout
            </button>
        </form>
    </div>
</aside>
