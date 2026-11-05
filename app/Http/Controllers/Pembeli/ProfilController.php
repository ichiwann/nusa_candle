<?php

namespace App\Http\Controllers\Pembeli;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfilController extends Controller
{
    /**
     * Tampilkan halaman profil
     */
    public function index()
    {
        $user = Auth::user();
        
        // Tentukan status keanggotaan berdasarkan total poin
        $membershipStatus = $this->getMembershipStatus($user->total_poin);
        
        return view('pages.pembeli.profil', compact('user', 'membershipStatus'));
    }

    /**
     * Update data diri
     */
    public function updateProfile(Request $request)
    {
         /** @var \App\Models\User $user */ // ← TAMBAHKAN BARIS INI
        $user = Auth::user();
        
        $validated = $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:100', 'unique:user,email,' . $user->id_user . ',id_user'],
            'no_telepon' => ['required', 'string', 'max:20'],
            'alamat' => ['required', 'string'],
        ]);

        $user->update($validated);

        return back()->with('success', 'Data diri berhasil diperbarui.');
    }

    /**
     * Update password
     */
    public function updatePassword(Request $request)
    {
         /** @var \App\Models\User $user */ // ← TAMBAHKAN BARIS INI
        $user = Auth::user();
        
        $validated = $request->validate([
            'password_lama' => ['required'],
            'password_baru' => ['required', 'confirmed', Password::min(8)],
        ]);

        // Verifikasi password lama
        if (!Hash::check($validated['password_lama'], $user->password)) {
            return back()->withErrors(['password_lama' => 'Password lama tidak sesuai.']);
        }

        // Update password baru
        $user->update([
            'password' => Hash::make($validated['password_baru']),
        ]);

        return back()->with('success', 'Password berhasil diperbarui.');
    }

    /**
     * Tentukan status keanggotaan berdasarkan poin
     */
    private function getMembershipStatus($poin)
    {
        if ($poin >= 200) {
            return [
                'label' => 'Sahabat Nusa Premium',
                'color' => 'text-purple-700',
                'bg' => 'bg-purple-100',
            ];
        } elseif ($poin >= 100) {
            return [
                'label' => 'Sahabat Nusa Gold',
                'color' => 'text-yellow-700',
                'bg' => 'bg-yellow-100',
            ];
        } elseif ($poin >= 50) {
            return [
                'label' => 'Sahabat Nusa Silver',
                'color' => 'text-gray-700',
                'bg' => 'bg-gray-100',
            ];
        } else {
            return [
                'label' => 'Sahabat Nusa',
                'color' => 'text-green-700',
                'bg' => 'bg-green-100',
            ];
        }
    }
}
