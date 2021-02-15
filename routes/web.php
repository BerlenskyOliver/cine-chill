<?php

use Illuminate\Routing\RouteUri;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
Route::group([
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
        ], 
    function(){

    Route::get('/', "HomeController@index")->name('home');
    Route::get('/movies', "Moviescontroller@index")->name('movies.index');
    Route::get('/movies/page/{page?}', "Moviescontroller@index");
    Route::get("/search", 'SearchController@show')->name('search');
    Route::get('/movies/{id}', 'Moviescontroller@show')->name('movie.show'); 

    Route::get('/actors', 'Actorscontroller@index')->name('actors.index');
    Route::get('/actors/page/{page?}', 'Actorscontroller@index');
    Route::get('/actors/{id}', 'Actorscontroller@show')->name('actors.show');
    Route::get('/tv', 'TvController@index')->name('tv.index');
    Route::get('/tv/page/{page?}', 'TvController@index');
    Route::get('/tv/{id}', 'TvController@show')->name('tv.show');
});