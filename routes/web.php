<?php
use Illuminate\Support\Facades\DB;
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
	return view('welcome');
});


Route::get('/home/keluar/{id}','homeController@keluar');

Route::post('/home/absen','homeController@absen')->name('absen');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['prefix' => 'admin','middleware' => ['admin','auth']], function(){
	Route::resource('/', 'AdminController');
	Route::get('/hapus/{name}','AdminController@hapus');
	Route::get('/edit/{id}','AdminController@edit');
	Route::post('/proses','AdminController@proses');
	Route::post('/update','AdminController@update');
	Route::get('/register','AdminController@register');
	Route::get('/home', 'AdminController@home')->name('home');

});
