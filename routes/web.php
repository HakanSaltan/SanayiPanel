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

use App\User;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//AracController
Route::get('/aracdetay/{plaka?}', 'AracController@aracDetay')->name('aracDetay');

//HomeController 
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile', 'HomeController@profile')->name('profile');
Route::get('/musterilerim', 'HomeController@musterilerim');
Route::get('/araclarim', 'HomeController@araclarim');

//AdminController
Route::post('/musteriKayit', 'AdminController@musteriKayit')->name('musteriKayit');

//AdminController Araç
Route::get('/aracGuncelle/{id?}/{mid?}', 'AdminController@aracGuncelle')->name('aracGuncelle');
Route::get('/aracSil/{id?}', 'AdminController@aracSil')->name('aracSil');

//AdminController Musteri
Route::get('/musteriGuncelle/{id?}', 'AdminController@musteriGuncelle')->name('musteriGuncelle');
Route::get('/musteriSil/{id?}', 'AdminController@musteriSil')->name('musteriSil');

