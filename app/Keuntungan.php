<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keuntungan extends Model
{
    protected $table = 'tb_keuntungan';

    protected $fillable =
    [
        'id_keuntungan','kd_transaksi','keuntungan'
    ];

    protected $primaryKey = 'id_keuntungan';

    public function transaksi(){
      return $this->belongsTo('App\Transaksi', 'kd_transaksi');
    }

}
