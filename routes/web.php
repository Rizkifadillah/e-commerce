<?php

use Illuminate\Support\Facades\Route;

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

Route::get('cek-cart', function () {
    $cek =\Cart::getContent();
    dd($cek);
});

Route::get('/', 'Beranda_Controller@index');

Route::get('/keluar', function () {
    \Auth::logout();
    return redirect('/login');
});

Auth::routes();

Route::get('/home', function(){
    return redirect('/admin');
});

Route::prefix('front')->group(function(){
    Route::get('kategori/{id}','Kategori_controller@index');
    
    Route::get('produk/search','Produk_controller@search');
    
    Route::get('produk/{id}','Produk_controller@detail');

    Route::get('add-cart/{id}','Cart_controller@add');

    Route::get('detail-cart','Cart_controller@detail');
    Route::get('hapus-cart/{id}','Cart_controller@hapus');

    Route::get('get-kota/{id_provinsi}','Cart_controller@get_kota_ajax');

    Route::get('cek-ongkir/{asal}/{tujuan}/{kurir}/{berat}','Cart_controller@get_ongkir');

    //ajax midtrans
    Route::get('checkout/{grand_total}/{servis}','Cart_controller@checkout');

});


Route::group(['middleware'=>'auth'],function(){
    
    Route::get('/admin', 'Admin\Beranda_Controller@index');

    //master kategori
    Route::get('/kategori/add', 'Admin\Kategori_controller@create');
    Route::post('/kategori/add', 'Admin\Kategori_controller@store');

    Route::get('/kategori', 'Admin\Kategori_controller@index');

    Route::get('/kategori/{id}', 'Admin\Kategori_controller@edit');
    Route::put('/kategori/{id}', 'Admin\Kategori_controller@update');

    Route::delete('/kategori/{id}', 'Admin\Kategori_controller@delete');

    

    //master produk
    Route::get('/produk/add', 'Admin\Produk_Controller@create');
    Route::post('/produk/add', 'Admin\Produk_Controller@store');

    Route::get('/produk', 'Admin\Produk_Controller@index');

    Route::get('/produk/{id}', 'Admin\Produk_Controller@edit');
    Route::put('/produk/{id}', 'Admin\Produk_Controller@update');

    Route::delete('/produk/{id}', 'Admin\Produk_Controller@delete');

     //master produk
     Route::get('/featured-produk', 'Admin\Produk_Controller@featured');
     Route::put('/featured-produk', 'Admin\Produk_Controller@featured_update');

     Route::get('alamat','Admin\Alamat_controller@index');
     Route::get('alamat/get-kota/{id_provinsi}','Admin\Alamat_controller@get_kota_ajax');
     Route::post('alamat','Admin\Alamat_controller@store');

});

