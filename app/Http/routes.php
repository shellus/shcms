<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
// --------------------- System Routes ---------------------
// Index Routes
Route::get('/', ['as' => 'index','uses' => 'IndexController@getIndex']);
Route::get('/test', ['as' => 'test','uses' => 'IndexController@getTest']);

// Auth Routes...
Route::get('login', ['as' => 'get_login', 'uses' => 'Auth\AuthController@showLoginForm']);
Route::post('login', ['as' => 'post_login', 'uses' => 'Auth\AuthController@login']);
Route::get('logout', ['as' => 'get_logout', 'uses' => 'Auth\AuthController@logout']);

// Registration Routes...
Route::get('register', ['as' => 'get_register', 'uses' => 'Auth\AuthController@showRegistrationForm']);
Route::post('register', ['as' => 'post_register', 'uses' => 'Auth\AuthController@register']);

// Password Reset Routes...
Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
Route::post('password/reset', 'Auth\PasswordController@reset');


// OAuth
Route::get('/oauth/authorize/{type}', ['as' => 'get_oauth_login', 'uses' => 'Auth\OAuthController@getAuthorize']);
Route::get('/oauth/access_token/{type}', ['as' => 'get_oauth_callback', 'uses' => 'Auth\OAuthController@postAccessToken']);

// permission require
//Route::group(['middleware' => ['auth','permission:access_site']], function () {
//
//});

Route::get('user/edit', [
    'as' => 'user.edit',
    'uses' => 'UserController@edit',
    'middleware' => 'auth',
]);
// User Home Routes...
Route::post('user/avatar', [
    'as' => 'avatar.store',
    'uses' => 'UserController@updateAvatar',
    'middleware' => 'auth',
]);
Route::get('user/avatar/{user}', [
    'as' => 'avatar.get',
    'uses' => 'UserController@getAvatar',
]);


// --------------------- Data Model Routes ---------------------

// Article Routes...

Route::resource('/article', 'ArticleController');
Route::get('/article/{slug_or_id}', ['as' => 'article.index','uses' => 'ArticleController@index']);

Route::get('/article/{article_id}/{tag_id}', ['as' => 'article.tag.add','uses' => 'ArticleController@getTagAdd']);
Route::get('/tag/{slug_or_id}', ['as' => 'article.tag.index','uses' => 'ArticleController@getTag']);

Route::resource('/tag', 'TagController');
Route::resource('/category', 'CategoryController');
Route::resource('/file', 'FileController');