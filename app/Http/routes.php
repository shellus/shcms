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

Route::group(['middleware' => ['auth','permission:access_site']], function () {

});
Route::get('/', ['as' => 'index','uses' => 'IndexController@getIndex']);
Route::get('/test', ['as' => 'test','uses' => 'IndexController@getTest']);

Route::resource('/user', 'UserController');
Route::resource('/article', 'ArticleController');
Route::resource('/tag', 'TagController');
Route::resource('/category', 'CategoryController');
Route::resource('/file', 'FileController');