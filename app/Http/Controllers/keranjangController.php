<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Produk;

class KeranjangController extends Controller
{
    public function index()
    {
        $keranjang = Keranjang::with('produk')
            ->where('id_user', auth()->user()->id_user)
            ->get();

        $total = $keranjang->sum(fn($item) => $item->produk->harga * $item->jumlah_produk);

        return view('user.keranjang', compact('keranjang', 'total'));
    }

    public function tambah(Request $request)
    {
        $request->validate([
            'id_produk'     => 'required|exists:produk,id_produk',
            'jumlah_produk' => 'required|integer|min:1',
        ]);

        $produk = Produk::findOrFail($request->id_produk);

        if ($produk->status !== 'aktif') {
            return redirect()->back()->with('error', 'Produk tidak tersedia.');
        }

        $keranjang = Keranjang::where('id_user', auth()->user()->id_user)
            ->where('id_produk', $request->id_produk)
            ->first();

        if ($keranjang) {
            $keranjang->jumlah_produk += $request->jumlah_produk;
            $keranjang->save();
        } else {
            Keranjang::create([
                'id_user'       => auth()->user()->id_user,
                'id_produk'     => $request->id_produk,
                'jumlah_produk' => $request->jumlah_produk,
            ]);
        }

        return redirect()->route('keranjang.index')
            ->with('success', $produk->nama_produk . ' berhasil ditambahkan ke keranjang!');
    }

    public function hapus($id)
    {
        $item = Keranjang::where('id_keranjang', $id)
            ->where('id_user', auth()->user()->id_user)
            ->firstOrFail();

        $item->delete();

        return redirect()->route('keranjang.index')
            ->with('success', 'Produk berhasil dihapus dari keranjang.');
    }
}