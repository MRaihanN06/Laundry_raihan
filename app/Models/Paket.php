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

    public function outlet()
    {
        return $this->belongsTo(outlet::class);
    }

}
