<?php

namespace App\Http\Controllers\Pembeli;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pesanan;
use App\Models\KodeRedeem;

class PoinController extends Controller
{
    /**
     * Tampilkan halaman poin dan loyalitas
     */
    public function index()
    {
        $user = Auth::user();

        $targetPoin = 70;
        $currentPoin = (int) $user->total_poin;
        $progressPercentage = min(100, ($currentPoin / $targetPoin) * 100);
        $kurangPoin = max(0, $targetPoin - $currentPoin);

        // Ambil riwayat perolehan poin
        $riwayatPoin = Pesanan::where('id_user', $user->id_user)
            ->where('status_pesanan', 'selesai')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get()
            ->map(function ($pesanan) {
                $poinDidapat = floor($pesanan->total_harga / 10000);
                return [
                    'tanggal' => $pesanan->created_at,
                    'keterangan' => 'Pembelian Pesanan #' . str_pad($pesanan->id_pesanan, 4, '0', STR_PAD_LEFT),
                    'total_pesanan' => 'Rp ' . number_format($pesanan->total_harga, 0, ',', '.'),
                    'poin' => $poinDidapat,
                    'status' => 'Selesai',
                    'type' => 'purchase',
                ];
            });

        // Bonus pendaftaran (contoh logic)
        if ($user->created_at->diffInDays(now()) <= 7) {
            $riwayatPoin->prepend([
                'tanggal' => $user->created_at,
                'keterangan' => 'Bonus Pendaftaran & Ulasan Bintang 5',
                'total_pesanan' => 'Rp 0',
                'poin' => 15,
                'status' => 'Bonus Diberikan',
                'type' => 'bonus',
            ]);
        }

        $membershipStatus = $this->getMembershipStatus($currentPoin);

        return view('pages.pembeli.poin', compact(
            'user',
            'currentPoin',
            'targetPoin',
            'progressPercentage',
            'kurangPoin',
            'membershipStatus',
            'riwayatPoin'
        ));
    }

    /**
     * Tukarkan redeem code
     */
    public function redeem(Request $request)
{
    /** @var \App\Models\User $user */ // ← TAMBAHKAN BARIS INI
    $user = Auth::user();
    
    $validated = $request->validate([
        'redeem_code' => ['required', 'string', 'max:32'],
    ]);

    $kodeRedeem = KodeRedeem::where('kode', strtoupper(trim($validated['redeem_code'])))->first();

    if (!$kodeRedeem) {
        return back()->withErrors(['redeem_code' => 'Kode redeem tidak ditemukan.']);
    }

    if ($kodeRedeem->status === 'terpakai') {
        return back()->withErrors(['redeem_code' => 'Kode redeem sudah pernah digunakan.']);
    }

    if (isset($kodeRedeem->berlaku_hingga) && $kodeRedeem->berlaku_hingga->isPast()) {
        return back()->withErrors(['redeem_code' => 'Kode redeem sudah kedaluwarsa.']);
    }

    // Proses penukaran - warning 'increment' akan hilang
    $user->increment('total_poin', $kodeRedeem->poin);
    
    $kodeRedeem->update([
        'status' => 'terpakai',
        'id_user' => $user->id_user,
        'dipakai_pada' => now(),
    ]);

    return back()->with('success', "Selamat! Anda mendapatkan {$kodeRedeem->poin} poin dari redeem code.");
}

    /**
     * Helper: Tentukan status keanggotaan
     */
    private function getMembershipStatus($poin)
    {
        if ($poin >= 200) {
            return ['label' => 'Pelanggan Setia NusaCandle', 'color' => 'text-purple-700', 'bg' => 'bg-purple-100'];
        } elseif ($poin >= 100) {
            return ['label' => 'Sahabat Nusa Gold', 'color' => 'text-yellow-700', 'bg' => 'bg-yellow-100'];
        } elseif ($poin >= 50) {
            return ['label' => 'Sahabat Nusa Silver', 'color' => 'text-gray-700', 'bg' => 'bg-gray-100'];
        }
        return ['label' => 'Pelanggan NusaCandle', 'color' => 'text-green-700', 'bg' => 'bg-green-100'];
    }

    /**
     * Klaim hadiah refill (tukar 70 poin)
     */
    public function claimHadiah()
{
    /** @var \App\Models\User $user */ // ← TAMBAHKAN BARIS INI
    $user = Auth::user();
    $targetPoin = 70;

    if ((int) $user->total_poin < $targetPoin) {
        return back()->withErrors(['claim' => 'Poin Anda belum mencukupi untuk klaim hadiah.']);
    }

    // Kurangi 70 poin dari user - warning 'decrement' akan hilang
    $user->decrement('total_poin', $targetPoin);

    return back()->with('success', "Selamat! Anda berhasil menukarkan {$targetPoin} poin dengan 1x Refill Lilin Aroma Terapi Aroma Apel Gratis. Hadiah akan dikirim ke alamat Anda.");
}
}
