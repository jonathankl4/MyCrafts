<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenggunaanBahan extends Model
{
    use HasFactory;


    protected $fillable = [
        'id_produksi',
        'id_bahan',
        'nama_bahan',
        'jumlah_penggunaan'
    ];

    public function rencanaProduksi()
    {
        return $this->belongsTo(RencanaProduksi::class, 'id_produksi');
    }

    public function bahan()
    {
        return $this->belongsTo(Bahan::class, 'id_bahan');
    }


}
