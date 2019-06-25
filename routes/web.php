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
    
    if(Auth::check()) {
        $user = Auth::user();
        return view('welcome')->with('user', $user);
    } else {
        return redirect('/play');
    }
});


Auth::routes();

Route::get('/play', 'HomeController@guestView')->name('guest');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/user/{user_id}/edit', 'ProfileController@edit')->name('edit');

Route::get('/user/{user_id}/profile', 'ProfileController@show')->name('profile');

Route::post('/user/{user_id}/update', 'ProfileController@update')->name('update');

Route::post('/user/{user_id}/delete', 'ProfileController@destroy')->name('delete');

Route::post('/movie/{user_id}/save', 'MovieController@store')->name('save-movie');

Route::get('/movie/{user_id}/list', 'MovieController@show')->name('list');

Route::delete('/movie/{user_id}/delete', 'MovieController@destroy')->name('delete-movie');

Route::post('/user/{user_id}/add_score', 'ProfileController@scoreUpdate')->name('score');

Route::get('/user/{user_id}/ranking', 'RankingController@show')->name('ranking');
