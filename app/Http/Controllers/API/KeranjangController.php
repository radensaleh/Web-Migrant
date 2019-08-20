<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Keranjang;

class KeranjangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Get Keranjang by kd_user
    public function index($kd_user)
    {
        $keranjang = Keranjang::where('kd_user',$kd_user)->first();

        if ($keranjang==null) {
            return response()->json([
                'response' => false,
                'message' => 'Tidak ada keranjang'
            ]);
        }
        else {
            return response()->json([
                $keranjang
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
    //Create Keranjang
    public function createKeranjang(Request $request)
    {
        $user = User::where('kd_user', $request->input('kd_user'))->first();

        if($user==null) {
            return response()->json([
                'response' => false,
                'message' => 'Kode user is not found !'
            ]);
        }

        if ($keranjang = Keranjang::save($request->all())) {
            return response()->json([
                'response' => true,
                'message' => 'Success create Keranjang '
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
    //Update Keranjang
    public function updateKeranjang(Request $request)
    {
        $keranjang = Keranjang::findOrFail($request->$kd_user);
        $keranjang->update($request->all());

        if($keranjang) {
            return response()->json([
                'response' => true,
                'message' => 'Success update keranjang'
            ],200);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_keranjang)
    {
        $keranjang = Keranjang::destroy($id_keranjang);

        if ($keranjang) {
            return response()->json([
                'response' => true,
                'message' => 'Keranjang berhasil di hapus'
            ],200);
        }
    }
}
