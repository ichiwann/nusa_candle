<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\Transaksi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class TransaksiController extends Controller
{
    public function index(Request $request): View
    {
        $query = Transaksi::with(['pesanan.user', 'pesanan.detailPesanan.produk']);

        if ($request->filled('search')) {
            $search = $request->search;
            $transactionId = preg_match('/^TRX-0*(\d+)$/i', $search, $transactionMatches)
                ? (int) $transactionMatches[1]
                : null;
            $orderId = preg_match('/^(?:#?NC-ORD-)?(?:\d{4}-)?(\d+)$/i', $search, $orderMatches)
                ? (int) $orderMatches[1]
                : null;

            $query->where(function ($q) use ($search, $transactionId, $orderId) {
                $q->where('id_transaksi', 'like', "%{$search}%")
                    ->orWhere('id_pesanan', 'like', "%{$search}%")
                    ->orWhereHas('pesanan.user', function ($q) use ($search) {
                        $q->where('nama_lengkap', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });

                if ($transactionId !== null) {
                    $q->orWhere('id_transaksi', $transactionId);
                }

                if ($orderId !== null) {
                    $q->orWhere('id_pesanan', $orderId);
                }
            });
        }

        if ($request->filled('status')) {
            $query->where('status_pembayaran', $request->status);
        }

        if ($request->filled('metode')) {
            $query->where('metode_pembayaran', $request->metode);
        }

        $sortBy = $request->get('sort', 'terbaru');
        match ($sortBy) {
            'terlama' => $query->orderBy('created_at', 'asc'),
            default => $query->orderBy('created_at', 'desc'),
        };

        $transaksis = $query->paginate(10)->withQueryString();

        $totalPendapatan = Pesanan::whereHas('transaksi', function ($q) {
            $q->where('status_pembayaran', 'berhasil');
        })->sum('total_harga');

        return view('pages.admin.transaksi', compact(
            'transaksis', 'totalPendapatan'
        ));
    }

    public function updateStatus(Request $request, int $id): RedirectResponse
    {
        $validated = $request->validate([
            'status_pembayaran' => ['required', 'in:menunggu,berhasil,gagal'],
            'catatan_admin' => ['nullable', 'string', 'max:5000'],
            // ✅ Opsional: admin boleh set status pesanan sampai "selesai" dari detail transaksi
            'status_pesanan' => ['nullable', 'in:menunggu_pembayaran,diproses,dikirim,selesai'],
        ]);

        $transaksi = Transaksi::with('pesanan')->findOrFail($id);
        $pesanan = $transaksi->pesanan;

        DB::beginTransaction();
        try {
            $transaksi->update([
                'status_pembayaran' => $validated['status_pembayaran'],
                'catatan_admin' => $validated['catatan_admin'] ?? null,
            ]);

            // Verifikasi berhasil → otomatis diproses (hanya jika masih menunggu pembayaran)
            if ($validated['status_pembayaran'] === 'berhasil' && $pesanan->status_pesanan === 'menunggu_pembayaran') {
                $pesanan->update(['status_pesanan' => 'diproses']);
            }

            // ✅ Update status pesanan manual (sampai selesai) jika dipilih
            if (! empty($validated['status_pesanan'])) {
                $pesanan->update(['status_pesanan' => $validated['status_pesanan']]);

                // COD diselesaikan admin → pembayaran otomatis lunas
                if ($validated['status_pesanan'] === 'selesai' && $transaksi->metode_pembayaran === 'cod') {
                    $transaksi->update(['status_pembayaran' => 'berhasil']);
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withErrors(['status' => 'Terjadi kesalahan: '.$e->getMessage()]);
        }

        return back()->with('success', 'Status pembayaran berhasil diperbarui.');
    }
}
