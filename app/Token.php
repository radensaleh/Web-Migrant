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
}
