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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/inbox', 'ThreadController@index');

Route::get('/newmessage', 'ThreadController@create');
Route::post('/newmessage', 'ThreadController@store');

Route::get('/replymessage/{id}', 'MessageController@create');
Route::post('/replymessage', 'MessageController@store');

Route::post('/deletemessage', 'ThreadController@delete');
Route::post('/restoremessage', 'ThreadController@restore');

Route::get('/deletedmessages', 'ThreadController@deleteIndex');
