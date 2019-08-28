<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $table = 'tb_bank';

    protected $fillable =
    [
        'no_rekening','nama_nasabah', 'nama_bank'
    ];

    protected $primaryKey = 'no_rekening';
}
