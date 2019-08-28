<?php

namespace App\Http\Controllers;

use DB;
use App\Transaksi;
use App\Pesanan;
use Illuminate\Http\Request;

class TokoController extends Controller
{
    public function dataBarang(Request $request){
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

        $kd_toko = $request->kd_toko;

        $barang = DB::table('tb_barang')
                    ->select('kd_barang', 'nama_barang', 'jenis.jenis_barang as jenis_barang', 'stok', 'harga_jual', 'deskripsi', 'foto_barang', 'berat_barang')
                    ->join('tb_jenis_barang as jenis', 'jenis.id_jenis', '=', 'tb_barang.id_jenis')
                    ->where('kd_toko', $kd_toko)
                    ->get();

        $nama_toko = DB::table('tb_toko')
                     ->where('kd_toko', $kd_toko)
                     ->value('nama_toko');

        return view('koordinator.toko.dataBarang', compact(
            'name', 'kd_koordinator', 'barang', 'nama_toko'
        ));

      }
    }

    public function dataPesanan(Request $request){
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

        $kd_toko = $request->kd_toko;

        $nama_toko = DB::table('tb_toko')
                     ->where('kd_toko', $kd_toko)
                     ->value('nama_toko');

        $pesanan = Pesanan::whereHas('list_barang', function($q){
            $q->whereHas('barang', function($q){
                $q->where('kd_toko', request('kd_toko'));
            });
        })->get();

        return view('koordinator.toko.dataPesanan', compact(
            'name', 'kd_koordinator', 'pesanan', 'nama_toko', 'kd_toko'
        ));

      }
    }

    // public function dataTransaksi(Request $request){
    //   if(!$request->session()->exists('koordinator')){
    //     return redirect()->route('loginPageKoor');
    //   }else{
    //     $koor = $request->session()->get('koordinator');
    //     $name = DB::table('tb_koordinator')
    //             ->where('nomer_hp', $koor)
    //             ->orWhere('email', $koor)
    //             ->value('nama_lengkap');
    //
    //     $kd_koordinator = DB::table('tb_koordinator')
    //                 ->where('nomer_hp', $koor)
    //                 ->orWhere('email', $koor)
    //                 ->value('kd_koordinator');
    //
    //     $kd_toko = $request->kd_toko;
    //
    //     $nama_toko = DB::table('tb_toko')
    //                  ->where('kd_toko', $kd_toko)
    //                  ->value('nama_toko');
    //
    //    $transaksi = Transaksi::
    //                  whereHas('pesanan', function($query){
    //                       $query->whereHas('list_barang', function($query){
    //                         $query->whereHas('barang', function($query){
    //                           $query->where('kd_toko', request('kd_toko'));
    //                         });
    //                       });
    //                   })->get();
    //
    //     return view('koordinator.toko.dataTransaksi', compact(
    //        'name', 'kd_koordinator', 'transaksi', 'nama_toko', 'kd_toko'
    //     ));
    //
    //   }
    // }
    //
    // public function dataPesanan(Request $request){
    //   if(!$request->session()->exists('koordinator')){
    //     return redirect()->route('loginPageKoor');
    //   }else{
    //     $koor = $request->session()->get('koordinator');
    //     $name = DB::table('tb_koordinator')
    //             ->where('nomer_hp', $koor)
    //             ->orWhere('email', $koor)
    //             ->value('nama_lengkap');
    //
    //     $kd_koordinator = DB::table('tb_koordinator')
    //                 ->where('nomer_hp', $koor)
    //                 ->orWhere('email', $koor)
    //                 ->value('kd_koordinator');
    //
    //     $kd_toko = $request->kd_toko;
    //     $kd_transaksi = $request->kd_transaksi;
    //
    //     $nama_toko = DB::table('tb_toko')
    //                  ->where('kd_toko', $kd_toko)
    //                  ->value('nama_toko');
    //
    //     $pesanan = DB::table('tb_pesanan')
    //                ->select('kd_pesanan', 'kd_transaksi', 'total_harga', 'ongkir', 'no_resi', 'kota.city_name as kota', 'kota.type', 'status.status', 'provinsi.province')
    //                ->join('tb_status as status', 'status.id_status', '=', 'tb_pesanan.id_status')
    //                ->join('tb_kota as kota', 'kota.city_id', '=', 'tb_pesanan.city_id')
    //                ->join('tb_provinsi as provinsi', 'provinsi.province_id', '=', 'kota.province_id')
    //                ->where('kd_transaksi', $kd_transaksi)
    //                ->get();
    //
    //     return view('koordinator.toko.dataPesanan', compact(
    //         'name', 'kd_koordinator', 'pesanan', 'nama_toko', 'kd_toko', 'kd_transaksi'
    //     ));
    //
    //   }
    // }
}
