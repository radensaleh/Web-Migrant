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
use Ixudra\Curl\Facades\Curl;


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


       $auth = auth()->guard('users');
       $credentials = [
            'email' => $email,
            'password' => $password
       ];

        if(!$auth->attempt($credentials)) {
            return response()->json([
                'status' => '404',
            ]);
        }
        else {
            $user = DB::table('tb_user')->where('email', '=', $email)->first();
            return response()->json(
                $user
            );
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
    /*Parameter
        -nama_lengkap
        -jenis_kelamin (1/0)
        -nomer_hp (0-9)
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
        $rand = $jam . rand(1, 1000);
        $kd_user = 'USR'.str_replace(' ','',$rand);

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

        //cek email
        $cekEmail = DB::table('tb_user')
                    ->where('email', $request->input('email'))
                    ->count();

        //input tabel pemilik toko pos
        $pos = DB::table('pemilik_toko')
               ->insert([
                 'id_pemilik_toko' => $kd_user,
                 'username' => $request->input('email'),
                 'nama_lengkap' => $request->input('nama_lengkap'),
                 'password' => $request->input('password'),
                 'no_hp' => $request->input('nomer_hp')
               ]);

         // $pos = Curl::to('http://migranshop.com/api/register.php')
         //             ->withData(array(
         //                'id_pemilik_toko' => $kd_user,
         //                'nama_lengkap' => $request->input('nama_lengkap'),
         //                'username' => $request->input('email'),
         //                'password' => $request->input('password'),
         //                'no_hp' => $request->input('nomer_hp')
         //             ))
         //             ->post();
        if($cekEmail > 0){
            return response()->json([
                'status' => '404',
                'message' => 'Email sudah terdaftar'
            ]);
        }else{
          if($user->save() && $pos) {
              return response()->json([
                  'status' => '200',
                  'nama_lengkap' => $request->input('nama_lengkap'),
                  'kd_user' => $kd_user
              ]);
          } else {
              return response()->json([
                  'status' => '404',
                  'message' => 'Registrasi Gagal'
              ]);
          }
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
        else
        {
            return response()->json([
                'response' => false,
                'message' => "Failed !"
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
