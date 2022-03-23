<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class outlet extends Model
{
    use HasFactory;

    protected $table = 'tb_outlet';
    protected $fillable = [
        'nama',
        'alamat',
        'tlp'
    ];

    /**
     * untuk merelasikan model outlet dengan model paket
     */
    public function paket()
    {
        return $this->belongsTo(paket::class);
    }

    /**
     * untuk merelasikan model outlet dengan model user
     */
    public function user()
    {
        return $this->belongsTo(user::class);
    }

    /**
     * untuk merelasikan model outlet dengan model transaksi
     */
    public function transaksi()
    {
        return $this->belongsTo(transaksi::class);
    }
    
}
