<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PencatatanPembelian extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function detailPencatatanPembelian(){
        return $this->hasMany(DetailPencatatanPembelian::class, 'id_pencatatan');
    }


    public function getTotalPembelianAttribute(){
        return $this->detailPencatatanPembelian->sum('total_harga');
    }
}
