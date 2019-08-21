<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Koordinator extends Authenticatable
{
    use Notifiable;

    protected $table = 'tb_koordinator';

    protected $fillable = [
      'kd_koordinator','KTP','nama_lengkap','jenis_kelamin','nomer_hp','email',
      'password','city_id','detail_alamat','foto_koordinator','poin'
    ];

    protected $hidden = [
      'password','remember_token'
    ];

    protected $primaryKey = 'kd_koordinator';

    public $incrementing = false;

    public function setPasswordAttribute($value)
    {
      $this->attributes['password'] = bcrypt($value);
    }

    public function token(){
       return $this->hasMany('App\Token', 'kd_koordinator');
    }

    public function city(){
       return $this->belongsTo('App\Kota', 'city_id');
    }
}
