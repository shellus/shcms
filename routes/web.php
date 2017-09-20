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
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;

Route::group([
    'middleware' => 'auth',
], function ($router) {
    Route::resource('article.comment', CommentController::class);

    Route::post('/category/update-logo', CategoryController::class . '@updateLogo');

    Route::post('/user/update-avatar', UserController::class . '@updateAvatar');
    Route::get('/home', HomeController::class . '@index')->name('home');

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
$this->get('password/reset/{token}', ResetPasswordController::class . '@showResetForm')->name('password.reset');
$this->post('password/reset', ResetPasswordController::class . '@reset');

/********************* End *********************/

/** 这是首页 */

Route::resource('/article', ArticleController::class);

Route::get('/category/{id}', ArticleController::class . '@index')->name('category.show');
Route::get('/tag/{id}', ArticleController::class . '@index')->name('tag.show');

Route::resource('/item', \App\Http\Controllers\ItemController::class);
