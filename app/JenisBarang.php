<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisBarang extends Model
{
    protected $table = 'tb_jenis_barang';

    protected $fillable =
    [
        'id_jenis','jenis_barang'
    ];

    protected $primaryKey = 'id_jenis';

    public function barang(){
       return $this->hasMany('App\Barang', 'id_jenis');
    }
}
