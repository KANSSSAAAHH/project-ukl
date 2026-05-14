<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $query = Produk::where('status', 'aktif');

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('search')) {
            $query->where('nama_produk', 'like', '%' . $request->search . '%');
        }

        $produk = $query->get();

        return view('produk', compact('produk'));
    }

    public function show($id)
    {
        $produk = Produk::findOrFail($id);
        return view('detail-produk', compact('produk'));
    }
}