<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Produk;
use App\Models\Pesanan;
use App\Models\DetailPesanan;
use App\Models\Pengiriman;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $keranjang = Keranjang::with('produk')
            ->where('id_user', auth()->user()->id_user)
            ->get();

        if ($keranjang->isEmpty()) {
            return redirect()->route('keranjang.index')
                ->with('error', 'Keranjang kamu kosong!');
        }

        $total = $keranjang->sum(fn($item) => $item->produk->harga * $item->jumlah_produk);

        return view('user.checkout', compact('keranjang', 'total'));
    }

    public function proses(Request $request)
    {
        $request->validate([
            'nama_penerima'  => 'required|string|max:255',
            'no_hp'          => 'required|string|max:20',
            'alamat_lengkap' => 'required|string',
            'kota'           => 'required|string|max:100',
            'kecamatan'      => 'required|string|max:100',
            'kode_pos'       => 'required|string|max:10',
            'metode'         => 'required|in:GoPay,Dana,OVO',
        ]);

        $keranjang = Keranjang::with('produk')
            ->where('id_user', auth()->user()->id_user)
            ->get();

        if ($keranjang->isEmpty()) {
            return redirect()->route('keranjang.index')
                ->with('error', 'Keranjang kamu kosong!');
        }

        $total = $keranjang->sum(fn($item) => $item->produk->harga * $item->jumlah_produk);

        DB::transaction(function () use ($request, $keranjang, $total) {
            $pesanan = Pesanan::create([
                'id_user'         => auth()->user()->id_user,
                'tanggal_pesanan' => now()->toDateString(),
                'total_harga'     => $total,
                'status_pesanan'  => 'menunggu',
            ]);

            foreach ($keranjang as $item) {
                DetailPesanan::create([
                    'id_pesanan'    => $pesanan->id_pesanan,
                    'id_produk'     => $item->id_produk,
                    'jumlah_produk' => $item->jumlah_produk,
                    'harga'         => $item->produk->harga,
                    'subtotal'      => $item->produk->harga * $item->jumlah_produk,
                ]);
            }

            Pengiriman::create([
                'id_pesanan'     => $pesanan->id_pesanan,
                'nama_penerima'  => $request->nama_penerima,
                'no_hp'          => $request->no_hp,
                'alamat_lengkap' => $request->alamat_lengkap,
                'kota'           => $request->kota,
                'kecamatan'      => $request->kecamatan,
                'kode_pos'       => $request->kode_pos,
            ]);

            Pembayaran::create([
                'id_pesanan'  => $pesanan->id_pesanan,
                'metode'      => $request->metode,
                'status'      => 'pending',
                'bukti_bayar' => null,
            ]);

            Keranjang::where('id_user', auth()->user()->id_user)->delete();

            session(['id_pesanan_baru' => $pesanan->id_pesanan]);
        });

        $idPesanan = session('id_pesanan_baru');
        return redirect()->route('pembayaran.index', $idPesanan)
            ->with('success', 'Pesanan berhasil dibuat! Silakan upload bukti pembayaran.');
    }
}