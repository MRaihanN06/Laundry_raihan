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

    public function paket()
    {
        return $this->belongsTo(paket::class);
    }

    public function user()
    {
        return $this->belongsTo(user::class);
    }
}
