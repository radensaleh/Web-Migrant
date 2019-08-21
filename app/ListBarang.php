<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListBarang extends Model
{
    protected $table = 'tb_list_barang';

    protected $fillable =
    [
        'id_list_barang','kd_pesanan','kd_barang','kuantitas','harga'
    ];

    protected $primaryKey = 'id_list_barang';

    public function pesanan(){
       return $this->belongsTo('App\Pesanan', 'kd_pesanan');
    }

    public function barang(){
       return $this->belongsTo('App\Barang', 'kd_barang');
    }
}
