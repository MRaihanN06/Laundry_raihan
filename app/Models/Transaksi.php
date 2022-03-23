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


    /**
     * untuk merelasikan model transaksi dengan model outlet sesuai id_outlet yang berada di model transaksi
     */
    public function outlet()
    {
        return $this->belongsTo(outlet::class, 'id_outlet');
    }

    /**
     * untuk merelasikan model transaksi dengan model member sesuai id_member yang berada di model transaksi
     */
    public function member()
    {
        return $this->belongsTo(member::class, 'id_member');
    }

    /**
     * untuk merelasikan model transaksi dengan model user sesuai id_user yang berada di model transaksi
     */
    public function user()
    {
        return $this->belongsTo(user::class, 'id_user');
    }

    /**
     * untuk merelasikan secara hasMany model transaksi dengan model DetailTransaksi sesuai id_tranksai yang berada di model DetailTransaksi
     */
    public function DetailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'id_transaksi');
    }

    /**
     * untuk merelasikan model transaksi dengan model paket
     */
    public function paket()
    {
        return $this->belongsTo(paket::class);
    }

    /**
     * untuk menghitung subtotal yang akan ditampilkan di view
     */
    public function getTotalPrice()
    {
        return $this->DetailTransaksi->reduce(function ($subTotal, $detail) {
            return $subTotal + ($detail->paket->harga * $detail->qty);
        });
    }
}
