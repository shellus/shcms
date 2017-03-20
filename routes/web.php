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

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\TestController;

Route::group([
    'middleware' => 'auth',
], function ($router) {
    Route::post('/article/vote', 'ArticleController@vote');
    Route::resource('article.comment', 'CommentController');

    Route::post('/category/update-logo', 'CategoryController@updateLogo');

    Route::post('/user/update-avatar', 'UserController@updateAvatar');
    Route::get('/home', \App\Http\Controllers\HomeController::class . '@index') -> name('home');

    Route::get('/favorite/show-add-article-to-favorite', 'FavoriteController@showAddArticleToFavorite') -> name('show-add-article-to-favorite');
    Route::post('/favorite/add-article-to-favorite', 'FavoriteController@addArticleToFavorite') -> name('add-article-to-favorite');
    Route::resource('/favorite', 'FavoriteController');
});

Route::get('/', IndexController::class . '@index')->name('index');
Route::get('/test', TestController::class . '@index');

/********************* Auth Routes *********************/
// Authentication Routes...
$this->get('login', LoginController::class . '@showLoginForm')->name('login');
$this->post('login', LoginController::class . '@login');
$this->post('logout', LoginController::class . '@logout')->name('logout');

// Registration Routes...
$this->get('register', RegisterController::class . '@showRegistrationForm')->name('register');
$this->post('register', RegisterController::class . '@register');

// Password Reset Routes...
$this->get('password/reset', ForgotPasswordController::class . '@showLinkRequestForm')->name('password.request');
$this->post('password/email', ForgotPasswordController::class . '@sendResetLinkEmail')->name('password.email');
$this->get('password/reset/{token}', ResetPasswordController::class . 'r@showResetForm')->name('password.reset');
$this->post('password/reset', ResetPasswordController::class . '@reset');

/********************* End *********************/

Route::get('/article/reading', 'ArticleController@reading');

/** 这是首页 */

Route::resource('/article', ArticleController::class);

Route::get('/category/{id}', ArticleController::class . '@index')->name('category.show');
Route::get('/tag/{id}', ArticleController::class . '@index')->name('tag.show');