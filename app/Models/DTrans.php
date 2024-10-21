<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DTrans extends Model
{
    use HasFactory;

    protected $fillable = [
        'h_trans_id',
        'nama_item',
        'jumlah',
        'harga',
        'jenis',
        'cek_redesain',



    ];
}
