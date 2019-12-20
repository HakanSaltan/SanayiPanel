<?php

use App\Http\Middleware\Ayar;
use App\User;

//Aşağıdaki adresten route ları kontrol edebilirsiniz
//https://docs.spatie.be/laravel-permission/v3/basic-usage/middleware/


Route::get('/', function () {
    return view('welcome'); 
});

Route::get('/ayar', function () {
    return view('ayar'); 
});

Auth::routes();

//AracController
Route::get('/detay/{plaka?}', 'AracController@detay')->name('detay');

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/plakaKontrol', 'AracController@plakaKontrol')->name('plakaKontrol');
Route::get('/aracDetay/{plaka?}', 'AracController@aracDetay')->name('aracDetay');



Route::group(['middleware' => ['role:super-admin']], function () {

    
    //RoleController
    Route::resource('roles','RoleController');

    //UserController
    Route::resource('users','UserController');

    
});
Route::group(['middleware' => ['role:admin']], function () {

    //HomeController 
    Route::get('/musterilerim', 'HomeController@musterilerim');

    //AdminController - Musteri
    Route::post('/musteriEkle', 'AdminController@musteriEkle')->name('musteriEkle');
    Route::post('/musteriGuncelle', 'AdminController@musteriGuncelle')->name('musteriGuncelle');
    Route::post('/musteriSil', 'AdminController@musteriSil')->name('musteriSil');
    Route::post('/musteriKayit', 'AdminController@musteriKayit')->name('musteriKayit');
    Route::post('/firmaKayit', 'AdminController@firmaKayit')->name('firmaKayit');
    

    //AdminController - Araç
    Route::post('/aracEkle', 'AdminController@aracEkle')->name('aracEkle');
    Route::post('/aracGuncelle', 'AdminController@aracGuncelle')->name('aracGuncelle');
    Route::post('/aracSil', 'AdminController@aracSil')->name('aracSil');
    Route::post('/musteriArac', 'AdminController@musteriArac')->name('musteriArac');

    //MuhasebeController - Fatura
    Route::post('/faturaOlustur', 'MuhasebeController@faturaOlustur')->name('faturaOlustur');
    Route::get('/fatura/{fatura?}', 'MuhasebeController@fatura')->name('fatura');
    Route::get('/hizmet/{arac_id?}', 'MuhasebeController@hizmet')->name('hizmet');

    Route::post('/hizmetEkle', 'MuhasebeController@hizmetEkle')->name('hizmetEkle');

});
Route::group(['middleware' => ['role:admin|musteri']], function () {

     //HomeController 
     Route::get('/profile', 'HomeController@profile')->name('profile');
     Route::get('/araclarim', 'HomeController@araclarim');

});












