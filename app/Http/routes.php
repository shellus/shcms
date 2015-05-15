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

Route::get('/', 'IndexController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('/test', function(){
    DB::listen(function($sql, $bindings, $time)
    {
        dump($sql);
    });
    $data = \App\Model\Tag::find(68262);
    dump($data);

    //return $data;
});


Route::get('post/search', 'PostController@search');
Route::get('post/random', 'PostController@random');
Route::get('post/tag/{id}', 'PostController@tag');

Route::get('post/category/{id}', ['as' => 'post.category', 'uses'=>'PostController@category']);

Route::get('post/add-tag/{post_id}/{tag_id}', ['as' => 'post.tag.add', 'uses'=>'TagController@addToPost']);
Route::get('post/del-tag/{post_id}/{tag_id}', ['as' => 'post.tag.del', 'uses'=>'TagController@delTagByPost']);


Route::get('post/user/{id}', 'PostController@user');

Route::resource('user', 'UserController');
Route::resource('post', 'PostController');
Route::resource('category', 'CategoryController');
Route::resource('tag', 'TagController');
Route::resource('file', 'FileController');
Route::resource('comment', 'CommentController');
Route::resource('mindmap', 'MindmapController');





