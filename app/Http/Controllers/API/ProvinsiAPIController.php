<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Provinsi;
use App\Kota;


class ProvinsiAPIController extends Controller
{
  public function show(){
    $provinsi= Provinsi::all();

    $list=[];

    for($i=0;$i<sizeof($provinsi);$i++){
      $kota = Kota::where('province_id',$provinsi[$i]->province_id)->get();

      $list[$i]=[
        'province_id' => $provinsi[$i]->province_id,
        'province' => $provinsi[$i]->province,
        'listKota' => $kota
      ];
    }

    return response()->json(
      $list
    );
  }

  public function getKota(){
    $city_id=request()->city_id;

    $kota = Kota::where('city_id',$city_id)->first();

    return response()->json(
      $kota
    );
  }
}
