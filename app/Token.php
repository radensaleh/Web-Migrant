<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    protected $table = 'tb_token';

    protected $fillable =
    [
        'id_token', 'token', 'kd_koordinator','status'
    ];

    protected $primaryKey = 'id_token';

    public function koordinator(){
       return $this->belongsTo('App\Koordinator','kd_koordinator');
    }

    public function toko(){
       return $this->hasMany('App\Toko', 'id_token');
    }
}
