<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Barang;
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
        $barangs = Barang::all();

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

        $barang->kd_toko = $kd_toko;
        $barang->nama_barang = $request->input('nama_barang');

        //Find ID Jenis
        $id_jenis = JenisBarang::where('id_jenis', $request->id_jenis)->first();
        if($id_jenis==null) {
            return [
                'response' => false,
                'message' => 'Cant find ID Jenis !'
            ];
        }
        $barang->id_jenis = $id_jenis;
        $barang->stok = $request->input('stok');
        $barang->harga_jual = $request->input('harga_jual');
        $barang->harga_modal = $request->input('harga_modal');
        $barang->deskripsi = $request->input('deskripsi');
        $barang->foto_barang = $request->input('foto_barang');
        $barang->berat_barang = $request->input('berat_barang');
        $barang->status = $request->input('status');

        if($barang->save()) {
            return response()->json([
                'response' => true,
                'message' => 'Barang created successfull'
            ]);
        }

    }

    public function showById(){
      $kd_barang=request()->kd_barang;
      $barang = Barang::where('kd_barang',$kd_barang)->first();
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function showByCategory()
    {
        $id_jenis=request()->id_jenis;
        $barang = Barang::where('id_jenis',$id_jenis)->get();
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
    //Menampilkan semua barang berdasarkan id_toko
    public function show($kd_toko)
    {
        $barang = Barang::where('kd_toko', $kd_toko)->get();

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
    public function deleteBarang($kd_barang)
    {
        $barang = Barang::destroy($kd_barang);
        if($barang) {
            return response()->json([
                'response' => true,
                'message' => 'Barang deleted !'
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
    public function destroy($id)
    {
        //
    }
}
