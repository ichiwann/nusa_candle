<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pembeli\HomeController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GiftController;
use App\Http\Controllers\Admin\AdminSettingsController;

// 1. HOME (Satu halaman buat semua orang)
Route::get('/', [HomeController::class, 'index'])->name('home');

// 2. GUEST (Hanya untuk yang belum login)
Route::middleware('guest')->group(function () {
    Route::redirect('/admin/login', '/login')->name('admin.login');
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
});

// 3. AUTH (Hanya untuk yang sudah login)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::get('/gifts', [GiftController::class, 'index'])->name('gifts.index');
    Route::post('/gifts', [GiftController::class, 'store'])->name('gifts.store');
    Route::put('/gifts/{gift}', [GiftController::class, 'update'])->name('gifts.update');
    Route::delete('/gifts/{gift}', [GiftController::class, 'destroy'])->name('gifts.destroy');
    Route::get('/settings', [AdminSettingsController::class, 'edit'])->name('settings.edit');
    Route::put('/settings/profile', [AdminSettingsController::class, 'updateProfile'])->name('settings.profile');
    Route::put('/settings/password', [AdminSettingsController::class, 'updatePassword'])->name('settings.password');
});

require __DIR__ . '/auth.php';