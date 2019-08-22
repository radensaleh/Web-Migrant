<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\User;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\User as UserResource;
use App\Http\Controllers\Controller;
use Carbon\Carbon;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    /* Parameter :
        -email
        -password
    */
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $user = DB::table('tb_user')->where('email', '=', $email)->
        where('password', '=', $password)->first();

        if($user==null) {
            return response()->json(
            [
                'status' => false,
                'message' => 'Login Failed !'
            ]);
        }
        else {
            return response()->json([
                $user
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
        $tanggal = Carbon::now()->format('d.m.Y');

        return $tanggal;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    /*Parameter
        -nama_lengkap
        -jenis_kelamin (1/0)
        -nomor HP (0-9)
        -email
        -password
        -city_id
        -detail_alamat

    */
    {
        $user = new User;

        $getDate = Carbon::now('Asia/Jakarta');
        $tgl = str_replace('-','', $getDate);
        $jam = str_replace(':','', $tgl);
        $kd_user = 'USR'.str_replace(' ','',$jam);

        $user->kd_user = $kd_user;
        $user->nama_lengkap = $request->input('nama_lengkap');
        $user->jenis_kelamin = $request->input('jenis_kelamin');
        $user->nomer_hp = $request->input('nomer_hp');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->city_id = $request->input('city_id');
        $user->detail_alamat = $request->input('detail_alamat');
        // $user->foto_user = $request->input('foto_user');
        $user->status = 0;

        if($user->save()) {
            return response()->json([
                'response' => true,
                'message' => 'Success'
            ]);
        } else 
        {
            return response()->json([
                'response' => false,
                'message' => 'Registration Failed !'
            ]);
        }

    }

//Update User Identity
    public function updateUser(Request $request)
    /*Parameter
        -kd_user -> Required !
        -nama_lengkap -> Optional
        -jenis_kelamin (1/0) ->optional
        -nomor HP (0-9) ->optional
        -email ->optional
        -password ->optional
        -city_id ->optional
        -detail_alamat ->optional
        -foto user ->optional

    */
    {
        $user = User::findOrFail($request->kd_user);
        $user->update($request->all());

        if($user) {
            return response()->json([
                'response' => true,
                'message' => "Berhasil Update Data User"
            ], 200);
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
