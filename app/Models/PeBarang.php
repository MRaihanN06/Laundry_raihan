<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeBarang extends Model
{
    use HasFactory;

    public $keyType = 'string';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $table = 'pebarang';
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
