<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Koordinator;
use App\Toko;
use App\JenisBarang;
use App\User;
use App\Transaksi;
use App\Pesanan;
use App\Keuntungan;
use App\Historis;

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
          $konfirm = Transaksi::whereHas('pesanan', function($query){
              $query->where('id_status', 1);
          })->count();

          $prosesTransaksi = Transaksi::whereHas('pesanan', function($query){
              $query->where('id_status', 2);
              $query->orWhere('id_status', 3);
              $query->orWhere('id_status', 4);
          })->count();

          $dataTransaksi = Transaksi::whereHas('pesanan', function($query){
              $query->where('id_status', 5);
          })->count();

          $riwayat = Historis::count();

          return view('admin.dashboard', compact(
              'name','koordinator','toko','jenisBarang','konfirm', 'prosesTransaksi', 'dataTransaksi', 'riwayat'
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

    //KONFIRMASI PEMBAYARAN
    public function dataKonfirmasiPembayaran(Request $request){
      if(!$request->session()->exists('username')){
          return redirect()->route('loginPage');
      }else{
        $username = $request->session()->get('username');
        $name  = DB::table('tb_admin')
                    ->where('username', $username)
                    ->value('nama_admin');

        $transaksi = Transaksi::
                     whereHas('pesanan', function($query){
                       $query->where('id_status', 1);
                      })->get();

        return view('admin.dataKonfirmasiPembayaran', compact(
            'name','transaksi'
        ));
      }
    }

    //DATA PESANAN di Konfirmasi Pembayaran
    public function dataPesanan(Request $request){
      if(!$request->session()->exists('username')){
          return redirect()->route('loginPage');
      }else{
        $username = $request->session()->get('username');
        $name  = DB::table('tb_admin')
                    ->where('username', $username)
                    ->value('nama_admin');

        $kd_transaksi = $request->kd_transaksi;

        $pesanan = Pesanan::
                     whereHas('transaksi', function($query){
                       $query->where('kd_transaksi', request('kd_transaksi'));
                      })->get();

        return view('admin.dataPesananKonfirmasi', compact(
            'name','pesanan','kd_transaksi'
        ));
      }
    }

    //DATA PESANAN di Data Pembayaran
    public function dataPesanan2(Request $request){
      if(!$request->session()->exists('username')){
          return redirect()->route('loginPage');
      }else{
        $username = $request->session()->get('username');
        $name  = DB::table('tb_admin')
                    ->where('username', $username)
                    ->value('nama_admin');

        $kd_transaksi = $request->kd_transaksi;

        $pesanan = Pesanan::
                     whereHas('transaksi', function($query){
                       $query->where('kd_transaksi', request('kd_transaksi'));
                      })->get();

        return view('admin.dataPesananProses', compact(
            'name','pesanan','kd_transaksi'
        ));
      }
    }

    //DATA PROSES TRANSAKSI
    public function dataProsesTransaksi(Request $request){
      if(!$request->session()->exists('username')){
          return redirect()->route('loginPage');
      }else{
        $username = $request->session()->get('username');
        $name  = DB::table('tb_admin')
                    ->where('username', $username)
                    ->value('nama_admin');

        $transaksi = Transaksi::
                     whereHas('pesanan', function($query){
                       $query->where('id_status', 2);
                       $query->orWhere('id_status', 3);
                       $query->orWhere('id_status', 4);
                      })->get();

        return view('admin.dataProsesTransaksi', compact(
            'name','transaksi'
        ));
      }
    }

    //KONFIRMASI TRANSAKSI
    public function konfirmPembayaran(Request $request){
      $kd_transaksi = $request->kd_transaksi;

      $konfirm = Pesanan::where('kd_transaksi', $kd_transaksi)
                 ->update(['id_status' => 2]);

      $total_harga = $request->total_harga;
      $keuntungan  = ($total_harga * 5)/100;

      if( $konfirm ){
        $keuntungan = Keuntungan::create([
          'kd_transaksi' => $kd_transaksi,
          'keuntungan'   => $keuntungan
        ]);

        if($keuntungan){
          return response()->json([
            'error'   => 0,
            'message' => 'Konfirmasi Transaksi ' . $kd_transaksi . ' Berhasil',
          ], 200);
        }

      }else{
        return response()->json([
          'error'   => 1,
          'message' => 'Konfirmasi Transaksi Gagal',
        ], 200);
      }
    }

    //DATA TRANSAKSI TELAH DITERIMA
    public function dataTransaksiDiterima(Request $request){
      if(!$request->session()->exists('username')){
          return redirect()->route('loginPage');
      }else{
        $username = $request->session()->get('username');
        $name  = DB::table('tb_admin')
                    ->where('username', $username)
                    ->value('nama_admin');

        $transaksi = Transaksi::
                     whereHas('pesanan', function($query){
                       $query->where('id_status', 5);
                      })->get();

        return view('admin.dataTransaksiDiterima', compact(
            'name','transaksi'
        ));
      }
    }

    //DATA PESANAN di Data Transaksi
    public function dataPesanan3(Request $request){
      if(!$request->session()->exists('username')){
          return redirect()->route('loginPage');
      }else{
        $username = $request->session()->get('username');
        $name  = DB::table('tb_admin')
                    ->where('username', $username)
                    ->value('nama_admin');

        $kd_transaksi = $request->kd_transaksi;

        $pesanan = Pesanan::
                     whereHas('transaksi', function($query){
                       $query->where('kd_transaksi', request('kd_transaksi'));
                     })->where('id_status', 5)->get();

        return view('admin.dataPesananTransaksi', compact(
            'name','pesanan','kd_transaksi'
        ));
      }
    }

    //RIWAYAT TRANSFER
    public function dataRiwayatTransfer(Request $request){
      if(!$request->session()->exists('username')){
          return redirect()->route('loginPage');
      }else{
        $username = $request->session()->get('username');
        $name  = DB::table('tb_admin')
                    ->where('username', $username)
                    ->value('nama_admin');

        $transaksi = Transaksi::
                     whereHas('pesanan', function($query){
                        $query->where('id_status', 6);
                     })->get();

        return view('admin.dataRiwayatTransfer', compact(
            'name', 'transaksi'
        ));
      }
    }

    //DATA PESANAN di Riwayat Tranfer
    public function dataPesanan4(Request $request){
      if(!$request->session()->exists('username')){
          return redirect()->route('loginPage');
      }else{
        $username = $request->session()->get('username');
        $name  = DB::table('tb_admin')
                    ->where('username', $username)
                    ->value('nama_admin');

        $kd_transaksi = $request->kd_transaksi;

        $pesanan = Pesanan::
                     whereHas('transaksi', function($query){
                       $query->where('kd_transaksi', request('kd_transaksi'));
                     })->where('id_status', 6)->get();

        return view('admin.dataPesananTransfer', compact(
            'name','pesanan','kd_transaksi'
        ));
      }
    }

    //UPLOAD BUKTI TRANSFER
    public function uploadBuktiTF(Request $request){
        $foto = $request->file('foto_bukti');
        $kd_pesanan = $request->kd_pesanan;
        $kd_transaksi = $request->kd_transaksi;

        $historis = [
            'kd_pesanan' => $kd_pesanan
        ];

        if($foto != ""){
					$path = 'images/bukti_tf/';
					$historis['foto_bukti'] = $kd_pesanan. '.' . $foto->getClientOriginalExtension();
					$foto->move($path, $historis['foto_bukti']);

          try{
            $create = Historis::create($historis);

            if($create){
              $pesanan = Pesanan::where('kd_pesanan', $kd_pesanan)
                         ->update(['id_status' => 6]);

              return response()->json([
                'error'   => 0,
                'message' => 'Upload Bukti Tranfer Pesanan ' . $kd_pesanan . ' Berhasil',
                'kd_transaksi' => $kd_transaksi
              ], 200);
            }else{
              return response()->json([
                'error'   => 2,
                'message' => 'Upload Gagal',
                'kd_transaksi' => $kd_transaksi
              ], 200);
            }
          }catch(QueryException $e){
            return response()->json([
              'error'   => 1,
              'message' => $e->errorInfo,
              'kd_transaksi' => $kd_transaksi
            ], 200);
          }

				}else{
          return response()->json([
            'error'   => 3,
            'message' => 'Foto kosong',
            'kd_transaksi' => $kd_transaksi
          ], 200);
        }

    }

}
