<?php

use Illuminate\Support\Facades\Route;
//// QJ = LQ
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
Route::get('/', "Moviescontroller@index")->name('movies.index');
Route::get('/movies/{id}', 'Moviescontroller@show')->name('movies.show'); 

Route::get('/actors', 'Actorscontroller@index')->name('actors.index');
Route::get('/actors/page/{page?}', 'Actorscontroller@index');
Route::get('/actors/{id}', 'Actorscontroller@show')->name('actors.show');
Route::get('/tv', 'TvController@index')->name('tv.index');
Route::get('/tv/{id}', 'TvController@show')->name('tv.show');