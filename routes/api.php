<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//Login
Route::post("/Login", "API\UserController@login");

<<<<<<< HEAD
Route::post("/Login", "UserController@login");

//api validasi tokens
Route::post("validasiToken", "API\TokenAPIController@checkToken");
=======
//Register
Route::post("/Register", "API\UserController@register");

//Update data User
Route::put("/UserUpdate", "API\UserController@updateUser");
>>>>>>> e2edeb2abf8b29736f4da2a14e566b749f7e5d83
