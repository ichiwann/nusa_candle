{{-- Sidebar DESKTOP: sticky full-height agar tidak ada celah abu-abu saat scroll --}}
<aside class="hidden min-h-screen flex-col bg-[#153f2e] px-4 py-4 text-white md:sticky md:top-0 md:flex md:h-screen">
    <a href="{{ route('admin.dashboard') }}" class="flex items-center justify-center gap-2 border-b border-white/10 px-2 pb-4">
        <img src="{{ asset('images/logo-nusacandle.png') }}" alt="NusaCandle" class="h-9 w-9 shrink-0 object-contain" onerror="this.style.display='none'">
        <span class="flex flex-col">
            <span class="display-font text-[13px] font-semibold leading-tight text-white">NusaCandle</span>
            <span class="mt-0.5 text-[7px] uppercase tracking-[0.12em] text-emerald-100/60">LILIN AROMA TERAPI</span>
        </span>
    </a>

    <nav class="mt-4 flex-1 space-y-4 overflow-y-auto" aria-label="Navigasi admin">
        <div>
            <p class="mb-1.5 px-2 text-[8px] font-semibold uppercase tracking-[0.13em] text-emerald-100/45">Dashboard</p>
            <a href="{{ route('admin.dashboard') }}" @class([
                'block border-r-[3px] px-2 py-1.5 text-[10px] leading-tight transition hover:bg-white/10 hover:text-white',
                'border-[#ae2527] bg-[#f7f4e9] text-[#153f2e]' => request()->routeIs('admin.dashboard'),
                'border-transparent text-emerald-50/75' => !request()->routeIs('admin.dashboard'),
            ])>Dashboard</a>
        </div>

        <div>
            <p class="mb-1.5 px-2 text-[8px] font-semibold uppercase tracking-[0.13em] text-emerald-100/45">Manajemen</p>
            <div class="space-y-1">
                <a href="{{ route('admin.products.index') }}" @class([
                    'block border-r-[3px] px-2 py-1.5 text-[10px] leading-tight transition hover:bg-white/10 hover:text-white',
                    'border-[#ae2527] bg-[#f7f4e9] text-[#153f2e]' => request()->routeIs('admin.products.*'),
                    'border-transparent text-emerald-50/75' => !request()->routeIs('admin.products.*'),
                ])>Manajemen Produk</a>
                <a href="{{ route('admin.orders.index') }}" @class([
                    'block border-r-[3px] px-2 py-1.5 text-[10px] leading-tight transition hover:bg-white/10 hover:text-white',
                    'border-[#ae2527] bg-[#f7f4e9] text-[#153f2e]' => request()->routeIs('admin.orders.*'),
                    'border-transparent text-emerald-50/75' => !request()->routeIs('admin.orders.*'),
                ])>Pesanan</a>
                <a href="{{ route('admin.payments.index') }}" @class([
                    'block border-r-[3px] px-2 py-1.5 text-[10px] leading-tight transition hover:bg-white/10 hover:text-white',
                    'border-[#ae2527] bg-[#f7f4e9] text-[#153f2e]' => request()->routeIs('admin.payments.*'),
                    'border-transparent text-emerald-50/75' => !request()->routeIs('admin.payments.*'),
                ])>Pembayaran</a>
                <a href="{{ route('admin.hadiah.index') }}" @class([
                    'block border-r-[3px] px-2 py-1.5 text-[10px] leading-tight transition hover:bg-white/10 hover:text-white',
                    'border-[#ae2527] bg-[#f7f4e9] text-[#153f2e]' => request()->routeIs('admin.hadiah.*'),
                    'border-transparent text-emerald-50/75' => !request()->routeIs('admin.hadiah.*'),
                ])>Kelola Hadiah</a>
                <a href="{{ route('admin.kodeRedeem.index') }}" @class([
                    'block border-r-[3px] px-2 py-1.5 text-[10px] leading-tight transition hover:bg-white/10 hover:text-white',
                    'border-[#ae2527] bg-[#f7f4e9] text-[#153f2e]' => request()->routeIs('admin.kodeRedeem.*'),
                    'border-transparent text-emerald-50/75' => !request()->routeIs('admin.kodeRedeem.*'),
                ])>Redeem Code</a>
            </div>
        </div>

        <div>
            <p class="mb-1.5 px-2 text-[8px] font-semibold uppercase tracking-[0.13em] text-emerald-100/45">Settings</p>
            <a href="{{ route('admin.settings.edit') }}" @class([
                'block border-r-[3px] px-2 py-1.5 text-[10px] leading-tight transition hover:bg-white/10 hover:text-white',
                'border-[#ae2527] bg-[#f7f4e9] text-[#153f2e]' => request()->routeIs('admin.settings.*'),
                'border-transparent text-emerald-50/75' => !request()->routeIs('admin.settings.*'),
            ])>Pengaturan Admin</a>
        </div>

        <form action="{{ route('logout') }}" method="POST" class="border-t border-white/10 pt-3">
            @csrf
            <button type="submit"
                class="flex w-full items-center gap-2 border-r-[3px] border-transparent px-2 py-2 text-left text-[10px] leading-tight text-emerald-50/75 transition hover:border-[#ae2527] hover:bg-white/10 hover:text-white">
                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6A2.25 2.25 0 005.25 5.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M18 15l3-3m0 0-3-3m3 3H9" />
                </svg>
                Keluar
            </button>
        </form>
    </nav>
</aside>

{{-- Drawer MOBILE (overlay) --}}
<div id="admin-sidebar-drawer" class="fixed inset-0 z-[70] hidden md:hidden" role="dialog" aria-modal="true" aria-label="Menu admin">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeAdminDrawer()"></div>
    <div class="absolute left-0 top-0 h-full w-64 max-w-[85vw] overflow-y-auto bg-[#153f2e] px-4 py-4 text-white shadow-2xl">
        <div class="mb-4 flex items-center justify-between border-b border-white/10 pb-3">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                <img src="{{ asset('images/logo-nusacandle.png') }}" alt="NusaCandle" class="h-8 w-8 shrink-0 object-contain" onerror="this.style.display='none'">
                <span class="display-font text-sm font-semibold text-white">NusaCandle</span>
            </a>
            <button type="button" onclick="closeAdminDrawer()" aria-label="Tutup menu"
                class="flex h-8 w-8 items-center justify-center rounded-md text-emerald-100/70 transition hover:bg-white/10 hover:text-white">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>

        <nav class="space-y-4" aria-label="Navigasi admin mobile">
            <div>
                <p class="mb-1.5 px-2 text-[8px] font-semibold uppercase tracking-[0.13em] text-emerald-100/45">Dashboard</p>
                <a href="{{ route('admin.dashboard') }}" onclick="closeAdminDrawer()" @class([
                    'block border-l-[3px] px-2 py-1.5 text-[11px] leading-tight transition hover:bg-white/10 hover:text-white',
                    'border-[#ae2527] bg-[#f7f4e9] text-[#153f2e]' => request()->routeIs('admin.dashboard'),
                    'border-transparent text-emerald-50/75' => !request()->routeIs('admin.dashboard'),
                ])>Dashboard</a>
            </div>
            <div>
                <p class="mb-1.5 px-2 text-[8px] font-semibold uppercase tracking-[0.13em] text-emerald-100/45">Manajemen</p>
                <div class="space-y-1">
                    <a href="{{ route('admin.products.index') }}" onclick="closeAdminDrawer()" @class([
                        'block border-l-[3px] px-2 py-1.5 text-[11px] leading-tight transition hover:bg-white/10 hover:text-white',
                        'border-[#ae2527] bg-[#f7f4e9] text-[#153f2e]' => request()->routeIs('admin.products.*'),
                        'border-transparent text-emerald-50/75' => !request()->routeIs('admin.products.*'),
                    ])>Manajemen Produk</a>
                    <a href="{{ route('admin.orders.index') }}" onclick="closeAdminDrawer()" @class([
                        'block border-l-[3px] px-2 py-1.5 text-[11px] leading-tight transition hover:bg-white/10 hover:text-white',
                        'border-[#ae2527] bg-[#f7f4e9] text-[#153f2e]' => request()->routeIs('admin.orders.*'),
                        'border-transparent text-emerald-50/75' => !request()->routeIs('admin.orders.*'),
                    ])>Pesanan</a>
                    <a href="{{ route('admin.payments.index') }}" onclick="closeAdminDrawer()" @class([
                        'block border-l-[3px] px-2 py-1.5 text-[11px] leading-tight transition hover:bg-white/10 hover:text-white',
                        'border-[#ae2527] bg-[#f7f4e9] text-[#153f2e]' => request()->routeIs('admin.payments.*'),
                        'border-transparent text-emerald-50/75' => !request()->routeIs('admin.payments.*'),
                    ])>Pembayaran</a>
                    <a href="{{ route('admin.hadiah.index') }}" onclick="closeAdminDrawer()" @class([
                        'block border-l-[3px] px-2 py-1.5 text-[11px] leading-tight transition hover:bg-white/10 hover:text-white',
                        'border-[#ae2527] bg-[#f7f4e9] text-[#153f2e]' => request()->routeIs('admin.hadiah.*'),
                        'border-transparent text-emerald-50/75' => !request()->routeIs('admin.hadiah.*'),
                    ])>Kelola Hadiah</a>
                    <a href="{{ route('admin.kodeRedeem.index') }}" onclick="closeAdminDrawer()" @class([
                        'block border-l-[3px] px-2 py-1.5 text-[11px] leading-tight transition hover:bg-white/10 hover:text-white',
                        'border-[#ae2527] bg-[#f7f4e9] text-[#153f2e]' => request()->routeIs('admin.kodeRedeem.*'),
                        'border-transparent text-emerald-50/75' => !request()->routeIs('admin.kodeRedeem.*'),
                    ])>Redeem Code</a>
                </div>
            </div>
            <div>
                <p class="mb-1.5 px-2 text-[8px] font-semibold uppercase tracking-[0.13em] text-emerald-100/45">Settings</p>
                <a href="{{ route('admin.settings.edit') }}" onclick="closeAdminDrawer()" @class([
                    'block border-l-[3px] px-2 py-1.5 text-[11px] leading-tight transition hover:bg-white/10 hover:text-white',
                    'border-[#ae2527] bg-[#f7f4e9] text-[#153f2e]' => request()->routeIs('admin.settings.*'),
                    'border-transparent text-emerald-50/75' => !request()->routeIs('admin.settings.*'),
                ])>Pengaturan Admin</a>
            </div>
            <form action="{{ route('logout') }}" method="POST" class="border-t border-white/10 pt-3">
                @csrf
                <button type="submit"
                    class="flex w-full items-center gap-2 border-l-[3px] border-transparent px-2 py-2 text-left text-[11px] leading-tight text-emerald-50/75 transition hover:border-[#ae2527] hover:bg-white/10 hover:text-white">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6A2.25 2.25 0 005.25 5.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M18 15l3-3m0 0-3-3m3 3H9" />
                    </svg>
                    Keluar
                </button>
            </form>
        </nav>
    </div>
</div>

<script>
    function openAdminDrawer() {
        document.getElementById('admin-sidebar-drawer').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    function closeAdminDrawer() {
        document.getElementById('admin-sidebar-drawer').classList.add('hidden');
        document.body.style.overflow = '';
    }
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeAdminDrawer();
    });
</script>