<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    protected $table = 'pengiriman';
    protected $primaryKey = 'id_pengiriman';
    public $timestamps = false;

    protected $fillable = ['id_pesanan','nama_penerima','no_hp','alamat_lengkap','kota','kecamatan','kode_pos'];

    public function pesanan() { return $this->belongsTo(Pesanan::class, 'id_pesanan', 'id_pesanan'); }
}