@extends('layouts.admin')

@section('title', 'Manajemen Produk')
@section('page_title', 'Manajemen Produk')

@section('content')
    <!-- Header -->
    <div class="flex flex-wrap items-start justify-between gap-4 mb-6">
        <div>
            <p class="text-[10px] font-semibold uppercase tracking-[0.17em] text-[#64835d]">Admin Ledger</p>
            <h1 class="display-font mt-1 text-3xl font-semibold text-[#183b2c]">Manajemen Produk</h1>
            <p class="mt-2 max-w-2xl text-sm text-[#718078] leading-relaxed">
                Katalog Eksklusif Produk Tunggal — Lilin Aroma Terapi Apel Malang (Signature Edition).<br>
                Kelola stok, formulasi botani, harga, dan format kemasan resmi.
            </p>
        </div>
        <button onclick="openTambahModal()"
            class="bg-[#103a2a] hover:bg-[#315d41] text-white px-5 py-2.5 rounded-md text-sm font-semibold transition flex items-center gap-2 shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Produk
        </button>
    </div>

    <!-- Stats Cards -->
    <section class="grid gap-4 sm:grid-cols-3 mb-6">
        <article class="border border-[#e8eee8] bg-white p-5 rounded-md shadow-sm relative">
            <p class="text-[10px] font-semibold uppercase tracking-[0.13em] text-[#718078]">Total Produk</p>
            <p class="display-font mt-2 text-4xl font-semibold text-[#183b2c]">{{ number_format($totalProduk) }}</p>
            <p class="mt-1 text-xs text-[#87948b]">Produk Aktif</p>
        </article>
        <article class="border border-[#e8eee8] bg-white p-5 rounded-md shadow-sm relative">
            <p class="text-[10px] font-semibold uppercase tracking-[0.13em] text-[#718078]">Produk Terjual</p>
            <p class="display-font mt-2 text-4xl font-semibold text-[#183b2c]">{{ number_format($produkTerjual) }}</p>
            <p class="mt-1 text-xs text-[#87948b]">Pcs Terjual</p>
        </article>
        <article class="border border-[#e8eee8] bg-white p-5 rounded-md shadow-sm relative">
            <p class="text-[10px] font-semibold uppercase tracking-[0.13em] text-[#718078]">Status Stok</p>
            <p class="display-font mt-2 text-4xl font-semibold text-[#183b2c]">{{ $statusStokText }}</p>
            <p class="mt-1 text-xs text-[#87948b]">di Krisis</p>
        </article>
    </section>

    <!-- Search & Filter Bar -->
    <form method="GET" action="{{ route('admin.products.index') }}" class="flex flex-wrap items-center gap-3 mb-4">
        <div class="flex-1 min-w-[250px] relative">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-[#87948b]" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama produk..."
                class="w-full pl-10 pr-4 py-2.5 bg-white border border-[#e8eee8] rounded-md text-sm focus:border-[#103a2a] focus:ring-1 focus:ring-[#103a2a]/20 outline-none">
        </div>

        <select name="sort" onchange="this.form.submit()"
            class="px-4 py-2.5 bg-white border border-[#e8eee8] rounded-md text-sm focus:border-[#103a2a] outline-none min-w-[150px]">
            <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
            <option value="harga_terendah" {{ request('sort') == 'harga_terendah' ? 'selected' : '' }}>Harga Terendah
            </option>
            <option value="harga_tertinggi" {{ request('sort') == 'harga_tertinggi' ? 'selected' : '' }}>Harga Tertinggi
            </option>
            <option value="stok_terendah" {{ request('sort') == 'stok_terendah' ? 'selected' : '' }}>Stok Terendah</option>
            <option value="stok_tertinggi" {{ request('sort') == 'stok_tertinggi' ? 'selected' : '' }}>Stok Tertinggi
            </option>
        </select>
    </form>

    <!-- Tabel Produk -->
    <section class="border border-[#e8eee8] bg-white rounded-md shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead
                    class="bg-[#f7faf7] text-[10px] uppercase tracking-[0.12em] text-[#718078] border-b border-[#edf0eb]">
                    <tr>
                        <th class="px-5 py-3 font-semibold">Foto</th>
                        <th class="px-5 py-3 font-semibold">Nama Produk</th>
                        <th class="px-5 py-3 font-semibold">ID Produk</th> <!-- GANTI DARI KODE PRODUK -->
                        <th class="px-5 py-3 font-semibold">Harga Satuan</th>
                        <th class="px-5 py-3 font-semibold">Stok</th>
                        <th class="px-5 py-3 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#edf0eb]">
                    @forelse($produks as $produk)
                        <tr class="text-xs hover:bg-[#f9fcf9] transition-colors">
                            <td class="px-5 py-4">
                                @if ($produk->gambar)
                                    <img src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->nama_produk }}"
                                        class="w-14 h-14 object-cover rounded-md border border-[#edf0eb]">
                                @else
                                    <div
                                        class="w-14 h-14 bg-[#f0f7f0] rounded-md flex items-center justify-center border border-[#edf0eb]">
                                        <svg class="w-6 h-6 text-[#718078]" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                            </td>
                            <td class="px-5 py-4">
                                <p class="font-semibold text-[#30483a] text-sm">{{ $produk->nama_produk }}</p>
                            </td>
                            <td class="px-5 py-4">
                                <!-- TAMPILKAN ID PRODUK -->
                                <span
                                    class="inline-block bg-[#f0f7f0] text-[#103a2a] text-[10px] font-mono font-semibold px-2 py-1 rounded">
                                    #{{ $produk->id_produk }}
                                </span>
                            </td>
                            <td class="px-5 py-4">
                                <p class="font-semibold text-[#183b2c]">Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                </p>
                            </td>
                            <td class="px-5 py-4">
                                <p class="font-semibold text-[#183b2c]">{{ number_format($produk->stok) }} <span
                                        class="text-[10px] text-[#87948b] font-normal">Pcs</span></p>
                            </td>
                            <td class="px-5 py-4">
                                <div class="flex justify-end gap-1.5">
                                    <button onclick='editProduk({{ json_encode($produk) }})'
                                        class="p-1.5 text-[#718078] hover:text-[#103a2a] hover:bg-[#f0f7f0] rounded transition"
                                        title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                    <form action="{{ route('admin.products.destroy', $produk->id_produk) }}" method="POST"
                                        onsubmit="return confirm('Hapus produk ini?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="p-1.5 text-[#718078] hover:text-red-600 hover:bg-red-50 rounded transition"
                                            title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-12 text-center">
                                <p class="text-sm font-semibold text-[#30483a]">Tidak ada produk ditemukan</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($produks->hasPages())
            <div class="border-t border-[#edf0eb] px-5 py-4 flex items-center justify-between">
                <p class="text-xs text-[#718078]">
                    Menampilkan {{ $produks->firstItem() }}-{{ $produks->lastItem() }} dari {{ $produks->total() }}
                    produk
                </p>
                <!-- Link Pagination Laravel -->
                <div class="flex items-center gap-1">
                    {{ $produks->links() }}
                </div>
            </div>
        @endif
    </section>

    <!-- Modal Form (Input Kode Produk dihapus karena auto-increment) -->
    <div id="produk-modal"
        class="hidden fixed inset-0 z-50 flex items-center justify-center bg-[#0b251b]/60 p-4 backdrop-blur-sm">
        <div class="w-full max-w-2xl bg-white rounded-lg shadow-2xl max-h-[90vh] overflow-y-auto">
            <div class="sticky top-0 bg-white border-b border-[#edf0eb] px-6 py-4 flex items-center justify-between z-10">
                <div>
                    <h2 id="modal-title" class="display-font text-2xl font-semibold text-[#183b2c]">Tambah Produk</h2>
                </div>
                <button onclick="closeModal()"
                    class="text-2xl text-[#718078] hover:text-[#30483a] transition">&times;</button>
            </div>

            <form id="produk-form" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
                @csrf
                <input type="hidden" name="_method" id="form-method" value="POST">

                <!-- Upload Foto -->
                <div>
                    <label class="block text-[10px] font-semibold uppercase tracking-[0.15em] text-[#64835d] mb-2">Foto
                        Produk Lilin</label>
                    <div class="border-2 border-dashed border-[#dce7dc] rounded-lg p-6 text-center hover:border-[#103a2a] transition cursor-pointer bg-[#f9fcf9]"
                        onclick="document.getElementById('gambar').click()">
                        <div id="preview-container" class="mb-3 hidden">
                            <img id="preview-image" src="" alt="Preview"
                                class="w-24 h-24 object-cover rounded-lg mx-auto border border-[#edf0eb]">
                        </div>
                        <div id="upload-placeholder">
                            <svg class="w-8 h-8 mx-auto text-[#87948b] mb-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <p class="text-sm font-medium text-[#30483a]">Unggah Foto Master Produk</p>
                            <p class="text-[10px] text-[#87948b] mt-1">Format JPG, PNG atau WebP (Maksimum 2MB).</p>
                        </div>
                        <input type="file" name="gambar" id="gambar" accept="image/*" class="hidden"
                            onchange="previewImage(this)">
                    </div>
                </div>

                <!-- Nama Produk -->
                <div>
                    <label class="block text-[10px] font-semibold uppercase tracking-[0.15em] text-[#64835d] mb-1.5">Nama
                        Produk</label>
                    <input type="text" name="nama_produk" id="nama_produk" required
                        class="w-full px-3 py-2.5 bg-[#f9fcf9] border border-[#dce7dc] rounded-md text-sm focus:border-[#103a2a] focus:ring-1 focus:ring-[#103a2a]/20 outline-none"
                        placeholder="NusaCandle - Lilin Aroma Terapi...">
                </div>

                <!-- Harga & Stok -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label
                            class="block text-[10px] font-semibold uppercase tracking-[0.15em] text-[#64835d] mb-1.5">Harga
                            Satuan (IDR)</label>
                        <input type="number" name="harga" id="harga" required min="0"
                            class="w-full px-3 py-2.5 bg-[#f9fcf9] border border-[#dce7dc] rounded-md text-sm focus:border-[#103a2a] focus:ring-1 focus:ring-[#103a2a]/20 outline-none"
                            placeholder="125000">
                    </div>
                    <div>
                        <label
                            class="block text-[10px] font-semibold uppercase tracking-[0.15em] text-[#64835d] mb-1.5">Stok
                            Fisik</label>
                        <input type="number" name="stok" id="stok" required min="0"
                            class="w-full px-3 py-2.5 bg-[#f9fcf9] border border-[#dce7dc] rounded-md text-sm focus:border-[#103a2a] focus:ring-1 focus:ring-[#103a2a]/20 outline-none"
                            placeholder="150">
                    </div>
                </div>

                <!-- Footer Buttons -->
                <div class="flex justify-end gap-2 border-t border-[#edf0eb] pt-4">
                    <button type="button" onclick="closeModal()"
                        class="border border-[#dce7dc] px-4 py-2 text-sm text-[#52645a] hover:bg-[#f7faf7] rounded-md transition">Batal</button>
                    <button type="submit"
                        class="bg-[#103a2a] px-5 py-2 text-sm font-semibold text-white hover:bg-[#315d41] rounded-md transition">Simpan
                        Produk</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openTambahModal() {
            document.getElementById('modal-title').textContent = 'Tambah Produk';
            document.getElementById('produk-form').action = "{{ route('admin.products.store') }}";
            document.getElementById('form-method').value = 'POST';
            document.getElementById('produk-form').reset();
            document.getElementById('preview-container').classList.add('hidden');
            document.getElementById('upload-placeholder').classList.remove('hidden');
            document.getElementById('produk-modal').classList.remove('hidden');
        }

        function editProduk(produk) {
            document.getElementById('modal-title').textContent = 'Edit Produk (ID: #' + produk.id_produk + ')';
            document.getElementById('produk-form').action = `/admin/produk/${produk.id_produk}`;
            document.getElementById('form-method').value = 'PUT';

            document.getElementById('nama_produk').value = produk.nama_produk;
            document.getElementById('stok').value = produk.stok;
            document.getElementById('harga').value = produk.harga;

            if (produk.gambar) {
                document.getElementById('preview-image').src = '/storage/' + produk.gambar;
                document.getElementById('preview-container').classList.remove('hidden');
                document.getElementById('upload-placeholder').classList.add('hidden');
            } else {
                document.getElementById('preview-container').classList.add('hidden');
                document.getElementById('upload-placeholder').classList.remove('hidden');
            }

            document.getElementById('produk-modal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('produk-modal').classList.add('hidden');
        }

        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview-image').src = e.target.result;
                    document.getElementById('preview-container').classList.remove('hidden');
                    document.getElementById('upload-placeholder').classList.add('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
