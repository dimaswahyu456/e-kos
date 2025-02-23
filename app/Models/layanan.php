<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class layanan extends Model
{
    use HasFactory;
    protected $table = 'tbl_layanan';
    protected $fillable = [
        'nama_layanan',
        'harga',
        'keterangan',
        'tgl_psb'
    ];
}
