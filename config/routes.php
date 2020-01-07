<?php
use App\resources\packages\routes\Route;

Route::get('/', 'HomeController@index')->name('default');
Route::get('/home', 'HomeController@home')->name('2default');
Route::get('/login', 'Auth\AuthController@index')->name('gLogin2');
Route::post('/home', 'AuthController@home')->name('gHome2');
Route::post('/home1', 'AuthController@home');
Route::post('/login', 'AuthController@login')->name('gHome3');
Route::put('/login', 'AuthController@login')->name('gHome4');
Route::patch('/login', 'AuthController@login')->name('gHome5');
Route::post('/login1', 'AuthController@login')->name('gHome6');
Route::delete('/login', 'AuthController@login');
Route::get('/home1', 'Auth\AuthController@home');

return Route::router();