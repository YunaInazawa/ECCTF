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
Route::get('/question/{code}', 'PlayerController@question')->name('player.question');
Route::post('/check', 'PlayerController@check')->name('player.check');
Route::get('/commentary/{id}', 'PlayerController@commentary')->name('player.commentary');
Route::get('/my_page', 'PlayerController@my_page')->name('player.my_page');
Route::post('/delete', 'PlayerController@delete')->name('player.delete');
Route::get('/challenge', 'PlayerController@challenge')->name('player.challenge');
Route::post('/apply', 'PlayerController@apply')->name('player.apply');

Route::get('/management', 'AdminController@index')->name('admin.management');
Route::get('/question_details/{id}', 'AdminController@question_details')->name('admin.question_details');
Route::get('/gift_details/{id}', 'AdminController@gift_details')->name('admin.gift_details');
Route::get('/user_details/{id}', 'AdminCOntroller@user_details')->name('admin.user_details');
Route::get('/question_create', 'AdminController@question_create')->name('admin.question_create');
Route::post('/question_check', 'AdminCOntroller@question_check')->name('admin.question_check');
Route::post('/question_new', 'AdminCOntroller@question_new')->name('admin.question_new');
