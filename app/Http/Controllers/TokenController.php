<?php

namespace App\Http\Controllers;

use App\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TokenController extends Controller
{
    public function store(Request $request){
        $randomToken = Str::random(4);
        $endToken    = Str::random(4);

        $kd_koordinator = $request->kd_koordinator;

        $token = new Token();
        $token->token = $randomToken.$endToken;
        $token->kd_koordinator = $kd_koordinator;
        $token->status = 0;
        $token->save();

        if( $token ){
          return response()->json([
            'error' => 0,
            'message' => 'Success Generate Token'
          ], 200);
        }
    }

    public function destroy(Request $request){
       $data = Token::findOrFail($request->id_token);

       try {
         $data->delete();

         if( $data ){
           return response()->json([
             'error' => 0,
             'message' => 'Success Delete Data'
           ], 200);
         }
       } catch (\Exception $e) {
           return response()->json([
             'error' => 1,
             'message' => 'Failed Delete Data'
           ], 200);
       }
    }
}
