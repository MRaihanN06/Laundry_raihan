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

    public function transaksi()
    {
        return $this->belongsTo(transaksi::class);
    }

}
