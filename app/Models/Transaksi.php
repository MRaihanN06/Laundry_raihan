<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    public $keyType = 'string';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $table = 'tb_transaksi';
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $fillable = [
        'id_outlet',
        'kode_invoice',
        'id_member',
        'tgl',
        'batas_waktu',
        'biaya_tambahan',
        'diskon',
        'pajak',
        'status',
        'pembayaran',
        'id_user',
        'total'
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
        return $this->belongsTo(member::class, 'id_member');
    }

    public function user()
    {
        return $this->belongsTo(user::class, 'id_user');
    }
}
