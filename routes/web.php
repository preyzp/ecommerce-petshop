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

Route::get('/', 'BerandaController@index');

Route::get('shop', 'BarangController@shop');

Route::get('form-daftar', 'PelangganController@daftar');
Route::post('simpan-daftar', 'PelangganController@simpandaftar');


Route::get('shop/detail/{id}', 'PelangganController@detail');
Route::get('/home', 'PelangganController@home');
Route::group(['prefix' => 'pelanggan'], function () {
    Route::group(['middleware' => 'is.login:pelanggan'], function () {
        Route::get('profile', 'PelangganController@profile');
        Route::get('profile/edit/{id}', 'PelangganController@edit');
        Route::put('profile/update/{id}', 'PelangganController@update');
        Route::post('profile/alamat/simpan', 'PelangganController@simpanalamat');
        Route::get('profile/alamat/{id}/hapus', 'PelangganController@hapusalamat');
        Route::post('pesan/simpan', 'PelangganController@simpanpesan');
        Route::get('pesan/hapus/{id}', 'PelangganController@hapuspesan');
        Route::get('pesan/hasil', 'PelangganController@hasilpesan');
        Route::put('pesan/update', 'PelangganController@pesanupdate');
        Route::get('pesan/bayar', 'PelangganController@bayarpesan');
        Route::post('pesan/bayar/ongkir', 'PelangganController@ongkir');
        Route::post('pesan/bayar', 'PelangganController@konfirmasipesan');
        Route::get('transaksi', 'PelangganController@transaksi');
        Route::get('transaksi/{id}', 'PelangganController@transaksidetail');
        Route::put('transaksi/{id}/upload', 'PelangganController@transaksiupload');
        Route::put('transaksi/{id}/konfirmasi', 'PelangganController@transaksikonfirmasi');
        Route::put('transaksi/{id}/status', 'PelangganController@transaksistatus');
        
    });
});

Route::get('form-login', 'PelangganController@formLogin');
Route::post('proses-login', 'PelangganController@prosesLogin');

Route::get('logout', 'PelangganController@logout');

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('pelanggan/index', 'PelangganController@index');
    Route::get('pelanggan/hapus/{id}', 'PelangganController@hapus');
    Route::get('pelanggan/cari', 'PelangganController@cari');

    Route::get('kategori/index', 'KategoriController@index');
    Route::get('kategori/tambah', 'KategoriController@tambah');
    Route::post('kategori/simpan', 'KategoriController@simpan');
    Route::get('kategori/edit/{id}', 'KategoriController@edit');
    Route::put('kategori/update/{id}', 'KategoriController@update');
    Route::get('kategori/hapus/{id}', 'KategoriController@hapus');
    Route::get('kategori/cari', 'KategoriController@cari');

    Route::get('barang/index', 'BarangController@index');
    Route::get('barang/tambah', 'BarangController@tambah');
    Route::post('barang/simpan', 'BarangController@simpan');
    Route::get('barang/edit/{id}', 'BarangController@edit');
    Route::put('barang/update/{id}', 'BarangController@update');
    Route::get('barang/hapus/{id}', 'BarangController@hapus');
    Route::get('barang/cari', 'BarangController@cari');

    Route::get('transaksi/index', 'TransaksiController@index');
    Route::get('transaksi/print', 'TransaksiController@print');
    Route::get('transaksi/{id}', 'TransaksiController@detail');
    Route::put('transaksi/{id}', 'TransaksiController@status');
    Route::get('transaksi/cari', 'TransaksiController@cari');
    
    


    Route::get('admin/index', 'AdminController@index');
    Route::get('admin/tambah', 'AdminController@tambah');
    Route::post('admin/simpan', 'AdminController@simpan');
    Route::get('admin/edit/{id}', 'AdminController@edit');
    Route::put('admin/update/{id}', 'AdminController@update');
    Route::get('admin/hapus/{id}', 'AdminController@hapus');
    Route::get('admin/cari', 'AdminController@cari');

    Route::get('bank/index', 'BankController@index');
    Route::get('bank/tambah', 'BankController@tambah');
    Route::post('bank/simpan', 'BankController@simpan');
    Route::get('bank/edit/{id}', 'BankController@edit');
    Route::put('bank/update/{id}', 'BankController@update');
    Route::get('bank/hapus/{id}', 'BankController@hapus');
    Route::get('bank/cari', 'BankController@cari');

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
