<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailProdukCustomDijual extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_produk_custom_dijual',
        'jenis_kayu',
        'harga',
    ];
}
