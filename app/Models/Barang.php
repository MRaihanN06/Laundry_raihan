<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'tb_barang';
    protected $fillable = [
            'nama_barang',
            'merk_barang', 
            'qty',
            'kondisi',
            'tanggal_pengadaan'
    ];
}
