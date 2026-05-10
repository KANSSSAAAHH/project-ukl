<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::where('status', 'aktif')->get();
        return view('produk', compact('produk'));
    }

    public function show($id)
    {
        $produk = Produk::findOrFail($id);
        return view('detail-produk', compact('produk'));
    }
}