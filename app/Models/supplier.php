<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class supplier extends Model
{
    use HasFactory;

    protected $table = "suppliers";


    protected $fillable = [
        'id_toko',
        'nama_sup',
        'alamat_sup',
        'notelp_sup',
        'keterangan_sup',

    ];
}
