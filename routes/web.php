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

Route::group([
    'middleware' => 'auth',
], function ($router) {
    Route::post('/article/vote', 'ArticleController@vote');
    Route::resource('article.comment', 'CommentController');

    Route::post('/category/update-logo', 'CategoryController@updateLogo');

    Route::post('/user/update-avatar', 'UserController@updateAvatar');
    Route::get('/home', 'HomeController@index') -> name('home');

    Route::get('/favorite/show-add-article-to-favorite', 'FavoriteController@showAddArticleToFavorite') -> name('show-add-article-to-favorite');
    Route::post('/favorite/add-article-to-favorite', 'FavoriteController@addArticleToFavorite') -> name('add-article-to-favorite');
    Route::resource('/favorite', 'FavoriteController');
});

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

Route::get('/article/search', 'ArticleController@search');
Route::get('/article/reading', 'ArticleController@reading');
Route::resource('/article', 'ArticleController');

Route::get('/category/{id}', 'ArticleController@categoryIndex');
Route::resource('/category', 'CategoryController');

Route::get('/tag/{id}', 'ArticleController@tagIndex');
Route::resource('/tag', 'TagController');


Route::resource('/region', 'RegionController');
