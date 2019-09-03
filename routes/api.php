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
Route::post("/UserUpdate", "API\UserController@updateUser");

//Register Toko
Route::post("/RegisterToko", "API\TokoController@register");

//Update Data Toko -> Require Kd_toko and Data to be Change
Route::post("/Toko", "API\TokoController@update");

//Get Data toko by id user
Route::get("/Toko", "API\TokoController@getToko");

//Bank
Route::get("/Bank", "API\BankController@index");

//JenisBarang
Route::get("/JenisBarang", "API\JenisBarangController@index");

//Create JenisBarang
Route::post("/JenisBarang", "API\JenisBarangController@createCategory");

//Create Barang / Menambah Barang
Route::post("/Barang", "API\BarangController@createBarang");

//Get All Barang
Route::get("/Barang", "API\BarangController@index");

//Menampilkan semua barang berdasarkan kd_toko
Route::get("/getBarangByToko", "API\BarangController@show");

//Update Barang
Route::post("/BarangUpdate", "API\BarangController@update");

//Delete Barang
Route::delete("/BarangDelete","API\BarangController@deleteBarang");

//menampilkan semua barang berdasarkan kategori
Route::get("/BarangKategori","API\BarangController@showByCategory");

//menampilkan barang berdasarkan kd_barang
Route::get("/BarangID","API\BarangController@showById");

//Create Keranjang
Route::post("/Keranjang","API\KeranjangController@tambahBarangKeranjang");

//Update Keranjang
Route::post("/UpdateKeranjang", "API\KeranjangController@updateKeranjang");

//Get Keranjang by kd_user
Route::get("/Keranjang", "API\KeranjangController@index");

//Delete Keranjang
Route::delete("/Keranjang", "API\KeranjangController@destroy");

//Create List Barang Keranjang
Route::post("/ListKeranjang", "API\ListBarangKeranjang@createListKeranjang");

//Get list Barang Keranjang by id_keranjang
Route::get("/ListKeranjang/{id_keranjang}", "API\ListBarangKeranjang@index");

//update List Barang Keranjang by id_list_keranjang
Route::put("/ListKeranjang", "API\ListBarangKeranjang@update");

//delete List Barang Keranjang by id_list_keranjang
Route::delete("/ListKeranjang", "API\ListBarangKeranjang@destroy");

//Create Pesanan
Route::post("/Pesanan", "API\PesananController@createPesanan");

//Upload no resi
Route::post("/Resi", "API\PesananController@upload");

//Konfirmasi Barang diterima
Route::post("/Selesai", "API\PesananController@finish");

//Get Pesanan by kd_toko
Route::post("/getPesananToko", "API\PesananController@getPesananByToko");
//
Route::get("/Provinsi", "API\ProvinsiAPIController@show");

//GetSuspendByToko
Route::post("/Suspend", "API\SuspendController@getSuspendByToko");

//Konfirmasi Pesanan Sedang Diproses Oleh Penjual
Route::post("/ProsesPesanan", "API\PesananController@konfirmasiPesanan");

//Delete Barang dikeranjang
Route::post("/deletebarangkeranjang", "API\KeranjangController@deleteBarangKeranjang");
