<?php
// --------------------- API Routes ---------------------

    Route::post('login', App\Http\Controllers\Api\AuthController::class . '@postLogin');

    Route::group(['middleware' => 'auth:api'], function() {
        Route::resource('article', App\Http\Controllers\Api\ArticleController::class);
    });
