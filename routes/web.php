<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/question', 'PlayerController@question')->name('player.question');
Route::post('/check', 'PlayerController@check')->name('player.check');
Route::get('/commentary', 'PlayerController@commentary')->name('player.commentary');
Route::get('/my_page', 'PlayerController@my_page')->name('player.my_page');
Route::post('/delete', 'PlayerController@delete')->name('player.delete');
Route::get('/challenge', 'PlayerController@challenge')->name('player.challenge');
Route::post('/apply', 'PlayerController@apply')->name('player.apply');
