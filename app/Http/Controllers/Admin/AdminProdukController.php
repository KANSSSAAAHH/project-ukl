<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::all();
        return response()->json(['success' => true, 'data' => $produk]);
    }

    public function show($id)
    {
        $produk = Produk::find($id);
        if (!$produk) {
            return response()->json(['success' => false, 'message' => 'Produk tidak ditemukan'], 404);
        }
        return response()->json(['success' => true, 'data' => $produk]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required',
            'kategori'    => 'required',
            'harga'       => 'required|numeric',
            'status'      => 'required|in:aktif,nonaktif',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $fotoNama = null;
        if ($request->hasFile('foto')) {
            $fotoNama = $request->file('foto')->store('produk', 'public');
        }

        $produk = Produk::create([
            'nama_produk' => $request->nama_produk,
            'kategori'    => $request->kategori,
            'harga'       => $request->harga,
            'deskripsi'   => $request->deskripsi,
            'foto'        => $fotoNama,
            'status'      => $request->status,
        ]);

        return response()->json(['success' => true, 'message' => 'Produk berhasil ditambahkan', 'data' => $produk], 201);
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::find($id);
        if (!$produk) {
            return response()->json(['success' => false, 'message' => 'Produk tidak ditemukan'], 404);
        }

        if ($request->hasFile('foto')) {
            if ($produk->foto) Storage::disk('public')->delete($produk->foto);
            $produk->foto = $request->file('foto')->store('produk', 'public');
        }

        $produk->nama_produk = $request->nama_produk;
        $produk->kategori    = $request->kategori;
        $produk->harga       = $request->harga;
        $produk->deskripsi   = $request->deskripsi;
        $produk->status      = $request->status;
        $produk->save();

        return response()->json(['success' => true, 'message' => 'Produk berhasil diupdate', 'data' => $produk]);
    }

    public function destroy($id)
    {
        $produk = Produk::find($id);
        if (!$produk) {
            return response()->json(['success' => false, 'message' => 'Produk tidak ditemukan'], 404);
        }
        if ($produk->foto) Storage::disk('public')->delete($produk->foto);
        $produk->delete();
        return response()->json(['success' => true, 'message' => 'Produk berhasil dihapus']);
    }
}