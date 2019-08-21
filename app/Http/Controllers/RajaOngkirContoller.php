<?php

namespace App\Http\Controllers;

use App\Provinsi;
use App\Kota;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;

class RajaOngkirContoller extends Controller
{

    public function apiRajaOngkir(){
      $response = Curl::to('https://api.rajaongkir.com/starter/province')
                  ->withData( array( 'key' => 'e047008e889ac6329aa2dd447480dbf0' ) )
                  ->asJson()
                  ->get();

      foreach($response as $key => $data){
        for($i = 0; $i < sizeof($data->results); $i++){
          //store province
          $provinsi = new Provinsi;
          $provinsi->province_id = $data->results[$i]->province_id;
          $provinsi->province = $data->results[$i]->province;
          $provinsi->save();

          $res = Curl::to('https://api.rajaongkir.com/starter/city')
                 ->withData( array( 'key' => 'e047008e889ac6329aa2dd447480dbf0', 'province' => $i+1 ) )
                 ->asJson()
                 ->get();

          foreach ($res as $key => $value) {
              for($x = 0; $x < sizeof($value->results); $x++){
                  //store city
                  $kota = new Kota;
                  $kota->city_id = $value->results[$x]->city_id;
                  $kota->province_id = $value->results[$x]->province_id;
                  $kota->type = $value->results[$x]->type;
                  $kota->city_name = $value->results[$x]->city_name;
                  $kota->postal_code = $value->results[$x]->postal_code;
                  $kota->save();
              }
          }
        }
      }

    }
}
