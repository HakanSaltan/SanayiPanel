<?php

use App\User;

//Aşağıdaki adresten route ları kontrol edebilirsiniz
//https://docs.spatie.be/laravel-permission/v3/basic-usage/middleware/


Route::get('/', function () {
    return view('welcome'); 
});





Auth::routes();

//AracController
Route::get('/detay/{plaka?}', 'AracController@detay')->name('detay');
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['role:super-admin']], function () {


    
});
Route::group(['middleware' => ['role:admin']], function () {

    //RoleController
    Route::resource('roles','RoleController');

    //UserController
    Route::resource('users','UserController');

    //HomeController 
    Route::get('/musterilerim', 'HomeController@musterilerim');

    //AdminController - Musteri
    Route::post('/musteriGuncelle/{id?}', 'AdminController@musteriGuncelle')->name('musteriGuncelle');
    Route::post('/musteriSil/{id?}', 'AdminController@musteriSil')->name('musteriSil');
    Route::post('/musteriKayit', 'AdminController@musteriKayit')->name('musteriKayit');
    Route::get('/arac-detay/{id?}', 'AdminController@aracDetay')->name('arac-Detay');

    //AdminController - Araç
    Route::post('/aracGuncelle/{id?}/{mid?}', 'AdminController@aracGuncelle')->name('aracGuncelle');
    Route::post('/aracSil/{id?}', 'AdminController@aracSil')->name('aracSil');

    //MuhasebeController - Fatura
    Route::get('/fatura/{fatura?}', 'MuhasebeController@fatura')->name('fatura');
    Route::get('/hizmet/{arac_id?}', 'MuhasebeController@hizmet')->name('hizmet');

    Route::post('/hizmetEkle', 'MuhasebeController@hizmetEkle')->name('hizmetEkle');

});
Route::group(['middleware' => ['role:admin|musteri']], function () {

     //HomeController 
     Route::get('/profile', 'HomeController@profile')->name('profile');
     Route::get('/araclarim', 'HomeController@araclarim');

});












