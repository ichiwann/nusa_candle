<?php

use Illuminate\Support\Facades\Route;

// --- Controllers ---
use App\Http\Controllers\Pembeli\HomeController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HadiahController;       // Nanti bisa diganti HadiahController
use App\Http\Controllers\Admin\AdminSettingsController;

/*
|--------------------------------------------------------------------------
| 1. PUBLIC & GUEST ROUTES
|--------------------------------------------------------------------------
*/
// Halaman Utama (Bisa diakses siapa saja)
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rute khusus tamu (belum login)
Route::middleware('guest')->group(function () {
    // Redirect jika ada yang nekat akses /admin/login
    Route::redirect('/admin/login', '/login')->name('admin.login');

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);

    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
});

/*
|--------------------------------------------------------------------------
| 2. AUTHENTICATED ROUTES (UMUM)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

/*
|--------------------------------------------------------------------------
| 3. ADMIN ROUTES (PROTECTED)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin']) // Pastikan middleware 'admin' sudah didaftarkan!
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Manajemen Hadiah (Gift)
        Route::get('/hadiah', [HadiahController::class, 'index'])->name('hadiah.index');
        Route::post('/hadiah', [HadiahController::class, 'store'])->name('hadiah.store');
        Route::put('/hadiah/{hadiah}', [HadiahController::class, 'update'])->name('hadiah.update');
        Route::delete('/hadiah/{hadiah}', [HadiahController::class, 'destroy'])->name('hadiah.destroy');

        // Pengaturan Admin
        Route::get('/settings', [AdminSettingsController::class, 'edit'])->name('settings.edit');
        Route::put('/settings/profile', [AdminSettingsController::class, 'updateProfile'])->name('settings.profile');
        Route::put('/settings/password', [AdminSettingsController::class, 'updatePassword'])->name('settings.password');

        // Manajemen Produk
        Route::get('/produk', [\App\Http\Controllers\Admin\ProdukController::class, 'index'])->name('products.index');
        Route::post('/produk', [\App\Http\Controllers\Admin\ProdukController::class, 'store'])->name('products.store');
        Route::put('/produk/{id}', [\App\Http\Controllers\Admin\ProdukController::class, 'update'])->name('products.update');
        Route::delete('/produk/{id}', [\App\Http\Controllers\Admin\ProdukController::class, 'destroy'])->name('products.destroy');

        // Manajemen Pesanan
        Route::get('/pesanan', [\App\Http\Controllers\Admin\PesananController::class, 'index'])->name('orders.index');
        Route::patch('/pesanan/{id}/status', [\App\Http\Controllers\Admin\PesananController::class, 'updateStatus'])->name('orders.updateStatus');

        // Manajemen Transaksi
        Route::get('/transaksi', [\App\Http\Controllers\Admin\TransaksiController::class, 'index'])->name('transactions.index');
        Route::patch('/transaksi/{id}/status', [\App\Http\Controllers\Admin\TransaksiController::class, 'updateStatus'])->name('transactions.updateStatus');
    });


require __DIR__ . '/auth.php';
