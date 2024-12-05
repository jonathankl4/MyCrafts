<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class PenerimaanBarang extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_toko',
        'tanggal_penerimaan',
        'jenis_penerimaan',
        'status_penerimaan',
        'catatan'
    ];



    public function details()
    {
        return $this->hasMany(DetailPenerimaanBarang::class, 'id_penerimaan');
    }

    public function jenis()
    {
        if ($this->jenis_penerimaan == 1) {
            return 'Mebel Retur';
        } else if ($this->jenis_penerimaan == 2) {
            return 'Hasil Produksi';
        } else {
            return 'Tidak Diketahui'; // Atau nilai default lainnya
        }
    }
}
