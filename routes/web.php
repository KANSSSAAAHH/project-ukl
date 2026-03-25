<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

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
    Route::get('/produk',         function () { return view('admin.produk'); })->name('admin.produk');
    Route::get('/users',          function () { return view('admin.users'); })->name('admin.users');
    Route::get('/pesanan',        function () { return view('admin.pesanan'); })->name('admin.pesanan');
    Route::get('/pembayaran',     function () { return view('admin.pembayaran'); })->name('admin.pembayaran');
    Route::get('/pengiriman',     function () { return view('admin.pengiriman'); })->name('admin.pengiriman');
    Route::get('/review',         function () { return view('admin.review'); })->name('admin.review');
    Route::get('/keranjang',      function () { return view('admin.keranjang'); })->name('admin.keranjang');
    Route::get('/detail-pesanan', function () { return view('admin.detail_pesanan'); })->name('admin.detailpesanan');
});