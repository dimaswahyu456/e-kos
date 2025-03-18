<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    use HasFactory;
    protected $table = 'tbl_transaksi';
    protected $fillable = [
        'nama',
        'code_transaksi',
        'email',
        'no_telp',
        'id_kos',
        'payment_status',
        'total_amount'
    ];
}
