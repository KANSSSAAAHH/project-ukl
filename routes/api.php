<?php

use Illuminate\Support\Facades\Route;
use App\Models\Produk;
use App\Models\Review;

Route::get('/produk', function () {
    return response()->json(Produk::all());
});

Route::get('/review', function () {
    return response()->json(Review::all());
});