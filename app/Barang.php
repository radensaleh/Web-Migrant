<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'tb_barang';

    protected $fillable =
    [
        'kd_barang','kd_toko','nama_barang','id_jenis','stok','harga_jual',
<<<<<<< HEAD
        'deskripsi','foto_barang','berat_barang'
=======
        'harga_modal','deskripsi','foto_barang','berat_barang','status_barang'
>>>>>>> 470e1e79437b596c4239dba2d9f22c4e584c6f14
    ];

    protected $primaryKey = 'kd_barang';

    public $incrementing = false;

    public function toko(){
       return $this->belongsTo('App\Toko', 'kd_toko');
    }

    public function jenis_barang(){
       return $this->belongsTo('App\JenisBarang', 'id_jenis');
    }

    public function list_barangkeranjang(){
       return $this->hasMany('App\ListBarangKeranjang', 'kd_barang');
    }

    public function list_barang(){
       return $this->hasMany('App\ListBarang', 'kd_barang');
    }

    public function suspend(){
      return $this->hasMany('App\Suspend', 'kd_barang');
    }

}
