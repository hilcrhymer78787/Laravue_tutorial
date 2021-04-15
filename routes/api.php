<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/task/create', 'TaskController@create');
Route::get('/task/read', 'TaskController@read');
Route::put('/task/update', 'TaskController@update');
Route::delete('/task/delete/{id}', 'TaskController@delete');
Route::post('/task/search', 'TaskController@search');