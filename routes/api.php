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

/** @var Route $router */


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::resource('/article','Api\ArticleController');


Route::get('/system-info','Api\IndexController@systemInfo');

Route::group([
    'prefix' => 'auth',
], function ($router) {
    Route::post('/login','Api\AuthController@postLogin');
});
