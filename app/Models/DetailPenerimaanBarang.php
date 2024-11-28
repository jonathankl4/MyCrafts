<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenerimaanBarang extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_penerimaan',
        'id_barang',
        'jumlah',
        'keterangan'
    ];

    public function penerimaanBarang()
    {
        return $this->belongsTo(PenerimaanBarang::class, 'id_penerimaan');
    }

    public function barang()
    {
        return $this->belongsTo(Bahan::class, 'id_barang');
    }
}
