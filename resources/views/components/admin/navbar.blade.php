@props(['totalOrders' => 0])

@if (request()->routeIs('admin.*'))
    <header class="flex h-14 items-center justify-between border-b border-[#ece5d7] bg-[#fffaf0] px-4 sm:px-6">
        <p class="text-[11px] font-semibold uppercase tracking-[0.14em] text-[#42634f]">
            Admin Ledger <span class="text-[#9b9b8c]">›</span> <span class="normal-case tracking-normal text-[#302d27]">Console</span>
        </p>

        <div class="flex items-center gap-4">
            @if (request()->routeIs('admin.dashboard'))
                <div class="relative" data-dashboard-dropdown>
                    <button id="dashboard-notifications-toggle" type="button" class="relative flex h-9 w-9 items-center justify-center text-[#354735] focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#a51f27]" aria-label="Buka ringkasan aktivitas" aria-controls="dashboard-notifications" aria-expanded="false">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                            <path d="M10 2a4 4 0 00-4 4v1.18c0 .53-.21 1.04-.59 1.41L4.3 9.7A1 1 0 005 11.4h10a1 1 0 00.7-1.7l-1.11-1.11A2 2 0 0114 7.18V6a4 4 0 00-4-4zM8 13a2 2 0 104 0H8z"/>
                        </svg>
                        @if ($totalOrders > 0)
                            <span class="absolute right-1 top-1 h-1.5 w-1.5 rounded-full bg-[#ad2028]"></span>
                        @endif
                    </button>
                    <div id="dashboard-notifications" class="dashboard-menu absolute right-0 top-[calc(100%+6px)] z-[60] hidden w-72 max-w-[calc(100vw-32px)] border border-[#e8e2d6] bg-white p-4 shadow-lg" role="region" aria-labelledby="dashboard-notifications-toggle">
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
                    class="flex h-9 w-9 items-center justify-center text-[#354735] transition hover:text-[#a51f27] focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#a51f27]"
                    aria-label="Buka daftar pesanan" title="Daftar pesanan">
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                        <path d="M10 2a4 4 0 00-4 4v1.18c0 .53-.21 1.04-.59 1.41L4.3 9.7A1 1 0 005 11.4h10a1 1 0 00.7-1.7l-1.11-1.11A2 2 0 0114 7.18V6a4 4 0 00-4-4zM8 13a2 2 0 104 0H8z"/>
                    </svg>
                </a>
            @endif
            <span class="h-5 border-l border-[#e8dfd1]"></span>
            <details class="relative">
                <summary class="flex cursor-pointer list-none items-center gap-2 text-left focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#a51f27]">
                    <span class="flex h-8 w-8 items-center justify-center rounded-full bg-[#a51f27] text-white">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 21a8 8 0 00-16 0m8-10a4 4 0 100-8 4 4 0 000 8z"/>
                        </svg>
                    </span>
                    <span class="hidden text-xs leading-[1.2] sm:block">
                        <span class="block font-semibold text-[#302d27]">{{ auth()->user()->nama_lengkap }}</span>
                        <span class="block text-[9px] uppercase tracking-[0.08em] text-[#77736b]">Administrator</span>
                    </span>
                    <svg class="h-3 w-3 text-[#77736b]" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m6 9 6 6 6-6"/>
                    </svg>
                </summary>
                <div class="absolute right-0 top-[calc(100%+6px)] z-[60] w-56 border border-[#e8e2d6] bg-white p-2 shadow-lg">
                    <a href="{{ route('admin.settings.edit') }}" class="block px-3 py-2 text-sm text-[#302d27] hover:bg-[#f7f4e9]">
                        Pengaturan Admin
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="block w-full px-3 py-2 text-left text-sm text-[#8b1e1e] hover:bg-[#f7f4e9]">
                            Keluar
                        </button>
                    </form>
                </div>
            </details>
        </div>
    </header>
@else
    <header class="flex flex-wrap items-center justify-between gap-4 border-b border-[#e8eee8] bg-[#eaf5ec] px-6 py-4 sm:px-9">
        <!-- Breadcrumb -->
        <div class="flex items-center gap-3 text-xs text-[#64766a]">
            <span class="h-2 w-2 rounded-full bg-[#50885c]"></span>
            <span class="text-[10px] font-semibold uppercase tracking-[0.17em] text-[#64835d]">Admin Ledger</span>
            <span class="text-[#a2b1a6]">/</span>
            <span class="font-medium text-[#30483a]">@yield('page_title', 'Dashboard')</span>
        </div>
        <!-- User Info -->
        <div class="flex items-center gap-3">
            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-[#d6ead9] text-sm font-semibold text-[#214d33]">
                {{ mb_substr(auth()->user()->nama_lengkap, 0, 1) }}
            </div>
            <div>
                <span class="block text-xs font-semibold text-[#254332]">{{ auth()->user()->nama_lengkap }}</span>
                <span class="block text-[10px] text-[#718078]">Administrator · Online</span>
            </div>
        </div>
    </header>
@endif