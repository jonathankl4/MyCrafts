<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RencanaProduksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_produksi',
        'id_toko',
        'tgl_produksi_mulai',
        'tgl_produksi_selesai',
        'jumlahdiproduksi',
        'waktu_produksi',
        'nama_produk',
        'id_bom',
        'status'
    ];

    public function penggunaanBahan()
    {
        return $this->hasMany(PenggunaanBahan::class, 'id_produksi');
    }

    public function getStatusTextAttribute()
    {
        return match($this->status) {
            0 => 'Belum Mulai',
            1 => 'Sedang Berlangsung',
            2 => 'Selesai',
            3 => 'Dibatalkan',
            default => 'Status Tidak Dikenal'
        };
    }
}
