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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', 'LinkController@index');
Route::post('/shorten', 'LinkController@shorten');

// проверка что url является кодом заданных параметров (буквы/цифры длиной 6 символов)
Route::get('{code}', 'LinkController@get')->where('code', '[0-9a-zA-Z]{6}');
