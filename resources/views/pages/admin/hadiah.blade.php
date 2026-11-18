@extends('layouts.admin')

@section('title', 'Kelola Hadiah')
@section('page_title', 'Kelola Hadiah')

@section('content')
    {{-- Header --}}
    <div class="flex flex-wrap items-start justify-between gap-4 mb-6">
        <div>
            <p class="text-[10px] font-semibold uppercase tracking-[0.17em] text-[#64835d]">Program Loyalitas</p>
            <h1 class="display-font mt-1 text-3xl font-semibold text-[#183b2c]">Kelola Hadiah</h1>
            <p class="mt-2 max-w-2xl text-sm text-[#718078] leading-relaxed">
                Atur produk hadiah dan jumlah poin yang dibutuhkan untuk penukaran pelanggan.
            </p>
        </div>
        <button onclick="openTambahModal()"
            class="bg-[#103a2a] hover:bg-[#315d41] text-white px-5 py-2.5 rounded-md text-sm font-semibold transition flex items-center gap-2 shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            + Tambah Hadiah
        </button>
    </div>

    {{-- Stats Cards --}}
    <section class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4 mb-6">
        <article class="border border-[#e8eee8] bg-white p-5 rounded-md shadow-sm">
            <p class="text-[10px] font-semibold uppercase tracking-[0.13em] text-[#718078]">Stok Produk</p>
            <p class="display-font mt-2 text-3xl font-semibold text-[#183b2c]">{{ number_format($totalStokProduk) }}</p>
            <p class="mt-1 text-[10px] text-[#87948b]">unit tersedia di katalog</p>
        </article>

        <article class="border border-[#e8eee8] bg-white p-5 rounded-md shadow-sm">
            <p class="text-[10px] font-semibold uppercase tracking-[0.13em] text-[#718078]">Program Hadiah</p>
            <p class="display-font mt-2 text-3xl font-semibold text-[#183b2c]">{{ number_format($totalHadiah) }}</p>
            <p class="mt-1 text-[10px] text-[#87948b]">hadiah terdaftar</p>
        </article>

        <article class="border border-[#e8eee8] bg-white p-5 rounded-md shadow-sm">
            <p class="text-[10px] font-semibold uppercase tracking-[0.13em] text-[#718078]">Penukaran Pending</p>
            <p class="display-font mt-2 text-3xl font-semibold text-orange-600">{{ number_format($penukaranPending) }}</p>
            <p class="mt-1 text-[10px] text-[#87948b]">menunggu persetujuan</p>
        </article>

        <article class="border border-[#e8eee8] bg-white p-5 rounded-md shadow-sm">
            <p class="text-[10px] font-semibold uppercase tracking-[0.13em] text-[#718078]">Total Penukaran</p>
            <p class="display-font mt-2 text-3xl font-semibold text-[#183b2c]">{{ number_format($totalPenukaran) }}</p>
            <p class="mt-1 text-[10px] text-[#87948b]">klaim masuk</p>
        </article>
    </section>

    {{-- Daftar Hadiah --}}
    <section class="border border-[#e8eee8] bg-white rounded-md shadow-sm overflow-hidden">
        <div class="px-5 py-4 border-b border-[#edf0eb] flex items-center justify-between">
            <div>
                <h2 class="display-font text-lg font-semibold text-[#183b2c]">Daftar Hadiah</h2>
                <p class="text-[10px] text-[#718078] mt-1">{{ $totalHadiah }} hadiah terdaftar</p>
            </div>
            <span class="text-[10px] bg-[#f0f7f0] text-[#103a2a] font-semibold px-2 py-1 rounded">Data Katalog</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead
                    class="bg-[#f7faf7] text-[10px] uppercase tracking-[0.12em] text-[#718078] border-b border-[#edf0eb]">
                    <tr>
                        <th class="px-5 py-3 font-semibold">Produk</th>
                        <th class="px-5 py-3 font-semibold">Stok Tersedia</th>
                        <th class="px-5 py-3 font-semibold">Poin Dibutuhkan</th>
                        <th class="px-5 py-3 font-semibold">Tanggal Dibuat</th>
                        <th class="px-5 py-3 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#edf0eb]">
                    @forelse($daftarHadiah as $hadiah)
                        <tr class="text-xs hover:bg-[#f9fcf9] transition-colors">
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">
                                    @if ($hadiah->produk->gambar)
                                        <img src="{{ asset('storage/' . $hadiah->produk->gambar) }}"
                                            alt="{{ $hadiah->produk->nama_produk }}"
                                            class="w-12 h-12 object-cover rounded-md">
                                    @else
                                        <div class="w-12 h-12 bg-gray-100 rounded-md flex items-center justify-center">
                                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @endif
                                    <div>
                                        <p class="font-semibold text-[#30483a]">{{ $hadiah->produk->nama_produk }}</p>
                                        <p class="text-[10px] text-[#87948b]">ID Produk: #{{ $hadiah->id_produk }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-4">
                                <span
                                    class="inline-block bg-[#f0f7f0] text-[#103a2a] text-[10px] font-semibold px-2 py-1 rounded">
                                    {{ number_format($hadiah->produk->stok) }} unit
                                </span>
                            </td>
                            <td class="px-5 py-4">
                                <span
                                    class="inline-block bg-[#FCE4EC] text-[#8B1E1E] text-[10px] font-semibold px-2 py-1 rounded">
                                    {{ number_format($hadiah->poin_dibutuhkan) }} Poin
                                </span>
                            </td>
                            <td class="px-5 py-4">
                                <p class="text-[#30483a]">{{ $hadiah->created_at->format('d M Y') }}</p>
                                <p class="text-[10px] text-[#87948b]">{{ $hadiah->created_at->format('H:i') }}</p>
                            </td>
                            <td class="px-5 py-4">
                                <div class="flex justify-end">
                                    <form action="{{ route('admin.hadiah.destroy', $hadiah->id_hadiah) }}" method="POST"
                                        onsubmit="return confirm('Hapus hadiah ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="border border-red-200 text-red-700 hover:bg-red-50 px-3 py-1.5 rounded text-[10px] font-semibold transition">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-12 text-center">
                                <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                                <p class="text-sm font-semibold text-[#30483a]">Belum ada produk untuk dijadikan hadiah</p>
                                <p class="mt-1 text-xs text-[#87948b]">Tambahkan produk terlebih dahulu di menu Manajemen
                                    Produk.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
    {{-- ✅ SECTION KONFIRMASI KLAIM HADIAH --}}
    <section class="border border-[#e8eee8] bg-white rounded-md shadow-sm overflow-hidden mt-6">
        <div class="px-5 py-4 border-b border-[#edf0eb] flex items-center justify-between">
            <div>
                <h2 class="display-font text-lg font-semibold text-[#183b2c]">Konfirmasi Klaim Hadiah</h2>
                <p class="text-[10px] text-[#718078] mt-1">
                    {{ $penukaranPending }} klaim menunggu persetujuan
                </p>
            </div>
            <div class="flex items-center gap-2">
                <span class="text-[10px] bg-orange-100 text-orange-800 font-semibold px-2 py-1 rounded">
                    {{ $penukaranPending }} Pending
                </span>
                <span class="text-[10px] bg-green-100 text-green-800 font-semibold px-2 py-1 rounded">
                    {{ $penukaranDisetujui }} Disetujui
                </span>
                <span class="text-[10px] bg-red-100 text-red-800 font-semibold px-2 py-1 rounded">
                    {{ $penukaranDitolak }} Ditolak
                </span>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead
                    class="bg-[#f7faf7] text-[10px] uppercase tracking-[0.12em] text-[#718078] border-b border-[#edf0eb]">
                    <tr>
                        <th class="px-5 py-3 font-semibold">ID Penukaran</th>
                        <th class="px-5 py-3 font-semibold">Pelanggan</th>
                        <th class="px-5 py-3 font-semibold">Progress Poin</th>
                        <th class="px-5 py-3 font-semibold">Hadiah</th>
                        <th class="px-5 py-3 font-semibold">Poin Ditukar</th>
                        <th class="px-5 py-3 font-semibold">Catatan / Alamat</th>
                        <th class="px-5 py-3 font-semibold">Status</th>
                        <th class="px-5 py-3 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#edf0eb]">
                    @forelse($daftarPenukaran as $penukaran)
                        <tr class="text-xs hover:bg-[#f9fcf9] transition-colors">
                            <td class="px-5 py-4">
                                <p class="font-mono font-semibold text-[#30483a]">
                                    #{{ str_pad($penukaran['id_penukaran'], 4, '0', STR_PAD_LEFT) }}</p>
                                <p class="text-[10px] text-[#87948b]">{{ $penukaran['tanggal']->format('d M Y, H:i') }}
                                </p>
                            </td>
                            <td class="px-5 py-4">
                                <p class="font-semibold text-[#30483a]">{{ $penukaran['nama_user'] }}</p>
                                <p class="text-[10px] text-[#87948b]">{{ $penukaran['username'] }}</p>
                            </td>
                            <td class="px-5 py-4">
                                <div class="min-w-[140px]">
                                    {{-- POIN SAAT KLAIM (sebelum dikurangi) --}}
                                    <p class="text-[9px] text-[#87948b] mb-0.5">Poin saat klaim:</p>
                                    <p class="text-[11px] font-bold text-[#103a2a] mb-1">
                                        {{ $penukaran['poin_saat_klaim'] }} Poin
                                    </p>

                                    {{-- Progress bar --}}
                                    <div class="w-full bg-gray-200 rounded-full h-1.5 mb-1">
                                        <div class="bg-gradient-to-r from-[#103a2a] to-[#315d41] h-1.5 rounded-full"
                                            style="width: {{ min(100, ($penukaran['poin_saat_klaim'] / 70) * 100) }}%">
                                        </div>
                                    </div>

                                    {{-- Status --}}
                                    @if ($penukaran['poin_saat_klaim'] >= 70)
                                        <p class="text-[9px] text-green-700 font-semibold">✅ Cukup untuk klaim</p>
                                    @else
                                        <p class="text-[9px] text-red-600 font-semibold">⚠️ Kurang
                                            {{ 70 - $penukaran['poin_saat_klaim'] }} poin</p>
                                    @endif

                                    {{-- Poin sekarang (setelah dikurangi) --}}
                                    <p class="text-[9px] text-[#87948b] mt-1">
                                        Poin sekarang: <span
                                            class="font-semibold">{{ $penukaran['poin_sekarang'] }}</span>
                                    </p>
                                </div>
                            </td>
                            <td class="px-5 py-4">
                                <p class="font-semibold text-[#30483a]">{{ $penukaran['nama_produk'] }}</p>
                            </td>
                            <td class="px-5 py-4">
                                <span
                                    class="inline-block bg-[#FCE4EC] text-[#8B1E1E] text-[10px] font-semibold px-2 py-1 rounded">
                                    -{{ number_format($penukaran['poin_ditukar']) }} Poin
                                </span>
                            </td>
                            <td class="px-5 py-4">
                                @if ($penukaran['catatan'])
                                    <p class="text-[#30483a] text-[11px] leading-relaxed max-w-[200px]">
                                        {{ Str::limit($penukaran['catatan'], 80) }}</p>
                                @else
                                    <span class="text-[10px] text-[#87948b] italic">Tidak ada catatan</span>
                                @endif
                            </td>
                            <td class="px-5 py-4">
                                @php
                                    $statusConfig = [
                                        'pending' => ['label' => 'Pending', 'class' => 'bg-yellow-100 text-yellow-800'],
                                        'disetujui' => [
                                            'label' => 'Disetujui',
                                            'class' => 'bg-green-100 text-green-800',
                                        ],
                                        'ditolak' => ['label' => 'Ditolak', 'class' => 'bg-red-100 text-red-800'],
                                    ];
                                    $config = $statusConfig[$penukaran['status_klaim']] ?? [
                                        'label' => $penukaran['status_klaim'],
                                        'class' => 'bg-gray-100 text-gray-800',
                                    ];
                                @endphp
                                <span
                                    class="inline-block px-2.5 py-1 rounded text-[10px] font-semibold {{ $config['class'] }}">
                                    {{ $config['label'] }}
                                </span>
                            </td>
                            <td class="px-5 py-4">
                                <div class="flex justify-end gap-2">
                                    @if ($penukaran['status_klaim'] === 'pending')
                                        <form action="{{ route('admin.hadiah.approve', $penukaran['id_penukaran']) }}"
                                            method="POST" class="inline">
                                            @csrf
                                            <button type="submit" onclick="return confirm('Setujui klaim hadiah ini?')"
                                                class="bg-green-600 hover:bg-green-700 text-white px-3 py-1.5 rounded text-[10px] font-semibold transition">
                                                ✓ Setujui
                                            </button>
                                        </form>
                                        <button type="button"
                                            onclick="openRejectModal({{ $penukaran['id_penukaran'] }}, '{{ $penukaran['nama_user'] }}')"
                                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded text-[10px] font-semibold transition">
                                            ✕ Tolak
                                        </button>
                                    @elseif($penukaran['status_klaim'] === 'disetujui')
                                        <span class="text-[10px] text-green-700 font-semibold">✓ Sudah Diproses</span>
                                    @else
                                        <span class="text-[10px] text-red-700 font-semibold">✕ Ditolak</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-5 py-12 text-center">
                                <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <p class="text-sm font-semibold text-[#30483a]">Belum ada klaim hadiah masuk</p>
                                <p class="mt-1 text-xs text-[#87948b]">Klaim dari pelanggan akan muncul di sini.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    {{-- Modal Tolak Klaim --}}
    <div id="reject-modal"
        class="hidden fixed inset-0 z-50 flex items-center justify-center bg-[#0b251b]/60 p-4 backdrop-blur-sm">
        <div class="w-full max-w-md bg-white rounded-lg shadow-2xl">
            <div class="border-b border-[#edf0eb] px-6 py-4 flex items-center justify-between">
                <div>
                    <p class="text-[9px] font-semibold uppercase tracking-[0.17em] text-[#64835d]">Tolak Klaim Hadiah</p>
                    <h2 class="display-font mt-1 text-xl font-semibold text-[#183b2c]">Tolak Klaim <span
                            id="reject-user-name"></span></h2>
                </div>
                <button onclick="closeRejectModal()"
                    class="text-2xl text-[#718078] hover:text-[#30483a] transition">&times;</button>
            </div>

            <form id="reject-form" method="POST" class="p-6 space-y-4">
                @csrf
                @method('POST')

                <div>
                    <label class="block text-[10px] font-semibold uppercase tracking-[0.15em] text-[#64835d] mb-1.5">Alasan
                        Penolakan</label>
                    <textarea name="alasan_tolak" rows="3" placeholder="Contoh: Alamat tidak lengkap, stok habis, dll..."
                        class="w-full px-3 py-2.5 bg-[#f9fcf9] border border-[#dce7dc] rounded-md text-sm focus:border-[#103a2a] focus:ring-1 focus:ring-[#103a2a]/20 outline-none resize-none"></textarea>
                    <p class="mt-1 text-[10px] text-[#87948b]">⚠️ Poin user akan dikembalikan jika klaim ditolak.</p>
                </div>

                <div class="flex justify-end gap-2 border-t border-[#edf0eb] pt-4">
                    <button type="button" onclick="closeRejectModal()"
                        class="border border-[#dce7dc] px-4 py-2 text-sm text-[#52645a] hover:bg-[#f7faf7] rounded-md transition">Batal</button>
                    <button type="submit"
                        class="bg-red-600 px-5 py-2 text-sm font-semibold text-white hover:bg-red-700 rounded-md transition">Tolak
                        Klaim</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Tambah Hadiah --}}
    <div id="hadiah-modal"
        class="hidden fixed inset-0 z-50 flex items-center justify-center bg-[#0b251b]/60 p-4 backdrop-blur-sm">
        <div class="w-full max-w-md bg-white rounded-lg shadow-2xl">
            <div class="border-b border-[#edf0eb] px-6 py-4 flex items-center justify-between">
                <div>
                    <p class="text-[9px] font-semibold uppercase tracking-[0.17em] text-[#64835d]">Tambah Hadiah Baru</p>
                    <h2 class="display-font mt-1 text-xl font-semibold text-[#183b2c]">Pilih Produk untuk Hadiah</h2>
                </div>
                <button onclick="closeModal()"
                    class="text-2xl text-[#718078] hover:text-[#30483a] transition">&times;</button>
            </div>

            <form action="{{ route('admin.hadiah.store') }}" method="POST" class="p-6 space-y-4">
                @csrf

                <div>
                    <label class="block text-[10px] font-semibold uppercase tracking-[0.15em] text-[#64835d] mb-1.5">Pilih
                        Produk <span class="text-red-500">*</span></label>
                    <select name="id_produk" required
                        class="w-full px-3 py-2.5 bg-[#f9fcf9] border border-[#dce7dc] rounded-md text-sm focus:border-[#103a2a] focus:ring-1 focus:ring-[#103a2a]/20 outline-none">
                        <option value="">-- Pilih Produk --</option>
                        @foreach (\App\Models\Produk::all() as $produk)
                            <option value="{{ $produk->id_produk }}"
                                {{ old('id_produk') == $produk->id_produk ? 'selected' : '' }}>
                                {{ $produk->nama_produk }} (Stok: {{ $produk->stok }})
                            </option>
                        @endforeach
                    </select>
                    <p class="mt-1 text-[10px] text-[#87948b]">Stok hadiah akan otomatis mengikuti stok produk di katalog.
                    </p>
                </div>

                <div>
                    <label class="block text-[10px] font-semibold uppercase tracking-[0.15em] text-[#64835d] mb-1.5">Poin
                        Dibutuhkan <span class="text-red-500">*</span></label>
                    <input type="number" name="poin_dibutuhkan" required min="1"
                        value="{{ old('poin_dibutuhkan', 70) }}"
                        class="w-full px-3 py-2.5 bg-[#f9fcf9] border border-[#dce7dc] rounded-md text-sm focus:border-[#103a2a] focus:ring-1 focus:ring-[#103a2a]/20 outline-none">
                    <p class="mt-1 text-[10px] text-[#87948b]">Jumlah poin yang harus dikumpulkan pelanggan untuk menukar
                        hadiah ini.</p>
                </div>

                <div class="flex justify-end gap-2 border-t border-[#edf0eb] pt-4">
                    <button type="button" onclick="closeModal()"
                        class="border border-[#dce7dc] px-4 py-2 text-sm text-[#52645a] hover:bg-[#f7faf7] rounded-md transition">Batal</button>
                    <button type="submit"
                        class="bg-[#103a2a] px-5 py-2 text-sm font-semibold text-white hover:bg-[#315d41] rounded-md transition">Tambah
                        Hadiah</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openTambahModal() {
            document.getElementById('hadiah-modal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('hadiah-modal').classList.add('hidden');
        }

        document.getElementById('hadiah-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        function openRejectModal(id, userName) {
            document.getElementById('reject-user-name').textContent = userName;
            document.getElementById('reject-form').action = `/admin/hadiah/${id}/reject`;
            document.getElementById('reject-modal').classList.remove('hidden');
        }

        function closeRejectModal() {
            document.getElementById('reject-modal').classList.add('hidden');
            document.querySelector('#reject-form textarea').value = '';
        }

        document.getElementById('reject-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeRejectModal();
            }
        });
    </script>
@endsection
