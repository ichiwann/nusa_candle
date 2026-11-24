<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - NusaCandle</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="flex min-h-screen items-center justify-center bg-[#f4f4f4] p-2 font-buyer">
    <main class="mx-auto flex min-h-[96vh] w-[97vw] max-w-[1152px] items-center justify-center rounded-md bg-[#f7f4e9] p-4 min-[600px]:h-[96vh] min-[600px]:min-h-0 min-[600px]:max-h-[828px] min-[600px]:p-6">
        <div class="grid w-full grid-cols-1 gap-4 min-[600px]:h-[68vh] min-[600px]:max-h-[554px] min-[600px]:grid-cols-[0.75fr_1fr] min-[600px]:gap-10">
            <section class="flex min-h-0 flex-col justify-center rounded-[10px] border border-[#eee8d8] bg-[#fffdf8] p-5 min-[600px]:h-full min-[600px]:px-6" aria-label="Tentang NusaCandle">
                <div class="mb-1 text-center">
                    <img src="{{ asset('images/logo-nusacandle.png') }}" alt="NusaCandle"
                        class="mx-auto mb-3 h-16 w-16 object-contain sm:h-20 sm:w-20" onerror="this.style.display='none'">
                    <h1 class="font-display text-sm font-semibold text-[#a51f27] sm:text-lg">NusaCandle</h1>
                    <p class="mt-0 text-[7px] uppercase tracking-[0.16em] text-[#52645a] sm:text-[8px]">Lilin Aroma Terapi</p>
                    <p class="mt-0.5 text-[7px] italic text-[#77736b] sm:text-[8px]">"Aroma Apel • Relaksasi Setiap Saat"</p>
                </div>

                <div class="mt-4 border-t border-[#eee8d8] pt-4">
                    <h2 class="mb-1 text-center text-[7px] font-bold uppercase tracking-wide text-[#183b2c] sm:text-[8px]">
                        Keistimewaan Anggota NusaCandle
                    </h2>
                    <div class="space-y-4">
                        <div class="flex min-h-10 items-center gap-2 rounded-md border border-[#eee8d8] bg-[#f7f4e9] px-2 py-2">
                            <span class="flex h-4 w-4 shrink-0 items-center justify-center rounded bg-[#183b2c] text-white" aria-hidden="true">
                                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </span>
                            <p class="text-[7px] leading-relaxed text-stone-700 sm:text-[8px]">
                                Kumpulkan <span class="font-semibold text-[#a51f27]">75 poin NusaCandle</span> dan dapatkan hadiah eksklusif.
                            </p>
                        </div>
                        <div class="flex min-h-10 items-center gap-2 rounded-md border border-[#eee8d8] bg-[#f7f4e9] px-2 py-2">
                            <svg class="h-3 w-3 shrink-0 text-[#537056]" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21s-8-4.5-8-11a4 4 0 017.5-2 4 4 0 017.5 2c0 6.5-7 11-7 11z" />
                            </svg>
                            <p class="text-[7px] leading-relaxed text-stone-700 sm:text-[8px]">
                                100% Minyak Atsiri Organik &amp; Soy Wax Ramah Lingkungan.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="min-h-0 rounded-[10px] border border-[#eee8d8] bg-[#fffdf8] px-5 py-6 min-[600px]:h-full min-[600px]:px-6 min-[600px]:py-5" aria-labelledby="register-title">
                <header class="mb-3">
                    <p class="text-[7px] font-semibold uppercase tracking-[0.16em] text-[#537056] sm:text-[8px]">Registrasi</p>
                    <h2 id="register-title" class="font-display text-sm font-semibold leading-tight text-[#a51f27] sm:text-xl">
                        Buat Akun NusaCandle
                    </h2>
                    <p class="mt-0.5 text-[7px] leading-relaxed text-stone-500 sm:text-[8px]">Daftar dan nikmati pengalaman berbelanja di NusaCandle.</p>
                </header>

                @if ($errors->any())
                    <div class="mb-2 rounded-md border border-red-100 bg-red-50 px-2 py-1 text-[7px] leading-relaxed text-red-700">
                        <ul class="list-inside list-disc space-y-0.5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('register') }}" method="POST" class="space-y-2 sm:space-y-2.5">
                    @csrf

                    <div>
                        <label for="nama_lengkap" class="block text-[6px] font-semibold uppercase tracking-wide text-[#52645a] sm:text-[8px]">Nama Lengkap</label>
                        <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required autocomplete="name"
                            class="block h-5 w-full rounded-md border border-[#e5dfd1] bg-white px-2 text-[7px] outline-none focus:border-[#a51f27] focus:ring-1 focus:ring-[#a51f27]/20 sm:h-8 sm:text-[10px]"
                            placeholder="Masukkan nama lengkap">
                    </div>

                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label for="username" class="block text-[6px] font-semibold uppercase tracking-wide text-[#52645a] sm:text-[8px]">Username</label>
                            <input type="text" id="username" name="username" value="{{ old('username') }}" required autocomplete="username"
                                class="block h-5 w-full rounded-md border border-[#e5dfd1] bg-white px-2 text-[7px] outline-none focus:border-[#a51f27] focus:ring-1 focus:ring-[#a51f27]/20 sm:h-8 sm:text-[10px]"
                                placeholder="Masukkan username">
                        </div>
                        <div>
                            <label for="no_telepon" class="block text-[6px] font-semibold uppercase tracking-wide text-[#52645a] sm:text-[8px]">Nomor Telepon</label>
                            <input type="tel" id="no_telepon" name="no_telepon" value="{{ old('no_telepon') }}" required autocomplete="tel"
                                class="block h-5 w-full rounded-md border border-[#e5dfd1] bg-white px-2 text-[7px] outline-none focus:border-[#a51f27] focus:ring-1 focus:ring-[#a51f27]/20 sm:h-8 sm:text-[10px]"
                                placeholder="Nomor telepon">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label for="email" class="block text-[6px] font-semibold uppercase tracking-wide text-[#52645a] sm:text-[8px]">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                                class="block h-5 w-full rounded-md border border-[#e5dfd1] bg-white px-2 text-[7px] outline-none focus:border-[#a51f27] focus:ring-1 focus:ring-[#a51f27]/20 sm:h-8 sm:text-[10px]"
                                placeholder="Alamat email">
                        </div>
                        <div>
                            <label for="alamat" class="block text-[6px] font-semibold uppercase tracking-wide text-[#52645a] sm:text-[8px]">Alamat Lengkap</label>
                            <input type="text" id="alamat" name="alamat" value="{{ old('alamat') }}" required autocomplete="street-address"
                                class="block h-5 w-full rounded-md border border-[#e5dfd1] bg-white px-2 text-[7px] outline-none focus:border-[#a51f27] focus:ring-1 focus:ring-[#a51f27]/20 sm:h-8 sm:text-[10px]"
                                placeholder="Alamat lengkap">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label for="password" class="block text-[6px] font-semibold uppercase tracking-wide text-[#52645a] sm:text-[8px]">Password</label>
                            <input type="password" id="password" name="password" required autocomplete="new-password"
                                class="block h-5 w-full rounded-md border border-[#e5dfd1] bg-white px-2 text-[7px] outline-none focus:border-[#a51f27] focus:ring-1 focus:ring-[#a51f27]/20 sm:h-8 sm:text-[10px]"
                                placeholder="Buat password">
                        </div>
                        <div>
                            <label for="password_confirmation" class="block text-[6px] font-semibold uppercase tracking-wide text-[#52645a] sm:text-[8px]">Konfirmasi Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password"
                                class="block h-5 w-full rounded-md border border-[#e5dfd1] bg-white px-2 text-[7px] outline-none focus:border-[#a51f27] focus:ring-1 focus:ring-[#a51f27]/20 sm:h-8 sm:text-[10px]"
                                placeholder="Ulangi password">
                        </div>
                    </div>

                    <div class="flex items-start gap-1.5 pt-0.5">
                        <input type="checkbox" id="terms" name="terms" required
                            class="mt-0.5 h-2.5 w-2.5 shrink-0 cursor-pointer rounded border-stone-300 accent-[#a51f27]">
                        <label for="terms" class="cursor-pointer select-none text-[6px] leading-relaxed text-stone-600 sm:text-[8px]">
                            Saya menyetujui <a href="#" class="font-semibold text-[#a51f27] underline">Syarat & Ketentuan</a> serta
                            <a href="#" class="font-semibold text-[#a51f27] underline">Kebijakan Privasi</a> NusaCandle.
                        </label>
                    </div>

                    <button type="submit"
                        class="flex h-6 w-full items-center justify-center gap-1 rounded-md bg-[#a51f27] text-[7px] font-semibold text-white transition hover:bg-[#8e1820] sm:h-8 sm:text-[9px]">
                        <span>Daftar Sekarang</span>
                        <svg class="h-2.5 w-2.5 sm:h-3 sm:w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </button>
                </form>

                <p class="mt-3.5 text-center text-[7px] text-stone-500 sm:text-[8px]">
                    Sudah punya akun? <a href="{{ route('login') }}" class="font-semibold text-[#a51f27] underline">Masuk sekarang</a>
                </p>
            </section>
        </div>
    </main>
</body>
</html>
