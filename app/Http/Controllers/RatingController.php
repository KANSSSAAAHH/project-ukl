<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function index(Request $request)
    {
        // 1. Tangkap id_produk yang dikirim dari tombol "Beri Rating" di riwayat pesanan
        $id_produk = $request->query('id_produk');

        // 2. Cari data produk berdasarkan id untuk memastikan produknya ada & aktif
        $produk = Produk::where('id_produk', $id_produk)
                        ->where('status', 'aktif')
                        ->first();

        // 3. Jika produk tidak ditemukan (atau link dimanipulasi), kembalikan ke riwayat dengan pesan eror
        if (!$produk) {
            return redirect()->route('pesanan.riwayat')->with('error', 'Produk tidak ditemukan atau sudah tidak aktif.');
        }

        // 4. Lempar variabel ke dalam view user.rating
        return view('user.rating', compact('id_produk', 'produk'));
    }

    public function store(Request $request)
    {
        // Validasi tetap ketat untuk menjaga keamanan database
        $request->validate([
            'id_produk' => ['required', 'exists:produk,id_produk'],
            'rating'    => ['required', 'integer', 'min:1', 'max:5'],
            'komentar'  => ['required', 'string', 'max:1000'],
        ], [
            'id_produk.required' => 'Pilih produk terlebih dahulu.',
            'id_produk.exists'   => 'Produk tidak ditemukan.',
            'rating.required'    => 'Pilih rating bintang.',
            'rating.min'         => 'Rating minimal 1 bintang.',
            'rating.max'         => 'Rating maksimal 5 bintang.',
            'komentar.required'  => 'Komentar wajib diisi.',
            'komentar.max'       => 'Komentar maksimal 1000 karakter.',
        ]);

        // Simpan review ke database
        Review::create([
            'id_user'   => Auth::id(),
            'id_produk' => $request->id_produk,
            'rating'    => $request->rating,
            'komentar'  => $request->komentar,
        ]);

        return back()->with('success', 'Rating berhasil dikirim!');
    }
}