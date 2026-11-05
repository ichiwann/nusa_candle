<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\KodeRedeem;
use Illuminate\Support\Str;

class KodeRedeemController extends Controller
{
    public function index(Request $request): View
    {
        $query = KodeRedeem::with('user');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('kode', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($q) use ($search) {
                      $q->where('nama_lengkap', 'like', "%{$search}%");
                  });
            });
        }

        // Filter Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Sort
        $sortBy = $request->get('sort', 'terbaru');
        match ($sortBy) {
            'terlama' => $query->orderBy('created_at', 'asc'),
            'poin_terendah' => $query->orderBy('poin', 'asc'),
            'poin_tertinggi' => $query->orderBy('poin', 'desc'),
            default => $query->orderBy('created_at', 'desc'),
        };

        $redeemCodes = $query->paginate(10)->withQueryString();

        // Statistik
        $totalKode = KodeRedeem::count();
        $tersedia = KodeRedeem::where('status', 'tersedia')->count();
        $terpakai = KodeRedeem::where('status', 'terpakai')->count();

        return view('pages.admin.kode_redeem', compact(
            'redeemCodes',
            'totalKode',
            'tersedia',
            'terpakai'
        ));
    }

    public function store(Request $request): RedirectResponse
    {
        $rules = [
            'mode' => ['required', 'in:manual,auto'],
            'poin' => ['required', 'integer', 'min:1'],
            'berlaku_hingga' => ['nullable', 'date', 'after:today'], // ← TAMBAHKAN VALIDASI INI
        ];

        if ($request->mode === 'manual') {
            $rules['kode_manual'] = ['required', 'string', 'max:32', 'unique:kode_redeem,kode'];
        } else {
            $rules['jumlah'] = ['required', 'integer', 'min:1', 'max:1000'];
        }

        $validated = $request->validate($rules);

        $createdCount = 0;

        // Siapkan data dasar (termasuk berlaku_hingga)
        $data = [
            'poin' => $validated['poin'],
            'status' => 'tersedia',
            'berlaku_hingga' => $validated['berlaku_hingga'] ?? null, // ← SIMPAN TANGGAL
        ];

        if ($validated['mode'] === 'manual') {
            $data['kode'] = strtoupper(trim($validated['kode_manual']));
            KodeRedeem::create($data);
            $createdCount = 1;
        } else {
            for ($i = 0; $i < $validated['jumlah']; $i++) {
                do {
                    $kode = strtoupper(Str::random(8));
                } while (KodeRedeem::where('kode', $kode)->exists());

                $data['kode'] = $kode;
                KodeRedeem::create($data);
                $createdCount++;
            }
        }

        return back()->with('success', "Berhasil membuat {$createdCount} kode redeem.");
    }
}
