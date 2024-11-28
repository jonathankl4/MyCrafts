<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    use HasFactory;

    protected $table = 'pengiriman';
    protected $fillable = [
        'id_toko',
        'nama_penerima',
        'id_mebel',
        'jumlah',
        'tanggal_pengiriman',
        'alamat',
        'jasa_pengiriman',
        'nomor_resi',
        'biaya_pengiriman'
    ];

    public function toko()
    {
        return $this->belongsTo(Toko::class, 'id_toko');
    }



    public function mebel()
    {
        return $this->belongsTo(Mebel::class, 'id_mebel');
    }
}
