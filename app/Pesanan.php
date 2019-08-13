<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'tb_pesanan';

    protected $fillable = 
    [
        'kd_pesanan','kd_transaksi','total_harga','ongkir'
    ];

    protected $primaryKey = 'kd_pesanan';
}
