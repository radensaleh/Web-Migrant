<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diskusi extends Model
{
    protected $table = 'tb_diskusi';

    protected $fillable =
    [
        'id_diskusi','kd_user','kd_barang','pertanyaan','jawaban'
    ];

    protected $primaryKey = 'id_diskusi';

    public function user(){
       return $this->belongsTo('App\User', 'kd_user');
    }

    public function barang(){
       return $this->belongsTo('App\Barang', 'kd_barang');
    }
}
