<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'tb_pesanan';

    protected $fillable =
    [
        'kd_pesanan','kd_transaksi','total_harga','ongkir','no_resi','city_id','id_status',
        'estimasi_pengiriman','kurir', 'nama_service', 'alamat_lengkap', 'nomor_telepon'
    ];

    protected $primaryKey = 'kd_pesanan';

    public $incrementing = false;

    public function city(){
       return $this->belongsTo('App\Kota', 'city_id');
    }

    public function transaksi(){
       return $this->belongsTo('App\Transaksi', 'kd_transaksi');
    }

    public function list_barang(){
       return $this->hasMany('App\ListBarang', 'kd_pesanan');
    }

    public function status(){
      return $this->belongsTo('App\Status', 'id_status');
    }

    public function historis(){
      return $this->hasMany('App\Historis', 'kd_pesanan');
    }
}
