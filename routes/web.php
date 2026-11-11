<?php

use Illuminate\Support\Facades\Route;

// --- Controllers ---
use App\Http\Controllers\Pembeli\HomeController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HadiahController;       // Nanti bisa diganti HadiahController
use App\Http\Controllers\Admin\AdminSettingsController;
use App\Http\Controllers\Admin\KodeRedeemController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\PesananController;
use App\Http\Controllers\Admin\TransaksiController;
use App\Http\Controllers\Pembeli\ProfilController;
use App\Http\Controllers\Pembeli\PoinController;
use App\Http\Controllers\Pembeli\PembeliProdukController;
use App\Http\Controllers\Pembeli\KeranjangController;
use App\Http\Controllers\Pembeli\PembeliPesananController;
use App\Http\Controllers\Pembeli\PembeliTransaksiController;

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
        Route::post('/hadiah/{id}/approve', [HadiahController::class, 'approve'])->name('hadiah.approve');
        Route::post('/hadiah/{id}/reject', [HadiahController::class, 'reject'])->name('hadiah.reject');

        // Pengaturan Admin
        Route::get('/settings', [AdminSettingsController::class, 'edit'])->name('settings.edit');
        Route::put('/settings/profile', [AdminSettingsController::class, 'updateProfile'])->name('settings.profile');
        Route::put('/settings/password', [AdminSettingsController::class, 'updatePassword'])->name('settings.password');

        // Manajemen Produk
        Route::get('/produk', [ProdukController::class, 'index'])->name('products.index');
        Route::post('/produk', [ProdukController::class, 'store'])->name('products.store');
        Route::put('/produk/{id}', [ProdukController::class, 'update'])->name('products.update');
        Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->name('products.destroy');

        // Manajemen Pesanan
        Route::get('/pesanan', [PesananController::class, 'index'])->name('orders.index');
        Route::patch('/pesanan/{id}/status', [PesananController::class, 'updateStatus'])->name('orders.updateStatus');

        // Manajemen Transaksi
        Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transactions.index');
        Route::patch('/transaksi/{id}/status', [TransaksiController::class, 'updateStatus'])->name('transactions.updateStatus');

        // Redeem Code
        Route::get('/kode-redeem', [KodeRedeemController::class, 'index'])->name('kodeRedeem.index');
        Route::post('/kode-redeem', [KodeRedeemController::class, 'store'])->name('kodeRedeem.store');
        Route::delete('/kode-redeem/{id}', [KodeRedeemController::class, 'destroy'])->name('kodeRedeem.destroy');
    });

// Routes untuk Pembeli (perlu login)
Route::middleware(['auth'])->group(function () {
    Route::get('/profil', [ProfilController::class, 'index'])->name('profil.index');
    Route::put('/profil/update', [ProfilController::class, 'updateProfile'])->name('profil.update');
    Route::put('/profil/password', [ProfilController::class, 'updatePassword'])->name('profil.password');

    // --- ROUTE POIN ---
    Route::get('/poin-saya', [PoinController::class, 'index'])->name('poin.index'); // ← GANTI INI
    Route::post('/poin-saya/redeem', [PoinController::class, 'redeem'])->name('poin.redeem'); // ← GANTI INI
    Route::post('/poin-saya/klaim-hadiah', [PoinController::class, 'claimHadiah'])->name('poin.klaim'); // ← GANTI INI

    // halaman produk untuk pembeli
    Route::get('/produk', [PembeliProdukController::class, 'index'])->name('produk.index');
    Route::get('/produk/{id}', [PembeliProdukController::class, 'show'])->name('produk.show');

    // Keranjang (perlu login)
    Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
    Route::post('/keranjang', [KeranjangController::class, 'store'])->name('keranjang.store');
    Route::put('/keranjang/{id}', [KeranjangController::class, 'update'])->name('keranjang.update');
    Route::delete('/keranjang/{id}', [KeranjangController::class, 'destroy'])->name('keranjang.destroy');
    Route::delete('/keranjang', [KeranjangController::class, 'clear'])->name('keranjang.clear');

    // Di dalam Route::middleware(['auth'])->group(...)
    Route::get('/pesanan', [PembeliPesananController::class, 'index'])->name('pembeli.pesanan.index');
    Route::get('/pesanan/{id}', [PembeliPesananController::class, 'show'])->name('pembeli.pesanan.show');
    Route::post('/pesanan/{id}/reorder', [PembeliPesananController::class, 'reorder'])->name('pembeli.pesanan.reorder');
    // Halaman checkout (pilih metode pembayaran)
    Route::get('/checkout', [PembeliPesananController::class, 'showCheckout'])->name('pembeli.checkout.show');
    // Proses checkout setelah pilih metode
    Route::post('/checkout', [PembeliPesananController::class, 'checkout'])->name('pembeli.checkout.store');


    // Di dalam Route::middleware(['auth'])->group(...)
    Route::get('/transaksi', [PembeliTransaksiController::class, 'index'])->name('pembeli.transaksi.index');
    Route::post('/transaksi/konfirmasi', [PembeliTransaksiController::class, 'store'])->name('pembeli.transaksi.store');
    Route::get('/transaksi/{id}', [PembeliTransaksiController::class, 'show'])->name('pembeli.transaksi.show');
});


require __DIR__ . '/auth.php';
