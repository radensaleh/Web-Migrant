<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    protected $table = 'tb_toko';

    protected $fillable = [
        'kd_toko','id_token','KTP','nama_toko','foto_toko',
        'kd_user','no_rekening'
    ];

    protected $primaryKey = 'kd_toko';
}
