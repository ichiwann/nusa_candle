<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - NusaCandle</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus {
            -webkit-box-shadow: 0 0 0 1000px #fff inset;
            -webkit-text-fill-color: #292524;
        }
    </style>
</head>
<body class="flex min-h-screen items-center justify-center bg-[#f4f4f4] px-2 pt-3 font-sans">
    <main class="h-[90vh] max-h-[630px] w-[95vw] max-w-[936px]">
        <div class="grid h-full grid-cols-2 overflow-hidden rounded-xl bg-white shadow-md">
            <section class="flex flex-col justify-center bg-[#f3e7dd] px-4 py-6 sm:px-8 lg:px-10" aria-label="Tentang NusaCandle">
                <div class="mb-6">
                    <img src="{{ asset('images/logo-nusacandle.png') }}" alt="Logo NusaCandle"
                        class="mb-5 h-24 w-24 object-contain sm:h-[120px] sm:w-[120px]">
                    <h1 class="font-display text-3xl font-bold leading-none text-[#183b2c] sm:text-5xl">NusaCandle</h1>
                    <p class="mt-2 text-[10px] font-medium uppercase tracking-[0.24em] text-[#52645a] sm:text-sm">Lilin Aroma Terapi</p>
                    <p class="mt-3 font-display text-xs italic text-[#52645a] sm:text-base">"Aroma Apel • Relaksasi Setiap Saat"</p>
                </div>

                <div class="space-y-3">
                    <div class="flex items-center gap-3 rounded-xl border border-[#e8dec8] bg-[#fffdf8] px-3 py-3 sm:px-4 sm:py-4">
                        <svg class="h-5 w-5 shrink-0 text-[#315b42]" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M20.5 3.5C11 3.5 5 7.7 5 14a6 6 0 006 6c6.3 0 10.5-6 9.5-16.5Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 21c3-4 6.5-7.5 12-11" />
                        </svg>
                        <p class="text-[9px] leading-relaxed text-[#4b463f] sm:text-sm">100% Kedelai Alami (Soy Wax) &amp; Bebas Parafin</p>
                    </div>
                    <div class="flex items-center gap-3 rounded-xl border border-[#e8dec8] bg-[#fffdf8] px-3 py-3 sm:px-4 sm:py-4">
                        <svg class="h-5 w-5 shrink-0 text-[#183d2b]" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4c-3.3 0-5.8 2.3-5.x`8 5.5 0 2.3-1.4 4-2.7 5.6-1.1 1.3-.2 3.2 1.5 3.2h14c1.7 0 2.6-1.9 1.5-3.2-1.3-1.6-2.7-3.3-2.7-5.6C17.8 6.3 15.3 4 12 4Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 18.3v3.2m-5.5.5h11" />
                        </svg>
                        <p class="text-[9px] leading-relaxed text-[#4b463f] sm:text-sm">Ekstrak Buah Apel Khas Kota Malang &amp; Minyak Atsiri Alami</p>
                    </div>
                </div>
            </section>

            <section class="flex flex-col justify-center px-4 py-4 sm:px-10 sm:py-7 lg:px-12" aria-labelledby="login-title">
                <div class="mb-3 sm:mb-5">
                    <h2 id="login-title" class="font-display text-sm font-bold leading-tight text-[#a51f27] sm:text-4xl">Login</h2>
                    <p class="mt-0.5 font-buyer text-[6px] text-[#77736b] sm:text-lg">Selamat datang di NusaCandle.</p>
                </div>

            @if ($errors->any())
                <div class="mb-2 rounded-md border border-red-100 bg-red-50 px-2 py-1 text-[7px] text-red-700 sm:mb-4 sm:px-3 sm:py-2 sm:text-[10px]">
                    {{ $errors->first() }}
                </div>
            @endif

            @if (session('success'))
                <div class="mb-2 rounded-md border border-emerald-100 bg-emerald-50 px-2 py-1 text-[7px] text-emerald-800 sm:mb-4 sm:px-3 sm:py-2 sm:text-[10px]">
                    {{ session('success') }}
                </div>
            @endif

                <form action="{{ route('login') }}" method="POST" class="space-y-1.5 sm:space-y-4">
                @csrf

                <div>
                    <label for="username" class="mb-0.5 block text-[6px] font-semibold uppercase tracking-wide text-[#52645a] sm:mb-1 sm:text-[11px]">Username</label>
                    <div class="relative">
                        <svg class="absolute left-2 top-1/2 h-2 w-2 -translate-y-1/2 text-[#a59d91] sm:left-3 sm:h-4 sm:w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <rect x="3" y="5" width="18" height="14" rx="1.5" stroke-width="1.8" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m4 7 8 5 8-5" />
                        </svg>
                        <input type="text" id="username" name="username" value="{{ old('username') }}" required autocomplete="username"
                            class="h-[15px] w-full rounded-md border border-[#e5dfd1] bg-white pl-5 pr-2 text-[6px] outline-none transition focus:border-[#a51f27] focus:ring-1 focus:ring-[#a51f27]/20 sm:h-12 sm:pl-10 sm:pr-3 sm:text-xs"
                            placeholder="Masukkan username">
                    </div>
                </div>

                <div>
                    <label for="password" class="mb-0.5 block text-[6px] font-semibold uppercase tracking-wide text-[#52645a] sm:mb-1 sm:text-[11px]">Password</label>
                    <div class="relative">
                        <input type="password" id="password" name="password" required autocomplete="current-password"
                            class="h-[15px] w-full rounded-md border border-[#e5dfd1] bg-white pl-5 pr-6 text-[6px] outline-none transition focus:border-[#a51f27] focus:ring-1 focus:ring-[#a51f27]/20 sm:h-12 sm:pl-10 sm:pr-10 sm:text-xs"
                            placeholder="Masukkan password">
                        <svg class="absolute left-1.5 top-1/2 h-2 w-2 -translate-y-1/2 text-[#a59d91] sm:left-3 sm:h-4 sm:w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M7 10V7a5 5 0 0110 0v3m-11 0h12a2 2 0 012 2v8H4v-8a2 2 0 012-2z" />
                        </svg>
                        <button type="button" onclick="togglePassword()" aria-label="Tampilkan atau sembunyikan password" class="absolute right-1.5 top-1/2 -translate-y-1/2 text-[#a59d91] hover:text-[#52645a] sm:right-3">
                            <svg id="eyeIcon" class="h-2 w-2 sm:h-4 sm:w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                   <br> <div class="mt-1 flex items-center justify-between gap-2 text-[6px] sm:mt-2 sm:text-[11px]">
                        <label for="remember" class="inline-flex items-center gap-1 text-[#77736b] sm:gap-1.5">
                            <input id="remember" type="checkbox" name="remember" value="1" class="h-2 w-2 rounded border-[#d9d4c6] accent-[#a51f27] sm:h-4 sm:w-4">
                            Ingat saya
                        </label>
                        <a href="#" class="text-[#77736b] transition hover:text-[#a51f27]">Lupa password?</a>
                    </div>
                </div>

                   <button type="submit" class="flex h-[16px] w-full items-center justify-center gap-1 rounded-md bg-[#a51f27] text-[6px] font-semibold uppercase text-white shadow-sm transition hover:bg-[#8e1820] sm:h-12 sm:gap-2 sm:text-[11px]">
                    <span>Login</span>
                        <svg class="h-2 w-2 sm:h-4 sm:w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </button>
            </form>

                <br><p class="mt-3 text-center text-[6px] text-[#77736b] sm:mt-4 sm:text-[11px]">
                    Belum punya akun? <a href="{{ route('register') }}" class="font-semibold text-[#a51f27] hover:underline">Daftar sekarang</a>
                </p>
            </section>
        </div>
    </main>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        }
    </script>

</body>
</html>