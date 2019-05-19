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
	return view('auth/login');
});


Route::get('/home/keluar/{id}','HomeController@keluar');

Route::post('/home/absen','HomeController@absen')->name('absen');
Route::post('/home/izin','HomeController@izin')->name('izin');
Route::post('/home/sakit','HomeController@sakit')->name('sakit');
Route::get('/home/permohonan','HomeController@permohonan')->name('permohonan');
Route::get('/home/edit_profile','HomeController@edit_profile')->name('edit_profile');
Route::get('/home/profile','HomeController@profile')->name('profile');
Route::post('/home/update','HomeController@update')->name('update');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['prefix' => 'admin','middleware' => ['admin','auth']], function(){
	Route::resource('/', 'AdminController');
	Route::get('/hapus/{name}','AdminController@hapus');
	Route::get('/edit/{id}','AdminController@edit');
	Route::post('/proses','AdminController@proses');
	Route::post('/update','AdminController@update')->name('update');
	Route::get('/register','AdminController@register');
	Route::get('/home', 'AdminController@home')->name('home');
	Route::get('/permohonan', 'AdminController@permohonan')->name('permohonan');
	Route::get('/konfirmasi/{id}','AdminController@konfirmasi');
	Route::get('/batal/{id}','AdminController@batal');
	Route::get('/cari','AdminController@cari');
	Route::get('/cari_p','AdminController@cari_p');
	Route::get('/cari_a','AdminController@cari_a');
	Route::get('/hapus_p/{id}','AdminController@hapus_p');
	Route::get('/edit_p/{id}','AdminController@edit_p');
	Route::post('/update_p','AdminController@update_p')->name('update_p');
});
