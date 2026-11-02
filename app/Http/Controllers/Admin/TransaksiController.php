<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Transaksi;
use App\Models\Pesanan;

class TransaksiController extends Controller
{
     public function index(Request $request): View
    {
        $query = Transaksi::with(['pesanan.user']);

        // Search
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

        // Filter Status
        if ($request->filled('status')) {
            $query->where('status_pembayaran', $request->status);
        }

        // Filter Metode
        if ($request->filled('metode')) {
            $query->where('metode_pembayaran', $request->metode);
        }

        // Sort (HANYA BERDASARKAN WAKTU, karena kolom 'total' tidak ada di tabel transaksi)
        $sortBy = $request->get('sort', 'terbaru');
        match ($sortBy) {
            'terlama' => $query->orderBy('created_at', 'asc'),
            default => $query->orderBy('created_at', 'desc'),
        };

        $transaksis = $query->paginate(10)->withQueryString();

        // 🔥 PERBAIKAN STATISTIK DI SINI 🔥
        $totalTransaksi = Transaksi::count();
        
        // Hitung total pendapatan dari pesanan yang transaksinya BERHASIL
        $totalPendapatan = Pesanan::whereHas('transaksi', function ($q) {
            $q->where('status_pembayaran', 'berhasil');
        })->sum('total_harga');
        
        // Total terjual (pesanan yang sudah selesai)
        $totalTerjual = Pesanan::where('status_pesanan', 'selesai')->count();

        return view('pages.admin.transaksi', compact(
            'transaksis',
            'totalTransaksi',
            'totalPendapatan',
            'totalTerjual'
        ));
    }

    public function updateStatus(Request $request, int $id): RedirectResponse
    {
        $validated = $request->validate([
            'status_pembayaran' => ['required', 'in:menunggu,berhasil,gagal'],
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update($validated);

        // Jika berhasil, update status pesanan jadi 'diproses'
        if ($validated['status_pembayaran'] === 'berhasil') {
            $transaksi->pesanan->update(['status_pesanan' => 'diproses']);
        }

        return back()->with('success', 'Status transaksi berhasil diperbarui.');
    }
}
