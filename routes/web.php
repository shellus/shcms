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

Route::get('/', 'IndexController@index') -> name('index');
Route::get('/test', 'TestController@index');


/********************* Auth Routes *********************/
// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
$this->post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
$this->post('password/reset', 'Auth\ResetPasswordController@reset');
/********************* End *********************/


Route::group([
    'middleware' => 'auth',
], function ($router) {
    Route::get('/article/search', 'ArticleController@search');
    Route::get('/article/reading', 'ArticleController@reading');

    Route::post('/article/vote', 'ArticleController@vote');

    Route::resource('/article', 'ArticleController');

    Route::resource('/category', 'CategoryController');

    Route::get('/home', 'HomeController@index') -> name('home');

    Route::get('/favorite/add', 'FavoriteController@add');
    Route::resource('/favorite', 'FavoriteController');
});



