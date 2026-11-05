@extends('layouts.pembeli')

@section('title', 'Profil Akun Pelanggan - NusaCandle')

@section('content')
    {{-- Breadcrumb --}}
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center gap-2 text-sm">
                <a href="{{ route('home') }}" class="text-[#718078] hover:text-[#8B1E1E]">Beranda</a>
                <span class="text-[#718078]">/</span>
                <span class="text-[#8B1E1E] font-semibold">Profil Saya</span>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Header --}}
        <div class="mb-8">
            <h1 class="font-serif text-3xl font-bold text-[#2C1810]">Profil Akun Pelanggan</h1>
            <p class="text-[#718078] mt-2">Kelola data pribadi & preferensi keamanan akun NusaCandle Anda</p>
        </div>

        {{-- Notifikasi --}}
        @if (session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-md">
                <ul class="list-inside list-disc space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- BAGIAN 01 - Data Diri Pelanggan --}}
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <span class="bg-[#8B1E1E] text-white text-xs font-semibold px-2 py-0.5 rounded">BAGIAN 01</span>
                        <span
                            class="bg-green-100 text-green-800 text-xs font-semibold px-2 py-0.5 rounded flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Terverifikasi
                        </span>
                    </div>
                    <h2 class="font-serif text-2xl font-bold text-[#2C1810]">Data Diri Pelanggan</h2>
                </div>
                <button onclick="toggleEditSection()"
                    class="border-2 border-[#8B1E1E] text-[#8B1E1E] hover:bg-[#8B1E1E] hover:text-white px-4 py-2 rounded-md text-sm font-semibold transition flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit Data Diri
                </button>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
                {{-- Nama Lengkap --}}
                <div class="bg-[#FAF9F6] p-4 rounded-lg">
                    <p class="text-xs text-[#718078] mb-1">Nama Lengkap</p>
                    <p class="font-semibold text-[#2C1810]">{{ $user->nama_lengkap }}</p>
                </div>

                {{-- Email --}}
                <div class="bg-[#FAF9F6] p-4 rounded-lg">
                    <p class="text-xs text-[#718078] mb-1">Alamat Email</p>
                    <p class="font-semibold text-[#2C1810] flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#718078]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        {{ $user->email }}
                    </p>
                </div>

                {{-- Nomor Telepon --}}
                <div class="bg-[#FAF9F6] p-4 rounded-lg">
                    <p class="text-xs text-[#718078] mb-1">Nomor Telepon</p>
                    <p class="font-semibold text-[#2C1810] flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#718078]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        {{ $user->no_telepon }}
                    </p>
                </div>

                {{-- Status Keanggotaan --}}
                <div class="bg-[#FAF9F6] p-4 rounded-lg">
                    <p class="text-xs text-[#718078] mb-1">Status Keanggotaan</p>
                    <p class="font-semibold {{ $membershipStatus['color'] }} flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ $membershipStatus['label'] }}
                    </p>
                </div>

                {{-- Total Poin --}}
                <div class="bg-[#FAF9F6] p-4 rounded-lg">
                    <p class="text-xs text-[#718078] mb-1">Total Poin Aromaterapi</p>
                    <p class="font-semibold text-[#8B1E1E]">{{ number_format($user->total_poin) }} Poin</p>
                </div>

                {{-- Alamat --}}
                <div class="md:col-span-2 lg:col-span-3 bg-[#FAF9F6] p-4 rounded-lg">
                    <p class="text-xs text-[#718078] mb-1">Alamat Lengkap Pengiriman</p>
                    <p class="font-semibold text-[#2C1810] flex items-start gap-2">
                        <svg class="w-4 h-4 text-[#718078] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        {{ $user->alamat ?? 'Belum diisi' }}
                    </p>
                </div>
            </div>
        </div>

        {{-- BAGIAN 02 - Update Data Diri --}}
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <span class="bg-[#8B1E1E] text-white text-xs font-semibold px-2 py-0.5 rounded">BAGIAN 02</span>
                    </div>
                    <h2 class="font-serif text-2xl font-bold text-[#2C1810]">Update Data Diri</h2>
                </div>
            </div>

            <form action="{{ route('profil.update') }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-[#718078] mb-2">Nama
                            Lengkap</label>
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-[#718078]" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <input type="text" name="nama_lengkap"
                                value="{{ old('nama_lengkap', $user->nama_lengkap) }}" required
                                class="w-full pl-10 pr-4 py-2.5 bg-[#FAF9F6] border border-gray-200 rounded-md text-sm focus:border-[#8B1E1E] focus:ring-1 focus:ring-[#8B1E1E]/20 outline-none">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-[#718078] mb-2">Alamat
                            Email</label>
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-[#718078]" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                                class="w-full pl-10 pr-4 py-2.5 bg-[#FAF9F6] border border-gray-200 rounded-md text-sm focus:border-[#8B1E1E] focus:ring-1 focus:ring-[#8B1E1E]/20 outline-none">
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-[#718078] mb-2">Nomor
                        Telepon</label>
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-[#718078]" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <input type="text" name="no_telepon" value="{{ old('no_telepon', $user->no_telepon) }}"
                            required
                            class="w-full pl-10 pr-4 py-2.5 bg-[#FAF9F6] border border-gray-200 rounded-md text-sm focus:border-[#8B1E1E] focus:ring-1 focus:ring-[#8B1E1E]/20 outline-none">
                    </div>
                    <p class="text-xs text-[#718078] mt-1">Nomor aktif digunakan untuk konfirmasi pengiriman paket lilin
                        NusaCandle.</p>
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-[#718078] mb-2">Alamat
                        Lengkap</label>
                    <textarea name="alamat" rows="3" required
                        class="w-full px-4 py-2.5 bg-[#FAF9F6] border border-gray-200 rounded-md text-sm focus:border-[#8B1E1E] focus:ring-1 focus:ring-[#8B1E1E]/20 outline-none resize-none">{{ old('alamat', $user->alamat) }}</textarea>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-[#8B1E1E] hover:bg-[#6B1515] text-white px-6 py-2.5 rounded-md font-semibold transition flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        {{-- BAGIAN 03 - Update Password --}}
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <span class="bg-[#8B1E1E] text-white text-xs font-semibold px-2 py-0.5 rounded">BAGIAN 03</span>
                    </div>
                    <h2 class="font-serif text-2xl font-bold text-[#2C1810]">Update Password</h2>
                </div>
            </div>

            <form action="{{ route('profil.password') }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-[#718078] mb-2">Password
                        Lama</label>
                    <div class="relative">
                        <input type="password" name="password_lama" required
                            class="w-full px-4 py-2.5 bg-[#FAF9F6] border border-gray-200 rounded-md text-sm focus:border-[#8B1E1E] focus:ring-1 focus:ring-[#8B1E1E]/20 outline-none"
                            placeholder="Masukkan kata sandi lama Anda">
                        <button type="button"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-[#718078] hover:text-[#8B1E1E]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-[#718078] mb-2">Password
                            Baru</label>
                        <div class="relative">
                            <input type="password" name="password_baru" required
                                class="w-full px-4 py-2.5 bg-[#FAF9F6] border border-gray-200 rounded-md text-sm focus:border-[#8B1E1E] focus:ring-1 focus:ring-[#8B1E1E]/20 outline-none"
                                placeholder="Minimal 8 karakter">
                            <button type="button"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-[#718078] hover:text-[#8B1E1E]">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-[#718078] mb-2">Konfirmasi
                            Password Baru</label>
                        <div class="relative">
                            <input type="password" name="password_baru_confirmation" required
                                class="w-full px-4 py-2.5 bg-[#FAF9F6] border border-gray-200 rounded-md text-sm focus:border-[#8B1E1E] focus:ring-1 focus:ring-[#8B1E1E]/20 outline-none"
                                placeholder="Ulangi password baru">
                            <button type="button"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-[#718078] hover:text-[#8B1E1E]">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="bg-[#FAF9F6] p-4 rounded-md">
                    <div class="flex items-start gap-2">
                        <svg class="w-4 h-4 text-[#718078] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>
                            <p class="text-xs font-semibold text-[#2C1810]">Panduan Keamanan Kata Sandi</p>
                            <p class="text-xs text-[#718078]">Gunakan kombinasi minimal 8 karakter yang terdiri dari huruf
                                besar, huruf kecil, dan angka.</p>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-[#8B1E1E] hover:bg-[#6B1515] text-white px-6 py-2.5 rounded-md font-semibold transition flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        Update Password
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleEditSection() {
            // 1. Ambil URL route dulu agar aman dari konflik tanda kutip
            const targetUrl = "{{ route('profil.update') }}";

            // 2. Cari form berdasarkan action URL tersebut menggunakan backticks (`)
        const editSection = document.querySelector(`form[action="${targetUrl}"]`).closest('.bg-white');

            // 3. Scroll halus ke bagian form
            if (editSection) {
                editSection.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }
        }
    </script>
@endsection

