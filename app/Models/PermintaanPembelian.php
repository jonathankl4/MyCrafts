<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermintaanPembelian extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function detailPermintaanPembelian()
    {
        return $this->hasMany(DetailPermintaanPembelian::class, 'id_permintaan');
    }

    public function getStatusTextAttribute()
    {
        return match($this->status) {
            0 => 'Draft',
            1 => 'Disetujui',
            2 => 'Ditolak',
            default => 'Unknown'
        };
    }

    public function getTotalPembelianAttribute()
    {
        return $this->detailPermintaanPembelian->sum('total_harga');
    }
}
