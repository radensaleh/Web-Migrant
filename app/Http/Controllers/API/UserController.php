<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\User;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\User as UserResource;
use App\Http\Controllers\Controller;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $user = DB::table('tb_user')->where('email', '=', $email)->
        where('password', '=', $password)->first();

        if($user==null) {
            return [
                'status' => '404'
            ];
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
        $user = new User;

        $user->kd_user = $request->input('kd_user');
        $user->nama_lengkap = $request->input('nama_lengkap');
        $user->jenis_kelamin = $request->input('jenis_kelamin');
        $user->nomer_hp = $request->input('nomer_hp');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->provinsi = $request->input('provinsi');
        $user->daerah = $request->input('daerah');
        $user->nama_daerah = $request->input('nama_daerah');
        $user->detail_alamat = $request->input('detail_alamat');
        $user->status = $request->input('status');
        $user->foto_user = $request->input('foto_user');

        if($user->save()) {
            return [
                'status' => 'Success'
            ];
        }
    }

//Update User Identity
    // public function updateUser(Request $request)
    // {
    //     $user = User::findOrFail($request->kd_user);

    //     $user->kd_user = $request->input('kd_user');
    //     $user->nama_lengkap = $request->input('nama_lengkap');
    //     $user->jenis_kelamin = $request->input('jenis_kelamin');
    //     $user->nomer_hp = $request->input('nomer_hp');
    //     $user->email = $request->input('email');
    //     $user->password = $request->input('password');
    //     $user->provinsi = $request->input('provinsi');
    //     $user->daerah = $request->input('daerah');
    //     $user->nama_daerah = $request->input('nama_daerah');
    //     $user->detail_alamat = $request->input('detail_alamat');
    //     $user->status = $request->input('status');
    //     $user->foto_user = $request->input('foto_user');

    //     if($user->save()) {
    //         return new UserResource($user);
    //     }
    // }

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
