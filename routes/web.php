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
Auth::routes();
Route::get('/','Auth\LoginController@showLoginForm');

Route::get('/home', 'HomeController@index')->name('home');


//SISWA
Route::get('aspirasisiswa/{username}','HomeController@aspirasisiswa');
Route::get('siswa/{username}','HomeController@siswa');


Route::post('siswa/{username}/update','HomeController@siswaupdate');
Route::post('aspirasisiswa/{username}/insert','HomeController@aspirasiinsert');
Route::get('aspirasisiswa/{username}/delete/{id}','HomeController@aspirasidelete');
Route::post('deletedata','HomeController@deletedata');



//GURU
Route::get('aspirasiguru/{username}','HomeController@aspirasiguru');
Route::get('guru/{username}','HomeController@guru');

Route::post('guru/{username}/update','HomeController@guruupdate');
Route::get('aspirasiguru/{username}/{id}','HomeController@aspirasiguruid');
Route::get('statistik/{username}','HomeController@statistik');