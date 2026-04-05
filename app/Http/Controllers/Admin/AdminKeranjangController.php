<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Keranjang;
use App\Models\User;
use App\Models\Produk;
use Illuminate\Http\Request;

class AdminKeranjangController extends Controller
{
    public function index()
    {
        $keranjang = Keranjang::with(['user', 'produk'])->orderBy('id_keranjang', 'desc')->get();
        return view('admin.keranjang.index', compact('keranjang'));
    }

    public function create()
    {
        $users  = User::all();
        $produk = Produk::where('status', 'aktif')->get();
        return view('admin.keranjang.create', compact('users', 'produk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_user'       => 'required|exists:users,id_user',
            'id_produk'     => 'required|exists:produk,id_produk',
            'jumlah_produk' => 'required|integer|min:1',
        ]);

        Keranjang::create($request->only('id_user', 'id_produk', 'jumlah_produk'));

        return redirect()->route('admin.keranjang.index')
                         ->with('success', 'Item berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $keranjang = Keranjang::with(['user', 'produk'])->findOrFail($id);
        return view('admin.keranjang.edit', compact('keranjang'));
    }

    public function update(Request $request, $id)
    {
        $keranjang = Keranjang::findOrFail($id);
        $request->validate([
            'jumlah_produk' => 'required|integer|min:1',
        ]);
        $keranjang->jumlah_produk = $request->jumlah_produk;
        $keranjang->save();

        return redirect()->route('admin.keranjang.index')
                         ->with('success', 'Jumlah berhasil diupdate!');
    }

    public function destroy($id)
    {
        Keranjang::findOrFail($id)->delete();
        return redirect()->route('admin.keranjang.index')
                         ->with('success', 'Item keranjang berhasil dihapus!');
    }
}