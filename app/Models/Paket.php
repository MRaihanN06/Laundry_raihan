<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class paket extends Model
{
    use HasFactory;

    protected $table = 'tb_paket';
    protected $fillable = [
            'id_outlet',
            'jenis', 
            'nama_paket',
            'harga'
    ];

    /**
     * untuk merelasikan model paket dengan model outlet sesuai id_outlet yang berada di model paket
     */
    public function outlet()
    {
        return $this->belongsTo(outlet::class, 'id_outlet');
    }

    /**
     * untuk merelasikan model paket dengan model transaksi
     */
    public function transaksi()
    {
        return $this->belongsTo(transaksi::class);
    }

}
