@extends('layouts.pembeli')

@section('title', 'Transaksi Saya - NusaCandle')

@section('content')
    <div class="bg-[#FAF9F6] min-h-screen">
        {{-- Header --}}
        <div class="bg-white border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="flex flex-wrap items-start justify-between gap-4">
                    <div>
                        <div class="inline-flex items-center gap-2 bg-[#E8F5E9] px-3 py-1 rounded-full mb-3">
                            <svg class="w-4 h-4 text-[#2E7D32]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="text-xs font-semibold text-[#2E7D32]">Portal Pembayaran Pelanggan</span>
                        </div>
                        <h1 class="font-serif text-4xl font-bold text-[#2C1810]">Transaksi Saya</h1>
                        <p class="text-[#718078] mt-2 max-w-2xl">Daftar riwayat pembayaran dan konfirmasi transaksi lilin aromaterapi Anda. Kelola tagihan aktif dengan verifikasi aman.</p>
                    </div>

                    {{-- Security Info --}}
                    <div class="flex items-center gap-4 text-xs text-[#718078]">
                        <div class="flex items-center gap-1">
                            <svg class="w-4 h-4 text-[#2E7D32]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>Enkripsi 256-Bit</span>
                        </div>
                        <div class="flex items-center gap-1">
                            <svg class="w-4 h-4 text-[#8B1E1E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                            <span>Verifikasi Otomatis</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
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

            <div class="grid lg:grid-cols-2 gap-6 mb-8">
                {{-- TRANSAKSI BERJALAN --}}
                @if($transaksiBerjalan->count() > 0)
                <section>
                    @foreach($transaksiBerjalan as $transaksi)
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden mb-4">
                        {{-- Header --}}
                        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between bg-[#FAF9F6]">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-[#718078] mb-1">Transaksi Berjalan</p>
                                <p class="font-mono font-bold text-[#2C1810]">TRX-{{ str_pad($transaksi->id_transaksi, 5, '0', STR_PAD_LEFT) }}</p>
                                <p class="text-xs text-[#718078] mt-1">Pesanan #NC-{{ $transaksi->pesanan->created_at->format('Y') }}-{{ str_pad($transaksi->pesanan->id_pesanan, 4, '0', STR_PAD_LEFT) }}</p>
                            </div>
                            <span class="inline-flex items-center gap-1 bg-[#FCE4EC] text-[#8B1E1E] px-3 py-1 rounded-full text-xs font-semibold">
                                <span class="w-2 h-2 rounded-full bg-[#8B1E1E]"></span>
                                Menunggu Pembayaran
                            </span>
                        </div>

                        {{-- Produk --}}
                        @foreach($transaksi->pesanan->detailPesanan as $detail)
                        <div class="px-6 py-4 flex gap-4 border-b border-gray-100">
                            <div class="flex-shrink-0">
                                @if($detail->produk->gambar)
                                    <img src="{{ asset('storage/' . $detail->produk->gambar) }}" alt="{{ $detail->produk->nama_produk }}" class="w-16 h-16 object-cover rounded-md">
                                @else
                                    <div class="w-16 h-16 bg-gray-200 rounded-md flex items-center justify-center">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1">
                                <p class="text-[10px] font-semibold uppercase tracking-wider text-[#718078] mb-1">100% Natural Soy Wax</p>
                                <h3 class="font-serif text-base font-bold text-[#2C1810]">{{ $detail->produk->nama_produk }}</h3>
                                <p class="text-xs text-[#718078] mt-1">Jumlah: {{ $detail->jumlah }} Pcs ({{ $detail->jumlah * 200 }} gr)</p>
                                <p class="text-xs text-[#718078]">Tanggal: {{ $transaksi->created_at->format('d F Y, H:i') }} WIB</p>
                            </div>
                        </div>
                        @endforeach

                        {{-- Metode Pembayaran --}}
                        <div class="px-6 py-4 bg-[#FAF9F6]">
                            <div class="flex items-center justify-between mb-2">
                                <p class="text-xs font-semibold text-[#718078]">Metode Pembayaran</p>
                                <p class="text-sm font-bold text-[#2C1810]">{{ $transaksi->metode_label }}</p>
                            </div>
                            @if(in_array($transaksi->metode_pembayaran, ['bca', 'mandiri']))
                            <div class="mb-3">
                                <p class="text-xs text-[#718078] mb-1">Nomor Virtual Account</p>
                                <div class="flex items-center justify-between bg-white border border-gray-200 rounded-md px-4 py-2">
                                    <p class="font-mono text-lg font-bold text-[#8B1E1E] tracking-wider">8271 0812 3456 7890</p>
                                    <button onclick="copyToClipboard('8271081234567890')" class="text-xs bg-[#8B1E1E] text-white px-3 py-1 rounded hover:bg-[#6B1515] transition">
                                        Salin
                                    </button>
                                </div>
                            </div>
                            @endif
                            <div class="flex items-center justify-between pt-3 border-t border-gray-200">
                                <p class="text-sm font-semibold text-[#718078]">Total Tagihan</p>
                                <p class="font-serif text-2xl font-bold text-[#8B1E1E]">Rp{{ number_format($transaksi->pesanan->total_harga, 0, ',', '.') }}</p>
                            </div>
                        </div>

                        {{-- Footer --}}
                        <div class="px-6 py-3 border-t border-gray-100 flex gap-2">
                            <a href="{{ route('pembeli.transaksi.show', $transaksi->id_transaksi) }}" class="flex-1 inline-flex items-center justify-center gap-2 bg-white border border-gray-200 hover:border-[#8B1E1E] text-[#2C1810] px-4 py-2 rounded-md text-sm font-semibold transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                Lihat Detail
                            </a>
                            <button onclick="scrollToKonfirmasi()" class="flex-1 inline-flex items-center justify-center gap-2 bg-[#8B1E1E] hover:bg-[#6B1515] text-white px-4 py-2 rounded-md text-sm font-semibold transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                </svg>
                                Bayar Sekarang
                            </button>
                        </div>
                    </div>
                    @endforeach
                </section>
                @else
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-12 text-center">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <p class="text-sm font-semibold text-[#2C1810] mb-1">Tidak ada transaksi berjalan</p>
                    <p class="text-xs text-[#718078]">Semua pembayaran Anda sudah selesai diproses.</p>
                </div>
                @endif

                {{-- KONFIRMASI PEMBAYARAN --}}
                @if($transaksiKonfirmasi)
                <section id="section-konfirmasi">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 sticky top-24">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <h2 class="font-serif text-2xl font-bold text-[#2C1810]">Konfirmasi Pembayaran</h2>
                                <p class="text-xs text-[#718078] mt-1">Kirim bukti transfer bank bila sistem belum memperbarui status pesanan Anda secara otomatis.</p>
                            </div>
                            <div class="w-10 h-10 rounded-full bg-[#FCE4EC] flex items-center justify-center">
                                <svg class="w-5 h-5 text-[#8B1E1E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                        </div>

                        <form action="{{ route('pembeli.transaksi.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                            @csrf
                            <input type="hidden" name="id_transaksi" value="{{ $transaksiKonfirmasi->id_transaksi }}">

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-semibold uppercase tracking-wider text-[#718078] mb-1.5">ID Pesanan</label>
                                    <input type="text" value="#NC-{{ $transaksiKonfirmasi->pesanan->created_at->format('Y') }}-{{ str_pad($transaksiKonfirmasi->pesanan->id_pesanan, 4, '0', STR_PAD_LEFT) }} (TRX-{{ str_pad($transaksiKonfirmasi->id_transaksi, 5, '0', STR_PAD_LEFT) }} - Rp{{ number_format($transaksiKonfirmasi->pesanan->total_harga, 0, ',', '.') }})" readonly
                                        class="w-full px-3 py-2.5 bg-[#FAF9F6] border border-gray-200 rounded-md text-sm text-[#2C1810] font-semibold">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold uppercase tracking-wider text-[#718078] mb-1.5">Metode Pembayaran</label>
                                    <input type="text" value="{{ $transaksiKonfirmasi->metode_label }}" readonly
                                        class="w-full px-3 py-2.5 bg-[#FAF9F6] border border-gray-200 rounded-md text-sm text-[#2C1810]">
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-semibold uppercase tracking-wider text-[#718078] mb-1.5">Jumlah Pembayaran</label>
                                    <input type="text" value="Rp {{ number_format($transaksiKonfirmasi->pesanan->total_harga, 0, ',', '.') }}" readonly
                                        class="w-full px-3 py-2.5 bg-[#FAF9F6] border border-gray-200 rounded-md text-sm font-bold text-[#8B1E1E]">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold uppercase tracking-wider text-[#718078] mb-1.5">Nama Pemilik Rekening Pengirim</label>
                                    <input type="text" name="nama_pemilik" required placeholder="Contoh: Rian Anggoro"
                                        class="w-full px-3 py-2.5 bg-white border border-gray-200 rounded-md text-sm focus:border-[#8B1E1E] focus:ring-1 focus:ring-[#8B1E1E]/20 outline-none">
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold uppercase tracking-wider text-[#718078] mb-1.5">Bukti Pembayaran (Foto/PDF Bukti Transfer)</label>
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-[#8B1E1E] transition cursor-pointer" onclick="document.getElementById('bukti_pembayaran').click()">
                                    <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" accept=".jpg,.jpeg,.png,.pdf" required class="hidden" onchange="showFileName(this)">
                                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                    </svg>
                                    <p class="text-sm text-[#718078] mb-1">Klik untuk pilih file atau seret gambar bukti transfer ke sini</p>
                                    <p class="text-xs text-[#718078]">Format didukung: JPG, PNG, atau PDF (Maksimal 5MB)</p>
                                    <p id="file-name" class="text-xs text-[#8B1E1E] font-semibold mt-2 hidden"></p>
                                </div>
                            </div>

                            <div class="flex items-center gap-2 text-xs text-[#718078]">
                                <svg class="w-4 h-4 text-[#2E7D32]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>Privasi finansial terlindungi sistem SSL NusaCandle.</span>
                            </div>

                            <button type="submit" class="w-full bg-[#8B1E1E] hover:bg-[#6B1515] text-white px-6 py-3 rounded-md font-semibold transition flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Konfirmasi Pembayaran
                            </button>
                        </form>
                    </div>
                </section>
                @endif
            </div>

            {{-- Garansi Kesegaran Atsiri --}}
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-[#E8F5E9] rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-[#2E7D32]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-serif text-lg font-bold text-[#2C1810] mb-2">Garansi Kesegaran Atsiri</h3>
                        <p class="text-sm text-[#718078] leading-relaxed">Lilin dikemas dengan lapisan kedap udara dan lilin kedelai organik murni langsung dari perkebunan apel Batu, Malang.</p>
                    </div>
                </div>
            </div>

            {{-- RIWAYAT TRANSAKSI --}}
            <section class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                    <div>
                        <h2 class="font-serif text-2xl font-bold text-[#2C1810]">Riwayat Transaksi</h2>
                        <p class="text-xs text-[#718078] mt-1">Semua catatan pembayaran pemesanan aroma apel NusaCandle.</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded-full">• {{ $totalBerhasil }} Berhasil</span>
                        <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-3 py-1 rounded-full">• {{ $totalMenunggu }} Menunggu Verifikasi</span>
                        <span class="bg-red-100 text-red-800 text-xs font-semibold px-3 py-1 rounded-full">• {{ $totalDibatalkan }} Dibatalkan</span>
                    </div>
                </div>

                <div class="divide-y divide-gray-100">
                    @forelse($riwayatTransaksi as $transaksi)
                    <div class="px-6 py-4 flex items-center gap-4 hover:bg-[#FAF9F6] transition">
                        {{-- Icon Status --}}
                        <div class="w-10 h-10 rounded-full {{ $transaksi->status_pembayaran === 'berhasil' ? 'bg-green-100' : 'bg-red-100' }} flex items-center justify-center flex-shrink-0">
                            @if($transaksi->status_pembayaran === 'berhasil')
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            @else
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            @endif
                        </div>

                        {{-- Info Transaksi --}}
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2 mb-1">
                                <p class="font-mono font-bold text-[#2C1810]">TRX-{{ str_pad($transaksi->id_transaksi, 5, '0', STR_PAD_LEFT) }}</p>
                                <span class="text-xs text-[#718078]">•</span>
                                <p class="text-xs text-[#718078]">#NC-{{ $transaksi->pesanan->created_at->format('Y') }}-{{ str_pad($transaksi->pesanan->id_pesanan, 4, '0', STR_PAD_LEFT) }}</p>
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-semibold {{ $transaksi->status_color }}">
                                    {{ $transaksi->status_label }}
                                </span>
                            </div>
                            <p class="text-sm text-[#2C1810] font-semibold truncate">
                                {{ $transaksi->pesanan->detailPesanan->first()?->produk->nama_produk ?? 'Produk' }} ({{ $transaksi->pesanan->detailPesanan->sum('jumlah') }} Pcs)
                            </p>
                            <p class="text-xs text-[#718078] mt-1">
                                Metode: {{ $transaksi->metode_label }} • {{ $transaksi->created_at->format('d M Y') }}
                            </p>
                        </div>

                        {{-- Total --}}
                        <div class="text-right flex-shrink-0">
                            <p class="text-xs text-[#718078] mb-1">{{ $transaksi->status_pembayaran === 'gagal' ? 'Nilai Tagihan' : 'Total Dibayar' }}</p>
                            <p class="font-serif text-lg font-bold {{ $transaksi->status_pembayaran === 'gagal' ? 'text-gray-400 line-through' : 'text-[#8B1E1E]' }}">
                                Rp{{ number_format($transaksi->pesanan->total_harga, 0, ',', '.') }}
                            </p>
                        </div>

                        {{-- Tombol --}}
                        <a href="{{ route('pembeli.transaksi.show', $transaksi->id_transaksi) }}" class="inline-flex items-center gap-1 bg-white border border-gray-200 hover:border-[#8B1E1E] text-[#2C1810] px-4 py-2 rounded-md text-xs font-semibold transition flex-shrink-0">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            Lihat Detail
                        </a>
                    </div>
                    @empty
                    <div class="px-6 py-12 text-center">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <p class="text-sm font-semibold text-[#2C1810] mb-1">Belum ada riwayat transaksi</p>
                        <p class="text-xs text-[#718078]">Transaksi yang sudah selesai akan muncul di sini.</p>
                    </div>
                    @endforelse
                </div>
            </section>
        </div>
    </div>

    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                alert('Nomor VA berhasil disalin!');
            });
        }

        function scrollToKonfirmasi() {
            document.getElementById('section-konfirmasi').scrollIntoView({ behavior: 'smooth', block: 'center' });
        }

        function showFileName(input) {
            const fileName = input.files[0]?.name;
            const fileNameElement = document.getElementById('file-name');
            if (fileName) {
                fileNameElement.textContent = 'File terpilih: ' + fileName;
                fileNameElement.classList.remove('hidden');
            }
        }
    </script>
@endsection