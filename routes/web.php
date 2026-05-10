<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PembayaranUserController;
use App\Http\Controllers\RiwayatPesananController;
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

    // Dashboard (fallback)
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');

    // Halaman utama user setelah login
    Route::get('/user/home', function () {
        $produk = \App\Models\Produk::where('status', 'aktif')->get();
        return view('user.home', compact('produk'));
    })->name('user.home');

    // Profile
    Route::get('/profile',    [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',  [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Keranjang
    Route::get('/keranjang',         [KeranjangController::class, 'index'])->name('keranjang.index');
    Route::post('/keranjang/tambah', [KeranjangController::class, 'tambah'])->name('keranjang.tambah');
    Route::delete('/keranjang/{id}', [KeranjangController::class, 'hapus'])->name('keranjang.hapus');

    // Checkout
    Route::get('/checkout',  [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'proses'])->name('checkout.proses');

    // Pembayaran
    Route::get('/pembayaran/{id}',  [PembayaranUserController::class, 'index'])->name('pembayaran.index');
    Route::post('/pembayaran/{id}', [PembayaranUserController::class, 'upload'])->name('pembayaran.upload');

    // Sukses
    Route::get('/pesanan/sukses/{id}', fn($id) => view('user.sukses', ['id' => $id]))->name('pesanan.sukses');

    // Riwayat Pesanan
    Route::get('/pesanan/riwayat',      [RiwayatPesananController::class, 'index'])->name('pesanan.riwayat');
    Route::get('/pesanan/riwayat/{id}', [RiwayatPesananController::class, 'detail'])->name('pesanan.detail');

});

// ===================================================
// ADMIN
// ===================================================
Route::prefix('admin')->name('admin.')->middleware('is_admin')->group(function () {

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::resource('produk',         AdminProdukController::class);
    Route::resource('pesanan',        AdminPesananController::class);
    Route::resource('detail-pesanan', AdminDetailPesananController::class);
    Route::resource('pembayaran',     AdminPembayaranController::class);
    Route::resource('pengiriman',     AdminPengirimanController::class);
    Route::resource('keranjang',      AdminKeranjangController::class);
    Route::resource('review',         AdminReviewController::class);
    Route::resource('users',          AdminUsersController::class);

});