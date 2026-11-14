@extends('layouts.pembeli')

@section('title', 'Profil Akun Pelanggan - NusaCandle')

@section('content')
    <style>
        body:has(.profile-page) {
            background: #faf7ed;
        }

        body:has(.profile-page) > nav:not(#catalog-pagination) {
            border-top: 3px solid #8b1e1e;
            background: #faf7ed;
            box-shadow: none;
        }

        body:has(.profile-page) > main {
            background: #faf7ed;
        }

        body:has(.profile-page) > footer {
            border-top-color: #e8dfcd;
            background: #f5f0e2;
        }
    </style>

    <div class="profile-page min-h-screen bg-[#faf7ed]">
    <div class="mx-auto max-w-5xl px-4 pb-8 pt-3 sm:px-6 lg:px-8">
        <nav aria-label="Jejak halaman" class="mb-3 flex items-center gap-2 text-[9px] text-[#796d5d]">
            <a href="{{ route('home') }}" class="transition hover:text-[#8B1E1E]">Beranda</a>
            <span aria-hidden="true">/</span>
            <span class="font-semibold text-[#8B1E1E]">Profil Saya</span>
        </nav>

        {{-- Header --}}
        <div class="mb-5">
            <h1 class="font-serif text-xl font-bold text-[#2C1810] sm:text-2xl">Profil Akun Pelanggan</h1>
            <p class="mt-1 text-[9px] text-[#796d5d] sm:text-[10px]">Kelola data pribadi &amp; preferensi keamanan akun NusaCandle Anda</p>
        </div>

        {{-- BAGIAN 01 - Data Diri Pelanggan --}}
        <div class="mb-4 rounded-xl border border-[#e8dfcf] bg-white p-4 shadow-sm sm:p-5">
            <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
                <div>
                    <div class="mb-1.5 flex flex-wrap items-center gap-1.5">
                        <span class="rounded bg-[#8B1E1E] px-2 py-0.5 text-[7px] font-semibold text-white">BAGIAN 01</span>
                        <span class="inline-flex items-center gap-1 rounded bg-[#e8f2e2] px-2 py-0.5 text-[7px] font-semibold text-[#2E7D32]">
                            <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Terverifikasi
                        </span>
                    </div>
                    <h2 class="font-serif text-base font-bold text-[#2C1810] sm:text-lg">Data Diri Pelanggan</h2>
                </div>
                <button type="button" onclick="toggleEditSection()"
                    class="inline-flex items-center gap-1.5 rounded-md border border-[#8B1E1E] px-3 py-1.5 text-[8px] font-semibold text-[#8B1E1E] transition hover:bg-[#8B1E1E] hover:text-white sm:text-[9px]">
                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit Data Diri
                </button>
            </div>

            <div class="flex flex-col gap-3 sm:flex-row">
                <div class="flex shrink-0 items-center gap-2 sm:w-24 sm:flex-col sm:justify-center sm:gap-1.5">
                    <div class="flex h-14 w-14 items-center justify-center rounded-full border-2 border-white bg-[#e8f2e2] font-serif text-xl font-bold text-[#47784a] shadow-sm ring-1 ring-[#e8dfcf]"
                        role="img" aria-label="Inisial {{ $user->nama_lengkap }}">
                        {{ strtoupper(substr(trim($user->nama_lengkap), 0, 1)) }}
                    </div>
                    <span class="text-[7px] text-[#796d5d] sm:text-center">Profil Pelanggan</span>
                </div>

                <div class="min-w-0 flex-1">
                    <div class="grid grid-cols-2 gap-2">
                        <div class="rounded-md border border-[#eee8dc] bg-[#fbf9f3] px-2.5 py-2">
                            <p class="mb-0.5 text-[7px] text-[#796d5d]">Nama Lengkap</p>
                            <p class="truncate text-[8px] font-semibold text-[#2C1810] sm:text-[9px]">{{ $user->nama_lengkap }}</p>
                        </div>
                        <div class="rounded-md border border-[#eee8dc] bg-[#fbf9f3] px-2.5 py-2">
                            <p class="mb-0.5 text-[7px] text-[#796d5d]">Alamat Email</p>
                            <p class="break-all text-[8px] font-semibold text-[#2C1810] sm:text-[9px]">{{ $user->email }}</p>
                        </div>
                        <div class="rounded-md border border-[#eee8dc] bg-[#fbf9f3] px-2.5 py-2">
                            <p class="mb-0.5 text-[7px] text-[#796d5d]">Nomor Telepon</p>
                            <p class="text-[8px] font-semibold text-[#2C1810] sm:text-[9px]">{{ $user->no_telepon }}</p>
                        </div>
                        <div class="rounded-md border border-[#eee8dc] bg-[#fbf9f3] px-2.5 py-2">
                            <p class="mb-0.5 text-[7px] text-[#796d5d]">Status Keanggotaan</p>
                            <p>
                                <span class="inline-flex rounded-full px-1.5 py-0.5 text-[7px] font-semibold {{ $membershipStatus['bg'] }} {{ $membershipStatus['color'] }}">
                                    {{ $membershipStatus['label'] }}
                                </span>
                            </p>
                        </div>
                    </div>
                    <div class="mt-2 rounded-md border border-[#eee8dc] bg-[#fbf9f3] px-2.5 py-2">
                        <p class="mb-0.5 text-[7px] text-[#796d5d]">Alamat Lengkap Pengiriman</p>
                        <p class="text-[8px] leading-relaxed text-[#2C1810] sm:text-[9px]">{{ $user->alamat ?? 'Belum diisi' }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- BAGIAN 02 - Update Data Diri --}}
        <div id="profile-edit-section" class="mb-4 rounded-xl border border-[#e8dfcf] bg-white p-4 shadow-sm sm:p-5">
            <div class="mb-4 flex items-center justify-between gap-3">
                <div>
                    <div class="mb-1.5 flex items-center gap-2">
                        <span class="rounded bg-[#8B1E1E] px-2 py-0.5 text-[7px] font-semibold text-white">BAGIAN 02</span>
                    </div>
                    <h2 class="font-serif text-base font-bold text-[#2C1810] sm:text-lg">Update Data Diri</h2>
                </div>
                <svg class="h-4 w-4 text-[#796d5d]" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 6h16M7 12h10m-7 6h4M8 4v4m8 2v4m-6 2v4" />
                </svg>
            </div>

            <form action="{{ route('profil.update') }}" method="POST" class="space-y-3">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-2 gap-2 sm:gap-4">
                    <div>
                        <label class="mb-1.5 block text-[8px] font-semibold uppercase tracking-wide text-[#796d5d]">Nama
                            Lengkap</label>
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-[#718078]" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <input type="text" name="nama_lengkap"
                                value="{{ old('nama_lengkap', $user->nama_lengkap) }}" required
                                class="w-full rounded-md border border-[#e8dfcf] bg-[#fffdfa] py-2 pl-9 pr-3 text-[9px] text-[#2C1810] outline-none focus:border-[#8B1E1E] focus:ring-1 focus:ring-[#8B1E1E]/20">
                        </div>
                    </div>

                    <div>
                        <label class="mb-1.5 block text-[8px] font-semibold uppercase tracking-wide text-[#796d5d]">Alamat
                            Email</label>
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-[#718078]" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                                class="w-full rounded-md border border-[#e8dfcf] bg-[#fffdfa] py-2 pl-9 pr-3 text-[9px] text-[#2C1810] outline-none focus:border-[#8B1E1E] focus:ring-1 focus:ring-[#8B1E1E]/20">
                        </div>
                    </div>
                </div>

                <div>
                    <label class="mb-1.5 block text-[8px] font-semibold uppercase tracking-wide text-[#796d5d]">Nomor
                        Telepon</label>
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-[#718078]" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <input type="text" name="no_telepon" value="{{ old('no_telepon', $user->no_telepon) }}"
                            required
                            class="w-full rounded-md border border-[#e8dfcf] bg-[#fffdfa] py-2 pl-9 pr-3 text-[9px] text-[#2C1810] outline-none focus:border-[#8B1E1E] focus:ring-1 focus:ring-[#8B1E1E]/20">
                    </div>
                    <p class="mt-1 text-[7px] text-[#796d5d]">Nomor aktif digunakan untuk konfirmasi pengiriman paket lilin
                        NusaCandle.</p>
                </div>

                <div>
                    <label class="mb-1.5 block text-[8px] font-semibold uppercase tracking-wide text-[#796d5d]">Alamat
                        Lengkap</label>
                    <textarea name="alamat" rows="3" required
                        class="w-full resize-none rounded-md border border-[#e8dfcf] bg-[#fffdfa] px-3 py-2 text-[9px] text-[#2C1810] outline-none focus:border-[#8B1E1E] focus:ring-1 focus:ring-[#8B1E1E]/20">{{ old('alamat', $user->alamat) }}</textarea>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="inline-flex items-center gap-1.5 rounded-md bg-[#8B1E1E] px-3 py-2 text-[8px] font-semibold text-white transition hover:bg-[#6B1515]">
                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        {{-- BAGIAN 03 - Update Password --}}
        <div class="rounded-xl border border-[#e8dfcf] bg-white p-4 shadow-sm sm:p-5">
            <div class="mb-4 flex items-center justify-between gap-3">
                <div>
                    <div class="mb-1.5 flex items-center gap-2">
                        <span class="rounded bg-[#8B1E1E] px-2 py-0.5 text-[7px] font-semibold text-white">BAGIAN 03</span>
                    </div>
                    <h2 class="font-serif text-base font-bold text-[#2C1810] sm:text-lg">Update Password</h2>
                </div>
                <svg class="h-4 w-4 text-[#796d5d]" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>

            <form action="{{ route('profil.password') }}" method="POST" class="space-y-3">
                @csrf
                @method('PUT')

                <div>
                    <label class="mb-1.5 block text-[8px] font-semibold uppercase tracking-wide text-[#796d5d]">Password
                        Lama</label>
                    <div class="relative">
                        <input type="password" name="password_lama" required
                            class="w-full rounded-md border border-[#e8dfcf] bg-[#fffdfa] py-2 pl-3 pr-9 text-[9px] text-[#2C1810] outline-none focus:border-[#8B1E1E] focus:ring-1 focus:ring-[#8B1E1E]/20"
                            placeholder="Masukkan kata sandi lama Anda">
                        <button type="button"
                            class="absolute right-2.5 top-1/2 -translate-y-1/2 text-[#796d5d] hover:text-[#8B1E1E]">
                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-2 sm:gap-3">
                    <div>
                        <label class="mb-1.5 block text-[8px] font-semibold uppercase tracking-wide text-[#796d5d]">Password
                            Baru</label>
                        <div class="relative">
                            <input type="password" name="password_baru" required
                                class="w-full rounded-md border border-[#e8dfcf] bg-[#fffdfa] py-2 pl-3 pr-9 text-[9px] text-[#2C1810] outline-none focus:border-[#8B1E1E] focus:ring-1 focus:ring-[#8B1E1E]/20"
                                placeholder="Minimal 8 karakter">
                            <button type="button"
                                class="absolute right-2.5 top-1/2 -translate-y-1/2 text-[#796d5d] hover:text-[#8B1E1E]">
                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div>
                        <label class="mb-1.5 block text-[8px] font-semibold uppercase tracking-wide text-[#796d5d]">Konfirmasi
                            Password Baru</label>
                        <div class="relative">
                            <input type="password" name="password_baru_confirmation" required
                                class="w-full rounded-md border border-[#e8dfcf] bg-[#fffdfa] py-2 pl-3 pr-9 text-[9px] text-[#2C1810] outline-none focus:border-[#8B1E1E] focus:ring-1 focus:ring-[#8B1E1E]/20"
                                placeholder="Ulangi password baru">
                            <button type="button"
                                class="absolute right-2.5 top-1/2 -translate-y-1/2 text-[#796d5d] hover:text-[#8B1E1E]">
                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="rounded-md border border-[#cfe3c7] bg-[#edf6e9] px-3 py-2">
                    <div class="flex items-start gap-2">
                        <svg class="mt-0.5 h-3.5 w-3.5 shrink-0 text-[#2E7D32]" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>
                            <p class="text-[8px] font-semibold text-[#276236]">Panduan Keamanan Kata Sandi</p>
                            <p class="text-[7px] text-[#47784a]">Gunakan kombinasi minimal 8 karakter yang terdiri dari huruf
                                besar, huruf kecil, dan angka.</p>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="inline-flex items-center gap-1.5 rounded-md bg-[#8B1E1E] px-3 py-2 text-[8px] font-semibold text-white transition hover:bg-[#6B1515]">
                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        Update Password
                    </button>
                </div>
            </form>
        </div>
    </div>
    </div>

    <script>
        function toggleEditSection() {
            const editSection = document.getElementById('profile-edit-section');

            if (!editSection) {
                return;
            }

            editSection.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
        }
    </script>
@endsection

