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

Route::get('/', 'ShopController@index');

Route::get('/product/{id}', 'ShopController@show');

Auth::routes(['register' => false]);

/* Admin
--------------------------------------------------------------------------*/
Route::get('/admin', function () {
    return view('admin.app');
})->name('admin.app')->middleware('auth');

Route::group(['prefix' => 'admin'], function(){
	// Produk
	Route::resource('/produk', 'admin\ProdukController');
	Route::post('/produk/data', 'admin\ProdukController@getData')->name('admin.produk.data');
	Route::post('/produk/image-delete', 'admin\ProdukController@deleteImage')->name('admin.produk.deleteImage');

	// Kategori
	Route::resource('/kategori', 'admin\KategoriController');
	Route::post('/kategori/data', 'admin\KategoriController@getData')->name('admin.kategori.data');;
});
