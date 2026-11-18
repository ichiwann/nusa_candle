<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - NusaCandle</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="font-sans bg-[#FAF9F6] min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-5xl bg-white rounded-2xl shadow-xl overflow-hidden flex flex-col lg:flex-row">
        
        <!-- PANEL KIRI - Branding (SAMA PERSIS seperti register) -->
        <div class="lg:w-5/12 p-8 lg:p-10 bg-white border-r border-stone-100">
            <!-- Top Badge -->
            <div class="inline-flex items-center gap-1.5 bg-[#F0F7F0] px-3 py-1.5 rounded-full mb-6">
                <svg class="w-3.5 h-3.5 text-[#103a2a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                <span class="text-[10px] font-semibold text-[#103a2a] uppercase tracking-wider">100% NATURAL SOY WAX & BOTANICAL</span>
            </div>

            <!-- Logo -->
            <div class="text-center mb-8">
                <img src="{{ asset('images/logo-nusacandle.png') }}" alt="NusaCandle" class="w-16 h-16 object-contain mx-auto mb-4" onerror="this.style.display='none'">
                <h1 class="text-2xl font-serif font-bold text-[#103a2a]">NusaCandle</h1>
                <p class="text-xs text-stone-500 mt-1">LILIN AROMA TERAPI</p>
                <p class="text-[10px] text-stone-400 italic mt-2">"Aroma Apel • Relaksasi Setiap Saat"</p>
            </div>

            <!-- Keunggulan -->
            <div class="space-y-3 mb-8">
                <div class="flex items-start gap-3 p-3 bg-[#F0F7F0] rounded-lg">
                    <svg class="w-5 h-5 text-[#103a2a] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <p class="text-xs text-stone-700 leading-relaxed">
                        <span class="font-semibold text-[#103a2a]">100% Handmade</span> dengan Soy Wax & Botanical Fragrance
                    </p>
                </div>
                <div class="flex items-start gap-3 p-3 bg-[#F0F7F0] rounded-lg">
                    <svg class="w-5 h-5 text-[#103a2a] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <p class="text-xs text-stone-700 leading-relaxed">
                        <span class="font-semibold text-[#103a2a]">Shohihah</span>: Bebas Api, Aman untuk Anak & Hewan Peliharaan
                    </p>
                </div>
                <div class="flex items-start gap-3 p-3 bg-[#F0F7F0] rounded-lg">
                    <svg class="w-5 h-5 text-[#103a2a] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <p class="text-xs text-stone-700 leading-relaxed">
                        <span class="font-semibold text-[#103a2a]">Wangi Menenangkan</span> untuk Relaksasi Rumah & Kantor
                    </p>
                </div>
            </div>

            <!-- Footer -->
            <div class="text-[10px] text-stone-400 space-y-1">
                <p>© NusaCandle Indonesia | Terms & Conditions | Privacy Policy</p>
            </div>
        </div>

        <!-- PANEL KANAN - Form Login -->
        <div class="lg:w-7/12 p-8 lg:p-12 bg-white flex flex-col justify-center">
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-[#103a2a] mb-2">Login</h2>
                <p class="text-sm text-stone-500">Selamat datang di NusaCandle</p>
            </div>

            @if ($errors->any())
                <div class="bg-red-50 border border-red-100 text-red-700 px-4 py-3 rounded-lg mb-6 text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            @if (session('success'))
                <div class="bg-emerald-50 border border-emerald-100 text-emerald-800 px-4 py-3 rounded-lg mb-6 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label for="username" class="block text-xs font-semibold text-stone-700 mb-1.5">USERNAME</label>
                    <input type="text" id="username" name="username" value="{{ old('username') }}" required autofocus
                        class="w-full px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-lg focus:bg-white focus:border-[#103a2a] focus:ring-1 focus:ring-[#103a2a]/20 outline-none transition text-sm"
                        placeholder="Masukkan username">
                </div>

                <div>
                    <label for="password" class="block text-xs font-semibold text-stone-700 mb-1.5">PASSWORD</label>
                    <div class="relative">
                        <input type="password" id="password" name="password" required
                            class="w-full px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-lg focus:bg-white focus:border-[#103a2a] focus:ring-1 focus:ring-[#103a2a]/20 outline-none transition text-sm pr-10"
                            placeholder="Masukkan password">
                        <button type="button" onclick="togglePassword()" class="absolute right-3 top-1/2 -translate-y-1/2 text-stone-400 hover:text-stone-600">
                            <svg id="eyeIcon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                    <div class="flex justify-end mt-2">
                        <a href="#" class="text-xs text-stone-500 hover:text-[#103a2a] transition">Lupa password?</a>
                    </div>
                </div>

                <button type="submit" class="w-full bg-[#103a2a] hover:bg-[#0a261c] text-white font-semibold py-3 rounded-lg transition-all duration-200 shadow-md hover:shadow-lg flex items-center justify-center gap-2">
                    <span>Masuk</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </button>
            </form>

            <!-- LINK KE REGISTER PAGE -->
            <p class="text-center text-sm text-stone-500 mt-6">
                Belum punya akun? <a href="{{ route('register') }}" class="text-[#103a2a] font-semibold hover:underline">Daftar sekarang</a>
            </p>
        </div>
    </div>

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