@extends('layouts.pembeli')

@section('title', 'Keranjang Belanja Anda - NusaCandle')

@section('content')
    {{-- Breadcrumb --}}
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center gap-2 text-sm">
                <a href="{{ route('home') }}" class="text-[#718078] hover:text-[#8B1E1E]">Beranda</a>
                <span class="text-[#718078]">/</span>
                <span class="text-[#8B1E1E] font-semibold">Keranjang Belanja Anda</span>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Header --}}
        <div class="mb-8">
            <p class="text-xs font-semibold uppercase tracking-wider text-[#2E7D32] mb-2">🕯️ Artisan Botanical Apothecary</p>
            <h1 class="font-serif text-4xl font-bold text-[#2C1810] mb-2">Keranjang Belanja Anda</h1>
            <p class="text-[#718078]">Periksa kembali pilihan lilin aromaterapi apel Malang sebelum melanjutkan pemesanan.</p>
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

        {{-- Banner Gratis Ongkir --}}
        <div class="bg-gradient-to-r from-[#E8F5E9] to-[#C8E6C9] rounded-lg p-4 mb-6 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <svg class="w-8 h-8 text-[#2E7D32]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                </svg>
                <div>
                    <p class="font-semibold text-[#1B5E20]">Bebas Biaya Kirim Se-Jawa Timur</p>
                    <p class="text-xs text-[#2E7D32]">Minimal pembelian Rp150.000 untuk toples lilin keramik aroma apel khas Batu Malang.</p>
                </div>
            </div>
            <span class="bg-[#8B1E1E] text-white text-xs font-semibold px-3 py-1 rounded">VOUCHER AKTIF</span>
        </div>

        <div class="grid lg:grid-cols-3 gap-6">
            {{-- Daftar Produk di Keranjang --}}
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="font-serif text-xl font-bold text-[#2C1810]">Pilih Semua ({{ $totalItem }} Produk)</h2>
                        @if($keranjang->count() > 0)
                            <form action="{{ route('keranjang.clear') }}" method="POST" onsubmit="return confirm('Kosongkan semua keranjang?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs text-[#8B1E1E] hover:text-[#6B1515] font-semibold">Hapus Semua</button>
                            </form>
                        @endif
                    </div>

                    @forelse($keranjang as $item)
                    <div class="border-b border-gray-200 pb-6 mb-6 last:border-0 last:pb-0 last:mb-0">
                        <div class="flex gap-4">
                            {{-- Gambar Produk --}}
                            <div class="flex-shrink-0">
                                @if($item->produk->gambar)
                                    <img src="{{ asset('storage/' . $item->produk->gambar) }}" alt="{{ $item->produk->nama_produk }}" class="w-24 h-24 object-cover rounded-lg">
                                @else
                                    <div class="w-24 h-24 bg-gray-200 rounded-lg flex items-center justify-center">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            {{-- Info Produk --}}
                            <div class="flex-1">
                                <div class="flex items-start justify-between mb-2">
                                    <div>
                                        <span class="bg-[#FCE4EC] text-[#8B1E1E] text-[10px] font-semibold px-2 py-0.5 rounded">Khas Malang</span>
                                        <h3 class="font-serif text-lg font-bold text-[#2C1810] mt-1">{{ $item->produk->nama_produk }}</h3>
                                        <p class="text-xs text-[#718078]">Varian: Apel Manalagi 220g • Grade C1</p>
                                    </div>
                                    <form action="{{ route('keranjang.destroy', $item->id_keranjang) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-gray-400 hover:text-red-600 transition">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>

                                <div class="flex items-end justify-between mt-4">
                                    <div>
                                        <p class="text-xs text-[#718078] mb-1">Harga Satuan</p>
                                        <p class="font-semibold text-[#2C1810]">Rp {{ number_format($item->produk->harga, 0, ',', '.') }}</p>
                                    </div>

                                    {{-- Quantity --}}
                                    <form action="{{ route('keranjang.update', $item->id_keranjang) }}" method="POST" class="flex items-center gap-2">
                                        @csrf
                                        @method('PUT')
                                        <button type="button" onclick="updateQty({{ $item->id_keranjang }}, {{ $item->jumlah - 1 }})" 
                                            class="w-8 h-8 border border-gray-200 rounded hover:bg-gray-100 transition" {{ $item->jumlah <= 1 ? 'disabled' : '' }}>
                                            -
                                        </button>
                                        <input type="number" name="jumlah" value="{{ $item->jumlah }}" min="1" max="{{ $item->produk->stok }}" 
                                            class="w-12 text-center border border-gray-200 rounded py-1 text-sm font-semibold" 
                                            onchange="this.form.submit()">
                                        <button type="button" onclick="updateQty({{ $item->id_keranjang }}, {{ $item->jumlah + 1 }})" 
                                            class="w-8 h-8 border border-gray-200 rounded hover:bg-gray-100 transition" {{ $item->jumlah >= $item->produk->stok ? 'disabled' : '' }}>
                                            +
                                        </button>
                                    </form>

                                    <div class="text-right">
                                        <p class="text-xs text-[#718078] mb-1">Subtotal</p>
                                        <p class="font-bold text-[#8B1E1E]">Rp {{ number_format($item->produk->harga * $item->jumlah, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-12">
                        <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <p class="text-lg font-semibold text-[#2C1810] mb-2">Keranjang Anda Kosong</p>
                        <p class="text-sm text-[#718078] mb-6">Mulai belanja untuk menambahkan produk ke keranjang.</p>
                        <a href="{{ route('produk.index') }}" class="bg-[#8B1E1E] hover:bg-[#6B1515] text-white px-6 py-3 rounded-md font-semibold transition inline-block">
                            Belanja Sekarang
                        </a>
                    </div>
                    @endforelse
                </div>

                {{-- Sentuhan Tangan Pengrajin --}}
                <div class="mt-6 bg-[#FAF9F6] border border-gray-200 rounded-lg p-6">
                    <h3 class="font-serif text-lg font-bold text-[#2C1810] mb-2">Sentuhan Tangan Pengrajin Khas Apel</h3>
                    <p class="text-sm text-[#718078] leading-relaxed">
                        Lilin Anda dibuat perlahan menggunakan minyak atsiri murni dari perkebunan lokal (Batu). Ramah lingkungan, tidak ada jelaga hitam.
                    </p>
                </div>
            </div>

            {{-- Ringkasan Belanja --}}
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 sticky top-24">
                    <h2 class="font-serif text-xl font-bold text-[#2C1810] mb-6">Ringkasan Belanja</h2>

                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between text-sm">
                            <span class="text-[#718078]">Total Harga ({{ $totalItem }} item)</span>
                            <span class="font-semibold text-[#2C1810]">Rp {{ number_format($totalHarga, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-[#718078]">Ongkos Kirim (Malang & Sekitarnya)</span>
                            <span class="font-semibold text-[#2C1810]">Rp {{ number_format($ongkir, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-[#718078]">Packaging Kayu & Bubble Guard</span>
                            <span class="font-semibold text-[#2C1810]">Rp {{ number_format($packaging, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-[#718078]">Potongan Harga</span>
                            <span class="font-semibold text-[#2E7D32]">-Rp 0</span>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 pt-4 mb-6">
                        <div class="flex justify-between items-baseline">
                            <span class="text-sm text-[#718078]">Total Belanja</span>
                            <div class="text-right">
                                <p class="font-serif text-3xl font-bold text-[#8B1E1E]">Rp {{ number_format($totalBelanja, 0, ',', '.') }}</p>
                                <p class="text-xs text-[#718078]">Termasuk PPN & biaya lokal</p>
                            </div>
                        </div>
                    </div>

                    <button class="w-full bg-[#8B1E1E] hover:bg-[#6B1515] text-white px-6 py-3 rounded-md font-semibold transition flex items-center justify-center gap-2 mb-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                        Checkout Sekarang
                    </button>

                    <a href="{{ route('produk.index') }}" class="w-full border border-gray-200 hover:border-[#8B1E1E] text-[#718078] hover:text-[#8B1E1E] px-6 py-3 rounded-md font-semibold transition flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Lanjut Belanja
                    </a>

                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <div class="flex items-center gap-3 text-xs text-[#718078]">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-[#2E7D32]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                                </svg>
                                <span>Antar ke Alamat</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-[#2E7D32]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>100% Aman</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateQty(id, qty) {
            if (qty < 1) return;
            
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/keranjang/${id}`;
            
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = csrfToken;
            form.appendChild(csrfInput);
            
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'PUT';
            form.appendChild(methodInput);
            
            const qtyInput = document.createElement('input');
            qtyInput.type = 'hidden';
            qtyInput.name = 'jumlah';
            qtyInput.value = qty;
            form.appendChild(qtyInput);
            
            document.body.appendChild(form);
            form.submit();
        }
    </script>
@endsection