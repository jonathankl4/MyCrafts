<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenerimaanBahan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_penerimaan',
        'id_barang',
        'jumlah',
        'keterangan'
    ];

    public function penerimaanBahan()
    {
        return $this->belongsTo(PenerimaanBahan::class, 'id_penerimaan');
    }

    public function barang()
    {
        return $this->belongsTo(Bahan::class, 'id_barang');
    }
}
