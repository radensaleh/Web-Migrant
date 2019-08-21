<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    protected $table = 'tb_kota';

    protected $fillable =
    [
        'city_id','province_id','type','city_name','postal_code'
    ];

    protected $primaryKey = 'city_id';

    public function province(){
       return $this->belongsTo('App\Provinsi', 'province_id');
    }

    public function user(){
       return $this->hasMany('App\User', 'city_id');
    }

    public function koordinator(){
       return $this->hasMany('App\Koodinator', 'city_id');
    }

    public function toko(){
       return $this->hasMany('App\Toko', 'city_id');
    }

    public function pesanan(){
       return $this->hasMany('App\Pesanan', 'city_id');
    }
}
