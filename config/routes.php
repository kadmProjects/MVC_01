<?php
use App\resources\packages\routes\Route;

Route::get('/', 'HomeController@index')->name('default');
Route::get('/login', 'Auth\AuthController@index')->name('gLogin');
Route::post('/home', 'AuthController@home')->name('gHome');
Route::post('/home1', 'AuthController@home');
Route::post('/login', 'AuthController@login')->name('gHome');
Route::put('/login', 'AuthController@login')->name('gHome');
Route::patch('/login', 'AuthController@login')->name('gHome');
Route::post('/login1', 'AuthController@login')->name('gHome');
Route::delete('/login', 'AuthController@login');
Route::get('/home', 'AuthController@home');