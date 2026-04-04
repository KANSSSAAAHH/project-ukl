<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminPembayaranController extends Controller
{
    public function index()
    {
        $pembayaran = Pembayaran::with('pesanan')->orderBy('id_pembayaran', 'desc')->get();
        return view('admin.pembayaran.index', compact('pembayaran'));
    }

    public function create()
    {
        $pesanan = Pesanan::all();
        return view('admin.pembayaran.create', compact('pesanan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pesanan'  => 'required|exists:pesanan,id_pesanan',
            'metode'      => 'required|string|max:255',
            'status'      => 'required|string|max:255',
            'bukti_bayar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $buktiPath = null;
        if ($request->hasFile('bukti_bayar')) {
            $buktiPath = $request->file('bukti_bayar')->store('bukti_bayar', 'public');
        }

        Pembayaran::create([
            'id_pesanan'  => $request->id_pesanan,
            'metode'      => $request->metode,
            'status'      => $request->status,
            'bukti_bayar' => $buktiPath,
        ]);

        return redirect()->route('admin.pembayaran.index')
                         ->with('success', 'Pembayaran berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pesanan    = Pesanan::all();
        return view('admin.pembayaran.edit', compact('pembayaran', 'pesanan'));
    }

    public function update(Request $request, $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        $request->validate([
            'id_pesanan'  => 'required|exists:pesanan,id_pesanan',
            'metode'      => 'required|string|max:255',
            'status'      => 'required|string|max:255',
            'bukti_bayar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('bukti_bayar')) {
            if ($pembayaran->bukti_bayar) {
                Storage::disk('public')->delete($pembayaran->bukti_bayar);
            }
            $pembayaran->bukti_bayar = $request->file('bukti_bayar')->store('bukti_bayar', 'public');
        }

        $pembayaran->id_pesanan = $request->id_pesanan;
        $pembayaran->metode     = $request->metode;
        $pembayaran->status     = $request->status;
        $pembayaran->save();

        return redirect()->route('admin.pembayaran.index')
                         ->with('success', 'Pembayaran berhasil diupdate!');
    }

    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        if ($pembayaran->bukti_bayar) {
            Storage::disk('public')->delete($pembayaran->bukti_bayar);
        }
        $pembayaran->delete();

        return redirect()->route('admin.pembayaran.index')
                         ->with('success', 'Pembayaran berhasil dihapus!');
    }
}