<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Pesanan;

class PesananController extends Controller
{
    public function index(Request $request): View
    {
        $query = Pesanan::with(['user', 'detailPesanan.produk', 'transaksi']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('id_pesanan', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($q) use ($search) {
                      $q->where('nama_lengkap', 'like', "%{$search}%")
                        ->orWhere('username', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->filled('status')) {
            $query->where('status_pesanan', $request->status);
        }

        $sortBy = $request->get('sort', 'terbaru');
        match ($sortBy) {
            'terlama' => $query->orderBy('created_at', 'asc'),
            'total_terendah' => $query->orderBy('total_harga', 'asc'),
            'total_tertinggi' => $query->orderBy('total_harga', 'desc'),
            default => $query->orderBy('created_at', 'desc'),
        };

        $pesanans = $query->paginate(10)->withQueryString();

        $totalPesanan = Pesanan::count();
        $menunggu = Pesanan::where('status_pesanan', 'menunggu_pembayaran')->count();
        $diproses = Pesanan::where('status_pesanan', 'diproses')->count();
        $dikirim = Pesanan::where('status_pesanan', 'dikirim')->count();
        $selesai = Pesanan::where('status_pesanan', 'selesai')->count();
        $dibatalkan = Pesanan::where('status_pesanan', 'dibatalkan')->count();

        return view('pages.admin.pesanan', compact(
            'pesanans', 'totalPesanan', 'menunggu', 'diproses', 'dikirim', 'selesai', 'dibatalkan'
        ));
    }

    public function updateStatus(Request $request, int $id): RedirectResponse
    {
        $validated = $request->validate([
            // ✅ Admin hanya boleh sampai "dikirim".
            // "selesai" hanya via konfirmasi pembeli atau halaman Transaksi.
            'status_pesanan' => ['required', 'in:menunggu_pembayaran,diproses,dikirim'],
        ]);

        $pesanan = Pesanan::findOrFail($id);

        if (in_array($pesanan->status_pesanan, ['selesai', 'dibatalkan'])) {
            return back()->withErrors(['status_pesanan' => 'Pesanan yang sudah selesai/dibatalkan tidak dapat diubah.']);
        }

        $pesanan->update($validated);

        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }
}