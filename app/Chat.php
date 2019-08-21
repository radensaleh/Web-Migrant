<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = 'tb_chat';

    protected $fillable =
    [
        'id_chat','kd_user','kd_toko','pesan'
    ];

    protected $primaryKey = 'id_chat';

    public function user(){
       return $this->belongsTo('App\User', 'kd_user');
    }

    public function toko(){
       return $this->belongsTo('App\Toko', 'kd_toko');
    }
}
