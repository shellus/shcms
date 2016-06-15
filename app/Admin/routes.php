<?php

Route::get('', ['as' => 'admin.dashboard', function () {
	$content = 'Define your dashboard here.';
    return AdminSection::view(view('admin.dashboard'), '控制台');
}]);

Route::get('information', ['as' => 'admin.information', function () {
    return AdminSection::view(view('admin.information'), '系统信息');
}]);