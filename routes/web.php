<?php

use App\User;

//Aşağıdaki adresten route ları kontrol edebilirsiniz
//https://docs.spatie.be/laravel-permission/v3/basic-usage/middleware/


Route::get('/', function () {
    return view('welcome'); 
});

//arac-detay sayfası
Route::get('/arac-detay/{id?}', 'AdminController@aracDetay')->name('arac-Detay');
//
// Fatura Sayfası
Route::get('/fatura', function () {
    return view('fatura');
});
//
Auth::routes();

//AracController
Route::get('/aracdetay/{plaka?}', 'AracController@aracDetay')->name('aracDetay');
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['role:super-admin']], function () {
    //

    
});
Route::group(['middleware' => ['role:admin']], function () {
    //RoleController
    Route::resource('roles','RoleController');

    //UserController
    Route::resource('users','UserController');

    //HomeController 
    Route::get('/musterilerim', 'HomeController@musterilerim');

    //AdminController
    Route::post('/musteriKayit', 'AdminController@musteriKayit')->name('musteriKayit');

    //AdminController Musteri
    Route::post('/musteriGuncelle/{id?}', 'AdminController@musteriGuncelle')->name('musteriGuncelle');
    Route::post('/musteriSil/{id?}', 'AdminController@musteriSil')->name('musteriSil');

    //AdminController Araç
    Route::post('/aracGuncelle/{id?}/{mid?}', 'AdminController@aracGuncelle')->name('aracGuncelle');
    Route::post('/aracSil/{id?}', 'AdminController@aracSil')->name('aracSil');

});
Route::group(['middleware' => ['role:admin|musteri']], function () {

     //HomeController 
     Route::get('/profile', 'HomeController@profile')->name('profile');
     Route::get('/araclarim', 'HomeController@araclarim');
});












