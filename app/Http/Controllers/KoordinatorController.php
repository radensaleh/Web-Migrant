<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KoordinatorController extends Controller
{
    public function loginPage(Request $request){
      if($request->session()->exists('koordinator')){
        return redirect()->route('dashboardKoordinator');
      }else{
        return view('koordinator.loginKoordinator');
      }
    }

    public function dashboard(Request $request){
      if(!$request->session()->exists('koordinator')){
        return redirect()->route('loginPageKoor');
      }else{
        $koor = $request->session()->get('koordinator');
        $name = DB::table('tb_koordinator')
                ->where('nomer_hp', $koor)
                ->orWhere('email', $koor)
                ->value('nama_lengkap');
        return view('koordinator.dashboard', compact(
            'name'
        ));
      }
    }

    public function loginKoordinator(Request $request){
        $auth = auth()->guard('koordinator');

        $credentials = [
          'email'    => $request->email,
          'password' => $request->password,
        ];

        $validator = Validator::make($request->all(), [
          'email'       => 'required|email|max:255|unique:users',
          'password' => 'required|string|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
        ]);

        if ($validator->fails()) {
          return response()->json([
            'error'   => 1,
            'message' => $validator->messages(),
          ], 200);
        } else {
          if ($auth->attempt($credentials)) {
            $request->session()->put('koordinator', $request->email);
            return response()->json([
              'error'   => 0,
              'message' => 'Login Success',
              'email'   => $request->email
            ], 200);
          } else {
            return response()->json([
              'error'   => 2,
              'message' => 'Wrong Email or Password'
            ], 200);
          }
        }
    }

    public function logoutKoordinator(Request $request){
      $request->session()->forget('koordinator');
      return redirect()->route('loginPageKoor');
    }
}
