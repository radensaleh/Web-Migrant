<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ListBarangKeranjang;
use Illuminate\Support\Facades\DB;

class ListBarangKeranjangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id_keranjang)
    {
        $listKeranjang = ListBarangKeranjang::where('id_keranjang', $id_keranjang)->first();

        if($listKeranjang==null) {
            return response()->json([
                'response' => false,
                'message' => 'Tidak ada List Barang Keranjang'
            ]);
       }
       else {
           response()->json([
              $listKeranjang
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
    public function createListKeranjang(Request $request)
    {
        $keranjang = Keranjang::where('id_keranjang', $request->$id_keranjang)->first();

        if($keranjang==null) {
            return response()->json([
                'response' => false,
                'message' => 'id_keranjang tidak ditemukan'
            ]);
        }

        if($listKeranjang = ListBarangKeranjang::save($request->all())) {
            return response()->json([
                'response' => true,
                'message' => 'Berhasil create List Baranag Keranjang'
            ]);
        }

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
    public function update(Request $request)
    {
        $listKeranjang = ListBarangKeranjang::findOrFail($request->$id_list_keranjang);
        $listKeranjang->update($request->all());

        if($listKeranjang) {
            return response()->json([
                'response' => true,
                'message' => 'Success update List Barang Keranjang '
            ],200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $listKeranjang = ListBarangKeranjang::destroy($request->$id_list_keranjang);

        if($listKeranjang) {
            return response()->json([
                'response' => true,
                'message' => 'Berhasil delete List Barang Keranjang !'
            ],200);
        }
    }
}
