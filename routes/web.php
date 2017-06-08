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

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('post/{id}', ['as'=>'home.post', 'uses'=>'AdminPostsController@post']);

Route::get('/logout', 'Auth\LoginController@logout');

Route::group(['middleware'=>'admin'], function() {
	Route::get('/admin', function() {
	return view('admin.index');
	});
	Route::resource('admin/users', 'AdminUsersController', ['names'=>[
		'index'=>'admin.users.index',
		'create'=>'admin.users.create',
		'store'=>'admin.users.store',
		'edit'=>'admin.users.edit',
		'destroy'=>'admin.users.destroy',
		]]);
	Route::resource('admin/posts', 'AdminPostsController', ['names'=>[
		'index'=>'admin.posts.index',
		'create'=>'admin.posts.create',
		'store'=>'admin.posts.store',
		'edit'=>'admin.posts.edit',
		'destroy'=>'admin.posts.destroy',
		]]);
	Route::resource('admin/categories', 'AdminCategoriesController', ['names'=>[
		'index'=>'admin.categories.index',
		'create'=>'admin.categories.create',
		'store'=>'admin.categories.store',
		'edit'=>'admin.categories.edit',
		'destroy'=>'admin.categories.destroy',
		]]);
	Route::post('admin/delete/media', 'AdminMediaController@deleteMedia');
	Route::resource('admin/media', 'AdminMediaController', ['names'=>[
		'index'=>'admin.media.index',
		'create'=>'admin.media.create',
		'store'=>'admin.media.store',
		'edit'=>'admin.media.edit',
		'destroy'=>'admin.media.destroy',
		]]);
	// Route::get('admin/media/upload', ['as'=>'admin.media.upload', 'uses'=>'AdminMediaController@store']);
	Route::resource('admin/comments', 'PostCommentsController', ['names'=>[
		'show'=>'admin.comments.show',
		'index'=>'admin.comments.index',
		'create'=>'admin.comments.create',
		'store'=>'admin.comments.store',
		'edit'=>'admin.comments.edit',
		'destroy'=>'admin.comments.destroy',
		]]);
	Route::resource('admin/comment/replies', 'CommentRepliesController',['names'=>[
		'show'=>'admin.replies.comments.replies.show',
		'create'=>'admin.replies.comments.replies.create',
		'index'=>'admin.replies.comments.replies.index',
		]]);
});