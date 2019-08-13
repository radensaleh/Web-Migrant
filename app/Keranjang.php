<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    protected $table = 'tb_keranjang';

    protected $fillable = 
    [
        'id_keranjang','kd_user'
    ];

    protected $primaryKey = 'id_keranjang';
}
