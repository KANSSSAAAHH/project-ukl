<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\User;
use App\Models\Pesanan;
use App\Models\Review;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalProduk'    => Produk::count(),
            'produkAktif'    => Produk::where('status','aktif')->count(),
            'produkKering'   => Produk::where('kategori','kering')->count(),
            'produkBasah'    => Produk::where('kategori','basah')->count(),
            'produkTerbaru'  => Produk::orderBy('id_produk','desc')->take(5)->get(),
            'totalUser'      => User::count(),
            'totalPesanan'   => Pesanan::count(),
            'pesananMenunggu'=> Pesanan::where('status_pesanan','menunggu')->count(),
            'pesananTerbaru' => Pesanan::orderBy('id_pesanan','desc')->take(5)->get(),
            'totalReview'    => Review::count(),
            'reviewTerbaru'  => Review::with('user')->orderBy('id_review','desc')->take(3)->get(),
        ]);
    }
}