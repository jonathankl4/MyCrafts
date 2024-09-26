<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailAddonDijual extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_produk_custom_dijual',
        'nama_addon',
        'harga',
        'jenis',
        'tipe',
    ];
}
