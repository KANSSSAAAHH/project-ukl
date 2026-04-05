<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DetailPesanan;
use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Http\Request;

class AdminDetailPesananController extends Controller
{
    public function index()
    {
        $detail = DetailPesanan::with(['pesanan', 'produk'])->orderBy('id_detail', 'desc')->get();
        return view('admin.detail-pesanan.index', compact('detail'));
    }

    public function create()
    {
        $pesanan = Pesanan::with('user')->get();
        $produk  = Produk::where('status', 'aktif')->get();
        return view('admin.detail-pesanan.create', compact('pesanan', 'produk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pesanan'    => 'required|exists:pesanan,id_pesanan',
            'id_produk'     => 'required|exists:produk,id_produk',
            'jumlah_produk' => 'required|integer|min:1',
            'harga'         => 'required|integer|min:0',
            'subtotal'      => 'required|integer|min:0',
        ]);

        DetailPesanan::create($request->all());

        return redirect()->route('admin.detail-pesanan.index')
                         ->with('success', 'Detail pesanan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $detail  = DetailPesanan::findOrFail($id);
        $pesanan = Pesanan::with('user')->get();
        $produk  = Produk::where('status', 'aktif')->get();
        return view('admin.detail-pesanan.edit', compact('detail', 'pesanan', 'produk'));
    }

    public function update(Request $request, $id)
    {
        $detail = DetailPesanan::findOrFail($id);

        $request->validate([
            'id_pesanan'    => 'required|exists:pesanan,id_pesanan',
            'id_produk'     => 'required|exists:produk,id_produk',
            'jumlah_produk' => 'required|integer|min:1',
            'harga'         => 'required|integer|min:0',
            'subtotal'      => 'required|integer|min:0',
        ]);

        $detail->update($request->all());

        return redirect()->route('admin.detail-pesanan.index')
                         ->with('success', 'Detail pesanan berhasil diupdate!');
    }

    public function destroy($id)
    {
        DetailPesanan::findOrFail($id)->delete();
        return redirect()->route('admin.detail-pesanan.index')
                         ->with('success', 'Detail pesanan berhasil dihapus!');
    }
}