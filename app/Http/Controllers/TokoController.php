<?php

namespace App\Http\Controllers;

use DB;
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
}
