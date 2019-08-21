<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Toko;
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
    public function getToko($kd_user)
    {
        $toko = DB::table('tb_toko')->where('kd_user', $kd_user)->first();

        if($toko==null) {
            return response()->json([
                'response' => false,
                'message' => 'Toko is not available, probably wrong kd_user !'
            ]);
        } else
        {
            return response()->json([
                $toko
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
    public function register(Request $request)
    {
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

        $user = DB::table('tb_user')->where('nama_lengkap', $request->nama_lengkap)->first();
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

        $bank = DB::table('tb_bank')->first();

        $toko = new Toko;
        $getDate = Carbon::now();
        $tgl = str_replace('-','', $getDate);
        $jam = str_replace(':','', $tgl);
        $kd_toko = 'TK'.str_replace(' ','',$jam);

        $toko->kd_toko = $kd_toko;
        $toko->id_token = $token->id_token;
        $toko->KTP = $request->input('ktp');
        $toko->nama_toko = $request->input('nama_toko');
        $toko->foto_toko = $request->input('foto_toko');
        $toko->kd_user = $user->kd_user;
        $toko->no_rekening = $bank->no_rekening;

        if($toko->save()) {
            DB::table('tb_user')->where('nama_lengkap', $request->nama_lengkap)->update(['status' => '1']);
            DB::table('tb_token')->where('token', $kd_token)->update(['status' => '1']);
            return response()->json([
                'response' => true,
                'message' => 'Success'
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
