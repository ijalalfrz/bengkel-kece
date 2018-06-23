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
    return redirect('/login');
    // return view('welcome');
});

Auth::routes();

Route::group(['prefix' => 'kasir',  'middleware' => 'auth-kasir'], function() {
   Route::get('dashboard', 'Kasir\HomeController@index')->name('kasir.home');

   Route::resource('transaksi', 'Kasir\TransaksiController');
   Route::get('transaksi/part/{id}', 'Kasir\TransaksiController@getDetailPart')->name('kasir.part');
   Route::get('transaksi/service/{id}', 'Kasir\TransaksiController@getDetailService')->name('kasir.service');
   Route::get('transaksi/{id}/done', 'Kasir\TransaksiController@done')->name('transaksi.done');
   Route::get('transaksi/{id}/delete', 'Kasir\TransaksiController@delete')->name('transaksi.delete');

});

Route::group(['prefix' => 'kasir'], function() {


// Login Routes...
    Route::get('login', ['as' => 'kasir.login', 'uses' => 'AuthKasir\LoginController@showLoginForm']);
    Route::post('login', ['uses' => 'AuthKasir\LoginController@login']);
    Route::post('logout', ['as' => 'kasir.logout', 'uses' => 'AuthKasir\LoginController@logout']);

// Registration Routes...
    Route::get('register', ['as' => 'kasir.register', 'uses' => 'AuthKasir\RegisterController@showRegistrationForm']);
    Route::post('register', ['uses' => 'AuthKasir\RegisterController@register']);

// Password Reset Routes...
    Route::get('password/reset', ['as' => 'kasir.password.reset', 'uses' => 'AuthKasir\ForgotPasswordController@showLinkRequestForm']);
    Route::post('password/email', ['as' => 'kasir.password.email', 'uses' => 'AuthKasir\ForgotPasswordController@sendResetLinkEmail']);
    Route::get('password/reset/{token}', ['as' => 'kasir.password.reset.token', 'uses' => 'AuthKasir\ResetPasswordController@showResetForm']);
    Route::post('password/reset', ['uses' => 'AuthKasir\ResetPasswordController@reset']);
});

Route::group(['prefix' => 'manager',  'middleware' => 'auth-manager'], function() {

    Route::get('dashboard', 'Manager\HomeController@index')->name('manager.home');

    Route::resource('sparepart', 'Manager\SparePartController');
    Route::resource('servis', 'Manager\ServisController');
    Route::resource('montir', 'Manager\MontirController');
    Route::resource('kasir', 'Manager\KasirController');
    Route::put('sparepart/{id}/stok', 'Manager\SparePartController@updateStok')->name('sparepart.stok');
    Route::resource('transaksi', 'Manager\TransaksiController');
    Route::resource('pelanggan', 'Manager\PelangganController');
    Route::resource('laporan', 'Manager\LaporanController');

});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
