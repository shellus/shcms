<?php
// --------------------- Admin Routes ---------------------

Route::get('/', ['as' => 'admin','uses' => App\Http\Controllers\Admin\IndexController::class . '@index']);

Route::get('/index1', ['as' => 'index1','uses' => App\Http\Controllers\Admin\IndexController::class . '@index1']);
