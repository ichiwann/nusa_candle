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