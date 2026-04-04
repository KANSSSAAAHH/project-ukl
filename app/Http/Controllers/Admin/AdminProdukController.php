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
        $produk = Produk::orderBy('id_produk', 'desc')->get();
        return view('admin.produk.index', compact('produk'));
    }

    public function create()
    {
        return view('admin.produk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori'    => 'required|in:kering,basah',
            'harga'       => 'required|integer|min:0',
            'deskripsi'   => 'required|string',
            'status'      => 'required|in:aktif,nonaktif',
            'foto'        => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $fotoPath = $request->file('foto')->store('produk', 'public');

        Produk::create([
            'nama_produk' => $request->nama_produk,
            'kategori'    => $request->kategori,
            'harga'       => $request->harga,
            'deskripsi'   => $request->deskripsi,
            'status'      => $request->status,
            'foto'        => $fotoPath,
        ]);

        return redirect()->route('admin.produk.index')
                         ->with('success', 'Produk berhasil ditambahkan!');
    }

    public function show(string $id)
    {
        $produk = Produk::findOrFail($id);
        return view('admin.produk.show', compact('produk'));
    }

    public function edit(string $id)
    {
        $produk = Produk::findOrFail($id);
        return view('admin.produk.edit', compact('produk'));
    }

    public function update(Request $request, string $id)
    {
        $produk = Produk::findOrFail($id);

        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori'    => 'required|in:kering,basah',
            'harga'       => 'required|integer|min:0',
            'deskripsi'   => 'required|string',
            'status'      => 'required|in:aktif,nonaktif',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // Update foto hanya kalau ada file baru
        if ($request->hasFile('foto')) {
            // Hapus foto lama
            if ($produk->foto) {
                Storage::disk('public')->delete($produk->foto);
            }
            // Simpan foto baru
            $produk->foto = $request->file('foto')->store('produk', 'public');
        }

        $produk->nama_produk = $request->nama_produk;
        $produk->kategori    = $request->kategori;
        $produk->harga       = $request->harga;
        $produk->deskripsi   = $request->deskripsi;
        $produk->status      = $request->status;
        $produk->save();

        return redirect()->route('admin.produk.index')
                         ->with('success', 'Produk berhasil diupdate!');
    }

    public function destroy(string $id)
    {
        $produk = Produk::findOrFail($id);
        if ($produk->foto) {
            Storage::disk('public')->delete($produk->foto);
        }
        $produk->delete();

        return redirect()->route('admin.produk.index')
                         ->with('success', 'Produk berhasil dihapus!');
    }
}