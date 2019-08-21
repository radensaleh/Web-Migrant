<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Toko;
use App\Token;
use App\Koordinator;
use Ixudra\Curl\Facades\Curl;
use Carbon\Carbon;

class KoordinatorController extends Controller
{
    //RESOURCE
    public function store(Request $request){
        $koor = new Koordinator;

        $getDate = Carbon::now();
        $tgl = str_replace('-','', $getDate);
        $jam = str_replace(':','', $tgl);
        $kd_koor = 'KOOR'.str_replace(' ','',$jam);

        $koor->kd_koordinator = $kd_koor;
        $koor->KTP = $request->KTP;
        $koor->nama_lengkap = $request->nama_lengkap;
        $koor->jenis_kelamin = $request->jenis_kelamin;
        $koor->nomer_hp = $request->nomer_hp;
        $koor->email = $request->email;
        $koor->password = 'Koordinator123?';
        $koor->provinsi = $request->provinsi;
        $koor->daerah = $request->daerah;
        $koor->nama_daerah = $request->kabkota;
        $koor->detail_alamat = $request->detail_alamat;
        $koor->poin = '0';

        if($koor->save()){
            return response()->json([
              'error'   => 0,
              'message' => 'Koordinator ' . $request->nama_lengkap . ' berhasil ditambahkan :)'
            ], 200);
        }else{
            return response()->json([
              'error'   => 1,
              'message' => 'Gagal menambah data :('
            ], 200);
        }
    }

    public function update(Request $request){
        $koor = Koordinator::findOrFail($request->kd_koordinator);
        $koor->update($request->all());

        if($koor){
          return response()->json([
            'error'   => 0,
            'message' => 'Koordinator ' . $request->nama_lengkap . ' berhasil diubah :)'
          ], 200);
        }else{
          return response()->json([
            'error'   => 1,
            'message' => 'Gagal mengubah data :)'
          ], 200);
        }
    }

    public function destroy(Request $request){
       $data = Koordinator::findOrFail($request->kd_koordinator);

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
           ], 500);
       }
    }

    public function loginPage(Request $request){
      if($request->session()->exists('koordinator')){
        return redirect()->route('dashboardKoordinator');
      }else{
        return view('koordinator.loginKoordinator');
      }
    }

    public function dashboard(Request $request){
      if(!$request->session()->exists('koordinator')){
        return redirect()->route('loginPageKoor');
      }else{
        $koor = $request->session()->get('koordinator');
        $name = DB::table('tb_koordinator')
                ->where('nomer_hp', $koor)
                ->orWhere('email', $koor)
                ->value('nama_lengkap');

        $toko = Toko::count();

        $kd_koordinator = DB::table('tb_koordinator')
                    ->where('nomer_hp', $koor)
                    ->orWhere('email', $koor)
                    ->value('kd_koordinator');

        $token = DB::table('tb_token')
                 ->join('tb_koordinator', 'tb_koordinator.kd_koordinator', '=', 'tb_token.kd_koordinator')
                 ->where('tb_token.kd_koordinator', $kd_koordinator)
                 ->count();

        return view('koordinator.dashboard', compact(
            'name','toko','token'
        ));
      }
    }

    public function loginKoordinator(Request $request){
        $auth = auth()->guard('koordinator');

        $credentials = [
          'email'    => $request->email,
          'password' => $request->password,
        ];

        $validator = Validator::make($request->all(), [
          'email'       => 'required|email|max:255|unique:users',
          'password' => 'required|string|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
        ]);

        if ($validator->fails()) {
          return response()->json([
            'error'   => 1,
            'message' => $validator->messages(),
          ], 200);
        } else {
          if ($auth->attempt($credentials)) {
            $request->session()->put('koordinator', $request->email);
            return response()->json([
              'error'   => 0,
              'message' => 'Login Success',
              'email'   => $request->email
            ], 200);
          } else {
            return response()->json([
              'error'   => 2,
              'message' => 'Wrong Email or Password'
            ], 200);
          }
        }
    }

    public function logoutKoordinator(Request $request){
        $request->session()->forget('koordinator');
        return redirect()->route('loginPageKoor');
    }


    public function getProvince(){
      $response = Curl::to('https://api.rajaongkir.com/starter/province')
                  ->withData( array( 'key' => 'e047008e889ac6329aa2dd447480dbf0' ) )
                  ->get();

      return $response;
    }

    public function getKabKota(Request $request){
      $response = Curl::to('https://api.rajaongkir.com/starter/city')
                  ->withData( array( 'key' => 'e047008e889ac6329aa2dd447480dbf0', 'province' => $request->id_provinsi ) )
                  ->get();

      return $response;
    }

    public function getTypeDaerah(Request $request){
      $response = Curl::to('https://api.rajaongkir.com/starter/city')
                  ->withData( array( 'key' => 'e047008e889ac6329aa2dd447480dbf0', 'id' => $request->id ) )
                  ->get();

      return $response;
    }

    //TOKEN
    public function dataToken(Request $request){
        if(!$request->session()->exists('koordinator')){
          return redirect()->route('loginPageKoor');
        }else{
          $koor = $request->session()->get('koordinator');
          $name = DB::table('tb_koordinator')
                  ->where('nomer_hp', $koor)
                  ->orWhere('email', $koor)
                  ->value('nama_lengkap');

          $kd_koordinator = DB::table('tb_koordinator')
                      ->where('nomer_hp', $koor)
                      ->orWhere('email', $koor)
                      ->value('kd_koordinator');

          $token = DB::table('tb_token')
                   ->join('tb_koordinator', 'tb_koordinator.kd_koordinator', '=', 'tb_token.kd_koordinator')
                   ->where('tb_token.kd_koordinator', $kd_koordinator)
                   ->get();

          return view('koordinator.dataToken', compact(
              'name','token','kd_koordinator'
          ));
        }
    }
}
