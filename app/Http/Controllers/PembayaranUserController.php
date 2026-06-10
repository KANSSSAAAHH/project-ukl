<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Pembayaran;

class PembayaranUserController extends Controller
{
    public function index($id)
    {
        $pesanan    = Pesanan::where('id_pesanan', $id)
            ->where('id_user', auth()->user()->id_user)
            ->firstOrFail();
        $pembayaran = Pembayaran::where('id_pesanan', $id)->firstOrFail();

        return view('user.pembayaran', compact('pesanan', 'pembayaran'));
    }

    public function upload(Request $request, $id)
    {
        $request->validate([
            'bukti_bayar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $pembayaran = Pembayaran::where('id_pesanan', $id)->firstOrFail();

        $path = $request->file('bukti_bayar')->store('bukti_bayar', 'public');
        $pembayaran->bukti_bayar = $path;
        $pembayaran->status = 'lunas'; // langsung lunas setelah upload bukti
        $pembayaran->save();

        return redirect()->route('pesanan.sukses', $id)
            ->with('success', 'Pembayaran berhasil dikonfirmasi!');
    }
}