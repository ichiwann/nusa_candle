@extends('layouts.admin')

@section('title', 'Pengaturan Admin')
@section('page_title', 'Akun Admin')

@section('content')
    <div class="-mx-4 -my-6 min-h-[calc(100vh_-_4rem)] bg-[#f7f4e9] px-4 py-6 sm:-mx-6 sm:-my-9 sm:px-6 sm:py-9 lg:-mx-8 lg:px-8 xl:-mx-12 xl:px-12">
        <div class="mb-5">
            <p class="text-[9px] font-semibold uppercase tracking-[0.14em] text-[#42634f]">Admin Ledger /</p>
            <h1 class="display-font mt-1 text-2xl font-semibold text-[#302d27] sm:text-3xl">Akun Admin</h1>
            <p class="mt-1 max-w-2xl text-xs leading-relaxed text-[#77736b]">
                Kelola profil administrator dan keamanan akun sistem NusaCandle Lilin Aroma Terapi Malang.
            </p>
        </div>

        <section class="mb-4 overflow-hidden rounded-md border border-[#e8e2d6] bg-white shadow-sm">
            <div class="flex flex-wrap items-center justify-between gap-3 border-b border-[#eee8dc] px-4 py-3 sm:px-5">
                <div>
                    <h2 class="display-font text-base font-semibold text-[#302d27]">Data Profil Admin</h2>
                    <p class="mt-0.5 text-[10px] text-[#77736b]">Informasi akun dan pengelola operasional.</p>
                </div>
                <a href="#profile-form"
                    class="inline-flex items-center gap-1.5 bg-[#315d41] px-3 py-2 text-[10px] font-semibold uppercase tracking-wide text-white transition hover:bg-[#244b33] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#315d41]">
                    <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m16.862 4.487 2.651 2.651M8 16l8.862-8.862a1.875 1.875 0 112.651 2.651L10.65 18.651 7 19l.349-3.65z" />
                    </svg>
                    Edit Data Admin
                </a>
            </div>

            <dl class="grid sm:grid-cols-2">
                <div class="border-b border-[#eee8dc] px-4 py-3 sm:border-r sm:px-5">
                    <dt class="text-[9px] font-semibold uppercase tracking-[0.08em] text-[#77736b]">Nama Admin</dt>
                    <dd class="mt-1 text-xs font-semibold text-[#302d27]">{{ $admin->nama_lengkap }}</dd>
                </div>
                <div class="border-b border-[#eee8dc] px-4 py-3 sm:px-5">
                    <dt class="text-[9px] font-semibold uppercase tracking-[0.08em] text-[#77736b]">Username</dt>
                    <dd class="mt-1 text-xs font-medium text-[#42634f]">{{ '@' . ltrim($admin->username ?? '', '@') }}</dd>
                </div>
                <div class="border-b border-[#eee8dc] px-4 py-3 sm:border-b-0 sm:border-r sm:px-5">
                    <dt class="text-[9px] font-semibold uppercase tracking-[0.08em] text-[#77736b]">Alamat Email</dt>
                    <dd class="mt-1 text-xs text-[#302d27]">{{ $admin->email }}</dd>
                </div>
                <div class="px-4 py-3 sm:px-5">
                    <dt class="text-[9px] font-semibold uppercase tracking-[0.08em] text-[#77736b]">Nomor Telepon</dt>
                    <dd class="mt-1 text-xs text-[#302d27]">{{ $admin->no_telepon ?: '-' }}</dd>
                </div>
            </dl>

            <div class="flex flex-wrap items-center justify-between gap-2 border-t border-[#eee8dc] px-4 py-2.5 text-[9px] text-[#77736b] sm:px-5">
                <span class="inline-flex items-center gap-1.5 font-semibold uppercase tracking-[0.06em]">
                    <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l2.5 1.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Terakhir diperbarui
                </span>
                <span>
                    @if ($admin->updated_at)
                        {{ $admin->updated_at->format('d/m/Y, H:i') }} WIB
                    @else
                        -
                    @endif
                </span>
            </div>
        </section>

        <div class="grid items-start gap-4 lg:grid-cols-2">
            <section id="profile-form" class="scroll-mt-4 rounded-lg border border-[#e8e2d6] bg-white p-4 shadow-lg sm:p-5">
                <div class="mb-3 border-b border-[#eee8dc] pb-2">
                    <h2 class="display-font text-base font-semibold text-[#302d27]">Update Data Admin</h2>
                </div>

                <form action="{{ route('admin.settings.profile') }}" method="POST" class="flex h-full flex-col">
                    @csrf
                    @method('PUT')

                    <div class="grid gap-3 sm:grid-cols-2">
                        <div>
                            <label for="nama_lengkap" class="mb-1 block text-[9px] font-semibold uppercase tracking-[0.04em] text-[#302d27]">Nama Admin</label>
                            <input id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap', $admin->nama_lengkap ?? '') }}" maxlength="100" required
                                class="w-full rounded-sm border border-[#e8e2d6] bg-[#f3f0e7] px-2.5 py-2 text-[11px] text-[#302d27] outline-none transition focus:border-[#315d41] focus:ring-1 focus:ring-[#315d41]/20">
                        </div>
                        <div>
                            <label for="username" class="mb-1 block text-[9px] font-semibold uppercase tracking-[0.04em] text-[#302d27]">Username</label>
                            <input id="username" name="username" value="{{ old('username', $admin->username ?? '') }}" minlength="3" maxlength="100" required
                                class="w-full rounded-sm border border-[#e8e2d6] bg-[#f3f0e7] px-2.5 py-2 text-[11px] text-[#302d27] outline-none transition focus:border-[#315d41] focus:ring-1 focus:ring-[#315d41]/20">
                        </div>
                        <div>
                            <label for="email" class="mb-1 block text-[9px] font-semibold uppercase tracking-[0.04em] text-[#302d27]">Alamat Email</label>
                            <input id="email" type="email" name="email" value="{{ old('email', $admin->email ?? '') }}" maxlength="100" required
                                class="w-full rounded-sm border border-[#e8e2d6] bg-[#f3f0e7] px-2.5 py-2 text-[11px] text-[#302d27] outline-none transition focus:border-[#315d41] focus:ring-1 focus:ring-[#315d41]/20">
                        </div>
                        <div>
                            <label for="no_telepon" class="mb-1 block text-[9px] font-semibold uppercase tracking-[0.04em] text-[#302d27]">Nomor Telepon</label>
                            <input id="no_telepon" name="no_telepon" inputmode="numeric" value="{{ old('no_telepon', $admin->no_telepon ?? '') }}"
                                class="w-full rounded-sm border border-[#e8e2d6] bg-[#f3f0e7] px-2.5 py-2 text-[11px] text-[#302d27] outline-none transition focus:border-[#315d41] focus:ring-1 focus:ring-[#315d41]/20">
                        </div>
                    </div>

                    <div class="mt-4 flex justify-end gap-2 border-t border-[#eee8dc] pt-3">
                        <button type="reset" class="border border-[#e8e2d6] bg-[#f7f4e9] px-3 py-2 text-[10px] font-medium text-[#514d45] transition hover:bg-[#eee8dc]">
                            Batal
                        </button>
                        <button type="submit" class="inline-flex items-center gap-1.5 bg-[#153f2e] px-3 py-2 text-[10px] font-semibold text-white transition hover:bg-[#244b33]">
                            <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m5 12 4 4L19 6" />
                            </svg>
                            Simpan
                        </button>
                    </div>
                </form>
            </section>

            <section class="rounded-lg border border-[#e8e2d6] bg-white p-4 shadow-lg sm:p-5">
                <div class="mb-3 border-b border-[#eee8dc] pb-2">
                    <h2 class="display-font text-base font-semibold text-[#302d27]">Update Password</h2>
                </div>

                <form action="{{ route('admin.settings.password') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid gap-3 sm:grid-cols-2">
                        <div>
                            <label for="current_password" class="mb-1 block text-[9px] font-semibold uppercase tracking-[0.04em] text-[#302d27]">Password Lama</label>
                            <input id="current_password" type="password" name="current_password" autocomplete="current-password" required
                                class="w-full rounded-sm border border-[#e8e2d6] bg-[#f3f0e7] px-2.5 py-2 text-[11px] text-[#302d27] outline-none transition focus:border-[#315d41] focus:ring-1 focus:ring-[#315d41]/20">
                        </div>
                        <div>
                            <label for="password" class="mb-1 block text-[9px] font-semibold uppercase tracking-[0.04em] text-[#302d27]">Password Baru</label>
                            <input id="password" type="password" name="password" minlength="8" autocomplete="new-password" required
                                class="w-full rounded-sm border border-[#e8e2d6] bg-[#f3f0e7] px-2.5 py-2 text-[11px] text-[#302d27] outline-none transition focus:border-[#315d41] focus:ring-1 focus:ring-[#315d41]/20">
                        </div>
                        <div class="sm:col-span-2">
                            <label for="password_confirmation" class="mb-1 block text-[9px] font-semibold uppercase tracking-[0.04em] text-[#302d27]">Konfirmasi Password Baru</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" minlength="8" autocomplete="new-password" required
                                class="w-full rounded-sm border border-[#e8e2d6] bg-[#f3f0e7] px-2.5 py-2 text-[11px] text-[#302d27] outline-none transition focus:border-[#315d41] focus:ring-1 focus:ring-[#315d41]/20">
                        </div>
                    </div>

                    <div class="mt-4 flex justify-end gap-2 border-t border-[#eee8dc] pt-3">
                        <button type="reset" class="border border-[#e8e2d6] bg-[#f7f4e9] px-3 py-2 text-[10px] font-medium text-[#514d45] transition hover:bg-[#eee8dc]">
                            Batal
                        </button>
                        <button type="submit" class="inline-flex items-center gap-1.5 bg-[#153f2e] px-3 py-2 text-[10px] font-semibold text-white transition hover:bg-[#244b33]">
                            <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m5 12 4 4L19 6" />
                            </svg>
                            Simpan
                        </button>
                    </div>
                </form>
            </section>
        </div>
    </div>
@endsection
