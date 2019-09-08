<?php

namespace App\Http\Controllers\API;

use App\Transaksi;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    /* Parameter
        -kd_transaksi,
        -foto_bukti
    */
    public function uploadPembayaran(Request $request)
    {
        $transaksi = Transaksi::findOrFail($request->kd_transaksi);
        $fotoBukti = $request->file('foto_bukti');

        $fotoBukti->move(public_path().'/images/bukti_tf', $request->kd_transaksi. "." .$fotoBukti->getClientOriginalExtension());
        $transaksi->foto_bukti = $request->kd_transaksi. "." .$fotoBukti->getClientOriginalExtension();

        if($transaksi->save()) {
            DB::table('tb_pesanan')->where('kd_transaksi', $request->kd_transaksi)->update(['id_status' => 2]);
            return response()->json([
                'response' => true,
                'message' => 'upload bukti pembayaran success'
            ]);
        } else
        {
            return response()->json([
                'response' => false,
                'message' => 'upload failed !'
            ]);
        }
    }

    public function getTransaksi(){
      $kd_user=request()->kd_user;
      $transaksi = Transaksi::where('kd_user', $kd_user)->where('foto_bukti', null)->get();

      return response()->json(
        $transaksi
      );
    }

    public function getTransaksiById(){
      $kd_transaksi=request()->kd_transaksi;
      $transaksi = Transaksi::where('kd_transaksi', $kd_transaksi)->first();

      return response()->json(
        $transaksi
      );
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
