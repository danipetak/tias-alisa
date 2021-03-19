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
