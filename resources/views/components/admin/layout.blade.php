<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }} - NusaCandle Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">
    <style>body{font-family:'DM Sans',sans-serif}.display-font{font-family:'Playfair Display',serif}</style>
</head>
<body class="min-h-screen bg-[#f5f7f4] text-[#183b2c]">
<div class="min-h-screen lg:grid lg:grid-cols-[244px_1fr]">
    <aside class="flex flex-col bg-[#103a2a] px-5 py-5 text-white lg:min-h-screen">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 border-b border-white/10 pb-6">
            <span class="flex h-10 w-10 items-center justify-center rounded-md bg-white/10 text-[#d8e9d8]" aria-hidden="true"><svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3 19 6v5c0 4.6-2.8 8.1-7 10-4.2-1.9-7-5.4-7-10V6l7-3Z"/><path stroke-linecap="round" stroke-linejoin="round" d="m9 12 2 2 4-4"/></svg></span>
            <span><span class="display-font block text-lg">NusaCandle</span><span class="block text-[9px] uppercase tracking-[0.18em] text-emerald-100/60">Admin Atelier</span></span>
        </a>
        <nav class="mt-7 flex-1 space-y-7" aria-label="Navigasi admin">
            <div><p class="mb-2 px-2 text-[9px] font-semibold uppercase tracking-[0.18em] text-emerald-100/45">Dashboard</p><a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 rounded-sm px-3 py-2.5 text-sm text-emerald-50/75 transition hover:bg-white/10 hover:text-white">▦ Ringkasan</a></div>
            <div><p class="mb-2 px-2 text-[9px] font-semibold uppercase tracking-[0.18em] text-emerald-100/45">Manajemen</p><div class="space-y-1 text-sm text-emerald-50/75">
                <span class="flex items-center gap-3 px-3 py-2" title="Manajemen produk belum tersedia">▧ Manajemen Produk</span>
                <span class="flex items-center gap-3 px-3 py-2" title="Manajemen pesanan belum tersedia">▣ Pesanan</span>
                <span class="flex items-center gap-3 px-3 py-2" title="Manajemen transaksi belum tersedia">↗ Transaksi</span>
                <a href="{{ route('admin.gifts.index') }}" @class(['flex items-center gap-3 rounded-sm px-3 py-2 transition hover:bg-white/10 hover:text-white', 'bg-[#315d41] text-white' => request()->routeIs('admin.gifts.*'), 'text-emerald-50/75' => !request()->routeIs('admin.gifts.*')])>◇ Kelola Hadiah</a>
                <span class="flex items-center gap-3 px-3 py-2" title="Redeem code belum tersedia">⌑ Redeem Code</span>
            </div></div>
            <div><p class="mb-2 px-2 text-[9px] font-semibold uppercase tracking-[0.18em] text-emerald-100/45">Pengaturan</p><a href="{{ route('admin.settings.edit') }}" @class(['flex items-center gap-3 rounded-sm px-3 py-2 text-sm transition hover:bg-white/10 hover:text-white', 'bg-[#315d41] text-white' => request()->routeIs('admin.settings.*'), 'text-emerald-50/75' => !request()->routeIs('admin.settings.*')])>⚙ Pengaturan Admin</a></div>
        </nav>
        <div class="mt-8 border-t border-white/10 pt-4"><div class="mb-4 rounded-sm bg-white/5 px-3 py-2 text-[10px] text-emerald-100/75"><span class="mb-1 block font-medium text-white">Aroma Highlands Apel · Active</span>Sistem Orchard East Java<br>v2.4 · Highland apple</div><form action="{{ route('logout') }}" method="POST">@csrf<button type="submit" class="flex w-full items-center gap-2 px-3 py-2 text-sm text-emerald-50/80 transition hover:text-white">↪ Keluar Sistem</button></form></div>
    </aside>
    <main class="min-w-0">
        <header class="flex flex-wrap items-center justify-between gap-4 border-b border-[#e8eee8] bg-[#eaf5ec] px-6 py-4 sm:px-9">
            <div class="flex items-center gap-3 text-xs text-[#64766a]"><span class="h-2 w-2 rounded-full bg-[#50885c]"></span>NusaCandle Atelier <span class="text-[#a2b1a6]">/</span> {{ $title }}</div>
            <div class="flex items-center gap-3"><span class="flex h-9 w-9 items-center justify-center rounded-full bg-[#d6ead9] text-sm font-semibold text-[#214d33]">{{ mb_substr(auth()->user()->nama_lengkap, 0, 1) }}</span><span><span class="block text-xs font-semibold text-[#254332]">{{ auth()->user()->nama_lengkap }}</span><span class="block text-[10px] text-[#718078]">Administrator · Online</span></span></div>
        </header>
        <div class="mx-auto max-w-7xl space-y-6 px-5 py-7 sm:px-9 sm:py-9">
            @if (session('success'))<div role="status" class="border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">{{ session('success') }}</div>@endif
            @if ($errors->any())<div role="alert" class="border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700"><ul class="list-inside list-disc space-y-1">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
            {{ $slot }}
        </div>
    </main>
</div>
</body>
</html>
