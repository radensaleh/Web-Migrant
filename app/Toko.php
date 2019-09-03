<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    protected $table = 'tb_toko';

    protected $fillable = [
        'kd_toko','id_token','ktp','nama_toko','foto_toko',
        'kd_user','no_rekening','nama_nasabah', 'nama_bank','city_id'
    ];

    protected $primaryKey = 'kd_toko';

    public $incrementing = false;

    public function user(){
       return $this->belongsTo('App\User', 'kd_user');
    }

    public function token(){
       return $this->belongsTo('App\Token', 'id_token');
    }

    public function city(){
       return $this->belongsTo('App\Kota', 'city_id');
    }

    public function toko(){
       return $this->hasMany('App\Toko', 'kd_toko');
    }

}
