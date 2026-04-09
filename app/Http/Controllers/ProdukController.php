<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $query = Produk::where('status', 'aktif');

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('search')) {
            $query->where('nama_produk', 'like', '%'.$request->search.'%');
        }

        $produk = $query->orderBy('id_produk', 'desc')->get();

        return view('produk', compact('produk'));
    }

    public function show($id)
    {
        $produk = Produk::findOrFail($id);

        if ($produk->status !== 'aktif') {
            abort(404);
        }

        return view('produk.show', compact('produk'));
    }
}