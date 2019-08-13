<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    protected $table = 'tb_ulasan';

    protected $fillable =
    [
        'id_ulasan','kd_user','kd_barang','deskripsi_ulasan','rating','foto'
    ];

    protected $primaryKey = 'id_ulasan';
}
