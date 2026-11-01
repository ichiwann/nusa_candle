<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - NusaCandle</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        body { font-family: 'DM Sans', sans-serif; }
        .display-font { font-family: 'Playfair Display', serif; }
    </style>
</head>

<body class="min-h-screen bg-[#f3f6f1] p-4 py-8 text-[#153b2a] sm:p-4">

    <main class="mx-auto flex min-h-[calc(100vh-2rem)] w-full max-w-7xl items-center justify-center">
        <section class="grid w-full overflow-hidden rounded-lg bg-white shadow-[0_24px_70px_-35px_rgba(16,54,36,0.5)] lg:grid-cols-[0.78fr_1.22fr]">

        <!-- LEFT PANEL - Hijau Gelap (Natural Flow) -->
        <div class="flex flex-col bg-[#123b2b] p-7 text-white sm:p-10 lg:min-h-[560px] lg:p-12">

            <!-- Badge -->
            <div
                class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm px-4 py-2 rounded-full text-xs mb-6 w-fit">
                <svg class="w-3.5 h-3.5 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-emerald-100 font-medium uppercase tracking-wider text-[10px]">East Java Highlands
                    Artisanal</span>
            </div>

            <!-- Heading -->
            <h1 class="text-3xl md:text-4xl font-serif font-bold leading-tight mb-4">
                Aroma Apel •<br>Relaksasi Setiap Saat
            </h1>

            <!-- Deskripsi -->
            <p class="text-emerald-100/70 text-sm leading-relaxed mb-6">
                Lilin aromaterapi ramah lingkungan berbahan sari apel murni perkebunan dataran tinggi. Dibuat tangan
                dengan standar kemewahan alami.
            </p>

            <!-- Gambar Produk -->
            <div class="relative rounded-2xl overflow-hidden mb-8 aspect-[4/3]">
                <img src="https://images.unsplash.com/photo-1603006905003-be475563bc59?w=600&h=450&fit=crop"
                    alt="NusaCandle Product" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-emerald-900/60 to-transparent"></div>

                <!-- Info di atas gambar -->
                <div class="absolute bottom-4 left-4 right-4 flex justify-between text-xs text-white">
                    <div class="flex items-center space-x-1.5">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>Panen Pilihan Batu & Malang</span>
                    </div>
                    <span>100% Soy & Apple Wax</span>
                </div>
            </div>

            <!-- Features List - Natural Spacing -->
            <div class="space-y-5">
                <!-- Feature 1 -->
                <div class="flex items-start space-x-3">
                    <div class="w-8 h-8 bg-emerald-800/50 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold mb-1">Kumpulkan Poin Loyalitas</h3>
                        <p class="text-xs text-emerald-100/60 leading-relaxed">Dapatkan poin setiap transaksi dan
                            tukarkan dengan lilin edisi khusus serta gift box.</p>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="flex items-start space-x-3">
                    <div class="w-8 h-8 bg-emerald-800/50 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold mb-1">Diskon Member Eksklusif</h3>
                        <p class="text-xs text-emerald-100/60 leading-relaxed">Akses penawaran musiman dan voucher
                            gratis ongkir khusus akun pelanggan resmi.</p>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="flex items-start space-x-3">
                    <div class="w-8 h-8 bg-emerald-800/50 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold mb-1">Sertifikasi IFRA & Alami</h3>
                        <p class="text-xs text-emerald-100/60 leading-relaxed">Aman dihirup serumah, bebas toksin
                            timbal, ramah anak dan hewan peliharaan.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- RIGHT PANEL - Form -->
        <div class="flex flex-col justify-center px-6 py-10 sm:px-12 lg:px-16">

            <!-- Logo & Header -->
            <div class="mb-8">
                <div class="flex items-center space-x-3 mb-6">
                    <span class="flex h-11 w-11 items-center justify-center rounded-md bg-[#edf6ee] text-[#17432f]" aria-hidden="true">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3 19 6v5c0 4.6-2.8 8.1-7 10-4.2-1.9-7-5.4-7-10V6l7-3Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="m9 12 2 2 4-4" />
                        </svg>
                    </span>
                    <div>
                        <h3 class="display-font text-2xl font-semibold text-[#183b2c]">NusaCandle</h3>
                        <p class="text-[10px] text-gray-500 uppercase tracking-wider font-medium">Artisanal Botanical
                            Scent</p>
                    </div>
                </div>

                <h2 class="display-font mb-3 text-3xl font-semibold text-[#183b2c] sm:text-4xl">
                    Buat Akun NusaCandle
                </h2>
                <p class="text-sm leading-6 text-[#68766e]">
                    Daftar sekarang dan nikmati pengalaman berbelanja di NusaCandle.
                </p>
            </div>

            <!-- Error Message -->
            @if ($errors->any())
                <div class="bg-red-50 border border-red-100 text-red-700 px-4 py-3 rounded-xl mb-6 text-sm">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('register') }}" method="POST" class="grid grid-cols-1 gap-x-4 gap-y-3 sm:grid-cols-2">
                @csrf

                <!-- Nama Lengkap -->
                <div>
                    <label for="nama_lengkap"
                        class="block text-xs font-semibold text-gray-700 mb-1.5 uppercase tracking-wide">
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}"
                            maxlength="100" aria-describedby="nama_lengkap-error" required
                            class="block w-full px-4 py-3 bg-emerald-50/50 border border-emerald-100 rounded-xl focus:bg-white focus:border-emerald-900 focus:ring-2 focus:ring-emerald-900/10 outline-none transition-all text-gray-900 placeholder-gray-500 text-sm"
                            placeholder="Masukkan nama lengkap">
                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    </div>
                    <p id="nama_lengkap-error" role="alert" class="mt-1.5 {{ $errors->has('nama_lengkap') ? '' : 'hidden' }} text-xs font-medium text-red-600">{{ $errors->first('nama_lengkap') }}</p>
                </div>

                <!-- Username (TAMBAHAN) -->
                <div>
                    <label for="username"
                        class="block text-xs font-semibold text-gray-700 mb-1.5 uppercase tracking-wide">
                        Username <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="text" id="username" name="username" value="{{ old('username') }}"
                            minlength="3" maxlength="30" pattern="[A-Za-z0-9._-]+" aria-describedby="username-error" required
                            class="block w-full px-4 py-3 bg-emerald-50/50 border border-emerald-100 rounded-xl focus:bg-white focus:border-emerald-900 focus:ring-2 focus:ring-emerald-900/10 outline-none transition-all text-gray-900 placeholder-gray-500 text-sm"
                            placeholder="Buat username unik">
                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>
                        </div>
                    </div>
                    <p id="username-error" role="alert" class="mt-1.5 {{ $errors->has('username') ? '' : 'hidden' }} text-xs font-medium text-red-600">{{ $errors->first('username') }}</p>
                </div>

                <!-- Alamat (TAMBAHAN) -->
                <div class="sm:col-span-2">
                    <label for="alamat"
                        class="block text-xs font-semibold text-gray-700 mb-1.5 uppercase tracking-wide">
                        Alamat <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <textarea id="alamat" name="alamat" rows="2" minlength="10" maxlength="500" aria-describedby="alamat-error" required
                            class="block w-full px-4 py-3 bg-emerald-50/50 border border-emerald-100 rounded-xl focus:bg-white focus:border-emerald-900 focus:ring-2 focus:ring-emerald-900/10 outline-none transition-all text-gray-900 placeholder-gray-500 text-sm resize-none"
                            placeholder="Masukkan alamat lengkap">{{ old('alamat') }}</textarea>
                        <div class="absolute top-3 right-3 pointer-events-none">
                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                    </div>
                    <p id="alamat-error" role="alert" class="mt-1.5 {{ $errors->has('alamat') ? '' : 'hidden' }} text-xs font-medium text-red-600">{{ $errors->first('alamat') }}</p>
                </div>

                <!-- Email -->
                <div>
                    <label for="email"
                        class="block text-xs font-semibold text-gray-700 mb-1.5 uppercase tracking-wide">
                        Email <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="email" id="email" name="email" value="{{ old('email') }}" maxlength="100" aria-describedby="email-error" required
                            class="block w-full px-4 py-3 bg-emerald-50/50 border border-emerald-100 rounded-xl focus:bg-white focus:border-emerald-900 focus:ring-2 focus:ring-emerald-900/10 outline-none transition-all text-gray-900 placeholder-gray-500 text-sm"
                            placeholder="Masukkan alamat email">
                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                    <p id="email-error" role="alert" class="mt-1.5 {{ $errors->has('email') ? '' : 'hidden' }} text-xs font-medium text-red-600">{{ $errors->first('email') }}</p>
                </div>

                <!-- Nomor Telepon -->
                <div>
                    <label for="no_telepon"
                        class="block text-xs font-semibold text-gray-700 mb-1.5 uppercase tracking-wide">
                        Nomor Telepon <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="tel" id="no_telepon" name="no_telepon" value="{{ old('no_telepon') }}"
                            inputmode="numeric" minlength="10" maxlength="15" pattern="[0-9]{10,15}" aria-describedby="no_telepon-error" required
                            class="block w-full px-4 py-3 bg-emerald-50/50 border border-emerald-100 rounded-xl focus:bg-white focus:border-emerald-900 focus:ring-2 focus:ring-emerald-900/10 outline-none transition-all text-gray-900 placeholder-gray-500 text-sm"
                            placeholder="Masukkan nomor telepon">
                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                    </div>
                    <p id="no_telepon-error" role="alert" class="mt-1.5 {{ $errors->has('no_telepon') ? '' : 'hidden' }} text-xs font-medium text-red-600">{{ $errors->first('no_telepon') }}</p>
                </div>

                <!-- Password -->
                <div>
                    <label for="password"
                        class="block text-xs font-semibold text-gray-700 mb-1.5 uppercase tracking-wide">
                        Password <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="password" id="password" name="password" minlength="8" aria-describedby="password-error" required
                            class="block w-full px-4 py-3 bg-emerald-50/50 border border-emerald-100 rounded-xl focus:bg-white focus:border-emerald-900 focus:ring-2 focus:ring-emerald-900/10 outline-none transition-all text-gray-900 placeholder-gray-500 text-sm"
                            placeholder="Buat password">
                        <button type="button" class="absolute inset-y-0 right-0 pr-4 flex items-center"
                            onclick="togglePassword('password', 'eye1')">
                            <svg id="eye1" class="h-4 w-4 text-gray-400 hover:text-gray-600" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                    <p id="password-error" role="alert" class="mt-1.5 {{ $errors->has('password') ? '' : 'hidden' }} text-xs font-medium text-red-600">{{ $errors->first('password') }}</p>
                </div>

                <!-- Konfirmasi Password -->
                <div>
                    <label for="password_confirmation"
                        class="block text-xs font-semibold text-gray-700 mb-1.5 uppercase tracking-wide">
                        Konfirmasi Password <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="password" id="password_confirmation" name="password_confirmation" minlength="8" aria-describedby="password_confirmation-error" required
                            class="block w-full px-4 py-3 bg-emerald-50/50 border border-emerald-100 rounded-xl focus:bg-white focus:border-emerald-900 focus:ring-2 focus:ring-emerald-900/10 outline-none transition-all text-gray-900 placeholder-gray-500 text-sm"
                            placeholder="Masukkan kembali password">
                        <button type="button" class="absolute inset-y-0 right-0 pr-4 flex items-center"
                            onclick="togglePassword('password_confirmation', 'eye2')">
                            <svg id="eye2" class="h-4 w-4 text-gray-400 hover:text-gray-600" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                    <p id="password_confirmation-error" role="alert" class="mt-1.5 {{ $errors->has('password_confirmation') ? '' : 'hidden' }} text-xs font-medium text-red-600">{{ $errors->first('password_confirmation') }}</p>
                </div>

                <!-- Terms Checkbox -->
                <div class="sm:col-span-2">
                    <div class="flex items-start space-x-2 pt-2">
                    <input id="terms" name="terms" type="checkbox" value="1" aria-describedby="terms-error" aria-invalid="false"
                        class="h-4 w-4 mt-0.5 text-emerald-900 border-gray-300 rounded focus:ring-emerald-900 cursor-pointer">
                    <label for="terms" class="text-xs text-gray-600 cursor-pointer select-none leading-relaxed">
                        Saya menyetujui <a href="#"
                            class="text-emerald-900 font-semibold hover:underline">Syarat & Ketentuan</a> serta <a
                            href="#" class="text-emerald-900 font-semibold hover:underline">Kebijakan
                            Privasi</a> NusaCandle.
                    </label>
                    </div>
                    <p id="terms-error" role="alert" class="mt-2 hidden text-xs font-medium text-red-600">
                        Centang persetujuan terlebih dahulu sebelum mendaftar.
                    </p>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="group mt-2 flex w-full items-center justify-center gap-2 bg-[#092f21] px-5 py-3.5 font-semibold text-white transition hover:bg-[#17432f] focus:outline-none focus:ring-2 focus:ring-[#315e43] focus:ring-offset-2 sm:col-span-2">
                    <span>Daftar Sekarang</span>
                    <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </button>

                <!-- Privacy Note -->
                <p class="flex items-center justify-center space-x-1 text-center text-[11px] text-gray-500 sm:col-span-2">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    <span>Data pribadi Anda dilindungi & dienkripsi dengan standar keamanan tinggi</span>
                </p>
            </form>

            <!-- Login Link -->
            <div class="mt-6 border-t border-[#edf0eb] pt-5 text-center sm:col-span-2">
                <p class="text-gray-700 text-sm">
                    Sudah punya akun NusaCandle?
                    <a href="{{ route('login') }}" class="font-semibold text-[#315e43] hover:text-[#173b2a]">
                        Login
                    </a>
                </p>
            </div>
        </div>
        </section>
    </main>

    <script>
        const registerForm = document.querySelector('form[action$="/register"]');
        const termsCheckbox = document.getElementById('terms');
        const termsError = document.getElementById('terms-error');
        const validationRules = {
            nama_lengkap: input => !input.value.trim()
                ? 'Nama lengkap wajib diisi.'
                : !/^[\p{L}\p{M}][\p{L}\p{M}\s.'’-]*$/u.test(input.value.trim())
                ? 'Nama lengkap hanya boleh berisi huruf, spasi, titik, tanda hubung, atau apostrof.' : '',
            username: input => !input.value.trim()
                ? 'Username wajib diisi.'
                : !/^[A-Za-z0-9._-]{3,30}$/.test(input.value)
                ? 'Username harus 3-30 karakter dan hanya boleh berisi huruf, angka, titik, garis bawah, atau tanda hubung.' : '',
            alamat: input => !input.value.trim()
                ? 'Alamat wajib diisi.'
                : input.value.trim().length < 10 || input.value.trim().length > 500
                ? 'Alamat harus terdiri dari 10 sampai 500 karakter.' : '',
            no_telepon: input => !input.value.trim()
                ? 'Nomor telepon wajib diisi.'
                : !/^[0-9]+$/.test(input.value)
                    ? 'Nomor telepon hanya boleh berisi angka.'
                    : !/^[0-9]{10,15}$/.test(input.value)
                ? 'Nomor telepon harus terdiri dari 10 sampai 15 angka.' : '',
            password: input => !input.value ? 'Password wajib diisi.' : input.value.length < 8 ? 'Password minimal 8 karakter.' : '',
            password_confirmation: input => !input.value
                ? 'Konfirmasi password wajib diisi.'
                : input.value !== document.getElementById('password').value ? 'Konfirmasi password harus sama dengan password.' : '',
        };

        function validateField(input) {
            const error = document.getElementById(`${input.id}-error`);
            const message = validationRules[input.id](input);

            input.setCustomValidity(message);
            input.setAttribute('aria-invalid', String(Boolean(message)));
            error.textContent = message;
            error.classList.toggle('hidden', !message);
        }

        Object.keys(validationRules).forEach(fieldId => {
            const input = document.getElementById(fieldId);
            const validate = () => validateField(input);

            input.addEventListener('input', validate);
            input.addEventListener('blur', validate);
            input.addEventListener('invalid', validate);

        });

        document.getElementById('password').addEventListener('input', () => {
            const confirmation = document.getElementById('password_confirmation');
            if (confirmation.value) {
                validateField(confirmation);
            }
        });

        registerForm.addEventListener('submit', function (event) {
            if (!termsCheckbox.checked) {
                event.preventDefault();
                termsError.classList.remove('hidden');
                termsCheckbox.setAttribute('aria-invalid', 'true');
                termsCheckbox.focus();
            }
        });

        termsCheckbox.addEventListener('change', function () {
            if (this.checked) {
                termsError.classList.add('hidden');
                this.setAttribute('aria-invalid', 'false');
            }
        });

        function togglePassword(inputId, eyeId) {
            const passwordInput = document.getElementById(inputId);
            const eyeIcon = document.getElementById(eyeId);

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        }
    </script>

</body>

</html>
