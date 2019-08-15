<?php

namespace App\Http\Controllers;

use DB;
use App\JenisBarang;
use Illuminate\Http\Request;

class JenisBarangController extends Controller
{
      public function store(Request $request){
        $checkIfExist = JenisBarang::where('id_jenis', $request->id_jenis)->get();

        if( count($checkIfExist) != 0 ){
          return response()->json([
             'error' => 1,
             'message' => 'Id Jenis Already Exist'
           ], 200);
        }

        $create = JenisBarang::create($request->all());
        if( $create ) {
           return response()->json([
             'error' => 0,
             'message' => 'Success Add Data'
           ], 200);
      }
    }

    public function update(Request $request){
        $data = JenisBarang::findOrFail($request->id_jenis);
        $data->update($request->all());

        if( $data ){
          return response()->json([
            'error' => 0,
            'message' => 'Success Edit Data'
          ], 200);
        }
    }

    public function destroy(Request $request){
       $data = JenisBarang::findOrFail($request->id_jenis);

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
