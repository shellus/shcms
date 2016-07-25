<?php
// --------------------- Admin Routes ---------------------

Route::get('/', ['as' => 'admin','uses' => App\Http\Controllers\Admin\IndexController::class . '@index']);