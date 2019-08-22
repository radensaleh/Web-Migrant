<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Token;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TokenAPIController extends Controller
/*Parameter
  -kd_token
*/
{
  public function checkToken(){
    $kd_token = request()->token;

    $token = DB::table('tb_token')->where('token', $kd_token)->first();

    if($token==null){
      return response()->json(
        ['response' => false,
        'message' => 'Token salah']
      );
    }elseif ($token->status=='1') {
      //jika status bernilai 1 maka token sudah digunakan
      return response()->json(
        ['response' => false,
        'message' => 'Token sudah digunakan']
      );
    }else{
      DB::table('tb_token')->where('token', $kd_token)->update(['status' => '1']);
      return response()->json(
        ['response' => true,
        'message' => 'Berhasil']
      );
    }
  }
}
