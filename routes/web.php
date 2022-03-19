<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'LinkController@index');
Route::get('/{code}', 'LinkController@redirect');
Route::post('/shorten', 'LinkController@shorten');
