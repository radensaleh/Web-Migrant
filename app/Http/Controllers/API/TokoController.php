<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Toko;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\Toko as TokoResource;
use Carbon\Carbon;

class TokoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getToko(Request $request)
    /*Paramter
        -kd_user -> required !
    */
    {
        $kd_user = $request->kd_user;
        $toko = DB::table('tb_toko')->where('kd_user', $kd_user)->first();

        if($toko==null) {
            return response()->json([
                'response' => false,
                'message' => 'Toko is not available, probably wrong kd_user !',
                $kd_user
            ]);
        } else
        {
            return response()->json(
                $toko
            );
        }
    }

    public function getAllToko(Request $request){
        $data = DB::table('tb_toko')
                ->select('tb_toko.kd_toko', 'tb_toko.KTP', 'tb_toko.nama_toko','tb_toko.foto_toko',
                 'tb_toko.no_rekening', 'provinsi.province as provinsi', 'kota.city_name as kota',
                 'kota.type as type',DB::raw('COUNT(tb_transaksi.kd_transaksi) as terjual')) //total terjual belum
                ->join('tb_kota as kota', 'kota.city_id', '=', 'tb_toko.city_id')
                ->join('tb_barang', 'tb_barang.kd_toko', '=', 'tb_toko.kd_toko')
                ->join('tb_list_barang', 'tb_list_barang.kd_barang', '=', 'tb_barang.kd_barang')
             ->join('tb_pesanan', 'tb_pesanan.kd_pesanan', '=', 'tb_list_barang.kd_pesanan')
             ->join('tb_transaksi', 'tb_transaksi.kd_transaksi', '=', 'tb_pesanan.kd_transaksi')
                ->groupBy('tb_toko.kd_toko')
                ->join('tb_provinsi as provinsi', 'provinsi.province_id', '=', 'kota.province_id')
                ->get();

        // $data2 = DB::table('tb_toko')
        //         ->select(DB::raw('COUNT(tb_transaksi.kd_transaksi) as terjual')) //total terjual belum
        //        ->join('tb_kota as kota', 'kota.city_id', '=', 'tb_toko.city_id')
        //        ->join('tb_barang', 'tb_barang.kd_toko', '=', 'tb_toko.kd_toko')
        //        ->join('tb_list_barang', 'tb_list_barang.kd_barang', '=', 'tb_barang.kd_barang')
        //        ->join('tb_pesanan', 'tb_pesanan.kd_pesanan', '=', 'tb_list_barang.kd_pesanan')
        //        ->join('tb_transaksi', 'tb_transaksi.kd_transaksi', '=', 'tb_pesanan.kd_transaksi')
        //        ->groupBy('tb_toko.kd_toko')
        //        ->join('tb_provinsi as provinsi', 'provinsi.province_id', '=', 'kota.province_id')
        //        ->get();

        return response()->json($data);
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

    public function register(Request $request)
    {
        /*
    "kd_user" : "USR001",
	"token" : "xyzxyz",
	"ktp" : "1234567789",
	"nama_toko" : "Eka Shop",
    "city_id" : 1,
    "no_rekening" : "example",
    "nama_bank" : "BRI",
    "nama_nasabah :"Eka Rahadi"
        */
        $toko = new Toko;

        $kd_token = $request->input('token');

        $token = DB::table('tb_token')->where('token', $kd_token)->first();
        if($token==null) {
            return response()->json([
                'response' =>false,
                'mesaage' =>'Token is not available !'
            ]);
        }
        else if ($token->status=='1') {
            return response()->json([
                'response' => false,
                'mesaage' => 'Token already used !'
            ]);
        }

        $user = DB::table('tb_user')->where('kd_user', $request->kd_user)->first();
        if($user==null) {
            return response()->json([
                'response' => false,
                'message' => 'User doesnt exist'
            ]);
        } else if ($user->status=='1') {
            return response()->json([
                'response' => false,
                'message' => 'User already have a store'
            ]);
        }

        $toko = new Toko;
        $getDate = Carbon::now('Asia/Jakarta');
        $tgl = str_replace('-','', $getDate);
        $jam = str_replace(':','', $tgl);
        $kd_toko = 'TK'.str_replace(' ','',$jam);

        $toko->kd_toko = $kd_toko;
        $toko->id_token = $token->id_token;
        $toko->KTP = $request->ktp;
        $toko->nama_toko = $request->nama_toko;
        $toko->kd_user = $user->kd_user;
        $toko->no_rekening = $request->no_rekening;
        $toko->city_id = $request->city_id;
        $toko->nama_bank = $request->nama_bank;
        $toko->nama_nasabah = $request->nama_nasabah;

        if($toko->save()) {
            DB::table('tb_user')->where('kd_user', $request->kd_user)->update(['status' => '1']);
            DB::table('tb_token')->where('token', $kd_token)->update(['status' => '1']);
            return response()->json([
                'response' => true,
                'message' => 'Success'
            ]);
        } else {
            return response()->json([
                'response' => false,
                'message' => 'Failed !'
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
    //Update Toko
    public function update(Request $request)
    /* Parameter
        -kd_toko -> Required
        ktp; -> optional
        nama_toko; -> optional
        kd_user; -> optional
        no_rekening; -> optional
        city_id; -> optional
        nama_bank; -> optional
        nama_nasabah -> optional

    */
    {
        $toko = Toko::findOrFail($request->kd_toko);
        $toko->update($request->all());

        if($toko) {
            return response()->json([
                'response' => true,
                'mesaage' => 'Success Update Data Toko '
            ], 200);
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
