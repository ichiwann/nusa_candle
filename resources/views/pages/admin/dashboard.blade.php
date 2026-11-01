<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Admin - NusaCandle</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'DM Sans', sans-serif; }
        .display-font { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="min-h-screen bg-[#f5f7f4] text-[#183b2c]">
    <div class="min-h-screen lg:grid lg:grid-cols-[244px_1fr]">
        <aside class="flex flex-col bg-[#103a2a] px-5 py-5 text-white lg:min-h-screen">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 border-b border-white/10 pb-6">
                <span class="flex h-10 w-10 items-center justify-center rounded-md bg-white/10 text-[#d8e9d8]" aria-hidden="true">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3 19 6v5c0 4.6-2.8 8.1-7 10-4.2-1.9-7-5.4-7-10V6l7-3Z"/><path stroke-linecap="round" stroke-linejoin="round" d="m9 12 2 2 4-4"/></svg>
                </span>
                <span><span class="display-font block text-lg">NusaCandle</span><span class="block text-[9px] uppercase tracking-[0.18em] text-emerald-100/60">Admin Atelier</span></span>
            </a>

            <nav class="mt-7 flex-1 space-y-7" aria-label="Navigasi admin">
                <div>
                    <p class="mb-2 px-2 text-[9px] font-semibold uppercase tracking-[0.18em] text-emerald-100/45">Dashboard</p>
                    <a href="{{ route('admin.dashboard') }}" aria-current="page" class="flex items-center gap-3 rounded-sm bg-[#315d41] px-3 py-2.5 text-sm font-medium text-white">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
                        Ringkasan
                    </a>
                </div>
                <div>
                    <p class="mb-2 px-2 text-[9px] font-semibold uppercase tracking-[0.18em] text-emerald-100/45">Manajemen</p>
                    <div class="space-y-1 text-sm text-emerald-50/75">
                        <span class="flex items-center gap-3 px-3 py-2" title="Menu produk belum tersedia"><span aria-hidden="true">▧</span>Manajemen Produk</span>
                        <span class="flex items-center gap-3 px-3 py-2" title="Menu pesanan belum tersedia"><span aria-hidden="true">▣</span>Pesanan</span>
                        <span class="flex items-center gap-3 px-3 py-2" title="Menu transaksi belum tersedia"><span aria-hidden="true">↗</span>Transaksi</span>
                        <a href="{{ route('admin.gifts.index') }}" class="flex items-center gap-3 px-3 py-2 text-emerald-50/75 transition hover:bg-white/10 hover:text-white"><span aria-hidden="true">◇</span>Kelola Hadiah</a>
                        <span class="flex items-center gap-3 px-3 py-2" title="Menu redeem belum tersedia"><span aria-hidden="true">⌑</span>Redeem Code</span>
                    </div>
                </div>
                <div>
                    <p class="mb-2 px-2 text-[9px] font-semibold uppercase tracking-[0.18em] text-emerald-100/45">Pengaturan</p>
                    <a href="{{ route('admin.settings.edit') }}" class="flex items-center gap-3 px-3 py-2 text-sm text-emerald-50/75 transition hover:bg-white/10 hover:text-white"><span aria-hidden="true">⚙</span>Pengaturan Admin</a>
                </div>
            </nav>

            <div class="mt-8 border-t border-white/10 pt-4">
                <div class="mb-4 rounded-sm bg-white/5 px-3 py-2 text-[10px] text-emerald-100/75">
                    <span class="mb-1 block font-medium text-white">Aroma Highlands Apel · Active</span>
                    Sistem Orchard East Java<br>v2.4 · Highland apple
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex w-full items-center gap-2 px-3 py-2 text-sm text-emerald-50/80 transition hover:text-white">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M10 17l5-5-5-5m5 5H3m9-9h7a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-7"/></svg>
                        Keluar Sistem
                    </button>
                </form>
            </div>
        </aside>

        <main class="min-w-0">
            <header class="flex flex-wrap items-center justify-between gap-4 border-b border-[#e8eee8] bg-[#eaf5ec] px-6 py-4 sm:px-9">
                <div class="flex items-center gap-3 text-xs text-[#64766a]"><span class="h-2 w-2 rounded-full bg-[#50885c]"></span>NusaCandle Atelier <span class="text-[#a2b1a6]">/</span> Highland Apple Estate</div>
                <div class="flex items-center gap-3">
                    <span class="flex h-9 w-9 items-center justify-center rounded-full bg-[#d6ead9] text-sm font-semibold text-[#214d33]">{{ mb_substr(auth()->user()->nama_lengkap, 0, 1) }}</span>
                    <span><span class="block text-xs font-semibold text-[#254332]">{{ auth()->user()->nama_lengkap }}</span><span class="block text-[10px] text-[#718078]">Administrator · Online</span></span>
                </div>
            </header>

            <div class="mx-auto max-w-7xl space-y-7 px-5 py-7 sm:px-9 sm:py-9">
                <section class="relative overflow-hidden rounded-md bg-[#103a2a] px-6 py-7 text-white shadow-sm sm:px-8 sm:py-8">
                    <div class="pointer-events-none absolute -right-10 -top-20 h-64 w-64 rounded-full border border-white/10"></div>
                    <div class="relative flex flex-wrap items-end justify-between gap-6">
                        <div class="max-w-2xl">
                            <div class="mb-3 inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/10 px-3 py-1 text-[10px] text-emerald-50/90"><span class="h-1.5 w-1.5 rounded-full bg-[#b7d99c]"></span>Sistem Sinkron · Aktif <span class="text-white/40">|</span>{{ now()->locale('id')->translatedFormat('d M Y') }} · Batu, Jawa Timur</div>
                            <h1 class="display-font text-3xl font-semibold leading-tight sm:text-4xl">Selamat Datang, Admin<br>NusaCandle</h1>
                            <p class="mt-3 max-w-xl text-sm leading-6 text-emerald-50/70">Pantau pengguna, program loyalitas, koleksi produk, dan pesanan NusaCandle dari satu tempat.</p>
                        </div>
                        <div class="text-left sm:text-right"><p class="text-[9px] uppercase tracking-[0.18em] text-emerald-100/55">Aroma Primadona</p><p class="display-font mt-1 text-lg text-[#d8e8c7]">Highland Crisp Apple</p></div>
                    </div>
                </section>

                <section class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4" aria-label="Ringkasan toko">
                    @foreach ([['Total Pengguna', number_format($totalUsers, 0, ',', '.'), 'akun pelanggan', '♙'], ['Total Poin Pengguna', number_format($totalPoints, 0, ',', '.'), 'poin loyalitas', '♧'], ['Produk Aktif', number_format($totalProducts, 0, ',', '.'), 'produk katalog', '◇'], ['Pesanan Menunggu', number_format($pendingOrders, 0, ',', '.'), 'perlu ditinjau', '↗']] as [$label, $value, $caption, $icon])
                        <article class="rounded-md border border-[#e8eee8] bg-white p-5 shadow-[0_8px_24px_-22px_rgba(16,54,36,0.5)]">
                            <div class="flex items-start justify-between gap-3"><p class="text-[10px] font-semibold uppercase tracking-[0.13em] text-[#718078]">{{ $label }}</p><span class="flex h-8 w-8 items-center justify-center rounded-sm bg-[#edf6ee] text-[#315e43]">{{ $icon }}</span></div>
                            <p class="display-font mt-3 text-3xl font-semibold text-[#183b2c]">{{ $value }}</p>
                            <p class="mt-2 text-[11px] text-[#87948b]">{{ $caption }}</p>
                        </article>
                    @endforeach
                </section>

                <section class="rounded-md border border-[#e8eee8] bg-white p-5 shadow-[0_8px_24px_-22px_rgba(16,54,36,0.5)] sm:p-7">
                    <div class="mb-5 flex flex-wrap items-end justify-between gap-3">
                        <div><p class="text-[9px] font-semibold uppercase tracking-[0.17em] text-[#64835d]">Kurasi Poin Tertinggi</p><h2 class="display-font mt-1 text-2xl font-semibold text-[#183b2c]">Pengguna dengan Poin Tertinggi</h2><p class="mt-1 text-xs text-[#7b887f]">Pelanggan dengan pencapaian loyalitas tertinggi.</p></div>
                        <span class="rounded-sm bg-[#eaf5ec] px-3 py-2 text-[10px] font-medium text-[#315e43]">{{ number_format($totalPoints, 0, ',', '.') }} pts beredar</span>
                    </div>
                    <div class="space-y-2">
                        @forelse ($topUsers as $index => $user)
                            <article class="grid grid-cols-[32px_1fr_auto] items-center gap-3 rounded-sm {{ $index % 2 === 0 ? 'bg-[#eff8f0]' : 'bg-white' }} px-3 py-3 sm:grid-cols-[36px_1fr_150px_auto] sm:px-4">
                                <span class="flex h-8 w-8 items-center justify-center rounded-md bg-[#dcefdc] text-xs font-bold text-[#3c7147]">{{ $index + 1 }}</span>
                                <div class="min-w-0"><p class="truncate text-xs font-semibold text-[#30483a]">{{ $user->nama_lengkap }}</p><p class="mt-1 text-[10px] text-[#809087]">Pelanggan NusaCandle</p></div>
                                <div class="hidden sm:block"><div class="flex items-center justify-between text-[9px] text-[#7b887f]"><span>{{ number_format($user->total_poin ?? 0, 0, ',', '.') }} pts</span><span>Loyalitas</span></div><div class="mt-1 h-1.5 overflow-hidden rounded-full bg-[#dce9dc]"><div class="h-full rounded-full bg-[#57845a]" style="width: {{ min(100, max(8, (int) (($user->total_poin ?? 0) / max(1, $totalPoints) * 100))) }}%"></div></div></div>
                                <span class="rounded-sm bg-[#dcefdc] px-2.5 py-1.5 text-[10px] font-semibold text-[#356c40]">{{ number_format($user->total_poin ?? 0, 0, ',', '.') }} poin</span>
                            </article>
                        @empty
                            <div class="rounded-sm bg-[#f4f8f4] px-4 py-8 text-center text-sm text-[#7b887f]">Belum ada data pelanggan untuk ditampilkan.</div>
                        @endforelse
                    </div>
                </section>
            </div>
        </main>
    </div>
</body>
</html>
