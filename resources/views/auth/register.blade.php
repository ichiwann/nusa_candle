<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - NusaCandle</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
</head>

<body class="font-sans bg-[#FAF9F6] min-h-screen flex items-center justify-center p-4 py-8">

    <div class="w-full max-w-6xl bg-white rounded-2xl shadow-xl overflow-hidden flex flex-col lg:flex-row">

        <!-- PANEL KIRI - Branding & Info -->
        <div class="lg:w-5/12 p-8 lg:p-12 bg-white border-r border-stone-100">
            <!-- Logo -->
            <div class="text-center mb-8">
                <img src="{{ asset('images/logo-nusacandle.png') }}" alt="NusaCandle"
                    class="w-20 h-20 object-contain mx-auto mb-4" onerror="this.style.display='none'">
                <h1 class="text-3xl font-serif font-bold text-[#103a2a]">NusaCandle</h1>
                <p class="text-xs text-stone-500 mt-1">LILIN AROMA TERAPI</p>
                <p class="text-[10px] text-stone-400 italic mt-1">"Aroma Apel • Relaksasi Setiap Saat"</p>
            </div>

            <!-- Keistimewaan -->
            <div class="mb-8">
                <h3 class="text-xs font-bold uppercase tracking-wider text-[#103a2a] mb-4 text-center">KEISTIMEWAAN
                    ANGGOTA NUSACANDLE</h3>

                <div class="space-y-3">
                    <div class="flex items-start gap-3 p-3 bg-[#F0F7F0] rounded-lg">
                        <svg class="w-5 h-5 text-[#103a2a] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-xs text-stone-700 leading-relaxed">
                            <span class="font-semibold text-[#103a2a]">Kumpulkan 75 poin NusaCandle</span> dan dapatkan
                            hadiah eksklusif NusaCandle gratis!
                        </p>
                    </div>

                    <div class="flex items-start gap-3 p-3 bg-[#F0F7F0] rounded-lg">
                        <svg class="w-5 h-5 text-[#103a2a] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                        <p class="text-xs text-stone-700 leading-relaxed">
                            <span class="font-semibold text-[#103a2a]">Akses diskon member</span> dan penawaran spesial
                            hanya untuk anggota NusaCandle.
                        </p>
                    </div>

                    <div class="flex items-start gap-3 p-3 bg-[#F0F7F0] rounded-lg">
                        <svg class="w-5 h-5 text-[#103a2a] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        <p class="text-xs text-stone-700 leading-relaxed">
                            <span class="font-semibold text-[#103a2a]">Jaminan kualitas</span> aroma terapi bergaransi
                            dan 100% natural.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Footer Info -->
            <div class="text-center text-[10px] text-stone-400">
                <p>© 2025 NusaCandle. Natural Organic Soy Wax & Botanical Fragrances.</p>
            </div>
        </div>

        <!-- PANEL KANAN - Form Register -->
        <div class="lg:w-7/12 p-8 lg:p-12 bg-white">
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-[#103a2a] mb-1">REGISTRASI</h2>
                <p class="text-sm text-stone-500">Buat Akun NusaCandle</p>
                <p class="text-xs text-stone-400 mt-2">Daftar dan nikmati pengalaman berbelanja di NusaCandle</p>
            </div>

            @if ($errors->any())
                <div class="bg-red-50 border border-red-100 text-red-700 px-4 py-3 rounded-lg mb-6 text-sm">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="nama_lengkap" class="block text-xs font-semibold text-stone-700 mb-1.5">NAMA LENGKAP
                        <span class="text-red-500">*</span></label>
                    <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}"
                        required
                        class="w-full px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-lg focus:bg-white focus:border-[#103a2a] focus:ring-1 focus:ring-[#103a2a]/20 outline-none transition text-sm"
                        placeholder="Masukkan nama lengkap">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="username" class="block text-xs font-semibold text-stone-700 mb-1.5">USERNAME <span
                                class="text-red-500">*</span></label>
                        <input type="text" id="username" name="username" value="{{ old('username') }}" required
                            class="w-full px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-lg focus:bg-white focus:border-[#103a2a] focus:ring-1 focus:ring-[#103a2a]/20 outline-none transition text-sm"
                            placeholder="Username">
                    </div>
                    <div>
                        <label for="no_telepon" class="block text-xs font-semibold text-stone-700 mb-1.5">NOMOR TELEPON
                            <span class="text-red-500">*</span></label>
                        <input type="tel" id="no_telepon" name="no_telepon" value="{{ old('no_telepon') }}" required
                            class="w-full px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-lg focus:bg-white focus:border-[#103a2a] focus:ring-1 focus:ring-[#103a2a]/20 outline-none transition text-sm"
                            placeholder="Nomor telepon">
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-xs font-semibold text-stone-700 mb-1.5">EMAIL <span
                            class="text-red-500">*</span></label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                        class="w-full px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-lg focus:bg-white focus:border-[#103a2a] focus:ring-1 focus:ring-[#103a2a]/20 outline-none transition text-sm"
                        placeholder="Alamat email">
                </div>

                <!-- Tambahkan kode ini di antara Email dan Password -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-1.5">
                        Alamat Lengkap <span class="text-red-500">*</span>
                    </label>
                    <textarea name="alamat" rows="2" required
                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-md text-sm focus:border-[#0f4c3a] focus:ring-1 focus:ring-[#0f4c3a]/20 outline-none resize-none"
                        placeholder="Masukkan alamat lengkap">{{ old('alamat') }}</textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="password" class="block text-xs font-semibold text-stone-700 mb-1.5">PASSWORD <span
                                class="text-red-500">*</span></label>
                        <input type="password" id="password" name="password" required
                            class="w-full px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-lg focus:bg-white focus:border-[#103a2a] focus:ring-1 focus:ring-[#103a2a]/20 outline-none transition text-sm"
                            placeholder="Password">
                    </div>
                    <div>
                        <label for="password_confirmation"
                            class="block text-xs font-semibold text-stone-700 mb-1.5">KONFIRMASI PASSWORD <span
                                class="text-red-500">*</span></label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                            class="w-full px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-lg focus:bg-white focus:border-[#103a2a] focus:ring-1 focus:ring-[#103a2a]/20 outline-none transition text-sm"
                            placeholder="Ulangi password">
                    </div>
                </div>

                <div class="flex items-start gap-2 pt-2">
                    <input type="checkbox" id="terms" name="terms" required
                        class="mt-1 w-4 h-4 text-[#103a2a] border-stone-300 rounded focus:ring-[#103a2a] cursor-pointer">
                    <label for="terms" class="text-xs text-stone-600 cursor-pointer select-none leading-relaxed">
                        Saya menyetujui <a href="#" class="text-[#103a2a] font-semibold hover:underline">Syarat
                            & Ketentuan</a> serta <a href="#"
                            class="text-[#103a2a] font-semibold hover:underline">Kebijakan Privasi</a> NusaCandle.
                    </label>
                </div>

                <button type="submit"
                    class="w-full bg-[#103a2a] hover:bg-[#0a261c] text-white font-semibold py-3 rounded-lg transition-all duration-200 shadow-md hover:shadow-lg flex items-center justify-center gap-2 group">
                    <span>Daftar Sekarang</span>
                    <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </button>
            </form>

            <p class="text-center text-sm text-stone-500 mt-6">
                Sudah punya akun? <a href="{{ route('login') }}"
                    class="text-[#103a2a] font-semibold hover:underline">Masuk sekarang</a>
            </p>

            <div class="mt-8 pt-6 border-t border-stone-100 text-center">
                <p class="text-[10px] text-stone-400">© NusaCandle Indonesia | Terms & Conditions | Privacy Policy</p>
            </div>
        </div>
    </div>

</body>

</html>
