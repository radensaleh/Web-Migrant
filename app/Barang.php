<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'tb_barang';

    protected $fillable = 
    [
        'kd_barang','kd_toko','nama_barang','id_jenis','stok','harga_jual',
        'harga_modal','deskripsi','foto_barang','berat_barang','status'
    ];

    protected $primaryKey = 'kd_barang';
}
