<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenerimaanBahan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_toko',
        'tanggal_penerimaan',
        'id_supplier',
        'status_penerimaan',
        'catatan'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'id_supplier');
    }

    public function details()
    {
        return $this->hasMany(DetailPenerimaanBahan::class, 'id_penerimaan');
    }
}
