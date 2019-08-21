<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    protected $table = 'tb_provinsi';

    protected $fillable =
    [
        'province_id','province'
    ];

    protected $primaryKey = 'province_id';

    public function city(){
       return $this->hasMany('App\Kota', 'province_id');
    }

}
