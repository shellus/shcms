<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'IndexController@index');
Route::get('/test', 'TestController@index');


Auth::routes();

Route::group([
    'middleware' => 'auth',
], function ($router) {
    Route::get('/article/search', 'ArticleController@search');
    Route::get('/article/reading', 'ArticleController@reading');

    Route::post('/article/vote', 'ArticleController@vote');

    Route::resource('/article', 'ArticleController');

    Route::resource('/category', 'CategoryController');

    Route::get('/home', 'HomeController@index');

    Route::get('/favorite/add', 'FavoriteController@add');
    Route::resource('/favorite', 'FavoriteController');
});



