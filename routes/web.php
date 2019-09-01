<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    echo 'belum jadi';
});

//RESOURCE
Route::resource('data-jenis_barang', 'JenisBarangController');
Route::resource('data-token', 'TokenController');
Route::resource('data-koordinator', 'KoordinatorController');

// ADMIN
Route::get('/admin/login', 'AdminController@loginPage')->name('loginPage');
Route::post('/admin/loginAdmin', 'AdminController@loginAdmin')->name('loginAdmin');
Route::get('/admin/logoutAdmin', 'AdminController@logoutAdmin')->name('logoutAdmin');
Route::get('/admin/dashboard', 'AdminController@dashboard')->name('dashboardAdmin');
Route::get('/admin/dataKoordinator', 'AdminController@dataKoordinator')->name('dataKoordinator');
Route::get('/admin/dataToko', 'AdminController@dataToko')->name('dataToko');
Route::get('/admin/dataKonfirmasiPembayaran', 'AdminController@dataKonfirmasi')->name('dataKonfirmasi');
Route::get('/admin/konfirmasi_pembayaran/toko/{kd_transaksi}/dataPesanan', 'AdminController@dataPesanan');
Route::get('/admin/dataPembayaran', 'AdminController@dataPembayaran')->name('dataPembayaran');
Route::get('/admin/dataPembayaran/toko/{kd_transaksi}/dataPesanan', 'AdminController@dataPesanan2');
Route::post('/admin/transaksi/konfirmasiPembayaran', 'AdminController@konfirmPembayaran')->name('konfirmPembayaran');
// Jenis Barang
Route::get('/admin/dataJenisBarang', 'AdminController@dataJenisBarang')->name('dataJenisBarang');

// KOORDINATOR
Route::get('/koordinator/login', 'KoordinatorController@loginPage')->name('loginPageKoor');
Route::post('/koordinator/loginKoordinator', 'KoordinatorController@loginKoordinator')->name('loginKoordinator');
Route::get('/koordinator/logoutKoordinator', 'KoordinatorController@logoutKoordinator')->name('logoutKoordinator');
Route::get('/koordinator/dashboard', 'KoordinatorController@dashboard')->name('dashboardKoordinator');
Route::get('/koordinator/dataToken', 'KoordinatorController@dataToken')->name('dataToken');
Route::get('/koordinator/dataToko', 'KoordinatorController@dataToko')->name('koorDataToko');
Route::get('/koodinator/apiRajaOngkir/getProvince', 'KoordinatorController@getProvince');
Route::post('/koodinator/apiRajaOngkir/getKabKota', 'KoordinatorController@getKabKota');
Route::post('/koodinator/apiRajaOngkir/getTypeDaerah', 'KoordinatorController@getTypeDaerah');
// KOORDINATOR - DATA BARANG TOKO
Route::get('/koordinator/toko/{kd_toko}/dataBarang', 'TokoController@dataBarang');
Route::get('/koordinator/toko/{kd_toko}/dataPesanan', 'TokoController@dataPesanan')->name('koorDataPesanan');
// Route::get('/koordinator/toko/{kd_toko}/dataTransaksi', 'TokoController@dataTransaksi')->name('koorDataTransaksi');
// Route::get('/koordinator/toko/{kd_toko}/{kd_transaksi}/dataPesanan', 'TokoController@dataPesanan');

//Raja Ongkir
//Route::get('/api/rajaongkir/databases', 'RajaOngkirContoller@apiRajaOngkir');
