<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'tb_transaksi';

    protected $fillable =
    [
        'kd_transaksi','kd_user','foto_bukti','tgl_transaksi','total_harga','nama_penerima'
    ];

    protected $primaryKey = 'kd_transaksi';

    public $incrementing = false;

    public function user(){
       return $this->belongsTo('App\User', 'kd_user');
    }

    public function pesanan(){
       return $this->hasMany('App\Pesanan', 'kd_transaksi');
    }
}
