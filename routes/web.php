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
