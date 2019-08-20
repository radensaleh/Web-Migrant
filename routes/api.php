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
//Validasi Token

Route::post("validasiToken", "API\TokenAPIController@checkToken");
//Register
Route::post("/Register", "API\UserController@register");

//Update data User -> Require kd_user and Data to be Change
Route::put("/UserUpdate", "API\UserController@updateUser");

//Register Toko
Route::post("/RegisterToko", "API\TokoController@register");

//Update Data Toko -> Require Kd_toko and Data to be Change
Route::put("/Toko", "API\TokoController@update");

//Get Data toko by id user
Route::get("/Toko/{kd_user}", "API\TokoController@getToko");

//Bank
Route::get("/Bank", "API\BankController@index");

//JenisBarang
Route::get("/JenisBarang", "API\JenisBarangController@index");

//Create Barang / Menambah Barang
Route::post("/Barang", "API\BarangController@createBarang");

//Get All Barang
Route::get("/Barang", "API\BarangController@index");

//Menampilkan semua barang berdasarkan kd_toko
Route::get("/Barang/{kd_toko}", "API\BarangController@show");

//Update Barang
Route::post("/BarangUpdate", "API\BarangController@update");

//Delete Barang
Route::get("/BarangDelete/{kd_barang}","API\BarangController@deleteBarang");

//menampilkan semua barang berdasarkan kategori
Route::get("/BarangKategori/{id_jenis}","API\BarangController@showByCategory");
