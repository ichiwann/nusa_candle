<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - NusaCandle</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
</head>

<body class="font-sans bg-emerald-50 min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-6xl bg-white rounded-3xl shadow-2xl overflow-hidden flex flex-col md:flex-row">

        <!-- LEFT PANEL - Hijau Gelap -->
        <div class="md:w-5/12 bg-emerald-900 text-white p-8 md:p-12 flex flex-col justify-between">

            <!-- Top Content -->
            <div>
                <!-- Brand Header dengan Icon DAUN -->
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-10 h-10 border border-white/40 rounded-full flex items-center justify-center">
                        <!--  ICON DAUN (Leaf) -->
                        <svg class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M11 20A7 7 0 0 1 9.8 6.9C15.5 4.9 17 3.5 19 2c1 2 2 4.5 2 8 0 5.5-4.78 10-10 10Z" />
                            <path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-[10px] uppercase tracking-widest text-emerald-200/80 font-medium">East Java
                            Highlands Artisanal</p>
                        <h2 class="text-lg font-serif font-semibold">NusaCandle Highlands</h2>
                    </div>
                </div>

                <!-- Badge Hak Istimewa -->
                <div
                    class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm px-4 py-2 rounded-full text-xs mb-8">
                    <svg class="w-3.5 h-3.5 text-emerald-300" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="text-emerald-100 font-medium">Hak Istimewa Pelanggan Setia</span>
                </div>

                <!-- Heading -->
                <h1 class="text-3xl md:text-4xl font-serif font-bold leading-tight mb-4">
                    Aroma Apel Jawa Timur di Setiap Ruang Anda.
                </h1>

                <!-- Deskripsi -->
                <p class="text-emerald-100/70 text-sm leading-relaxed">
                    Masuk untuk memantau koleksi lilin botani edisi terbatas, saldo NusaPoin, dan penawaran aroma
                    musiman terkurasi.
                </p>
            </div>

            <!-- Bottom Info - Grid Kesamping -->
            <div class="grid grid-cols-2 gap-4 text-xs text-emerald-200/60 pt-4 border-t border-white/10">
                <div class="flex items-center space-x-2">
                    <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    </svg>
                    <span>Est. Malang, Jawa Timur</span>
                </div>
                <div class="flex items-center space-x-2">
                    <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>100% Lilin Kedelai Organik</span>
                </div>
            </div>
        </div>

        <!-- RIGHT PANEL - Form -->
        <div class="md:w-7/12 p-8 md:p-12 flex flex-col justify-center">

            <!-- Logo & Header -->
            <div class="mb-8">
                <div class="flex items-center space-x-3 mb-6">
                    <!-- 🖼️ LOGO NUSACANDLE (Ganti src dengan path logo kamu) -->
                    <img src="{{ asset('images/logo-nusacandle.png') }}" alt="NusaCandle Logo"
                        class="w-12 h-12 object-contain rounded-full bg-emerald-100 p-1.5">
                    <div>
                        <h3 class="text-2xl font-serif font-bold text-emerald-900">NusaCandle</h3>
                        <p class="text-[10px] text-gray-500 uppercase tracking-wider font-medium">E-Commerce Boutique
                        </p>
                    </div>
                </div>

                <h2 class="text-3xl md:text-4xl font-serif font-bold text-gray-900 mb-3">
                    Masuk ke Akun Pelanggan
                </h2>
                <p class="text-gray-600 text-sm leading-relaxed">
                    Selamat datang kembali! Masuk untuk cek pesanan, riwayat poin, dan voucher aroma apel Anda.
                </p>
            </div>

            <!--  NOTIFIKASI SUKSES REGISTER  -->
            @if (session('success'))
                <div
                    class="bg-emerald-50 border border-emerald-100 text-emerald-800 px-4 py-3 rounded-xl mb-6 text-sm flex items-center space-x-2 animate-pulse">
                    <svg class="w-5 h-5 flex-shrink-0 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Notifikasi Error (yang sudah ada) -->
            @if ($errors->any())
                <div
                    class="bg-red-50 border border-red-100 text-red-700 px-4 py-3 rounded-xl mb-6 text-sm flex items-center space-x-2">
                    <!-- ... -->
                </div>
            @endif

            <!-- Error Message -->
            @if ($errors->any())
                <div class="bg-red-50 border border-red-100 text-red-700 px-4 py-3 rounded-xl mb-6 text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Username -->
                <div>
                    <label for="username" class="block text-sm font-semibold text-gray-700 mb-2">Username</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <input type="text" id="username" name="username" value="{{ old('username') }}" required
                            autofocus
                            class="block w-full pl-11 pr-4 py-3.5 bg-emerald-50/50 border border-emerald-100 rounded-xl focus:bg-white focus:border-emerald-900 focus:ring-2 focus:ring-emerald-900/10 outline-none transition-all text-gray-900 placeholder-gray-500"
                            placeholder="Masukkan username">
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
                        <a href="#" class="text-sm text-emerald-900 hover:text-emerald-700 font-medium">
                            Lupa Password?
                        </a>
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input type="password" id="password" name="password" required
                            class="block w-full pl-11 pr-12 py-3.5 bg-emerald-50/50 border border-emerald-100 rounded-xl focus:bg-white focus:border-emerald-900 focus:ring-2 focus:ring-emerald-900/10 outline-none transition-all text-gray-900 placeholder-gray-500"
                            placeholder="Masukkan kata sandi">
                        <button type="button" class="absolute inset-y-0 right-0 pr-4 flex items-center"
                            onclick="togglePassword()">
                            <svg id="eyeIcon" class="h-5 w-5 text-gray-400 hover:text-gray-600" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input id="remember" name="remember" type="checkbox"
                        class="h-4 w-4 text-emerald-900 border-gray-300 rounded focus:ring-emerald-900 cursor-pointer">
                    <label for="remember" class="ml-3 block text-sm text-gray-600 cursor-pointer select-none">
                        Ingat saya di perangkat ini
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full bg-emerald-900 hover:bg-emerald-800 text-white font-semibold py-4 rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl flex items-center justify-center space-x-2 group">
                    <span>Masuk Sekarang</span>
                    <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </button>
            </form>

            <!-- Register Link -->
            <div class="mt-8 text-center">
                <p class="text-gray-600 text-sm">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-emerald-900 hover:text-emerald-700 font-semibold">
                        Daftar Sekarang
                    </a>
                </p>
            </div>

            <!-- Footer -->
            <div class="mt-8 pt-6 border-t border-gray-100">
                <p class="text-center text-xs text-gray-400">
                    © 2025 NusaCandle Natural Aromatics. Hak Cipta Dilindungi.
                </p>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        }
    </script>

</body>

</html>
