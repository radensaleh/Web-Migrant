<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suspend extends Model
{
    protected $table = 'tb_suspend';

    protected $fillable =
    [
        'id_suspend','kd_barang','pesan'
    ];

    protected $primaryKey = 'id_suspend';

    public function barang(){
      return $this->belongsTo('App\Barang', 'kd_barang');
    }

}
