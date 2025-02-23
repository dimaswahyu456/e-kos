<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    use HasFactory;
    protected $table = 'tbl_payments';
    protected $fillable = [
        'nama_payment',
        'kode_payment',
        'status'
    ];
}
