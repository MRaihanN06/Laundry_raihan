<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penjemputan extends Model
{
    use HasFactory;

    protected $table = 'tb_penjemputan';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function member()
    {
        return $this->belongsTo(member::class, 'id_member');
    }

    public function user()
    {
        return $this->belongsTo(user::class, 'id_user');
    }

}
