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

Route::get('/first', 'FirstController@description')->name('player.description');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/question/{code}', 'PlayerController@question')->name('player.question');
Route::post('/check', 'PlayerController@check')->name('player.check');
Route::get('/commentary/{id}', 'PlayerController@commentary')->name('player.commentary');
Route::get('/my_page', 'PlayerController@my_page')->name('player.my_page');
Route::get('/pass_reset', 'PlayerController@password_reset')->name('player.pass_reset');
Route::post('/pass_update', 'PlayerController@password_update')->name('player.pass_update');
Route::post('/delete', 'PlayerController@delete')->name('player.delete');
Route::get('/challenge', 'PlayerController@challenge')->name('player.challenge');
Route::post('/apply', 'PlayerController@apply')->name('player.apply');

Route::get('/management', 'AdminController@index')->name('admin.management');

Route::get('/question_details/{id}', 'AdminController@question_details')->name('admin.question_details');
Route::get('/question_create', 'AdminController@question_create')->name('admin.question_create');
Route::get('/question_edit/{id}', 'AdminController@question_edit')->name('admin.question_edit');
Route::post('/question_check', 'AdminController@question_check')->name('admin.question_check');
Route::post('/question_new', 'AdminController@question_new')->name('admin.question_new');
Route::get('/question_delete/{id}', 'AdminController@question_del')->name('admin.question_delete');

Route::get('/gift_details/{id}', 'AdminController@gift_details')->name('admin.gift_details');
Route::get('/gift_create', 'AdminController@gift_create')->name('admin.gift_create');
Route::get('/gift_edit/{id}', 'AdminController@gift_edit')->name('admin.gift_edit');
Route::post('/gift_check', 'AdminController@gift_check')->name('admin.gift_check');
Route::post('/gift_new', 'AdminController@gift_new')->name('admin.gift_new');
Route::get('/gift_delete/{id}', 'AdminController@gift_del')->name('admin.gift_delete');

Route::get('/user_details/{id}', 'AdminController@user_details')->name('admin.user_details');
Route::get('/user_edit/{id}', 'AdminController@user_edit')->name('admin.user_edit');
Route::post('/user_check', 'AdminController@user_check')->name('admin.user_check');
Route::post('/user_update', 'AdminController@user_update')->name('admin.user_update');
Route::get('/user_password_update/{id}', 'AdminController@user_password_update')->name('admin.user_password_update');
Route::get('/user_delete/{id}', 'AdminController@user_del')->name('admin.user_delete');

Route::get('/card_details/{id}', 'AdminController@card_details')->name('admin.card_details');
Route::get('/card_edit/{id}', 'AdminController@card_edit')->name('admin.card_edit');
Route::post('/card_check', 'AdminController@card_check')->name('admin.card_check');
Route::post('/card_update', 'AdminController@card_update')->name('admin.card_update');

Route::get('/room_details', 'AdminController@room_details')->name('admin.room_details');
Route::get('/room_edit', 'AdminController@room_edit')->name('admin.room_edit');
Route::post('/room_check', 'AdminController@room_check')->name('admin.room_check');
Route::post('/room_update', 'AdminController@room_update')->name('admin.room_update');
