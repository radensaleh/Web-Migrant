<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\ListBarang;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ListBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Get Barang terlaris
    public function barangTerlaris()
    {

        $terlaris = DB::table('tb_list_barang')
        ->join('tb_barang', 'tb_barang.kd_barang', '=', 'tb_list_barang.kd_barang')
        ->select('tb_list_barang.kd_barang','tb_list_barang.harga as harga_jual','tb_barang.nama_barang', 'tb_barang.foto_barang',DB::raw('SUM(kuantitas) as terjual'))
        ->groupBy('kd_barang')
        ->orderBy('kuantitas', 'desc')
        ->take(10)->get();

        if($terlaris) {
            return response()->json(
                $terlaris
            );
        }
        else
        {
            return response()->json([
                'response' => false,
                'message' => 'Tidak ada barang terlaris'
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
