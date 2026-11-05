@extends('layouts.admin')

@section('title', 'Redeem Code')
@section('page_title', 'Redeem Code')

@section('content')
    <!-- Header -->
    <div class="flex flex-wrap items-start justify-between gap-4 mb-6">
        <div>
            <p class="text-[10px] font-semibold uppercase tracking-[0.17em] text-[#64835d]">Admin Ledger</p>
            <h1 class="display-font mt-1 text-3xl font-semibold text-[#183b2c]">Redeem Code Poin</h1>
            <p class="mt-2 max-w-2xl text-sm text-[#718078] leading-relaxed">
                Generate kode manual untuk memberikan poin kepada pelanggan.
                Pelanggan dapat mengumpulkan poin (misal: 70 poin) untuk ditukar dengan Hadiah Lilin.
            </p>
        </div>
        <button onclick="openTambahModal()"
            class="bg-[#103a2a] hover:bg-[#315d41] text-white px-5 py-2.5 rounded-md text-sm font-semibold transition flex items-center gap-2 shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            + Buat Kode Manual
        </button>
    </div>

    <!-- Stats Cards -->
    <section class="grid gap-4 sm:grid-cols-3 mb-6">
        <article class="border border-[#e8eee8] bg-white p-5 rounded-md shadow-sm">
            <p class="text-[10px] font-semibold uppercase tracking-[0.13em] text-[#718078]">Total Kode</p>
            <p class="display-font mt-2 text-3xl font-semibold text-[#183b2c]">{{ number_format($totalKode) }}</p>
            <p class="mt-1 text-[10px] text-[#87948b]">Kode Dibuat</p>
        </article>

        <article class="border border-[#e8eee8] bg-white p-5 rounded-md shadow-sm">
            <p class="text-[10px] font-semibold uppercase tracking-[0.13em] text-[#718078]">Tersedia</p>
            <p class="display-font mt-2 text-3xl font-semibold text-emerald-600">{{ number_format($tersedia) }}</p>
            <p class="mt-1 text-[10px] text-[#87948b]">Belum Digunakan</p>
        </article>

        <article class="border border-[#e8eee8] bg-white p-5 rounded-md shadow-sm">
            <p class="text-[10px] font-semibold uppercase tracking-[0.13em] text-[#718078]">Terpakai</p>
            <p class="display-font mt-2 text-3xl font-semibold text-orange-600">{{ number_format($terpakai) }}</p>
            <p class="mt-1 text-[10px] text-[#87948b]">Sudah Diklaim User</p>
        </article>
    </section>

    <!-- Search & Filter Bar -->
    <form method="GET" action="{{ route('admin.kodeRedeem.index') }}" class="flex flex-wrap items-center gap-3 mb-4">
        <div class="flex-1 min-w-[250px] relative">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-[#87948b]" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Cari kode atau nama pengguna..."
                class="w-full pl-10 pr-4 py-2.5 bg-white border border-[#e8eee8] rounded-md text-sm focus:border-[#103a2a] focus:ring-1 focus:ring-[#103a2a]/20 outline-none">
        </div>

        <select name="status" onchange="this.form.submit()"
            class="px-4 py-2.5 bg-white border border-[#e8eee8] rounded-md text-sm focus:border-[#103a2a] outline-none min-w-[150px]">
            <option value="">Semua Status</option>
            <option value="tersedia" {{ request('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
            <option value="terpakai" {{ request('status') == 'terpakai' ? 'selected' : '' }}>Terpakai</option>
        </select>
    </form>

    <!-- Tabel Redeem Code -->
    <section class="border border-[#e8eee8] bg-white rounded-md shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead
                    class="bg-[#f7faf7] text-[10px] uppercase tracking-[0.12em] text-[#718078] border-b border-[#edf0eb]">
                    <tr>
                        <th class="px-5 py-3 font-semibold">Kode Redeem</th>
                        <th class="px-5 py-3 font-semibold">Nilai Poin</th>
                        <th class="px-5 py-3 font-semibold">Masa Aktif</th>
                        <th class="px-5 py-3 font-semibold">Tanggal Dibuat</th>
                        <th class="px-5 py-3 font-semibold">Status</th>
                        <th class="px-5 py-3 font-semibold">Pengguna</th>
                        <th class="px-5 py-3 font-semibold">Dipakai Pada</th>
                        <th class="px-5 py-3 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#edf0eb]">
                    @forelse($redeemCodes as $code)
                        <tr class="text-xs hover:bg-[#f9fcf9] transition-colors">
                            <td class="px-5 py-4">
                                <p class="font-mono font-semibold text-[#30483a]">{{ $code->kode }}</p>
                            </td>
                            <td class="px-5 py-4">
                                <span
                                    class="inline-block bg-[#f0f7f0] text-[#103a2a] text-[10px] font-semibold px-2 py-1 rounded">
                                    {{ number_format($code->poin) }} Poin
                                </span>
                            </td>
                            <td class="px-5 py-4">
                                @if ($code->berlaku_hingga)
                                    <p class="text-[#30483a]">{{ $code->berlaku_hingga->format('d M Y') }}</p>
                                    @if ($code->berlaku_hingga->isPast())
                                        <span class="text-[10px] text-red-600 font-semibold">Sudah Kadaluarsa</span>
                                    @else
                                        <p class="text-[10px] text-[#87948b]">{{ $code->berlaku_hingga->diffForHumans() }}
                                        </p>
                                    @endif
                                @else
                                    <span class="text-[10px] text-emerald-600 font-semibold">Selamanya</span>
                                @endif
                            </td>
                            <td class="px-5 py-4">
                                <p class="text-[#30483a]">{{ $code->created_at->format('d M Y') }}</p>
                                <p class="text-[10px] text-[#87948b]">{{ $code->created_at->format('H:i') }}</p>
                            </td>
                            <td class="px-5 py-4">
                                @php
                                    $statusColors = [
                                        'tersedia' => 'bg-emerald-100 text-emerald-800',
                                        'terpakai' => 'bg-orange-100 text-orange-800',
                                    ];
                                @endphp
                                <span
                                    class="inline-block px-2.5 py-1 rounded text-[10px] font-semibold {{ $statusColors[$code->status] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ $code->status_label }}
                                </span>
                            </td>
                            <td class="px-5 py-4">
                                @if ($code->user)
                                    <p class="font-semibold text-[#30483a]">{{ $code->user->nama_lengkap }}</p>
                                @else
                                    <span class="text-[10px] text-[#87948b]">-</span>
                                @endif
                            </td>
                            <td class="px-5 py-4">
                                @if ($code->dipakai_pada)
                                    <p class="text-[#30483a]">{{ $code->dipakai_pada->format('d M Y') }}</p>
                                @else
                                    <span class="text-[10px] text-[#87948b]">-</span>
                                @endif
                            </td>
                            <td class="px-5 py-4">
                                <div class="flex justify-end">
                                    <button
                                        onclick="navigator.clipboard.writeText('{{ $code->kode }}'); alert('Kode disalin!')"
                                        class="bg-[#103a2a] hover:bg-[#315d41] text-white px-3 py-1.5 rounded text-[10px] font-semibold transition">
                                        Salin Kode
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-5 py-12 text-center">
                                <p class="text-sm font-semibold text-[#30483a]">Belum ada kode redeem</p>
                                <p class="mt-1 text-xs text-[#87948b]">Klik tombol "Buat Kode Manual" untuk memulai.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($redeemCodes->hasPages())
            <div class="border-t border-[#edf0eb] px-5 py-4 flex items-center justify-between">
                <p class="text-xs text-[#718078]">
                    Menampilkan {{ $redeemCodes->firstItem() }}-{{ $redeemCodes->lastItem() }} dari
                    {{ $redeemCodes->total() }} kode
                </p>
                <div class="flex items-center gap-1">
                    {{ $redeemCodes->links() }}
                </div>
            </div>
        @endif
    </section>

    <!-- Modal Tambah Redeem Code -->
    <div id="redeem-modal"
        class="hidden fixed inset-0 z-50 flex items-center justify-center bg-[#0b251b]/60 p-4 backdrop-blur-sm">
        <div class="w-full max-w-lg bg-white rounded-lg shadow-2xl">
            <div class="border-b border-[#edf0eb] px-6 py-4 flex items-center justify-between">
                <div>
                    <p class="text-[9px] font-semibold uppercase tracking-[0.17em] text-[#64835d]">Buat Kode Redeem</p>
                    <h2 class="display-font mt-1 text-xl font-semibold text-[#183b2c]">Generate Kode Baru</h2>
                </div>
                <button onclick="closeModal()"
                    class="text-2xl text-[#718078] hover:text-[#30483a] transition">&times;</button>
            </div>

            <form action="{{ route('admin.kodeRedeem.store') }}" method="POST" class="p-6 space-y-4">
                @csrf

                <!-- Pilihan Mode -->
                <div>
                    <label class="block text-[10px] font-semibold uppercase tracking-[0.15em] text-[#64835d] mb-2">Metode
                        Pembuatan</label>
                    <div class="flex gap-4">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="mode" value="manual" id="mode-manual"
                                class="w-4 h-4 text-[#103a2a] border-[#dce7dc] focus:ring-[#103a2a]" checked
                                onchange="toggleMode()">
                            <span class="text-sm text-[#30483a]">Ketik Manual (1 Kode)</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="mode" value="auto" id="mode-auto"
                                class="w-4 h-4 text-[#103a2a] border-[#dce7dc] focus:ring-[#103a2a]"
                                onchange="toggleMode()">
                            <span class="text-sm text-[#30483a]">Generate Otomatis (Banyak)</span>
                        </label>
                    </div>
                </div>

                <!-- Input Manual (Muncul jika mode = manual) -->
                <div id="input-manual">
                    <label class="block text-[10px] font-semibold uppercase tracking-[0.15em] text-[#64835d] mb-1.5">Kode
                        Redeem <span class="text-red-500">*</span></label>
                    <input type="text" name="kode_manual"
                        class="w-full px-3 py-2.5 bg-[#f9fcf9] border border-[#dce7dc] rounded-md text-sm font-mono uppercase focus:border-[#103a2a] focus:ring-1 focus:ring-[#103a2a]/20 outline-none"
                        placeholder="CONTOH: DISKON50K">
                    <p class="mt-1 text-[10px] text-[#87948b]">Ketik kode yang diinginkan (huruf/angka)</p>
                </div>

                <!-- Input Auto Batch (Muncul jika mode = auto) -->
                <div id="input-auto" class="hidden">
                    <label class="block text-[10px] font-semibold uppercase tracking-[0.15em] text-[#64835d] mb-1.5">Jumlah
                        Kode <span class="text-red-500">*</span></label>
                    <input type="number" name="jumlah" value="10" min="1" max="1000"
                        class="w-full px-3 py-2.5 bg-[#f9fcf9] border border-[#dce7dc] rounded-md text-sm focus:border-[#103a2a] focus:ring-1 focus:ring-[#103a2a]/20 outline-none">
                    <p class="mt-1 text-[10px] text-[#87948b]">Sistem akan membuat kode random 8 karakter (Maks: 1000)</p>
                </div>

                <!-- Input Poin (Selalu Muncul) -->
                <div>
                    <label class="block text-[10px] font-semibold uppercase tracking-[0.15em] text-[#64835d] mb-1.5">Nilai
                        Poin <span class="text-red-500">*</span></label>
                    <input type="number" name="poin" required min="1" value="5"
                        class="w-full px-3 py-2.5 bg-[#f9fcf9] border border-[#dce7dc] rounded-md text-sm focus:border-[#103a2a] focus:ring-1 focus:ring-[#103a2a]/20 outline-none">
                    <p class="mt-1 text-[10px] text-[#87948b]">Poin yang didapat user saat menukarkan kode ini</p>
                </div>

                <div>
                    <label class="block text-[10px] font-semibold uppercase tracking-[0.15em] text-[#64835d] mb-1.5">Masa
                        Aktif (Opsional)</label>
                    <input type="date" name="berlaku_hingga" min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                        class="w-full px-3 py-2.5 bg-[#f9fcf9] border border-[#dce7dc] rounded-md text-sm focus:border-[#103a2a] focus:ring-1 focus:ring-[#103a2a]/20 outline-none">
                    <p class="mt-1 text-[10px] text-[#87948b]">Kosongkan jika kode berlaku selamanya</p>
                </div>

                <div class="flex justify-end gap-2 border-t border-[#edf0eb] pt-4">
                    <button type="button" onclick="closeModal()"
                        class="border border-[#dce7dc] px-4 py-2 text-sm text-[#52645a] hover:bg-[#f7faf7] rounded-md transition">Batal</button>
                    <button type="submit"
                        class="bg-[#103a2a] px-5 py-2 text-sm font-semibold text-white hover:bg-[#315d41] rounded-md transition">Buat
                        Kode</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script untuk Toggle Mode -->
    <script>
        function openTambahModal() {
            document.getElementById('redeem-modal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('redeem-modal').classList.add('hidden');
            // Reset form saat ditutup
            document.querySelector('form').reset();
            toggleMode();
        }

        function toggleMode() {
            const isManual = document.getElementById('mode-manual').checked;
            const inputManual = document.getElementById('input-manual');
            const inputAuto = document.getElementById('input-auto');

            if (isManual) {
                inputManual.classList.remove('hidden');
                inputAuto.classList.add('hidden');
                // Hapus atribut required dari input auto agar tidak error validasi
                inputAuto.querySelector('input').removeAttribute('required');
                inputManual.querySelector('input').setAttribute('required', 'required');
            } else {
                inputManual.classList.add('hidden');
                inputAuto.classList.remove('hidden');
                // Hapus atribut required dari input manual
                inputManual.querySelector('input').removeAttribute('required');
                inputAuto.querySelector('input').setAttribute('required', 'required');
            }
        }

        // Close modal when clicking outside
        document.getElementById('redeem-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
    </script>
@endsection
