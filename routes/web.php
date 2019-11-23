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

Route::get('/', 'WelcomeController@show')->name('welcome');
Route::post('/', 'WelcomeController@create')->name('createAppeal');

Route::get('/update/{id}', 'WelcomeController@update')->name('update')->middleware('auth');
Route::post('/updateAppeal/{id}', 'WelcomeController@saveUpdate')->name('updateAppeal')->middleware('auth');

Route::get('/delete/{id}', 'WelcomeController@delete')->name('delete')->middleware('auth');
Route::get('/history/{id}', 'WelcomeController@showHistory')->name('history')->middleware('auth');
Route::get('/changeStatus/{id}', 'WelcomeController@changeStatus')->name('changeStatus')->middleware('auth');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
