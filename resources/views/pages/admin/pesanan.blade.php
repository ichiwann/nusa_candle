@extends('layouts.admin')

@section('title', 'Manajemen Pesanan')
@section('page_title', 'Manajemen Pesanan')

@section('content')
    <!-- Header -->
    <div class="mb-6">
        <p class="text-[10px] font-semibold uppercase tracking-[0.17em] text-[#64835d]">Admin Ledger</p>
        <h1 class="display-font mt-1 text-3xl font-semibold text-[#183b2c]">Manajemen Pesanan</h1>
        <p class="mt-2 max-w-2xl text-sm text-[#718078] leading-relaxed">
            Kelola pesanan pelanggan khusus produk tunggal Lilin Aroma Terapi Apel Malang (Signature Edition). Verifikasi
            pengiriman dan status pesanan.
        </p>
    </div>

    <!-- Stats Cards -->
    <section class="grid gap-4 sm:grid-cols-2 lg:grid-cols-6 mb-6">
        <article class="border border-[#e8eee8] bg-white p-5 rounded-md shadow-sm">
            <p class="text-[10px] font-semibold uppercase tracking-[0.13em] text-[#718078]">Total Pesanan</p>
            <p class="display-font mt-2 text-3xl font-semibold text-[#183b2c]">{{ number_format($totalPesanan) }}</p>
            <p class="mt-1 text-[10px] text-emerald-700">+240 vs kemarin</p>
        </article>

        <article class="border border-[#e8eee8] bg-white p-5 rounded-md shadow-sm">
            <p class="text-[10px] font-semibold uppercase tracking-[0.13em] text-[#718078]">Menunggu</p>
            <p class="display-font mt-2 text-3xl font-semibold text-orange-600">{{ number_format($menunggu) }}</p>
            <p class="mt-1 text-[10px] text-[#87948b]">Butuh Konfirmasi</p>
        </article>

        <article class="border border-[#e8eee8] bg-white p-5 rounded-md shadow-sm">
            <p class="text-[10px] font-semibold uppercase tracking-[0.13em] text-[#718078]">Diproses</p>
            <p class="display-font mt-2 text-3xl font-semibold text-[#183b2c]">{{ number_format($diproses) }}</p>
            <p class="mt-1 text-[10px] text-[#87948b]">Sedang Dikemas</p>
        </article>

        <article class="border border-[#e8eee8] bg-white p-5 rounded-md shadow-sm">
            <p class="text-[10px] font-semibold uppercase tracking-[0.13em] text-[#718078]">Dikirim</p>
            <p class="display-font mt-2 text-3xl font-semibold text-[#183b2c]">{{ number_format($dikirim) }}</p>
            <p class="mt-1 text-[10px] text-[#87948b]">Dalam Perjalanan</p>
        </article>

        <article class="border border-[#e8eee8] bg-white p-5 rounded-md shadow-sm">
            <p class="text-[10px] font-semibold uppercase tracking-[0.13em] text-[#718078]">Selesai</p>
            <p class="display-font mt-2 text-3xl font-semibold text-[#183b2c]">{{ number_format($selesai) }}</p>
            <p class="mt-1 text-[10px] text-[#87948b]">Terkirim Sempurna</p>
        </article>

        <article class="border border-[#e8eee8] bg-white p-5 rounded-md shadow-sm">
            <p class="text-[10px] font-semibold uppercase tracking-[0.13em] text-[#718078]">Dibatalkan</p>
            <p class="display-font mt-2 text-3xl font-semibold text-red-600">{{ number_format($dibatalkan) }}</p>
            <p class="mt-1 text-[10px] text-[#87948b]">Dibatalkan</p>
        </article>
    </section>

    <!-- Search & Filter Bar -->
    <form method="GET" action="{{ route('admin.orders.index') }}" class="flex flex-wrap items-center gap-3 mb-4">
        <div class="flex-1 min-w-[250px] relative">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-[#87948b]" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Cari ID pesanan atau nama pelanggan..."
                class="w-full pl-10 pr-4 py-2.5 bg-white border border-[#e8eee8] rounded-md text-sm focus:border-[#103a2a] focus:ring-1 focus:ring-[#103a2a]/20 outline-none">
        </div>

        <select name="status" onchange="this.form.submit()"
            class="px-4 py-2.5 bg-white border border-[#e8eee8] rounded-md text-sm focus:border-[#103a2a] outline-none min-w-[150px]">
            <option value="">Semua Status</option>
            <option value="menunggu_pembayaran" {{ request('status') == 'menunggu_pembayaran' ? 'selected' : '' }}>Menunggu
                Pembayaran</option>
            <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
            <option value="dikirim" {{ request('status') == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
            <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
            <option value="dibatalkan" {{ request('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
        </select>

        <select name="sort" onchange="this.form.submit()"
            class="px-4 py-2.5 bg-white border border-[#e8eee8] rounded-md text-sm focus:border-[#103a2a] outline-none min-w-[150px]">
            <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
            <option value="terlama" {{ request('sort') == 'terlama' ? 'selected' : '' }}>Terlama</option>
            <option value="total_terendah" {{ request('sort') == 'total_terendah' ? 'selected' : '' }}>Total Terendah
            </option>
            <option value="total_tertinggi" {{ request('sort') == 'total_tertinggi' ? 'selected' : '' }}>Total Tertinggi
            </option>
        </select>
    </form>

    <!-- Info Bar -->
    <div class="flex items-center justify-between mb-3 px-1">
        <p class="text-[10px] text-[#718078] uppercase tracking-wider">
            Status: <span class="font-semibold text-[#103a2a]">Diproses ({{ $diproses }})</span>
        </p>
        <button type="button" onclick="window.location.href='{{ route('admin.orders.index') }}'"
            class="text-[10px] text-red-600 hover:text-red-700 font-medium flex items-center gap-1">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
            </svg>
            Reset Filter
        </button>
    </div>

    <!-- Tabel Pesanan -->
    <section class="border border-[#e8eee8] bg-white rounded-md shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead
                    class="bg-[#f7faf7] text-[10px] uppercase tracking-[0.12em] text-[#718078] border-b border-[#edf0eb]">
                    <tr>
                        <th class="px-5 py-3 font-semibold">No. Pesanan</th>
                        <th class="px-5 py-3 font-semibold">Pelanggan</th>
                        <th class="px-5 py-3 font-semibold">Spesifikasian Produk</th>
                        <th class="px-5 py-3 font-semibold">Qty</th>
                        <th class="px-5 py-3 font-semibold">Total</th>
                        <th class="px-5 py-3 font-semibold">Waktu Pesanan</th>
                        <th class="px-5 py-3 font-semibold">Status</th>
                        <th class="px-5 py-3 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#edf0eb]">
                    @forelse($pesanans as $pesanan)
                        <tr class="text-xs hover:bg-[#f9fcf9] transition-colors">
                            <td class="px-5 py-4">
                                <p class="font-semibold text-[#30483a]">
                                    #{{ str_pad($pesanan->id_pesanan, 4, '0', STR_PAD_LEFT) }}</p>
                                <p class="mt-1 text-[10px] text-[#87948b]">{{ $pesanan->created_at->format('d M Y') }}</p>
                            </td>
                            <td class="px-5 py-4">
                                <p class="font-semibold text-[#30483a]">{{ $pesanan->user->nama_lengkap ?? 'Unknown' }}</p>
                                <p class="mt-1 text-[10px] text-[#87948b]">{{ $pesanan->user->username ?? '-' }}</p>
                            </td>
                            <td class="px-5 py-4">
                                {{-- ✅ LEBIH AMAN --}}
                                @forelse($pesanan->detailPesanan as $item)
                                    <div class="text-sm">
                                        {{ $item->produk->nama_produk ?? 'Produk tidak tersedia' }}
                                        ({{ $item->jumlah }}x)
                                    </div>
                                @empty
                                    <span class="text-xs text-gray-400">Tidak ada produk</span>
                                @endforelse
                            </td>
                            <td class="px-5 py-4">
                                @php
                                    $totalQty = 0;
                                    if ($pesanan->detailPesanan && $pesanan->detailPesanan->isNotEmpty()) {
                                        $totalQty = $pesanan->detailPesanan->sum('jumlah');
                                    }
                                @endphp

                                <span class="text-sm font-semibold">{{ $totalQty }} Item</span>
                            </td>
                            <td class="px-5 py-4">
                                <p class="font-semibold text-[#183b2c]">Rp
                                    {{ number_format($pesanan->total_harga, 0, ',', '.') }}</p>
                            </td>
                            <td class="px-5 py-4">
                                <p class="text-[#30483a]">{{ $pesanan->created_at->format('d M Y') }}</p>
                                <p class="text-[10px] text-[#87948b]">{{ $pesanan->created_at->format('H:i') }}</p>
                            </td>
                            <td class="px-5 py-4">
                                @php
                                    $statusColors = [
                                        'menunggu_pembayaran' => 'bg-orange-100 text-orange-800',
                                        'diproses' => 'bg-blue-100 text-blue-800',
                                        'dikirim' => 'bg-purple-100 text-purple-800',
                                        'selesai' => 'bg-emerald-100 text-emerald-800',
                                        'dibatalkan' => 'bg-red-100 text-red-800',
                                    ];
                                    $statusLabels = [
                                        'menunggu_pembayaran' => 'Menunggu',
                                        'diproses' => 'Diproses',
                                        'dikirim' => 'Dikirim',
                                        'selesai' => 'Selesai',
                                        'dibatalkan' => 'Dibatalkan',
                                    ];
                                @endphp
                                <span
                                    class="inline-block px-2.5 py-1 rounded text-[10px] font-semibold {{ $statusColors[$pesanan->status_pesanan] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ $statusLabels[$pesanan->status_pesanan] ?? ucfirst($pesanan->status_pesanan) }}
                                </span>
                            </td>
                            <td class="px-5 py-4">
                                <div class="flex justify-end">
                                    @php
                                        $detailPayload = [
                                            'id' => $pesanan->id_pesanan,
                                            'pelanggan' => $pesanan->user->nama_lengkap ?? 'Unknown',
                                            'username' => $pesanan->user->username ?? '-',
                                            'tanggal' => $pesanan->created_at->format('d M Y H:i'),
                                            'total' => 'Rp ' . number_format($pesanan->total_harga, 0, ',', '.'),
                                            'status' => $pesanan->status_pesanan,
                                            'metode' => $pesanan->transaksi->first()?->metode_label ?? '-',
                                            'items' => $pesanan->detailPesanan
                                                ->map(
                                                    fn($d) => [
                                                        'nama' => $d->produk->nama_produk ?? 'Produk tidak tersedia',
                                                        'jumlah' => $d->jumlah,
                                                    ],
                                                )
                                                ->values()
                                                ->all(),
                                        ];
                                    @endphp
                                    <button onclick='openDetailModal(@json($detailPayload))'
                                        class="bg-[#103a2a] hover:bg-[#315d41] text-white px-3 py-1.5 rounded text-[10px] font-semibold transition">
                                        Lihat Detail
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-5 py-12 text-center">
                                <p class="text-sm font-semibold text-[#30483a]">Tidak ada pesanan ditemukan</p>
                                <p class="mt-1 text-xs text-[#87948b]">Coba ubah filter pencarian.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($pesanans->hasPages())
            <div class="border-t border-[#edf0eb] px-5 py-4 flex items-center justify-between">
                <p class="text-xs text-[#718078]">
                    Menampilkan {{ $pesanans->firstItem() }}-{{ $pesanans->lastItem() }} dari {{ $pesanans->total() }}
                    pesanan terdaftar
                </p>
                <div class="flex items-center gap-1">
                    {{ $pesanans->links() }}
                </div>
            </div>
        @endif
    </section>

    <!-- Modal Detail Pesanan -->
    <div id="status-modal"
        class="hidden fixed inset-0 z-50 flex items-center justify-center bg-[#0b251b]/60 p-4 backdrop-blur-sm">
        <div class="w-full max-w-lg bg-white rounded-lg shadow-2xl max-h-[90vh] overflow-y-auto">
            <div class="border-b border-[#edf0eb] px-6 py-4 flex items-center justify-between">
                <div>
                    <p class="text-[9px] font-semibold uppercase tracking-[0.17em] text-[#64835d]">Detail Pesanan</p>
                    <h2 class="display-font mt-1 text-xl font-semibold text-[#183b2c]">Pesanan #<span
                            id="modal-pesanan-id"></span></h2>
                </div>
                <button onclick="closeStatusModal()"
                    class="text-2xl text-[#718078] hover:text-[#30483a] transition">&times;</button>
            </div>

            <div class="px-6 pt-4 grid grid-cols-2 gap-3 text-xs">
                <div>
                    <p class="text-[10px] uppercase text-[#87948b]">Pelanggan</p>
                    <p id="modal-pelanggan" class="font-semibold text-[#30483a]"></p>
                    <p id="modal-username" class="text-[10px] text-[#87948b]"></p>
                </div>
                <div>
                    <p class="text-[10px] uppercase text-[#87948b]">Tanggal</p>
                    <p id="modal-tanggal" class="font-semibold text-[#30483a]"></p>
                </div>
                <div>
                    <p class="text-[10px] uppercase text-[#87948b]">Metode Bayar</p>
                    <p id="modal-metode" class="font-semibold text-[#30483a]"></p>
                </div>
                <div>
                    <p class="text-[10px] uppercase text-[#87948b]">Total</p>
                    <p id="modal-total" class="font-semibold text-[#183b2c]"></p>
                </div>
                <div class="col-span-2">
                    <p class="text-[10px] uppercase text-[#87948b] mb-1">Produk</p>
                    <ul id="modal-items" class="space-y-1 text-[#30483a]"></ul>
                </div>
            </div>

            <form id="status-form" method="POST" class="p-6 space-y-4">
                @csrf
                @method('PATCH')
                <div>
                    <label class="block text-[10px] font-semibold uppercase tracking-[0.15em] text-[#64835d] mb-2">Status
                        Pesanan</label>
                    <select name="status_pesanan" id="status_pesanan" required
                        class="w-full px-3 py-2.5 bg-[#f9fcf9] border border-[#dce7dc] rounded-md text-sm focus:border-[#103a2a] outline-none">
                        <option value="menunggu_pembayaran">Menunggu Pembayaran</option>
                        <option value="diproses">Diproses</option>
                        <option value="dikirim">Dikirim</option>
                    </select>
                    <p id="status-note" class="mt-2 text-[10px] text-[#87948b]"></p>
                </div>
                <div class="flex justify-end gap-2 border-t border-[#edf0eb] pt-4">
                    <button type="button" onclick="closeStatusModal()"
                        class="border border-[#dce7dc] px-4 py-2 text-sm text-[#52645a] hover:bg-[#f7faf7] rounded-md transition">Batal</button>
                    <button type="submit" id="status-submit"
                        class="bg-[#103a2a] px-5 py-2 text-sm font-semibold text-white hover:bg-[#315d41] rounded-md transition">Simpan
                        Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openDetailModal(data) {
            document.getElementById('modal-pesanan-id').textContent = String(data.id).padStart(4, '0');
            document.getElementById('modal-pelanggan').textContent = data.pelanggan;
            document.getElementById('modal-username').textContent = data.username;
            document.getElementById('modal-tanggal').textContent = data.tanggal;
            document.getElementById('modal-metode').textContent = data.metode;
            document.getElementById('modal-total').textContent = data.total;

            const itemsEl = document.getElementById('modal-items');
            itemsEl.innerHTML = '';
            data.items.forEach(item => {
                const li = document.createElement('li');
                li.textContent = '• ' + item.nama + ' (' + item.jumlah + 'x)';
                itemsEl.appendChild(li);
            });

            document.getElementById('status-form').action = `/admin/pesanan/${data.id}/status`;

            const allowed = ['menunggu_pembayaran', 'diproses', 'dikirim'];
            const locked = !allowed.includes(data.status);
            const select = document.getElementById('status_pesanan');
            const submitBtn = document.getElementById('status-submit');

            select.value = locked ? 'diproses' : data.status;
            select.disabled = locked;
            submitBtn.disabled = locked;
            submitBtn.classList.toggle('opacity-50', locked);
            submitBtn.classList.toggle('cursor-not-allowed', locked);

            document.getElementById('status-note').textContent = locked ?
                'Pesanan sudah selesai/dibatalkan — status tidak dapat diubah.' :
                'ℹ️ Admin hanya bisa mengubah sampai "Dikirim". "Selesai" dikonfirmasi pembeli saat barang tiba, atau lewat halaman Transaksi.';

            document.getElementById('status-modal').classList.remove('hidden');
        }

        function closeStatusModal() {
            document.getElementById('status-modal').classList.add('hidden');
        }

        document.getElementById('status-modal').addEventListener('click', function(e) {
            if (e.target === this) closeStatusModal();
        });
    </script>
@endsection
