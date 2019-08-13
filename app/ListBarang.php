<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListBarang extends Model
{
    protected $table = 'tb_list_barang';

    protected $fillable =
    [
        'id_list_barang','kd_pesanan','kd_barang','kuantitas'
    ];

    protected $primaryKey = 'id_list_barang';
}
