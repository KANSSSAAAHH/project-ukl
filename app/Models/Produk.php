<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    // Matikan timestamps karena tabel tidak punya created_at & updated_at
    public $timestamps = false;

    protected $table      = 'produk';
    protected $primaryKey = 'id_produk';

    protected $fillable = [
        'nama_produk',
        'kategori',
        'harga',
        'deskripsi',
        'foto',
        'status',
    ];
}