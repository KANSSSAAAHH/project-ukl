<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Admin\AdminProdukController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminPesananController;
use App\Http\Controllers\Admin\AdminPembayaranController;
use App\Http\Controllers\Admin\AdminPengirimanController;
use App\Http\Controllers\Admin\AdminReviewController;
use App\Http\Controllers\Admin\AdminKeranjangController;
use App\Http\Controllers\Admin\AdminDetailPesananController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/about', [AboutController::class, 'index']);
Route::get('/produk', [ProdukController::class, 'index']);
Route::get('/kontak', [KontakController::class, 'index']);
Route::get('/login', [LoginController::class, 'index']);
Route::get('/register', [RegisterController::class, 'index']);

Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/logout', function () {
    auth()->logout();
    return redirect('/');
})->name('logout');

Route::prefix('admin')->group(function () {
    Route::get('/produk', [AdminProdukController::class, 'index'])->name('admin.produk');
    Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users');
    Route::get('/pesanan', [AdminPesananController::class, 'index'])->name('admin.pesanan');
    Route::get('/pembayaran', [AdminPembayaranController::class, 'index'])->name('admin.pembayaran');
    Route::get('/pengiriman', [AdminPengirimanController::class, 'index'])->name('admin.pengiriman');
    Route::get('/review', [AdminReviewController::class, 'index'])->name('admin.review');
    Route::get('/keranjang', [AdminKeranjangController::class, 'index'])->name('admin.keranjang');
    Route::get('/detail-pesanan', [AdminDetailPesananController::class, 'index'])->name('admin.detailpesanan');
});