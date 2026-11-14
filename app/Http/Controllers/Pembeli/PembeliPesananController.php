<?php

namespace App\Http\Controllers\Pembeli;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pesanan;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\DetailPesanan;
use App\Models\Transaksi;
use App\Models\Keranjang;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;

class PembeliPesananController extends Controller
{
    public function index(Request $request): View
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $query = Pesanan::with(['detailPesanan.produk'])
            ->where('id_user', $user->id_user);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('id_pesanan', 'like', "%{$search}%");
        }

        $semuaPesanan = $query->orderBy('created_at', 'desc')->get();

        // Pisahkan pesanan aktif dan riwayat
        $pesananAktif = $semuaPesanan->filter(function ($p) {
            return !in_array($p->status_pesanan, ['selesai', 'dibatalkan']);
        });

        $riwayatPesanan = $semuaPesanan->filter(function ($p) {
            return $p->status_pesanan === 'selesai';
        });

        return view('pages.pembeli.pembeli_pesanan', compact(
            'pesananAktif',
            'riwayatPesanan'
        ));
    }

    public function reorder(int $id): \Illuminate\Http\RedirectResponse
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $pesanan = Pesanan::with('detailPesanan')
            ->where('id_pesanan', $id)
            ->where('id_user', $user->id_user)
            ->firstOrFail();

        // Tambahkan semua item dari pesanan lama ke keranjang
        foreach ($pesanan->detailPesanan as $detail) {
            $existing = Keranjang::where('id_user', $user->id_user)
                ->where('id_produk', $detail->id_produk)
                ->first();

            if ($existing) {
                $existing->increment('jumlah', $detail->jumlah);
            } else {
                Keranjang::create([
                    'id_user' => $user->id_user,
                    'id_produk' => $detail->id_produk,
                    'jumlah' => $detail->jumlah,
                ]);
            }
        }

        return redirect()->route('keranjang.index')->with('success', 'Produk dari pesanan sebelumnya berhasil ditambahkan ke keranjang.');
    }

    public function showCheckout(): View | RedirectResponse
    {
        $user = Auth::user();

        $keranjangItems = Keranjang::with('produk')
            ->where('id_user', $user->id_user)
            ->get();

        if ($keranjangItems->isEmpty()) {
            return redirect()->route('produk.index')
                ->withErrors(['checkout' => 'Keranjang Anda kosong.']);
        }

        // Hitung total
        $totalHargaProduk = 0;
        foreach ($keranjangItems as $item) {
            $totalHargaProduk += ($item->produk->harga * $item->jumlah);
        }

        $ongkir = 15000;
        $packaging = 5000;
        $totalBelanja = $totalHargaProduk + $ongkir + $packaging;

        return view('pages.pembeli.pembeli_checkout', compact(
            'keranjangItems',
            'totalHargaProduk',
            'ongkir',
            'packaging',
            'totalBelanja'
        ));
    }

    /**
     * Proses checkout setelah user pilih metode pembayaran
     */
    public function checkout(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'metode_pembayaran' => ['required', 'in:bca,mandiri,gopay,dana,shopeepay,cod'],
            'selected' => ['required', 'array', 'min:1'],          // ✅ wajib pilih min 1
            'selected.*' => ['integer', 'exists:keranjang,id_keranjang'],
        ]);

        $user = Auth::user();

        // ✅ Ambil HANYA item yang dicentang DAN milik user ini (aman dari manipulasi id)
        $keranjangItems = Keranjang::with('produk')
            ->where('id_user', $user->id_user)
            ->whereIn('id_keranjang', $validated['selected'])
            ->get();

        if ($keranjangItems->isEmpty()) {
            return back()->withErrors(['checkout' => 'Tidak ada item yang dipilih.']);
        }

        // ✅ VALIDASI STOK (hanya untuk item terpilih)
        foreach ($keranjangItems as $item) {
            if ($item->produk->stok < $item->jumlah) {
                return back()->withErrors([
                    'checkout' => "Stok {$item->produk->nama_produk} tidak mencukupi. Tersedia: {$item->produk->stok}, Diminta: {$item->jumlah}"
                ]);
            }
        }

        // Hitung total dari item terpilih saja
        $totalHargaProduk = 0;
        foreach ($keranjangItems as $item) {
            $totalHargaProduk += ($item->produk->harga * $item->jumlah);
        }

        $ongkir = 15000;
        $packaging = 5000;
        $totalBelanja = $totalHargaProduk + $ongkir + $packaging;

        DB::beginTransaction();
        try {
            $statusPesanan = $validated['metode_pembayaran'] === 'cod'
                ? 'diproses'
                : 'menunggu_pembayaran';

            $pesanan = Pesanan::create([
                'id_user' => $user->id_user,
                'total_harga' => $totalBelanja,
                'status_pesanan' => $statusPesanan,
            ]);

            foreach ($keranjangItems as $item) {
                DetailPesanan::create([
                    'id_pesanan' => $pesanan->id_pesanan,
                    'id_produk' => $item->id_produk,
                    'jumlah' => $item->jumlah,
                    'harga_satuan' => $item->produk->harga,
                ]);

                // Kurangi stok hanya untuk item terpilih
                $item->produk->decrement('stok', $item->jumlah);
            }

            Transaksi::create([
                'id_pesanan' => $pesanan->id_pesanan,
                'metode_pembayaran' => $validated['metode_pembayaran'],
                'status_pembayaran' => 'menunggu',
            ]);

            // ✅ HAPUS HANYA item yang dicentang — sisanya tetap di keranjang
            Keranjang::where('id_user', $user->id_user)
                ->whereIn('id_keranjang', $validated['selected'])
                ->delete();

            DB::commit();

            return redirect()->route('pembeli.pesanan.show', $pesanan->id_pesanan)
                ->with('success', $validated['metode_pembayaran'] === 'cod'
                    ? 'Pesanan COD berhasil dibuat! Pesanan akan segera diproses.'
                    : 'Pesanan berhasil dibuat! Silakan lakukan pembayaran.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['checkout' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function show(int $id): View
    {
        $user = Auth::user();

        $pesanan = Pesanan::with(['detailPesanan.produk', 'transaksi'])
            ->where('id_pesanan', $id)
            ->where('id_user', $user->id_user)
            ->firstOrFail();

        return view('pages.pembeli.pembeli_detail_pesanan', [
            'pesanan' => $pesanan,
            'isPreview' => false,
        ]);
    }

    public function preview(int $id): View
    {
        $previewOrders = [
            8841 => ['date' => '2024-10-24', 'status' => 'dikirim', 'label' => 'Dalam Perjalanan', 'color' => 'bg-[#e8f2e2] text-[#2E7D32]', 'quantity' => 2],
            8820 => ['date' => '2024-10-25', 'status' => 'diproses', 'label' => 'Sedang Diproses', 'color' => 'bg-[#f8e6e5] text-[#8B1E1E]', 'quantity' => 1],
            7102 => ['date' => '2024-09-12', 'status' => 'selesai', 'label' => 'Selesai', 'color' => 'bg-[#e8f2e2] text-[#2E7D32]', 'quantity' => 1],
            6510 => ['date' => '2024-08-08', 'status' => 'selesai', 'label' => 'Selesai', 'color' => 'bg-[#e8f2e2] text-[#2E7D32]', 'quantity' => 3],
        ];

        abort_unless(isset($previewOrders[$id]), 404);

        $preview = $previewOrders[$id];
        $produk = (object) [
            'nama_produk' => 'NusaCandle - Lilin Aroma Terapi Aroma Apel',
            'gambar' => null,
        ];
        $detail = (object) [
            'produk' => $produk,
            'jumlah' => $preview['quantity'],
            'harga_satuan' => 89000,
        ];
        $pesanan = (object) [
            'id_pesanan' => $id,
            'total_harga' => 89000 * $preview['quantity'],
            'status_pesanan' => $preview['status'],
            'status_label' => $preview['label'],
            'status_color' => $preview['color'],
            'created_at' => Carbon::parse($preview['date'])->locale('id'),
            'detailPesanan' => collect([$detail]),
            'transaksi' => collect(),
        ];

        return view('pages.pembeli.pembeli_detail_pesanan', [
            'pesanan' => $pesanan,
            'isPreview' => true,
        ]);
    }
}
