<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Koordinator;
use App\Toko;
use App\JenisBarang;
use App\User;

class AdminController extends Controller
{
    public function loginPage(Request $request){
      if($request->session()->exists('username')){
        return redirect()->route('dashboardAdmin');
      }else{
        return view('admin.loginAdmin');
      }
    }

    public function dashboard(Request $request){
      if(!$request->session()->exists('username')){
          return redirect()->route('loginPage');
      }else{
          $username = $request->session()->get('username');
          $name  = DB::table('tb_admin')
                      ->where('username', $username)
                      ->value('nama_admin');

          $koordinator = Koordinator::count();
          $toko = Toko::count();
          $jenisBarang = JenisBarang::count();

          return view('admin.dashboard', compact(
              'name','koordinator','toko','jenisBarang'
          ));
      }
    }

    public function loginAdmin(Request $request){
        $auth = auth()->guard('admin');

        $credentials = [
          'username'    => $request->username,
          'password' => $request->password,
        ];

        $validator = Validator::make($request->all(), [
          'username'   => 'required|max:15|alpha_dash|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])/',
          'password' => 'required|string|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
        ]);

        if ($validator->fails()) {
          return response()->json([
            'error'   => 1,
            'message' => $validator->messages(),
          ], 200);
        } else {
          if ($auth->attempt($credentials)) {
            $request->session()->put('username', $request->username);
            return response()->json([
              'error'   => 0,
              'message' => 'Login Success',
              'username'   => $request->username
            ], 200);
          } else {
            return response()->json([
              'error'   => 2,
              'message' => 'Wrong Username or Password'
            ], 200);
          }
        }
    }

    public function logoutAdmin(Request $request){
        $request->session()->forget('username');
        return redirect()->route('loginPage');
    }


    //KOORDINATOR
    public function dataKoordinator(Request $request){
        if(!$request->session()->exists('username')){
            return redirect()->route('loginPage');
        }else{
          $username = $request->session()->get('username');
          $name  = DB::table('tb_admin')
                      ->where('username', $username)
                      ->value('nama_admin');

          $koordinator = Koordinator::all();
          return view('admin.dataKoordinator', compact(
              'name','koordinator'
          ));
        }
    }

    //TOKO
    public function dataToko(Request $request){
      if(!$request->session()->exists('username')){
          return redirect()->route('loginPage');
      }else{
        $username = $request->session()->get('username');
        $name  = DB::table('tb_admin')
                    ->where('username', $username)
                    ->value('nama_admin');

        $toko = DB::table('tb_toko')
                ->select('tb_toko.kd_toko', 'tb_toko.KTP', 'tb_toko.nama_toko','tb_toko.foto_toko', 'tb_toko.no_rekening', 'user.nama_lengkap as nama_lengkap', 'provinsi.province as provinsi', 'kota.city_name as kota', 'kota.type as type', 'koordinator.nama_lengkap as nama_koor')
                ->join('tb_token as token', 'token.id_token', '=', 'tb_toko.id_token')
                ->join('tb_koordinator as koordinator', 'koordinator.kd_koordinator', '=', 'token.kd_koordinator')
                ->join('tb_user as user', 'user.kd_user', '=', 'tb_toko.kd_user')
                ->join('tb_kota as kota', 'kota.city_id', '=', 'tb_toko.city_id')
                ->join('tb_provinsi as provinsi', 'provinsi.province_id', '=', 'kota.province_id')
                ->get();

        $user = User::all();
        return view('admin.dataToko', compact(
            'name','toko','user'
        ));
      }
    }

    //JENIS BARANG
    public function dataJenisBarang(Request $request){
      if(!$request->session()->exists('username')){
          return redirect()->route('loginPage');
      }else{
        $username = $request->session()->get('username');
        $name  = DB::table('tb_admin')
                    ->where('username', $username)
                    ->value('nama_admin');

        $jenisBarang = JenisBarang::all();
        return view('admin.dataJenisBarang', compact(
            'name','jenisBarang'
        ));
      }
    }

}
