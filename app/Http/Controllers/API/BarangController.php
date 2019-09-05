<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Barang;
use App\ListBarang;
use Illuminate\Support\Facades\DB;
use App\Toko;
use App\JenisBarang;
use Carbon\Carbon;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Get All barang on table tb_barang
    public function index()
    {
        $barangs = Barang::where('status_barang', 0)->get();

        if($barangs==null) {
            return response()->json([
                'response' => false,
                'message' => 'List Barang tidak tersedia !'
            ]);
        }
        else {
            return response()->json(
                $barangs
            );
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Create Barang
    /*Parameter
        -kd_toko
        -nama_barang
        -id_jenis
        -stok
        -harga_jual
        -deskripsi
        -foto_barang
        -berat_barang
    */
    public function createBarang(Request $request )
    {
        $barang = new Barang;
        $getDate = Carbon::now('Asia/Jakarta');
        $tgl = str_replace('-','', $getDate);
        $jam = str_replace(':','', $tgl);
        $kd_barang = 'BRG'.str_replace(' ','',$jam);
        $barang->kd_barang = $kd_barang;

        //findKode Toko
        $kd_toko = Toko::where('kd_toko',($request->kd_toko))->first();
        if($kd_toko==null) {
            return response()->json([
                'response' => true,
                'message' => 'Cant Find Kode Toko !'
            ]);
        }

        $barang->kd_toko = $request->kd_toko;
        $barang->nama_barang = $request->input('nama_barang');

        //Find ID Jenis
        $id_jenis = JenisBarang::where('id_jenis', $request->id_jenis)->first();
        if($id_jenis==null) {
            return [
                'response' => false,
                'message' => 'Cant find ID Jenis !'
            ];
        }
        $barang->id_jenis = $request->id_jenis;
        $barang->stok = $request->input('stok');
        $barang->harga_jual = $request->input('harga_jual');
        $barang->deskripsi = $request->input('deskripsi');
        $barang->foto_barang = $request->input('foto_barang');
        $barang->berat_barang = $request->input('berat_barang');
        $barang->status_barang = 0;

        if($barang->save()) {
            return response()->json([
                'response' => true,
                'message' => 'Barang created successfull'
            ]);
        }
        else
        {
            return response()->json([
                'response' => false,
                'message' => 'Failed !'
            ]);
        }

    }
//Show By ID
/*Parameter
    -kd_barang
*/
    public function showById(Request $request){

      $kd_barang= $request->kd_barang;
      //Cek kd_barang ada di tb_list_barang ?
      $listBarang = ListBarang::where('kd_barang',$kd_barang);
      //handle barang yg gak ada di tb_list_barang
      $barang2 = DB::table('tb_barang')
      ->where('tb_barang.kd_barang', $kd_barang)
      ->join('tb_toko', 'tb_toko.kd_toko', '=', 'tb_barang.kd_toko')
      ->join('tb_kota', 'tb_kota.city_id', '=', 'tb_toko.city_id')
      ->join('tb_provinsi', 'tb_provinsi.province_id', '=', 'tb_kota.province_id')
      ->select('tb_barang.kd_barang','tb_barang.nama_barang','tb_barang.deskripsi',
      'tb_barang.stok as tersedia','tb_barang.foto_barang', 'tb_toko.kd_toko','tb_toko.nama_toko',
      'tb_toko.foto_toko', 'tb_kota.city_name', 'tb_kota.type', 'tb_provinsi.province')
      ->first();

      $barang = DB::table('tb_barang')
      ->where('tb_barang.kd_barang', $kd_barang)
      ->join('tb_list_barang', 'tb_list_barang.kd_barang', '=', 'tb_barang.kd_barang')
      ->join('tb_toko', 'tb_toko.kd_toko', '=', 'tb_barang.kd_toko')
      ->join('tb_kota', 'tb_kota.city_id', '=', 'tb_toko.city_id')
      ->join('tb_provinsi', 'tb_provinsi.province_id', '=', 'tb_kota.province_id')
      ->select('tb_barang.kd_barang','tb_barang.nama_barang','tb_barang.deskripsi',
      'tb_barang.stok as tersedia','tb_barang.foto_barang', 'tb_toko.kd_toko','tb_toko.nama_toko',
      'tb_toko.foto_toko', 'tb_kota.city_name', 'tb_kota.type', 'tb_provinsi.province', 'tb_list_barang.kuantitas as terjual')
      ->first();
      if($barang==null) {
          return response()->json(
              $barang2
          );
      }
      else {
          return response()->json(
            $barang
          );
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /*Parameter
        -id_jenis
    */
    public function showByCategory()
    {
        $id_jenis=request()->id_jenis;
        $barang = Barang::where('id_jenis',$id_jenis)->where('status_barang', 0)->get();
        if($barang==null) {
            return response()->json([
                'response' => true,
                'message' => 'Barang tidak ada !'
            ]);
        }
        else {
            return response()->json(
                $barang
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //Menampilkan semua barang berdasarkan kd_toko
    /*Parameter
        -kd_toko
    */
    public function show(Request $request)
    {
        $barang = Barang::where('kd_toko', $request->kd_toko)->where('status_barang', 0)->get();

        if($barang==null) {
            return response()->json([
                'response' => false,
                'message' => 'Tidak ada barang !'
            ]);
        }
        else {
            return response()->json([
                $barang
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteBarang(Request $request)
    {
        $barang = Barang::destroy($request->kd_barang);
        if($barang) {
            return response()->json([
                'response' => true,
                'message' => 'Barang deleted !'
            ]);
        }
        else
        {
            return response()->json([
                'response' => false,
                'message' => 'Failed !'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //Kode Barang
    /*Parameter
            -kd_barang ->required
            "nama_barang": "Kue", ->optional
            "id_jenis": 1, -> optional
            "stok": 30, -> optional
            "harga_jual": 10000, -> optional
            "deskripsi": "Kue ini enaaaaaak banget", -> optional
            "foto_barang": "http://foto.com", -> optional
            "berat_barang": 2, -> optional
            "status_barang": "0", -> optional
    */
    public function update(Request $request)
    {
        $barang = Barang::findOrFail($request->kd_barang);
        $barang->update($request->all());

        if($barang) {
            return response()->json([
                'response' => true,
                'message' => 'Success Update Barang'
            ],200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getBarangTerbaru()
    {
        $newestBarang = Barang::where('status_barang', 0)
        ->orderBy('created_at', 'desc')
        ->take(10)
        ->get();

        if($newestBarang) {
            return response()->json(
                $newestBarang
            );
        }
        else
        {
            return response()->json([
                'response' => false,
                'message' => 'Tidak ada Barang !'
            ]);
        }
    }
}
