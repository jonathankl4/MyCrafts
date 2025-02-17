<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class toko extends Model
{
    use HasFactory;

    protected $table = "toko";

    protected $fillable = [
        'id_owner',
        'nama',
        'slogan',
        'deskripsi',
        'foto',
        'status',
        'saldo',
        'saldo_pending',
        'membership_expires_at',
        'membership_type'

    ];
}
