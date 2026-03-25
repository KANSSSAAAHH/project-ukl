<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminProdukController;
use App\Http\Controllers\Admin\AdminPesananController;
use App\Http\Controllers\Admin\AdminDetailPesananController;
use App\Http\Controllers\Admin\AdminKeranjangController;
use App\Http\Controllers\Admin\AdminPembayaranController;
use App\Http\Controllers\Admin\AdminPengirimanController;
use App\Http\Controllers\Admin\AdminReviewController;
use App\Http\Controllers\Admin\AdminUserController;

Route::prefix('admin')->group(function () {
    Route::resource('produk',         AdminProdukController::class);
    Route::resource('pesanan',        AdminPesananController::class);
    Route::resource('detail_pesanan', AdminDetailPesananController::class);
    Route::resource('keranjang',      AdminKeranjangController::class);
    Route::resource('pembayaran',     AdminPembayaranController::class);
    Route::resource('pengiriman',     AdminPengirimanController::class);
    Route::resource('review',         AdminReviewController::class);
    Route::resource('users',          AdminUserController::class);
});