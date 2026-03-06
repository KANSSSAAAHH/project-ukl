<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $reviews = [
            [
                'nama'     => 'Sari Dewi',
                'rating'   => 5,
                'komentar' => 'Klepon-nya enak banget, lembut dan gurih! Pasti pesan lagi minggu depan.',
            ],
            [
                'nama'     => 'Budi Santoso',
                'rating'   => 5,
                'komentar' => 'Nastar-nya juara! Harum, lumer di mulut. Cocok banget buat hampers lebaran.',
            ],
            [
                'nama'     => 'Rina Kusuma',
                'rating'   => 5,
                'komentar' => 'Sudah langganan bertahun-tahun! Kualitasnya tidak pernah mengecewakan.',
            ],
            [
                'nama'     => 'Agus Prasetyo',
                'rating'   => 4,
                'komentar' => 'Pengiriman cepat, packaging rapi dan kuenya masih fresh. Recommended banget!',
            ],
        ];

        return view('home', compact('reviews'));
    }
}