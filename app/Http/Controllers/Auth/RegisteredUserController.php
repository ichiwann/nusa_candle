<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:100', 'regex:/^[\p{L}\p{M}][\p{L}\p{M}\s.\'-]*$/u'],
            'username' => ['required', 'string', 'min:3', 'max:30', 'regex:/^[A-Za-z0-9._-]+$/', 'unique:user,username'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:100', 'unique:user,email'],
            'alamat' => ['required', 'string', 'min:10', 'max:500'],
            'no_telepon' => ['required', 'string', 'regex:/^[0-9]+$/', 'digits_between:10,15'],
            'password' => ['required', Rules\Password::defaults()],
            'password_confirmation' => ['required', 'same:password'],
            'terms' => ['accepted'],
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'nama_lengkap.regex' => 'Nama lengkap hanya boleh berisi huruf, spasi, titik, tanda hubung, atau apostrof.',
            'username.required' => 'Username wajib diisi.',
            'username.min' => 'Username minimal 3 karakter.',
            'username.max' => 'Username maksimal 30 karakter.',
            'username.regex' => 'Username hanya boleh berisi huruf, angka, titik, garis bawah, dan tanda hubung.',
            'username.unique' => 'Username sudah digunakan.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Masukkan alamat email yang valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'alamat.required' => 'Alamat wajib diisi.',
            'alamat.min' => 'Alamat minimal 10 karakter.',
            'alamat.max' => 'Alamat maksimal 500 karakter.',
            'no_telepon.required' => 'Nomor telepon wajib diisi.',
            'no_telepon.regex' => 'Nomor telepon hanya boleh berisi angka.',
            'no_telepon.digits_between' => 'Nomor telepon harus terdiri dari 10 sampai 15 angka.',
            'password.required' => 'Password wajib diisi.',
            'password_confirmation.required' => 'Konfirmasi password wajib diisi.',
            'password_confirmation.same' => 'Konfirmasi password harus sama dengan password.',
            'terms.accepted' => 'Persetujuan wajib dicentang sebelum mendaftar.',
        ]);

        $user = User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'username' => $request->username,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'no_telepon' => $request->no_telepon, // ← TAMBAHKAN
            'password' => Hash::make($request->password),
            'role' => 'pembeli',
            'total_poin' => 0,
        ]);


        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan masuk dengan akun Anda.');
    }
}