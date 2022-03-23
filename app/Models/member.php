<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class member extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'tb_member';
    protected $fillable = [
        'nama',
        'alamat',
        'jenis_kelamin',
        'tlp'
    ];

    /**
     * untuk merelasikan model member dengan model transaksi
     */
    public function transaksi()
    {
        return $this->belongsTo(transaksi::class);
    }

    /**
     * untuk merelasikan model member dengan model penjemputan
     */
    public function penjemputan()
    {
        return $this->belongsTo(penjemputan::class);
    }
    
}
