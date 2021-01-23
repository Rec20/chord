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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/song/{id}', 'SongController@index')->name('song');
Route::get('/song/{id}/edit', 'SongController@edit')->name('edit');

Route::post('/createSong', 'HomeController@createSong')->name('home.createSong');
Route::post('/editSong', 'SongController@editSong')->name('song.editSong');
