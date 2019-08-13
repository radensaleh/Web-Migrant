<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'tb_transaksi';

    protected $fillable = 
    [
        'kd_transaksi','kd_user','foto_bukti','id_status','tgl_transaksi','total_harga','no_resi'
    ];

    protected $primaryKey = 'kd_transaksi';
}