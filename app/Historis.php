<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Historis extends Model
{
    protected $table = 'tb_historis';

    protected $fillable =
    [
        'id_historis','kd_pesanan','foto_bukti'
    ];

    protected $primaryKey = 'id_historis';

    public function pesanan(){
      return $this->belongsTo('App\Pesanan', 'kd_pesanan');
    }
}
