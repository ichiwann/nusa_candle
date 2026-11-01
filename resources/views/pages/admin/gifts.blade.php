<x-admin.layout title="Kelola Hadiah">
    <div class="flex flex-wrap items-end justify-between gap-4">
        <div><p class="text-[9px] font-semibold uppercase tracking-[0.17em] text-[#64835d]">Program Loyalitas</p><h1 class="display-font mt-1 text-3xl font-semibold text-[#183b2c]">Kelola Hadiah</h1><p class="mt-2 max-w-xl text-sm text-[#718078]">Atur produk hadiah dan jumlah poin yang dibutuhkan untuk penukaran pelanggan.</p></div>
        <button type="button" @disabled($products->isEmpty()) onclick="document.getElementById('gift-form').classList.remove('hidden')" class="inline-flex items-center gap-2 bg-[#103a2a] px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-[#315d41] disabled:cursor-not-allowed disabled:opacity-50">＋ Tambah Hadiah</button>
    </div>

    <section class="grid gap-4 sm:grid-cols-2" aria-label="Ringkasan hadiah">
        <article class="flex items-center justify-between border border-[#e8eee8] bg-white p-5"><div><p class="text-[10px] font-semibold uppercase tracking-[0.13em] text-[#718078]">Stok Produk</p><p class="display-font mt-2 text-2xl font-semibold text-[#183b2c]">{{ number_format($products->sum('stok'), 0, ',', '.') }}</p><p class="mt-1 text-[11px] text-[#87948b]">unit tersedia di katalog</p></div><span class="flex h-10 w-10 items-center justify-center bg-[#edf6ee] text-[#315e43]">▧</span></article>
        <article class="flex items-center justify-between border border-[#e8eee8] bg-white p-5"><div><p class="text-[10px] font-semibold uppercase tracking-[0.13em] text-[#718078]">Program Hadiah</p><p class="display-font mt-2 text-2xl font-semibold text-[#183b2c]">{{ number_format($gifts->count(), 0, ',', '.') }}</p><p class="mt-1 text-[11px] text-[#87948b]">hadiah terdaftar</p></div><span class="flex h-10 w-10 items-center justify-center bg-[#edf6ee] text-[#315e43]">◇</span></article>
    </section>

    <section class="border border-[#e8eee8] bg-white">
        <div class="flex flex-wrap items-center justify-between gap-3 border-b border-[#edf0eb] px-5 py-4"><div><h2 class="display-font text-xl font-semibold">Daftar Hadiah</h2><p class="mt-1 text-xs text-[#7b887f]">{{ number_format($totalMembers, 0, ',', '.') }} anggota · {{ number_format($totalPoints, 0, ',', '.') }} poin beredar</p></div><span class="bg-[#eaf5ec] px-3 py-1.5 text-[10px] font-medium text-[#315e43]">Data katalog</span></div>
        @if (!$hasGiftsTable)
            <div class="m-5 border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-800">Tabel hadiah belum tersedia. Jalankan migrasi database sebelum mengelola hadiah.</div>
        @elseif ($products->isEmpty())
            <div class="px-5 py-12 text-center"><p class="text-sm font-semibold text-[#30483a]">Belum ada produk untuk dijadikan hadiah</p><p class="mt-1 text-xs text-[#87948b]">Tambahkan produk terlebih dahulu di menu Manajemen Produk.</p></div>
        @elseif ($gifts->isEmpty())
            <div class="px-5 py-12 text-center"><p class="text-sm font-semibold text-[#30483a]">Belum ada hadiah</p><p class="mt-1 text-xs text-[#87948b]">Tambahkan produk pertama ke program loyalitas.</p></div>
        @else
            <div class="overflow-x-auto"><table class="w-full min-w-[720px] text-left"><thead class="bg-[#f7faf7] text-[9px] uppercase tracking-[0.12em] text-[#718078]"><tr><th class="px-5 py-3 font-semibold">Produk hadiah</th><th class="px-5 py-3 font-semibold">Stok</th><th class="px-5 py-3 font-semibold">Harga</th><th class="px-5 py-3 font-semibold">Poin ditukar</th><th class="px-5 py-3 text-right font-semibold">Aksi</th></tr></thead><tbody class="divide-y divide-[#edf0eb]">
                @foreach ($gifts as $gift)
                    <tr class="text-xs"><td class="px-5 py-4"><span class="font-semibold text-[#30483a]">{{ $gift->nama_produk }}</span><span class="mt-1 block text-[10px] text-[#87948b]">Hadiah #{{ str_pad($gift->id_hadiah, 4, '0', STR_PAD_LEFT) }}</span></td><td class="px-5 py-4 text-[#52645a]">{{ number_format($gift->stok, 0, ',', '.') }} unit</td><td class="px-5 py-4 text-[#52645a]">Rp{{ number_format($gift->harga, 0, ',', '.') }}</td><td class="px-5 py-4"><span class="bg-[#eaf5ec] px-2.5 py-1.5 font-semibold text-[#315e43]">{{ number_format($gift->poin_dibutuhkan, 0, ',', '.') }} poin</span></td><td class="px-5 py-4"><div class="flex justify-end gap-2"><button type="button" onclick="editGift({{ $gift->id_hadiah }}, {{ $gift->id_produk }}, {{ $gift->poin_dibutuhkan }})" class="border border-[#dce7dc] px-3 py-1.5 text-[10px] font-medium text-[#315e43] hover:bg-[#f4faf4]">Ubah</button><form action="{{ route('admin.gifts.destroy', $gift->id_hadiah) }}" method="POST" onsubmit="return confirm('Hapus hadiah ini dari program loyalitas?')">@csrf @method('DELETE')<button class="border border-red-200 px-3 py-1.5 text-[10px] font-medium text-red-700 hover:bg-red-50">Hapus</button></form></div></td></tr>
                @endforeach
            </tbody></table></div>
        @endif
    </section>

    <div id="gift-form" class="{{ $errors->any() ? '' : 'hidden' }} fixed inset-0 z-50 flex items-center justify-center bg-[#0b251b]/50 p-4" role="dialog" aria-modal="true" aria-labelledby="gift-form-title">
        <div class="w-full max-w-lg border border-[#e8eee8] bg-white p-6 shadow-xl">
            <div class="mb-5 flex items-start justify-between gap-4"><div><p class="text-[9px] font-semibold uppercase tracking-[0.17em] text-[#64835d]">Program loyalitas</p><h2 id="gift-form-title" class="display-font mt-1 text-2xl font-semibold">Tambah Hadiah</h2></div><button type="button" onclick="closeGiftForm()" aria-label="Tutup" class="px-2 text-xl text-[#718078]">×</button></div>
            @if ($products->isEmpty())<p class="border border-amber-200 bg-amber-50 p-3 text-sm text-amber-800">Belum ada produk yang dapat dipilih. Tambahkan produk terlebih dahulu.</p>@else
                <form id="gift-form-element" action="{{ route('admin.gifts.store') }}" method="POST" class="space-y-4">@csrf
                    <div><label for="gift-product" class="mb-1.5 block text-xs font-semibold text-[#32483b]">Produk</label><select id="gift-product" name="id_produk" required class="w-full border border-[#dce7dc] bg-[#f7faf7] px-3 py-2.5 text-sm focus:border-[#315e43] focus:ring-[#315e43]/20"><option value="">Pilih produk</option>@foreach ($products as $product)<option value="{{ $product->id_produk }}" @selected(old('id_produk') == $product->id_produk)>{{ $product->nama_produk }} · stok {{ $product->stok }}</option>@endforeach</select></div>
                    <div><label for="gift-points" class="mb-1.5 block text-xs font-semibold text-[#32483b]">Poin yang dibutuhkan</label><input id="gift-points" type="number" name="poin_dibutuhkan" value="{{ old('poin_dibutuhkan') }}" min="1" max="100000000" required class="w-full border border-[#dce7dc] bg-[#f7faf7] px-3 py-2.5 text-sm focus:border-[#315e43] focus:ring-[#315e43]/20" placeholder="Contoh: 700"></div>
                    <div class="flex justify-end gap-2 border-t border-[#edf0eb] pt-4"><button type="button" onclick="closeGiftForm()" class="border border-[#dce7dc] px-4 py-2 text-sm text-[#52645a]">Batal</button><button type="submit" class="bg-[#103a2a] px-4 py-2 text-sm font-semibold text-white hover:bg-[#315d41]">Simpan Hadiah</button></div>
                </form>
            @endif
        </div>
    </div>

    <script>
        function closeGiftForm() { document.getElementById('gift-form').classList.add('hidden'); }
        function editGift(id, productId, points) {
            const form = document.getElementById('gift-form-element');
            form.action = `/admin/gifts/${id}`;
            if (!form.querySelector('[name="_method"]')) form.insertAdjacentHTML('beforeend', '<input type="hidden" name="_method" value="PUT">');
            form.querySelector('#gift-product').value = productId;
            form.querySelector('#gift-points').value = points;
            document.getElementById('gift-form-title').textContent = 'Ubah Hadiah';
            form.querySelector('button[type="submit"]').textContent = 'Simpan Perubahan';
            document.getElementById('gift-form').classList.remove('hidden');
        }
    </script>
</x-admin.layout>
