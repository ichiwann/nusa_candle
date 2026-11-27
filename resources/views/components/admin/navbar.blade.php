@props(['totalOrders' => 0])

@if (request()->routeIs('admin.*'))
    <header class="sticky top-0 z-40 flex h-14 w-full items-center justify-between border-b border-[#ece5d7] bg-[#fffaf0] px-3 sm:px-6">
        {{-- Kiri: hamburger (mobile) + logo --}}
        <div class="flex min-w-0 items-center gap-2">
            {{-- ✅ Tombol hamburger: hanya mobile, buka drawer sidebar --}}
            <button type="button" onclick="openAdminDrawer()" aria-label="Buka menu admin"
                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-md text-[#354735] transition hover:bg-[#f0ece1] md:hidden">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <img src="{{ asset('images/logo-nusacandle.png') }}" alt="NusaCandle"
                class="h-7 w-7 object-contain sm:h-8 sm:w-8" onerror="this.style.display='none'">
            <div class="min-w-0">
                <p class="truncate text-[10px] font-bold text-[#a51f27] sm:text-[11px]">NusaCandle</p>
                <p class="hidden truncate text-[7px] uppercase tracking-[0.14em] text-[#77736b] sm:block">
                    Malang Botanical Artisan
                </p>
            </div>
        </div>

        {{-- Kanan: notif + user --}}
        <div class="flex items-center gap-2 sm:gap-4">
            @if (request()->routeIs('admin.dashboard'))
                <div class="relative" data-dashboard-dropdown>
                    <button id="dashboard-notifications-toggle" type="button"
                        class="relative flex h-8 w-8 items-center justify-center rounded-md text-[#354735] transition hover:bg-[#f0ece1] focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#a51f27] sm:h-9 sm:w-9"
                        aria-label="Buka ringkasan aktivitas" aria-controls="dashboard-notifications" aria-expanded="false">
                        <svg class="h-4 w-4 sm:h-5 sm:w-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                            <path d="M10 2a4 4 0 00-4 4v1.18c0 .53-.21 1.04-.59 1.41L4.3 9.7A1 1 0 005 11.4h10a1 1 0 00.7-1.7l-1.11-1.11A2 2 0 0114 7.18V6a4 4 0 00-4-4zM8 13a2 2 0 104 0H8z" />
                        </svg>
                        @if ($totalOrders > 0)
                            <span class="absolute right-1 top-1 h-1.5 w-1.5 rounded-full bg-[#ad2028]"></span>
                        @endif
                    </button>
                    <div id="dashboard-notifications"
                        class="dashboard-menu absolute right-0 top-[calc(100%+6px)] z-[60] hidden w-72 max-w-[calc(100vw-32px)] border border-[#e8e2d6] bg-white p-4 shadow-lg"
                        role="region" aria-labelledby="dashboard-notifications-toggle">
                        <p class="text-sm font-semibold text-[#302d27]">Aktivitas 7 minggu terakhir</p>
                        @if ($totalOrders > 0)
                            <p class="mt-2 text-xs leading-relaxed text-[#625f56]">
                                Ada {{ number_format($totalOrders) }} pesanan selesai pada periode grafik.
                            </p>
                        @else
                            <p class="mt-2 text-xs leading-relaxed text-[#625f56]">Belum ada pesanan selesai pada periode grafik.</p>
                        @endif
                        <a href="{{ route('admin.orders.index') }}" class="mt-3 inline-flex text-xs font-semibold text-[#8b1e1e] hover:underline">
                            Lihat pesanan
                        </a>
                    </div>
                </div>
            @else
                <a href="{{ route('admin.orders.index') }}"
                    class="flex h-8 w-8 items-center justify-center rounded-md text-[#354735] transition hover:bg-[#f0ece1] hover:text-[#a51f27] sm:h-9 sm:w-9"
                    aria-label="Buka daftar pesanan" title="Daftar pesanan">
                    <svg class="h-4 w-4 sm:h-5 sm:w-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                        <path d="M10 2a4 4 0 00-4 4v1.18c0 .53-.21 1.04-.59 1.41L4.3 9.7A1 1 0 005 11.4h10a1 1 0 00.7-1.7l-1.11-1.11A2 2 0 0114 7.18V6a4 4 0 00-4-4zM8 13a2 2 0 104 0H8z" />
                    </svg>
                </a>
            @endif

            <span class="hidden h-5 border-l border-[#e8dfd1] sm:block"></span>

            <details class="relative">
                <summary class="flex list-none items-center gap-1.5 focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#a51f27] sm:gap-2">
                    <span class="flex h-7 w-7 items-center justify-center rounded-full bg-[#a51f27] text-[10px] font-bold text-white sm:h-8 sm:w-8 sm:text-xs">
                        {{ mb_substr(auth()->user()->nama_lengkap, 0, 1) }}
                    </span>
                    <span class="hidden text-xs leading-[1.2] sm:block">
                        <span class="block font-semibold text-[#302d27]">{{ auth()->user()->nama_lengkap }}</span>
                        <span class="block text-[9px] uppercase tracking-[0.08em] text-[#77736b]">Administrator</span>
                    </span>
                </summary>
                <div class="absolute right-0 top-[calc(100%+6px)] z-[60] hidden w-56 rounded-md border border-[#e8e2d6] bg-white py-2 shadow-lg group-open:block">
                    <div class="border-b border-[#f0ece1] px-3 py-2">
                        <p class="text-xs font-semibold text-[#302d27]">{{ auth()->user()->nama_lengkap }}</p>
                        <p class="text-[10px] text-[#77736b]">{{ auth()->user()->email ?? '-' }}</p>
                    </div>
                    <a href="{{ route('admin.dashboard') }}" class="block px-3 py-1.5 text-xs text-[#302d27] hover:bg-[#f5f0e5]">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full px-3 py-1.5 text-left text-xs text-[#a51f27] hover:bg-[#f5f0e5]">Logout</button>
                    </form>
                </div>
            </details>
        </div>
    </header>
@else
    <header class="flex flex-wrap items-center justify-between gap-2 border-b border-[#e8eee8] bg-[#eaf5ec] px-3 py-2.5 sm:px-6 sm:py-3">
        <div class="flex min-w-0 items-center gap-1.5 text-[9px] text-[#64766a] sm:text-xs">
            <span class="h-1.5 w-1.5 shrink-0 rounded-full bg-[#50885c]"></span>
            <span class="truncate text-[8px] font-semibold uppercase tracking-[0.14em] text-[#64835d] sm:text-[10px]">Admin Ledger</span>
            <span class="shrink-0 text-[#a2b1a6]">/</span>
            <span class="truncate font-medium text-[#30483a]">@yield('page_title', 'Dashboard')</span>
        </div>
        <div class="flex items-center gap-2 sm:gap-3">
            <div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-[#d6ead9] text-[10px] font-semibold text-[#214d33] sm:h-9 sm:w-9 sm:text-sm">
                {{ mb_substr(auth()->user()->nama_lengkap, 0, 1) }}
            </div>
            <div class="hidden min-w-0 sm:block">
                <span class="block truncate text-[10px] font-semibold text-[#254332] sm:text-xs">{{ auth()->user()->nama_lengkap }}</span>
                <span class="block text-[8px] text-[#718078] sm:text-[10px]">Administrator · Online</span>
            </div>
        </div>
    </header>
@endif