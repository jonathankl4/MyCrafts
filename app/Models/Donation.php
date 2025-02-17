<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'email',
        'amount',
        'note',
        'status',
        'snap_token',
        'pilihan',
        'h_trans_id'
    ];
}
