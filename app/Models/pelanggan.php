<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pelanggan extends Model
{
    use HasFactory;
    protected $table = 'tbl_pelanggan';
    protected $fillable = [
        'nama_pelanggan',
        'no_telp',
        'alamat',
        'jenis_kelamin',
        'tgl_masuk',
        'id_kos',
        'status'
    ];
}
