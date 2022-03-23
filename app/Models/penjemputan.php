<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penjemputan extends Model
{
    use HasFactory;

    protected $table = 'tb_penjemputan';
    protected $guarded = ['id', 'created_at', 'updated_at'];


    /**
     * untuk merelasikan model penjemputan dengan model member sesuai id_member yang berada di model penjemputan
     */
    public function member()
    {
        return $this->belongsTo(member::class, 'id_member');
    }

    /**
     * untuk merelasikan model penjemputan dengan model user sesuai id_user yang berada di model penjemputan
     */
    public function user()
    {
        return $this->belongsTo(user::class, 'id_user');
    }

}
