<?php

Route::post('/login', 'LoginController@login');
Route::get('/', 'LoginController@checkAuth');
Route::get('/logout', 'LoginController@logout');

Route::group(['middleware' => ['auth', 'role:superadmin']], function () {
    Route::get('/beranda', 'SuperadminController@beranda');
    Route::get('/paket', 'SuperadminController@paket');
    Route::get('/paket/create', 'SuperadminController@paketcreate');
    Route::post('/paket/create', 'SuperadminController@paketstore');
    Route::get('/paket/edit/{id}', 'SuperadminController@paketedit');
    Route::post('/paket/edit/{id}', 'SuperadminController@paketupdate');
    Route::get('/paket/delete/{id}', 'SuperadminController@paketdelete');

    Route::get('/pelanggan', 'SuperadminController@pelanggan');
    Route::get('/pelanggan/create', 'SuperadminController@pelanggancreate');
    Route::post('/pelanggan/create', 'SuperadminController@pelangganstore');
    Route::get('/pelanggan/edit/{id}', 'SuperadminController@pelangganedit');
    Route::post('/pelanggan/edit/{id}', 'SuperadminController@pelangganupdate');
    Route::get('/pelanggan/delete/{id}', 'SuperadminController@pelanggandelete');

    Route::get('/pemesanan', 'SuperadminController@pemesanan');
    Route::get('/pemesanan/create', 'SuperadminController@pemesanancreate');
    Route::get('/pemesanan/batal', 'SuperadminController@pemesananbatal');
    Route::post('/pemesanan/create', 'SuperadminController@pemesananstore');

    Route::get('/pemesanan/print/{id}', 'SuperadminController@pemesananprint');
    Route::get('/pemesanan/delete/{id}', 'SuperadminController@pemesanandelete');
    Route::get('/keranjang/delete/{id}', 'SuperadminController@keranjangdelete');

    Route::get('/pelunasan', 'SuperadminController@pelunasan');
    Route::get('/pelunasan/bayar/{id}', 'SuperadminController@pelunasanbayar');
    Route::post('/pelunasan/bayar/{id}', 'SuperadminController@simpanpelunasanbayar');
    Route::get('/pelunasan/print/{id}', 'SuperadminController@pelunasanprint');

    Route::get('/laporan/pemesanan', 'LaporanController@pemesanan');
    Route::get('/laporan/pelunasan', 'LaporanController@pelunasan');
    Route::get('/laporan/pelanggan', 'LaporanController@pelanggan');
    Route::get('/laporan/pemesanan/cetak', 'LaporanController@pemesanancetak');
    Route::get('/laporan/pelunasan/cetak', 'LaporanController@pelunasancetak');
    Route::get('/laporan/pelanggan/cetak', 'LaporanController@pelanggancetak');
});
