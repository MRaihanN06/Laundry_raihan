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
        'total',
        'keterangan'
    ];

    /**
     * untuk merelasikan model DetailTransaksi dengan model outlet sesuai id_outlet yang berada di DetailTransaksi
     */
    public function outlet()
    {
        return $this->belongsTo(outlet::class, 'id_outlet');
    }

/**
     * untuk merelasikan model DetailTransaksi dengan model Paket sesuai id_paket yang berada di Detailtransaksi
     */
    public function paket()
    {
        return $this->belongsTo(paket::class, 'id_paket');
    }

    /**
     * untuk merelasikan model DetailTransaksi dengan model Member
     */
    public function member()
    {
        return $this->belongsTo(member::class);
    }

    /**
     * untuk merelasikan model DetailTransaksi dengan model transaksi
     */
    public function Transaksi()
    {
        return $this->belongsTo(Transaksi::class,);
    }

    /**
     * untuk merelasikan model DetailTransaksi dengan model Laporan
     */
    public function laporan()
    {
        return $this->belongsTo(laporan::class);
    }
}
