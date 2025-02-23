<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kos extends Model
{
    use HasFactory;
    protected $table = 'tbl_kos';
    protected $fillable = [
        'nama_kos',
        'alamat',
        'price',
        'id_category',
        'keterangan',
        'status'
    ];
}
