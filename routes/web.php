<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProdukController;
use App\Http\Controllers\Admin\AdminKeranjangController;
use App\Http\Controllers\Admin\AdminPembayaranController;
use App\Http\Controllers\Admin\AdminPengirimanController;
use App\Http\Controllers\Admin\AdminPesananController;
use App\Http\Controllers\Admin\AdminReviewController;
use App\Http\Controllers\Admin\AdminUsersController;
use App\Http\Controllers\Admin\AdminDetailPesananController;
use Illuminate\Support\Facades\Route;

// ===================================================
// HALAMAN PUBLIK
// ===================================================
Route::get('/',       fn() => view('home'))->name('home');
Route::get('/about',  fn() => view('about'))->name('about');
Route::get('/kontak', fn() => view('kontak'))->name('kontak');

Route::get('/produk',      [ProdukController::class, 'index'])->name('produk.index');
Route::get('/produk/{id}', [ProdukController::class, 'show'])->name('produk.show');

// ===================================================
// AUTH — dari Breeze
// ===================================================
require __DIR__.'/auth.php';

// ===================================================
// HALAMAN BUTUH LOGIN (user biasa)
// ===================================================
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
    Route::get('/profile',    [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',  [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ===================================================
// ADMIN
// ===================================================
Route::prefix('admin')->name('admin.')->group(function () {

    // Dashboard Admin ← TAMBAHAN BARU
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Produk
    Route::resource('produk',         AdminProdukController::class);

    // Pesanan & Detail
    Route::resource('pesanan',        AdminPesananController::class);
    Route::resource('detail-pesanan', AdminDetailPesananController::class);

    // Pembayaran
    Route::resource('pembayaran',     AdminPembayaranController::class);

    // Pengiriman
    Route::resource('pengiriman',     AdminPengirimanController::class);

    // Keranjang
    Route::resource('keranjang',      AdminKeranjangController::class);

    // Review
    Route::resource('review',         AdminReviewController::class);

    // Users
    Route::resource('users',          AdminUsersController::class);

});