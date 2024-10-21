<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HTrans extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_toko',
        'id_user',
        'id_produk',
        'nama_produk',
        'jumlah',
        'tipe_trans',
        'perkiraan_harga',
        'harga',
        'harga_redesain',
        'fotoh1',
        'fotoh2',
        'fotoredesain',
        'status_redesain',
        'status',
        'tgl_transaksi',
        'panjang',
        'tinggi',
        'harga_kayu',
        'jenis_kayu',
        'catatan',
        'alamat',
        'nomorTelepon'

    ];
}
