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

Route::get('/kasir', function () {
    return redirect('/kasir/dashboard');
});

Route::get('/manager', function () {
    return redirect('/manager/dashboard');
});

Auth::routes();

Route::group(['prefix' => 'kasir',  'middleware' => 'auth-kasir'], function() {
   Route::get('dashboard', 'Kasir\HomeController@index')->name('kasir.home');

   Route::resource('transaksi', 'Kasir\TransaksiController');

   Route::resource('pelanggan', 'Kasir\PelangganController');

   Route::resource('laporan', 'Kasir\LaporanController');
   Route::get('transaksi/part/{id}', 'Kasir\TransaksiController@getDetailPart')->name('kasir.part');
   Route::get('transaksi/service/{id}', 'Kasir\TransaksiController@getDetailService')->name('kasir.service');
   Route::get('transaksi/{id}/done', 'Kasir\TransaksiController@done')->name('transaksi.done');
   Route::get('transaksi/{id}/delete', 'Kasir\TransaksiController@delete')->name('transaksi.delete');
   Route::get('transaksi/{id}/invoice', 'Kasir\TransaksiController@invoice')->name('transaksi.invoice');

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

    Route::get('transaksi/{year}/count', 'Manager\HomeController@getCountYear')->name('transaksi.yearcount');
    Route::get('transaksi/{year}/montir', 'Manager\HomeController@montirYear')->name('transaksi.yearmontir');
    Route::get('transaksi/{month}/{year}', 'Manager\HomeController@getData')->name('transaksi.monthyear');
    Route::get('transaksi/{month}/{year}/count', 'Manager\HomeController@getCount')->name('transaksi.monthyearcount');
    Route::get('transaksi/{month}/{year}/part', 'Manager\HomeController@getCountSparePart')->name('transaksi.monthyearpart');
    Route::get('transaksi/{month}/{year}/montir', 'Manager\HomeController@montirMonth')->name('transaksi.monthmontir');
    Route::get('transaksi/{year}', 'Manager\HomeController@getDataYear')->name('transaksi.year');

    Route::get('laporan/umum', 'Manager\LaporanController@umum')->name('laporan.umum');
    Route::get('laporan/{tgl}/khusus', 'Manager\LaporanController@khusus')->name('laporan.khusus');
    Route::get('laporan_bulanan/umum', 'Manager\LaporanBulananController@umum')->name('laporan_bulanan.umum');
    Route::get('laporan_bulanan/{tgl}/khusus', 'Manager\LaporanBulananController@khusus')->name('laporan_bulanan.khusus');
    Route::get('laporan_tahunan/umum', 'Manager\LaporanTahunanController@umum')->name('laporan_tahunan.umum');
    Route::get('laporan_tahunan/{tgl}/khusus', 'Manager\LaporanTahunanController@khusus')->name('laporan_tahunan.khusus');
    Route::get('laporan_range/{oldest}/{newest}/cetak', 'Manager\LaporanRangeController@cetak')->name('laporan_range.cetak');

    Route::resource('sparepart', 'Manager\SparePartController');
    Route::resource('servis', 'Manager\ServisController');
    Route::resource('montir', 'Manager\MontirController');
    Route::resource('kasir', 'Manager\KasirController');
    Route::put('sparepart/{id}/stok', 'Manager\SparePartController@updateStok')->name('sparepart.stok');
    Route::resource('transaksi', 'Manager\TransaksiController');
    Route::resource('pelanggan', 'Manager\PelangganController');
    Route::resource('laporan', 'Manager\LaporanController');
    Route::resource('laporan_bulanan', 'Manager\LaporanBulananController');
    Route::resource('laporan_tahunan', 'Manager\LaporanTahunanController');
    Route::resource('laporan_range', 'Manager\LaporanRangeController');
    Route::resource('laporan_part', 'Manager\LaporanPartController');

});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
