<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'tb_status';

    protected $fillable =
    [
        'id_status','status'
    ];

    protected $primaryKey = 'id_status';

    public function pesanan(){
      return $this->hasMany('App\Pesanan', 'id_status');
    }
}
