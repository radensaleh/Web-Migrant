<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'tb_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'kd_user', 'nama_lengkap','jenis_kelamin','nomer_hp', 'email', 'password','city_id','detail_alamat', 'foto_user','status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $primaryKey = 'kd_user';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'status' => 'boolean'

    ];

    public function city(){
       return $this->belongsTo('App\Kota', 'city_id');
    }

    public function toko(){
       return $this->hasMany('App\Toko', 'kd_user');
    }

    public function chat(){
       return $this->hasMany('App\Chat', 'kd_user');
    }

    public function diskusi(){
       return $this->hasMany('App\Diskusi', 'kd_user');
    }

    public function keranjang(){
       return $this->hasMany('App\Keranjang', 'kd_user');
    }

    public function transaksi(){
       return $this->hasMany('App\Transaksi', 'kd_user');
    }
}
