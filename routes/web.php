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

Auth::routes();

Route::group([
    'middleware' => 'auth',
], function ($router) {
    Route::get('/article/search', 'ArticleController@search');
    Route::get('/article/reading', 'ArticleController@reading');
    Route::resource('/article', 'ArticleController');

    Route::resource('/category', 'CategoryController');

    Route::get('/home', 'HomeController@index');
});



