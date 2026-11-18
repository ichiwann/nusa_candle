<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Transaksi;
use App\Models\Pesanan;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index(Request $request): View
    {
        $query = Transaksi::with(['pesanan.user']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('id_transaksi', 'like', "%{$search}%")
                  ->orWhereHas('pesanan.user', function ($q) use ($search) {
                      $q->where('nama_lengkap', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                  });
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

        $totalTransaksi = Transaksi::count();
        $totalPendapatan = Pesanan::whereHas('transaksi', function ($q) {
            $q->where('status_pembayaran', 'berhasil');
        })->sum('total_harga');
        $totalTerjual = Pesanan::where('status_pesanan', 'selesai')->count();

        return view('pages.admin.transaksi', compact(
            'transaksis', 'totalTransaksi', 'totalPendapatan', 'totalTerjual'
        ));
    }

    public function updateStatus(Request $request, int $id): RedirectResponse
    {
        $validated = $request->validate([
            'status_pembayaran' => ['required', 'in:menunggu,berhasil,gagal'],
            // ✅ Opsional: admin boleh set status pesanan sampai "selesai" dari detail transaksi
            'status_pesanan' => ['nullable', 'in:menunggu_pembayaran,diproses,dikirim,selesai'],
        ]);

        $transaksi = Transaksi::with('pesanan')->findOrFail($id);
        $pesanan = $transaksi->pesanan;

        DB::beginTransaction();
        try {
            $transaksi->update(['status_pembayaran' => $validated['status_pembayaran']]);

            // Verifikasi berhasil → otomatis diproses (hanya jika masih menunggu pembayaran)
            if ($validated['status_pembayaran'] === 'berhasil' && $pesanan->status_pesanan === 'menunggu_pembayaran') {
                $pesanan->update(['status_pesanan' => 'diproses']);
            }

            // ✅ Update status pesanan manual (sampai selesai) jika dipilih
            if (!empty($validated['status_pesanan'])) {
                $pesanan->update(['status_pesanan' => $validated['status_pesanan']]);

                // COD diselesaikan admin → pembayaran otomatis lunas
                if ($validated['status_pesanan'] === 'selesai' && $transaksi->metode_pembayaran === 'cod') {
                    $transaksi->update(['status_pembayaran' => 'berhasil']);
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['status' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }

        return back()->with('success', 'Status transaksi berhasil diperbarui.');
    }
}