<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - NusaCandle</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { margin: 0 !important; padding: 0 !important; }
    </style>
</head>
<body class="min-h-screen bg-[#f4f4f4] font-sans">
    <div class="flex min-h-screen items-center justify-center p-4">
        <div class="grid w-full max-w-5xl grid-cols-1 gap-6 lg:grid-cols-2 lg:gap-10">

            {{-- ===== KOLOM KIRI: BRANDING ===== --}}
            <div class="flex flex-col items-center justify-center rounded-xl border border-[#e8dfd1] bg-white p-8 shadow-sm">
                {{-- Logo --}}
                <img src="{{ asset('images/logo-nusacandle.png') }}" alt="NusaCandle"
                    class="mb-4 h-20 w-20 object-contain" onerror="this.style.display='none'">
                <h1 class="font-serif text-2xl font-bold text-[#a51f27]">NusaCandle</h1>
                <p class="mt-1 text-[10px] uppercase tracking-widest text-[#52645a]">Lilin Aroma Terapi</p>
                <p class="mt-1 text-[10px] italic text-[#77736b]">"Aroma Apel • Relaksasi Setiap Saat"</p>

                {{-- Divider --}}
                <div class="my-6 flex w-full items-center gap-2">
                    <span class="h-px flex-1 bg-[#eee8d8]"></span>
                    <svg class="h-4 w-4 text-[#8b7658]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m0 0l-4-4m4 4l4-4" />
                    </svg>
                    <span class="h-px flex-1 bg-[#eee8d8]"></span>
                </div>

                {{-- Keistimewaan Anggota NusaCandle --}}
                <h2 class="mb-3 text-center text-[10px] font-bold uppercase tracking-wide text-[#183b2c]">
                    Keistimewaan Anggota NusaCandle
                </h2>

                <div class="w-full space-y-3">
                    {{-- Card 1: Poin NusaCandle --}}
                    <div class="flex items-center gap-3 rounded-lg border border-[#e8dfd1] bg-[#f7f4e9] p-3">
                        <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-md bg-[#183b2c] text-white">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                        </span>
                        <p class="text-[11px] leading-relaxed text-stone-700">
                            Kumpulkan <span class="font-semibold text-[#a51f27]">70 poin NusaCandle</span> dan dapatkan refill lilin NusaCandle gratis!
                        </p>
                    </div>

                    {{-- Card 2: Bahan Organik --}}
                    <div class="flex items-center gap-3 rounded-lg border border-[#e8dfd1] bg-[#f7f4e9] p-3">
                        <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-md border border-[#183b2c] text-[#183b2c]">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                            </svg>
                        </span>
                        <p class="text-[11px] leading-relaxed text-stone-700">
                            100% Minyak Atsiri Organik & Soy Wax Ramah Lingkungan.
                        </p>
                    </div>
                </div>
            </div>

            {{-- ===== KOLOM KANAN: FORM REGISTER ===== --}}
            <div class="rounded-xl border border-[#e8dfd1] bg-white p-8 shadow-sm">
                <p class="text-[10px] font-semibold uppercase tracking-widest text-[#537056]">Registrasi</p>
                <h2 class="mt-1 font-serif text-3xl font-bold text-[#a51f27]">Buat Akun NusaCandle</h2>
                <p class="mt-2 text-sm text-stone-500">Daftar dan nikmati pengalaman berbelanja di NusaCandle.</p>

                @if ($errors->any())
                    <div class="mt-4 rounded-md border border-red-100 bg-red-50 p-3 text-sm text-red-700">
                        <ul class="list-inside list-disc space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('register') }}" method="POST" class="mt-6 space-y-4">
                    @csrf

                    <div>
                        <label for="nama_lengkap" class="block text-xs font-semibold uppercase tracking-wide text-[#52645a]">Nama Lengkap</label>
                        <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required autocomplete="name"
                            class="mt-1 block w-full rounded-md border border-[#e5dfd1] bg-white px-3 py-2.5 text-sm outline-none focus:border-[#a51f27] focus:ring-1 focus:ring-[#a51f27]/20"
                            placeholder="Masukkan nama lengkap">
                    </div>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <label for="username" class="block text-xs font-semibold uppercase tracking-wide text-[#52645a]">Username</label>
                            <input type="text" id="username" name="username" value="{{ old('username') }}" required autocomplete="username"
                                class="mt-1 block w-full rounded-md border border-[#e5dfd1] bg-white px-3 py-2.5 text-sm outline-none focus:border-[#a51f27] focus:ring-1 focus:ring-[#a51f27]/20"
                                placeholder="Masukkan username">
                        </div>
                        <div>
                            <label for="no_telepon" class="block text-xs font-semibold uppercase tracking-wide text-[#52645a]">Nomor Telepon</label>
                            <input type="tel" id="no_telepon" name="no_telepon" value="{{ old('no_telepon') }}" required autocomplete="tel"
                                class="mt-1 block w-full rounded-md border border-[#e5dfd1] bg-white px-3 py-2.5 text-sm outline-none focus:border-[#a51f27] focus:ring-1 focus:ring-[#a51f27]/20"
                                placeholder="Nomor telepon">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <label for="email" class="block text-xs font-semibold uppercase tracking-wide text-[#52645a]">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                                class="mt-1 block w-full rounded-md border border-[#e5dfd1] bg-white px-3 py-2.5 text-sm outline-none focus:border-[#a51f27] focus:ring-1 focus:ring-[#a51f27]/20"
                                placeholder="Alamat email">
                        </div>
                        <div>
                            <label for="alamat" class="block text-xs font-semibold uppercase tracking-wide text-[#52645a]">Alamat Lengkap</label>
                            <input type="text" id="alamat" name="alamat" value="{{ old('alamat') }}" required autocomplete="street-address"
                                class="mt-1 block w-full rounded-md border border-[#e5dfd1] bg-white px-3 py-2.5 text-sm outline-none focus:border-[#a51f27] focus:ring-1 focus:ring-[#a51f27]/20"
                                placeholder="Alamat lengkap">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <label for="password" class="block text-xs font-semibold uppercase tracking-wide text-[#52645a]">Password</label>
                            <div class="relative mt-1">
                                <input type="password" id="password" name="password" required autocomplete="new-password"
                                    class="block w-full rounded-md border border-[#e5dfd1] bg-white px-3 py-2.5 pr-10 text-sm outline-none focus:border-[#a51f27] focus:ring-1 focus:ring-[#a51f27]/20"
                                    placeholder="Buat password">
                                <button type="button" onclick="togglePassword('password', this)"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-[#8b8680] hover:text-[#a51f27]" tabindex="-1">
                                    <svg class="eye-open h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <svg class="eye-closed hidden h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div>
                            <label for="password_confirmation" class="block text-xs font-semibold uppercase tracking-wide text-[#52645a]">Konfirmasi Password</label>
                            <div class="relative mt-1">
                                <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password"
                                    class="block w-full rounded-md border border-[#e5dfd1] bg-white px-3 py-2.5 pr-10 text-sm outline-none focus:border-[#a51f27] focus:ring-1 focus:ring-[#a51f27]/20"
                                    placeholder="Ulangi password">
                                <button type="button" onclick="togglePassword('password_confirmation', this)"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-[#8b8680] hover:text-[#a51f27]" tabindex="-1">
                                    <svg class="eye-open h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <svg class="eye-closed hidden h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-start gap-2">
                        <input type="checkbox" id="terms" name="terms" required
                            class="mt-0.5 h-4 w-4 rounded border-stone-300 accent-[#a51f27]">
                        <label for="terms" class="text-xs text-stone-600">
                            Saya menyetujui <a href="#" class="font-semibold text-[#a51f27] underline">Syarat & Ketentuan</a> serta
                            <a href="#" class="font-semibold text-[#a51f27] underline">Kebijakan Privasi</a> NusaCandle.
                        </label>
                    </div>

                    <button type="submit"
                        class="flex w-full items-center justify-center gap-2 rounded-md bg-[#a51f27] px-4 py-3 text-sm font-semibold text-white transition hover:bg-[#8e1820]">
                        Daftar Sekarang
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </button>
                </form>

                <p class="mt-6 text-center text-sm text-stone-500">
                    Sudah punya akun? <a href="{{ route('login') }}" class="font-semibold text-[#a51f27] underline">Masuk sekarang</a>
                </p>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(inputId, button) {
            const input = document.getElementById(inputId);
            const eyeOpen = button.querySelector('.eye-open');
            const eyeClosed = button.querySelector('.eye-closed');
            if (input.type === 'password') {
                input.type = 'text';
                eyeOpen.classList.add('hidden');
                eyeClosed.classList.remove('hidden');
            } else {
                input.type = 'password';
                eyeOpen.classList.remove('hidden');
                eyeClosed.classList.add('hidden');
            }
        }
    </script>
</body>
</html>