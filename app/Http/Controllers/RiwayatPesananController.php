<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Review; // Tambahkan import model Review di atas ini

class RiwayatPesananController extends Controller
{
    public function index()
    {
        $userId = auth()->user()->id_user;

        // 1. Menampilkan halaman riwayat pesanan secara normal
        $pesanan = Pesanan::with(['detailPesanan.produk', 'pembayaran'])
            ->where('id_user', $userId)
            ->orderByDesc('id_pesanan')
            ->get();

        // 2. Ambil semua id_produk yang SUDAH PERNAH diberi rating oleh user ini, lalu ubah ke bentuk Array
        $sudahDirating = Review::where('id_user', $userId)
            ->pluck('id_produk')
            ->toArray();

        // 3. Kirim data pesanan dan list produk yang sudah dirating ke view riwayat
        return view('user.riwayat', compact('pesanan', 'sudahDirating'));
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