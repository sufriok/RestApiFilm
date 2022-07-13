<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', 'Api\AuthController@login');
Route::post('register', 'Api\AuthController@register');

Route::group(['middleware' => 'auth:api'], function(){

    Route::get('logout', 'Api\AuthController@logout');
    // route film
    Route::get('film', 'Api\FilmController@index');
    Route::get('film/show/{id}', 'Api\FilmController@show');
    // route rating
    // Route::get('rating', 'Api\RatingController@');
    Route::post('rating/store', 'Api\RatingController@store');
    Route::delete('rating/destroy/{id}', 'Api\RatingController@destroy');
    // route favorit
    // Route::get('favorit', 'Api\FavoritController@');
    Route::post('favorit/store', 'Api\FavoritController@store');
    Route::delete('favorit/destroy/{id}', 'Api\FavoritController@destroy');
    // route Admin
    Route::middleware('admin')->group(function() {
    	Route::post('film/store', 'Api\FilmController@store');
        Route::get('film/edit/{id}', 'Api\FilmController@edit');
        Route::post('film/update/{id}_method=PUT', 'Api\FilmController@update');
        Route::delete('film/destroy/{id}', 'Api\FilmController@destroy');
    });
    
});