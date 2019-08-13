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

// ADMIN
Route::get('/admin/login', 'AdminController@loginPage')->name('loginPage');
Route::post('/admin/loginAdmin', 'AdminController@loginAdmin')->name('loginAdmin');
Route::get('/admin/logoutAdmin', 'AdminController@logoutAdmin')->name('logoutAdmin');
Route::get('/admin/dashboard', 'AdminController@dashboardAdmin')->name('dashboardAdmin');

// KOORDINATOR
