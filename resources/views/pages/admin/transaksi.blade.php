@extends('layouts.admin')

@section('title', 'Manajemen Transaksi')
@section('page_title', 'Manajemen Transaksi')

@section('content')
    <!-- Header -->
    <div class="mb-6">
        <p class="text-[10px] font-semibold uppercase tracking-[0.17em] text-[#64835d]">Admin Ledger</p>
        <h1 class="display-font mt-1 text-3xl font-semibold text-[#183b2c]">Manajemen Transaksi</h1>
        <p class="mt-2 max-w-2xl text-sm text-[#718078] leading-relaxed">
            Pencatatan dan verifikasi pembayaran pesanan Lilin Aroma Terapi Apel Malang.
            Monitoring status pembayaran via gateway, dan konfirmasi manual.
        </p>
    </div>

    <!-- Stats Cards -->
    <section class="grid gap-4 sm:grid-cols-2 mb-6">
        <article class="border border-[#e8eee8] bg-white p-5 rounded-md shadow-sm relative">
            <div class="absolute top-4 right-4 text-[#718078]">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
            </div>
            <p class="text-[10px] font-semibold uppercase tracking-[0.13em] text-[#718078]">Total Transaksi</p>
            <p class="display-font mt-2 text-4xl font-semibold text-[#183b2c]">{{ number_format($totalTransaksi) }}</p>
            <p class="mt-1 text-[10px] text-emerald-700">+14.2% vs bulan lalu</p>
        </article>

        <article class="border border-[#e8eee8] bg-white p-5 rounded-md shadow-sm relative">
            <div class="absolute top-4 right-4 text-[#718078]">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <p class="text-[10px] font-semibold uppercase tracking-[0.13em] text-[#718078]">Total Pendapatan</p>
            <p class="display-font mt-2 text-4xl font-semibold text-[#183b2c]">Rp
                {{ number_format($totalPendapatan / 1000000, 1) }}M</p>
            <p class="mt-1 text-[10px] text-emerald-700">+12.8% vs bulan lalu</p>
        </article>
    </section>

    <!-- Banner Produk Terlaris -->
    <section class="bg-gradient-to-r from-[#103a2a] to-[#315d41] rounded-md p-6 mb-6 text-white">
        <div class="flex flex-wrap items-center gap-6">
            <div class="flex-shrink-0">
                <div class="w-32 h-32 bg-white/10 rounded-lg flex items-center justify-center">
                    <svg class="w-12 h-12 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>
            <div class="flex-1">
                <div class="flex items-center gap-2 mb-2">
                    <span class="bg-red-500 text-white text-[9px] font-bold px-2 py-0.5 rounded">BEST SELLER</span>
                </div>
                <h2 class="display-font text-2xl font-semibold">Lilin Aroma Terapi Aroma Apel</h2>
                <p class="mt-2 text-sm text-emerald-100/80 max-w-xl">
                    Komposisi: 100% Premium Soy Wax, Glattian Apel Malang Highland.
                    Dibuat di Jawa Barat, Carton Box.
                </p>
            </div>
            <div class="text-right">
                <p class="text-[10px] uppercase tracking-[0.17em] text-emerald-200/80">Total Terjual</p>
                <p class="display-font mt-1 text-3xl font-semibold">{{ number_format($totalTerjual) }}</p>
                <p class="text-[10px] text-emerald-200/80">Jar</p>
            </div>
        </div>
    </section>

    <!-- Search & Filter Bar -->
    <form method="GET" action="{{ route('admin.transactions.index') }}" class="flex flex-wrap items-center gap-3 mb-4">
        <div class="flex-1 min-w-[250px] relative">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-[#87948b]" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Cari ID transaksi, ID pesanan, atau nama pelanggan..."
                class="w-full pl-10 pr-4 py-2.5 bg-white border border-[#e8eee8] rounded-md text-sm focus:border-[#103a2a] focus:ring-1 focus:ring-[#103a2a]/20 outline-none">
        </div>

        <select name="status" onchange="this.form.submit()"
            class="px-4 py-2.5 bg-white border border-[#e8eee8] rounded-md text-sm focus:border-[#103a2a] outline-none min-w-[150px]">
            <option value="">Semua Status</option>
            <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu Pembayaran</option>
            <option value="berhasil" {{ request('status') == 'berhasil' ? 'selected' : '' }}>Berhasil</option>
            <option value="gagal" {{ request('status') == 'gagal' ? 'selected' : '' }}>Gagal</option>
        </select>

        <select name="metode" onchange="this.form.submit()"
            class="px-4 py-2.5 bg-white border border-[#e8eee8] rounded-md text-sm focus:border-[#103a2a] outline-none min-w-[150px]">
            <option value="">Semua Metode</option>
            <option value="bca" {{ request('metode') == 'bca' ? 'selected' : '' }}>BCA VA</option>
            <option value="mandiri" {{ request('metode') == 'mandiri' ? 'selected' : '' }}>Mandiri</option>
            <option value="gopay" {{ request('metode') == 'gopay' ? 'selected' : '' }}>GoPay</option>
            <option value="dana" {{ request('metode') == 'dana' ? 'selected' : '' }}>DANA</option>
            <option value="shopeepay" {{ request('metode') == 'shopeepay' ? 'selected' : '' }}>ShopeePay</option>
            <option value="cash" {{ request('metode') == 'cash' ? 'selected' : '' }}>Manual</option>
        </select>

        <!-- ✅ TAMBAHAN: Dropdown Sort -->
        <select name="sort" onchange="this.form.submit()"
            class="px-4 py-2.5 bg-white border border-[#e8eee8] rounded-md text-sm focus:border-[#103a2a] outline-none min-w-[150px]">
            <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
            <option value="terlama" {{ request('sort') == 'terlama' ? 'selected' : '' }}>Terlama</option>
        </select>
    </form>

    <!-- Info Bar -->
    <div class="flex items-center justify-between mb-3 px-1">
        <p class="text-[10px] text-[#718078] uppercase tracking-wider">
            Daftar Transaksi Masuk <span class="font-semibold text-[#103a2a]">TERBARU</span>
        </p>
        <p class="text-[10px] text-[#718078]">
            Menampilkan {{ $transaksis->firstItem() ?? 0 }}-{{ $transaksis->lastItem() ?? 0 }} dari
            {{ $transaksis->total() }} transaksi
        </p>
    </div>

    <!-- Tabel Transaksi -->
    <section class="border border-[#e8eee8] bg-white rounded-md shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead
                    class="bg-[#f7faf7] text-[10px] uppercase tracking-[0.12em] text-[#718078] border-b border-[#edf0eb]">
                    <tr>
                        <th class="px-5 py-3 font-semibold">No. Transaksi</th>
                        <th class="px-5 py-3 font-semibold">Pelanggan</th>
                        <th class="px-5 py-3 font-semibold">Metode</th>
                        <th class="px-5 py-3 font-semibold">Total Pembayaran</th>
                        <th class="px-5 py-3 font-semibold">Tanggal Transaksi</th>
                        <th class="px-5 py-3 font-semibold">Status</th>
                        <th class="px-5 py-3 text-right font-semibold">Bukti Bayar</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#edf0eb]">
                    @forelse($transaksis as $transaksi)
                        <tr class="text-xs hover:bg-[#f9fcf9] transition-colors">
                            <td class="px-5 py-4">
                                <p class="font-semibold text-[#30483a]">
                                    TRX-{{ str_pad($transaksi->id_transaksi, 4, '0', STR_PAD_LEFT) }}</p>
                                <p class="mt-1 text-[10px] text-[#87948b]">
                                    IDC-{{ str_pad($transaksi->id_pesanan ?? 0, 4, '0', STR_PAD_LEFT) }}</p>
                            </td>
                            <td class="px-5 py-4">
                                <p class="font-semibold text-[#30483a]">
                                    {{ $transaksi->pesanan->user->nama_lengkap ?? 'Unknown' }}</p>
                                <p class="mt-1 text-[10px] text-[#87948b]">{{ $transaksi->pesanan->user->email ?? '-' }}
                                </p>
                            </td>
                            <td class="px-5 py-4">
                                <span
                                    class="inline-block bg-[#f0f7f0] text-[#103a2a] text-[10px] font-semibold px-2 py-1 rounded">
                                    {{ $transaksi->metode_label }}
                                </span>
                            </td>
                            <td class="px-5 py-4">
                                <p class="font-semibold text-[#183b2c]">Rp
                                    {{ number_format($transaksi->pesanan->total_harga ?? 0, 0, ',', '.') }}</p>
                            </td>
                            <td class="px-5 py-4">
                                <p class="text-[#30483a]">{{ $transaksi->created_at->format('d M Y') }}</p>
                                <p class="text-[10px] text-[#87948b]">{{ $transaksi->created_at->format('H:i') }}</p>
                            </td>
                            <td class="px-5 py-4">
                                @php
                                    $statusColors = [
                                        'menunggu' => 'bg-orange-100 text-orange-800',
                                        'berhasil' => 'bg-emerald-100 text-emerald-800',
                                        'gagal' => 'bg-red-100 text-red-800',
                                    ];
                                @endphp
                                <span
                                    class="inline-block px-2.5 py-1 rounded text-[10px] font-semibold {{ $statusColors[$transaksi->status_pembayaran] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ $transaksi->status_label }}
                                </span>
                            </td>
                            <td class="px-5 py-4">
                                <div class="flex justify-end gap-2">
                                    @if ($transaksi->bukti_pembayaran)
                                        <a href="{{ asset('storage/' . $transaksi->bukti_pembayaran) }}" target="_blank"
                                            class="text-[#103a2a] hover:text-[#315d41] text-[10px] font-semibold underline">
                                            Lihat Bukti
                                        </a>
                                    @else
                                        <span class="text-[10px] text-[#87948b]">-</span>
                                    @endif
                                    @php
                                        $detailPayload = [
                                            'id' => $transaksi->id_transaksi,
                                            'pelanggan' => $transaksi->pesanan->user->nama_lengkap ?? 'Unknown',
                                            'metode' => $transaksi->metode_label,
                                            'total' =>
                                                'Rp ' .
                                                number_format($transaksi->pesanan->total_harga ?? 0, 0, ',', '.'),
                                            'tanggal' => $transaksi->created_at->format('d M Y H:i'),
                                            'statusPembayaran' => $transaksi->status_pembayaran,
                                            'statusPesanan' => $transaksi->pesanan->status_pesanan ?? '-',
                                            'bukti' => $transaksi->bukti_pembayaran
                                                ? asset('storage/' . $transaksi->bukti_pembayaran)
                                                : null,
                                        ];
                                    @endphp
                                    <button onclick='openDetailModal(@json($detailPayload))'
                                        class="bg-[#103a2a] hover:bg-[#315d41] text-white px-3 py-1.5 rounded text-[10px] font-semibold transition">
                                        Detail Transaksi
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-5 py-12 text-center">
                                <p class="text-sm font-semibold text-[#30483a]">Tidak ada transaksi ditemukan</p>
                                <p class="mt-1 text-xs text-[#87948b]">Coba ubah filter pencarian.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($transaksis->hasPages())
            <div class="border-t border-[#edf0eb] px-5 py-4 flex items-center justify-between">
                <p class="text-xs text-[#718078]">
                    Menampilkan {{ $transaksis->firstItem() }}-{{ $transaksis->lastItem() }} dari
                    {{ $transaksis->total() }} transaksi
                </p>
                <div class="flex items-center gap-1">
                    {{ $transaksis->links() }}
                </div>
            </div>
        @endif
    </section>

    <!-- Modal Detail Transaksi -->
    <div id="status-modal"
        class="hidden fixed inset-0 z-50 flex items-center justify-center bg-[#0b251b]/60 p-4 backdrop-blur-sm">
        <div class="w-full max-w-lg bg-white rounded-lg shadow-2xl max-h-[90vh] overflow-y-auto">
            <div class="border-b border-[#edf0eb] px-6 py-4 flex items-center justify-between">
                <div>
                    <p class="text-[9px] font-semibold uppercase tracking-[0.17em] text-[#64835d]">Detail Transaksi</p>
                    <h2 class="display-font mt-1 text-xl font-semibold text-[#183b2c]">TRX-<span
                            id="modal-transaksi-id"></span></h2>
                </div>
                <button onclick="closeStatusModal()"
                    class="text-2xl text-[#718078] hover:text-[#30483a] transition">&times;</button>
            </div>

            <div class="px-6 pt-4 grid grid-cols-2 gap-3 text-xs">
                <div>
                    <p class="text-[10px] uppercase text-[#87948b]">Pelanggan</p>
                    <p id="modal-pelanggan" class="font-semibold text-[#30483a]"></p>
                </div>
                <div>
                    <p class="text-[10px] uppercase text-[#87948b]">Tanggal</p>
                    <p id="modal-tanggal" class="font-semibold text-[#30483a]"></p>
                </div>
                <div>
                    <p class="text-[10px] uppercase text-[#87948b]">Metode</p>
                    <p id="modal-metode" class="font-semibold text-[#30483a]"></p>
                </div>
                <div>
                    <p class="text-[10px] uppercase text-[#87948b]">Total</p>
                    <p id="modal-total" class="font-semibold text-[#183b2c]"></p>
                </div>
                <div class="col-span-2">
                    <p class="text-[10px] uppercase text-[#87948b]">Status Pesanan Saat Ini</p>
                    <p id="modal-status-pesanan" class="font-semibold text-[#30483a] capitalize"></p>
                </div>
                <div id="modal-bukti-wrap" class="col-span-2 hidden">
                    <a id="modal-bukti-link" href="#" target="_blank" rel="noopener noreferrer"
                        class="inline-flex items-center gap-1.5 rounded-md border border-[#dce7dc] bg-[#f9fcf9] px-3 py-2 text-[11px] font-semibold text-[#103a2a] hover:border-[#103a2a] transition">
                        📎 Lihat Bukti Pembayaran (buka file)
                    </a>
                </div>
            </div>

            <form id="status-form" method="POST" class="p-6 space-y-4">
                @csrf
                @method('PATCH')

                <div>
                    <label class="block text-[10px] font-semibold uppercase tracking-[0.15em] text-[#64835d] mb-2">Status
                        Pembayaran</label>
                    <select name="status_pembayaran" id="status_pembayaran" required
                        class="w-full px-3 py-2.5 bg-[#f9fcf9] border border-[#dce7dc] rounded-md text-sm focus:border-[#103a2a] outline-none">
                        <option value="menunggu">Menunggu Verifikasi</option>
                        <option value="berhasil">Berhasil</option>
                        <option value="gagal">Gagal</option>
                    </select>
                    <p class="mt-2 text-[10px] text-[#87948b]">⚠️ "Berhasil" otomatis mengubah pesanan jadi "Diproses"
                        (jika masih menunggu pembayaran).</p>
                </div>

                <div>
                    <label class="block text-[10px] font-semibold uppercase tracking-[0.15em] text-[#64835d] mb-2">Status
                        Pesanan (opsional)</label>
                    <select name="status_pesanan" id="status_pesanan"
                        class="w-full px-3 py-2.5 bg-[#f9fcf9] border border-[#dce7dc] rounded-md text-sm focus:border-[#103a2a] outline-none">
                        <option value="">— Tidak diubah —</option>
                        <option value="menunggu_pembayaran">Menunggu Pembayaran</option>
                        <option value="diproses">Diproses</option>
                        <option value="dikirim">Dikirim</option>
                        <option value="selesai">Selesai</option>
                    </select>
                    <p class="mt-2 text-[10px] text-[#87948b]">ℹ️ Khusus COD: menandai "Selesai" otomatis melunasi
                        pembayaran.</p>
                </div>

                <div class="flex justify-end gap-2 border-t border-[#edf0eb] pt-4">
                    <button type="button" onclick="closeStatusModal()"
                        class="border border-[#dce7dc] px-4 py-2 text-sm text-[#52645a] hover:bg-[#f7faf7] rounded-md transition">Batal</button>
                    <button type="submit"
                        class="bg-[#103a2a] px-5 py-2 text-sm font-semibold text-white hover:bg-[#315d41] rounded-md transition">Simpan
                        Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openDetailModal(data) {
            document.getElementById('modal-transaksi-id').textContent = String(data.id).padStart(4, '0');
            document.getElementById('modal-pelanggan').textContent = data.pelanggan;
            document.getElementById('modal-metode').textContent = data.metode;
            document.getElementById('modal-total').textContent = data.total;
            document.getElementById('modal-tanggal').textContent = data.tanggal;
            document.getElementById('modal-status-pesanan').textContent = data.statusPesanan.replace(/_/g, ' ');

            const buktiWrap = document.getElementById('modal-bukti-wrap');
            if (data.bukti) {
                document.getElementById('modal-bukti-link').href = data.bukti;
                buktiWrap.classList.remove('hidden');
            } else {
                buktiWrap.classList.add('hidden');
            }

            document.getElementById('status-form').action = `/admin/transaksi/${data.id}/status`;
            document.getElementById('status_pembayaran').value = data.statusPembayaran;
            document.getElementById('status_pesanan').value = '';
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
