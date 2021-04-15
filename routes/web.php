<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::post('/logout', 'Auth\LoginController@logout', 'logout');
Route::group(['middleware' => 'auth:web'], function () {
     Route::get('/', function () {
         return view('app');
     });
});

Route::middleware('auth')->get('api/loginuser', 'UserController@loginuser');