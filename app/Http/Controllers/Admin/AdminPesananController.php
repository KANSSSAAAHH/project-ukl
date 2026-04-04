<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\User;
use Illuminate\Http\Request;

class AdminPesananController extends Controller
{
    public function index()
    {
        $pesanan = Pesanan::with('user')->latest('id_pesanan')->get();
        return view('admin.pesanan.index', compact('pesanan'));
    }

    public function create()
    {
        $users = User::all();
        return view('admin.pesanan.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_user'         => 'required|exists:users,id_user',
            'tanggal_pesanan' => 'required|date',
            'total_harga'     => 'required|numeric|min:0',
            'status_pesanan'  => 'required|in:menunggu,diproses,selesai',
        ]);

        Pesanan::create($request->all());

        return redirect()->route('admin.pesanan.index')
                         ->with('success', 'Pesanan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $users   = User::all();
        return view('admin.pesanan.edit', compact('pesanan', 'users'));
    }

    public function update(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);

        $request->validate([
            'id_user'         => 'required|exists:users,id_user',
            'tanggal_pesanan' => 'required|date',
            'total_harga'     => 'required|numeric|min:0',
            'status_pesanan'  => 'required|in:menunggu,diproses,selesai',
        ]);

        $pesanan->update($request->all());

        return redirect()->route('admin.pesanan.index')
                         ->with('success', 'Pesanan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->delete();

        return redirect()->route('admin.pesanan.index')
                         ->with('success', 'Pesanan berhasil dihapus!');
    }
}