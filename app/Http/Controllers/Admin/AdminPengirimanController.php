<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengiriman;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class AdminPengirimanController extends Controller
{
    public function index()
    {
        $pengiriman = Pengiriman::with('pesanan')->orderBy('id_pengiriman', 'desc')->get();
        return view('admin.pengiriman.index', compact('pengiriman'));
    }

    public function create()
    {
        $pesanan = Pesanan::with('user')->get();
        return view('admin.pengiriman.create', compact('pesanan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pesanan'    => 'required|exists:pesanan,id_pesanan',
            'nama_penerima' => 'required|string|max:255',
            'no_hp'         => 'required|string|max:20',
            'alamat_lengkap'=> 'required|string',
            'kota'          => 'required|string|max:255',
            'kecamatan'     => 'required|string|max:255',
            'kode_pos'      => 'required|string|max:10',
        ]);

        Pengiriman::create($request->all());

        return redirect()->route('admin.pengiriman.index')
                         ->with('success', 'Data pengiriman berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $pengiriman = Pengiriman::findOrFail($id);
        $pesanan    = Pesanan::with('user')->get();
        return view('admin.pengiriman.edit', compact('pengiriman', 'pesanan'));
    }

    public function update(Request $request, $id)
    {
        $pengiriman = Pengiriman::findOrFail($id);

        $request->validate([
            'id_pesanan'    => 'required|exists:pesanan,id_pesanan',
            'nama_penerima' => 'required|string|max:255',
            'no_hp'         => 'required|string|max:20',
            'alamat_lengkap'=> 'required|string',
            'kota'          => 'required|string|max:255',
            'kecamatan'     => 'required|string|max:255',
            'kode_pos'      => 'required|string|max:10',
        ]);

        $pengiriman->update($request->all());

        return redirect()->route('admin.pengiriman.index')
                         ->with('success', 'Data pengiriman berhasil diupdate!');
    }

    public function destroy($id)
    {
        Pengiriman::findOrFail($id)->delete();
        return redirect()->route('admin.pengiriman.index')
                         ->with('success', 'Data pengiriman berhasil dihapus!');
    }
}