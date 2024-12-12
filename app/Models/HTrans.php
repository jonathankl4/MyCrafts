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
        'status_pembayaran',
        'tgl_transaksi',
        'panjang',
        'tinggi',
        'lebar',
        'harga_kayu',
        'jenis_kayu',
        'catatan',
        'alamat',
        'nomorTelepon',
        'pilihan',
        'alasan_batal',
        'nomor_resi',
        'tgl_sampai',
        'retur',
        'finishing',
        'harga_finishing'



    ];
}
