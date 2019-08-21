<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'tb_pesanan';

    protected $fillable =
    [
        'kd_pesanan','kd_transaksi','total_harga','ongkir','no_resi','city_id','id_status'
    ];

    protected $primaryKey = 'kd_pesanan';

    public function city(){
       return $this->belongsTo('App\Kota', 'city_id');
    }

    public function transaksi(){
       return $this->belongsTo('App\Transaksi', 'kd_transaksi');
    }
}
