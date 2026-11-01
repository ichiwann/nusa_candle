<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - NusaCandle</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'DM Sans', sans-serif; }
        .display-font { font-family: 'Playfair Display', serif; }
    </style>
</head>

<body class="min-h-screen bg-[#f3f6f1] p-4 text-[#153b2a] sm:p-8">
    <main class="mx-auto flex min-h-[calc(100vh-2rem)] w-full max-w-6xl items-center justify-center sm:min-h-[calc(100vh-4rem)]">
        <section class="grid w-full overflow-hidden rounded-lg bg-white shadow-[0_24px_70px_-35px_rgba(16,54,36,0.5)] lg:grid-cols-[0.88fr_1.12fr]">
            <aside class="relative flex min-h-[360px] flex-col justify-between overflow-hidden bg-[#123b2b] p-7 text-white sm:p-10 lg:min-h-[560px] lg:p-12">
                <div class="pointer-events-none absolute -right-20 top-24 h-64 w-64 rounded-full border border-white/10"></div>
                <div class="pointer-events-none absolute -right-10 top-[8.5rem] h-44 w-44 rounded-full border border-white/10"></div>

                <div class="relative">
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-3 text-white no-underline">
                        <span class="flex h-10 w-10 items-center justify-center rounded-full border border-white/30 bg-white/5" aria-hidden="true">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21c-4.5-2.4-7-6.1-7-10.2C5 6.2 8.3 3.5 12 3c3.7.5 7 3.2 7 7.8 0 4.1-2.5 7.8-7 10.2Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 20c0-5 1.7-8.6 4.4-11.2M12 14c-1.1-1.5-2.3-2.5-4-3.2" />
                            </svg>
                        </span>
                        <span>
                            <span class="block text-[9px] uppercase tracking-[0.2em] text-emerald-100/70">East Java Highlands Artisanal</span>
                            <span class="display-font block text-lg">NusaCandle</span>
                        </span>
                    </a>

                    <div class="mt-12 inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/10 px-3 py-1.5 text-[10px] font-medium tracking-wide text-emerald-50">
                        <span class="h-1.5 w-1.5 rounded-full bg-[#d7bd85]"></span>
                        AKSES PELANGGAN & ADMINISTRATOR
                    </div>
                    <h1 class="display-font mt-5 max-w-md text-3xl leading-tight sm:text-4xl">
                        Aroma hangat untuk setiap ruang Anda.
                    </h1>
                    <p class="mt-4 max-w-sm text-sm leading-6 text-emerald-50/70">
                        Masuk untuk mengelola akun dan menikmati pengalaman NusaCandle dari mana saja.
                    </p>
                </div>

                <div class="relative mt-10 border-t border-white/15 pt-5 text-xs text-emerald-50/60">
                    <div class="flex flex-wrap items-center justify-between gap-3">
                        <span>Est. Malang, Jawa Timur</span>
                        <span class="inline-flex items-center gap-2">
                            <svg class="h-4 w-4 text-[#d7bd85]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2m0 14v2M5.6 5.6 7 7m10 10 1.4 1.4M3 12h2m14 0h2M5.6 18.4 7 17m10-10 1.4-1.4M12 8a4 4 0 1 0 0 8 4 4 0 0 0 0-8Z" />
                            </svg>
                            Dibuat dengan ketelitian
                        </span>
                    </div>
                </div>
            </aside>

            <div class="flex items-center px-6 py-10 sm:px-12 lg:px-16">
                <div class="mx-auto w-full max-w-md">
                    <div class="mb-9">
                        <div class="mb-7 flex items-center gap-3">
                            <span class="flex h-11 w-11 items-center justify-center rounded-md bg-[#edf6ee] text-[#17432f]" aria-hidden="true">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3 19 6v5c0 4.6-2.8 8.1-7 10-4.2-1.9-7-5.4-7-10V6l7-3Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m9 12 2 2 4-4" />
                                </svg>
                            </span>
                            <div>
                                <p class="display-font text-xl font-semibold">NusaCandle</p>
                                <p class="text-[10px] uppercase tracking-[0.16em] text-[#718078]">NusaCandle account</p>
                            </div>
                        </div>
                        <p class="mb-2 text-xs font-semibold uppercase tracking-[0.15em] text-[#718078]">Selamat datang kembali</p>
                        <h2 class="display-font text-3xl font-semibold leading-tight text-[#183b2c] sm:text-4xl">Masuk ke akun NusaCandle</h2>
                        <p class="mt-3 text-sm leading-6 text-[#68766e]">Gunakan username dan password akun Anda untuk melanjutkan.</p>
                    </div>

                    @if (session('status'))
                        <div role="status" class="mb-5 border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (session('success'))
                        <div role="status" class="mb-5 border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div role="alert" class="mb-5 border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form action="{{ route('login') }}" method="POST" class="space-y-5">
                        @csrf
                        <div>
                            <label for="username" class="mb-2 block text-sm font-semibold text-[#32483b]">Username</label>
                            <div class="relative">
                                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-[#829187]" aria-hidden="true">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 21a8 8 0 0 0-16 0m8-10a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z" />
                                    </svg>
                                </span>
                                <input id="username" name="username" type="text" value="{{ old('username') }}" autocomplete="username" required autofocus
                                    class="block w-full border border-[#dce7dc] bg-[#f4faf4] py-3 pl-11 pr-4 text-sm text-[#203c2e] outline-none transition focus:border-[#315e43] focus:bg-white focus:ring-2 focus:ring-[#315e43]/10"
                                    placeholder="Masukkan username">
                            </div>
                        </div>

                        <div>
                            <div class="mb-2 flex items-center justify-between gap-3">
                                <label for="password" class="block text-sm font-semibold text-[#32483b]">Password</label>
                                <a href="{{ route('password.request') }}" class="text-xs font-medium text-[#315e43] hover:text-[#173b2a]">Lupa password?</a>
                            </div>
                            <div class="relative">
                                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-[#829187]" aria-hidden="true">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                        <rect x="4" y="10" width="16" height="11" rx="2" />
                                        <path stroke-linecap="round" d="M8 10V7a4 4 0 1 1 8 0v3m-4 5v2" />
                                    </svg>
                                </span>
                                <input id="password" name="password" type="password" autocomplete="current-password" required
                                    class="block w-full border border-[#dce7dc] bg-[#f4faf4] py-3 pl-11 pr-12 text-sm text-[#203c2e] outline-none transition focus:border-[#315e43] focus:bg-white focus:ring-2 focus:ring-[#315e43]/10"
                                    placeholder="Masukkan password">
                                <button type="button" id="toggle-password" aria-label="Tampilkan password" aria-pressed="false"
                                    class="absolute inset-y-0 right-0 flex items-center px-4 text-[#829187] transition hover:text-[#315e43]">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z" />
                                        <circle cx="12" cy="12" r="3" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <label for="remember" class="flex cursor-pointer items-center gap-2.5 text-sm text-[#68766e]">
                            <input id="remember" name="remember" type="checkbox" value="1" class="h-4 w-4 accent-[#17432f]">
                            Ingat saya di perangkat ini
                        </label>

                        <button type="submit" class="group flex w-full items-center justify-center gap-2 bg-[#092f21] px-5 py-3.5 text-sm font-semibold text-white transition hover:bg-[#17432f] focus:outline-none focus:ring-2 focus:ring-[#315e43] focus:ring-offset-2">
                            Masuk Sekarang
                            <svg class="h-4 w-4 transition-transform group-hover:translate-x-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6" />
                            </svg>
                        </button>
                    </form>

                    <div class="mt-8 border-t border-[#edf0eb] pt-5 text-center">
                        <a href="{{ route('home') }}" class="text-xs font-medium text-[#68766e] transition hover:text-[#17432f]">Kembali ke toko NusaCandle</a>
                        <p class="mt-5 text-[11px] text-[#98a29b]">&copy; {{ date('Y') }} NusaCandle Natural Aromatics</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script>
        document.getElementById('toggle-password').addEventListener('click', function () {
            const password = document.getElementById('password');
            const visible = password.type === 'password';
            password.type = visible ? 'text' : 'password';
            this.setAttribute('aria-pressed', String(visible));
            this.setAttribute('aria-label', visible ? 'Sembunyikan password' : 'Tampilkan password');
        });
    </script>
</body>

</html>