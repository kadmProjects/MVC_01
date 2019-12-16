<?php
use App\resources\packages\routes\Route;

Route::get('/', 'HomeController@index')->name('default');
Route::get('/login', 'Auth\AuthController@index')->name('gLogin');
// Route::post('/home', 'AuthController@home')->name('gHome');
// Route::post('/home', 'AuthController@home');
//Route::post('/login', 'AuthController@login');