<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retur extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_toko',
        'jumlah',
        'alasan_retur',
        'tgl_retur',
        'tgl_retur_sampai',
        'status',
        'alasan_retur_ditolak'
    ];

    public function getStatusTextAttribute()
    {
        return match($this->status) {
            1 => 'Diterima',
            2 => 'Ditolak',
            default => 'Menunggu'
        };
    }
}
