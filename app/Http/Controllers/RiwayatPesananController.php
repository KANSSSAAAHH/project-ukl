<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;

class RiwayatPesananController extends Controller
{
    public function index()
    {
        $pesanan = Pesanan::with(['detailPesanan.produk', 'pembayaran'])
            ->where('id_user', auth()->user()->id_user)
            ->orderByDesc('id_pesanan')
            ->get();

        return view('user.riwayat', compact('pesanan'));
    }

    public function detail($id)
    {
        $pesanan = Pesanan::with(['detailPesanan.produk', 'pembayaran', 'pengiriman'])
            ->where('id_pesanan', $id)
            ->where('id_user', auth()->user()->id_user)
            ->firstOrFail();

        return view('user.detail-pesanan', compact('pesanan'));
    }
}