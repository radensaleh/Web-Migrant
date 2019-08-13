<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListBarangKeranjang extends Model
{
    protected $table = 'tb_list_barang_keranjang';

    protected $fillable = 
    [
        'id_list_keranjang', 'id_keranjang','kd_barang','kuantitas'
    ];

    protected $primaryKey = 'id_list_keranjang';
}
