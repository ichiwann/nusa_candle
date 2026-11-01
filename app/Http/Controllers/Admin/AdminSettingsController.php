<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class AdminSettingsController extends Controller
{
    public function edit(Request $request): View
    {
        return view('pages.admin.settings', [
            'admin' => $request->user(),
        ]);
    }

    public function updateProfile(Request $request): RedirectResponse
    {
        $admin = $request->user();
        $validated = $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:100'],
            'username' => ['required', 'string', 'min:3', 'max:100', Rule::unique('user', 'username')->ignore($admin->id_user, 'id_user')],
            'email' => ['required', 'email', 'max:100', Rule::unique('user', 'email')->ignore($admin->id_user, 'id_user')],
            'no_telepon' => ['nullable', 'string', 'regex:/^[0-9]{10,15}$/'],
        ], [
            'username.unique' => 'Username sudah digunakan.',
            'email.email' => 'Masukkan alamat email yang valid.',
            'email.unique' => 'Email sudah digunakan.',
            'no_telepon.regex' => 'Nomor telepon harus terdiri dari 10 sampai 15 angka.',
        ]);

        $admin->update($validated);

        return back()->with('success', 'Profil admin berhasil diperbarui.');
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ], [
            'current_password.current_password' => 'Password saat ini tidak sesuai.',
            'password.confirmed' => 'Konfirmasi password baru tidak sama.',
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('success', 'Password admin berhasil diperbarui.');
    }
}
