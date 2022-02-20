<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;

    public $keyType = 'string';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $table = 'tb_detail_transaksi';
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $fillable = [
        'id_transaksi',
        'id_paket',
        'qty',
        'keterangan'
    ];


    public function outlet()
    {
        return $this->belongsTo(outlet::class, 'id_outlet');
    }

    public function paket()
    {
        return $this->belongsTo(paket::class);
    }

    public function member()
    {
        return $this->belongsTo(member::class);
    }
}
