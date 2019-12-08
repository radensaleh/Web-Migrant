<?php

namespace App\Http\Controllers;

use DB;
use App\Transaksi;
use App\Pesanan;
use App\Suspend;
use App\Barang;
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
                    ->select('kd_barang', 'kd_toko', 'nama_barang', 'jenis.jenis_barang as jenis_barang', 'harga_jual', 'deskripsi', 'foto_barang', 'berat_barang', 'status_barang', 'satuan_barang', 'harga_modal_barang', 'status_stok')
                    ->join('tb_jenis_barang as jenis', 'jenis.id_jenis', '=', 'tb_barang.id_jenis')
                    ->where('kd_toko', $kd_toko)
                    ->get();

        $dataBarang = array();
        foreach ($barang as $value) {
              $masukan = DB::table('produk_masuk')
                         ->select(DB::raw('SUM(qty_produk) as qty_masuk'))
                         ->where('id_produk', $value->kd_barang)
                         ->value('qty_masuk');

              $keluar = DB::table('produk_keluar')
                         ->select(DB::raw('SUM(qty_produk_keluar) as qty_keluar'))
                         ->where('id_produk', $value->kd_barang)
                         ->value('qty_keluar');

              $stok = $masukan - $keluar;

              $data['kd_barang']    = $value->kd_barang;
              $data['nama_barang']  = $value->nama_barang;
              $data['jenis_barang'] = $value->jenis_barang;
              $data['harga_jual']   = $value->harga_jual;
              $data['deskripsi']    = $value->deskripsi;
              $data['foto_barang']  = $value->foto_barang;
              $data['berat_barang'] = $value->berat_barang;
              $data['status_barang']= $value->status_barang;
              $data['satuan_barang']= $value->satuan_barang;
              $data['harga_modal_barang']= $value->harga_modal_barang;
              $data['status_stok']  = $value->status_stok;
              $data['stok']         = $stok;
            //   $data['nama_toko']    = $value->nama_toko;
              $data['kd_toko']      = $value->kd_toko;
              $dataBarang[] = $data;
        }

        $objBarang = collect($dataBarang)->map(function ($barang) {
            return (object) $barang;
        });

        $nama_toko = DB::table('tb_toko')
                     ->where('kd_toko', $kd_toko)
                     ->value('nama_toko');

        return view('koordinator.toko.dataBarang', compact(
            'name', 'kd_koordinator', 'objBarang', 'nama_toko'
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

    public function suspendBarang(Request $request){
       $suspend = Suspend::create($request->all());
       if( $suspend ){
         $barang = Barang::findOrFail($request->kd_barang);
         $barang->status_barang = 1;
         $barang->update();

         if( $barang ){
           return response()->json([
             'error' => 0,
             'message' => 'Success Suspend Data',
             'kd_toko' => $request->kd_toko
           ], 200);
         }

       }else{
         return response()->json([
           'error' => 1,
           'message' => 'Failed Suspend Data',
           'kd_toko' => $request->kd_toko
         ], 200);
       }
    }

    public function verifBarang(Request $request){
       $kd_barang = $request->kd_barang;
       $verif = Suspend::where('kd_barang', '=', $kd_barang)->first();

       try {
         $verif->delete();

         if( $verif ){
           $barang = Barang::findOrFail($kd_barang);
           $barang->status_barang = 0;
           $barang->update();

           if( $barang ){
             return response()->json([
               'error' => 0,
               'message' => 'Success Verification Data',
               'kd_toko' => $request->kd_toko
             ], 200);
           }

         }

       } catch (\Exception $e) {
           return response()->json([
             'error' => 1,
             'message' => 'Failed Verification Data',
             'kd_toko' => $request->kd_toko
           ], 500);
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
