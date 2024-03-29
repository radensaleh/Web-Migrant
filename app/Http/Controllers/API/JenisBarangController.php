<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\JenisBarang;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class JenisBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jenisBarang = DB::table('tb_jenis_barang')->get();

        if($jenisBarang==null) {
            return response()->json([
                'response' => false,
                'message' => 'Jenis Barang is not available'
            ]);
        } else {
            return response()->json(
                $jenisBarang
            );
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Create Category
    /*Parameter
        -jenis_barang
    */
    public function createCategory(Request $request)
    {
        $jenis_barang = $request->jenis_barang;
        $jenisBarang = new JenisBarang;
        $jenisBarang->jenis_barang = $jenis_barang;

        if($jenisBarang->save()) {
            return response()->json([
                'response' => true,
                'message' => 'Success create category'
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
