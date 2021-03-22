<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes([
    'register' => false,   // Registration Routes...
    'reset'    => false,  // Password Reset Routes...
    'verify'   => false, // Email Verification Routes...
]);

Route::get('/', 'HomeController@index')->name('index');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profil', 'Auth\Profil@index')->name('profil.index');
Route::patch('/profil', 'Auth\Profil@update')->name('profil.update');

Route::get('/profil-perusahaan', 'Master\Data\ProfilPerusahaan@index')->name('profil_perusahaan.index');
Route::post('/profil-perusahaan', 'Master\Data\ProfilPerusahaan@store')->name('profil_perusahaan.store');

Route::get('/daftar-pengguna', 'Master\Data\DataPengguna@index')->name('pengguna.index');
Route::post('/daftar-pengguna', 'Master\Data\DataPengguna@store')->name('pengguna.store');
Route::get('/daftar-pengguna/show', 'Master\Data\DataPengguna@show')->name('pengguna.show');
Route::post('/daftar-pengguna/show', 'Master\Data\DataPengguna@detail')->name('pengguna.detail');
Route::delete('/daftar-pengguna/show', 'Master\Data\DataPengguna@destroy')->name('pengguna.destroy');

Route::get('/penghubung-rekening', 'Master\Account\PenghubungRekening@index')->name('penghubung_rekening.index');
Route::post('/penghubung-rekening', 'Master\Account\PenghubungRekening@store')->name('penghubung_rekening.store');
Route::get('/penghubung-rekening/show', 'Master\Account\PenghubungRekening@show')->name('penghubung_rekening.show');
Route::post('/penghubung-rekening/show', 'Master\Account\PenghubungRekening@detail')->name('penghubung_rekening.detail');
Route::delete('/penghubung-rekening/show', 'Master\Account\PenghubungRekening@destroy')->name('penghubung_rekening.destroy');

Route::get('/rekening-aruskas', 'Master\Account\ArusKas@index')->name('rekening_aruskas.index');
Route::post('/rekening-aruskas', 'Master\Account\ArusKas@store')->name('rekening_aruskas.store');
Route::get('/rekening-aruskas/show', 'Master\Account\ArusKas@show')->name('rekening_aruskas.show');
Route::post('/rekening-aruskas/show', 'Master\Account\ArusKas@detail')->name('rekening_aruskas.detail');
Route::delete('/rekening-aruskas/show', 'Master\Account\ArusKas@destroy')->name('rekening_aruskas.destroy');

Route::get('/rekening-akuntansi', 'Master\Account\RekeningAkuntansi@index')->name('rekening.index');
Route::post('/rekening-akuntansi', 'Master\Account\RekeningAkuntansi@store')->name('rekening.store');
Route::get('/rekening-akuntansi/show', 'Master\Account\RekeningAkuntansi@show')->name('rekening.show');
Route::delete('/rekening-akuntansi/show', 'Master\Account\RekeningAkuntansi@destroy')->name('rekening.destroy');

Route::get('/periode-akuntansi', 'Master\Data\PeriodeAkuntansi@index')->name('periode.index');
Route::post('/periode-akuntansi', 'Master\Data\PeriodeAkuntansi@store')->name('periode.store');
Route::patch('/periode-akuntansi', 'Master\Data\PeriodeAkuntansi@update')->name('periode.update');
Route::delete('/periode-akuntansi', 'Master\Data\PeriodeAkuntansi@destroy')->name('periode.destroy');
Route::get('/periode-akuntansi/show', 'Master\Data\PeriodeAkuntansi@show')->name('periode.show');
Route::get('/periode-akuntansi/info', 'Master\Data\PeriodeAkuntansi@info')->name('periode.info');

Route::get('/saldo-awal', 'Transaksi\SaldoAwal@index')->name('saldoawal.index');
Route::get('/saldo-awal/show', 'Transaksi\SaldoAwal@show')->name('saldoawal.show');
