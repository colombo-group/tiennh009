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

//pages
Route::get('home', 'PageController@getHome');

Route::get('category', 'PageController@getCategory');

Route::get('detail', 'PageController@getDetail');

//login
Route::get('login', 'UserController@getLogin');
Route::post('login', 'UserController@postLogin');
Route::get('logout', 'UserController@getLogout');

//signup
Route::get('signup', 'UserController@getSignup');
Route::post('signup', 'UserController@postSignup');

//admin

Route::get('admin/login', 'UserController@getLoginAdmin');
Route::post('admin/login', 'UserController@postLoginAdmin');
Route::get('admin/logout', 'UserController@getLogoutAdmin');

Route::group(['prefix' => 'admin', 'middleware' => 'adminLogin'], function () {
	Route::group(['prefix' => 'category'], function () {
		Route::get('list', 'CategoryController@getList');

		Route::get('add', 'CategoryController@getAdd');

		Route::get('edit/{id}', 'CategoryController@getEdit');

		Route::get('delete/{id}', 'CategoryController@getDelete');

		Route::post('add', 'CategoryController@postAdd');

		Route::post('edit/{id}', 'CategoryController@postEdit');
	});	

	Route::group(['prefix' => 'post'], function () {
		Route::get('list', 'PostController@getList');

		Route::get('add', 'PostController@getAdd');

		Route::get('edit/{id}', 'PostController@getEdit');

		Route::get('delete/{id}', 'PostController@getDelete');

		Route::post('add', 'PostController@postAdd');

		Route::post('edit/{id}', 'PostController@postEdit');
	});

	Route::group(['prefix' => 'user'], function () {
		Route::get('list', 'UserController@getList');

		Route::get('add', 'UserController@getAdd');

		Route::get('edit/{id}', 'UserController@getEdit');

		Route::get('delete/{id}', 'UserController@getDelete');

		Route::post('add', 'UserController@postAdd');

		Route::post('edit/{id}', 'UserController@postEdit');
	});

	// Route::group(['prefix' => 'comment'], function () {
	// 	Route::get('xoa/{id}/{idTinTuc}', 'CommentController@getXoa');
	// });
});

//facebook
Route::get('facebook/redirect', 'Auth\SocialController@redirectToProviderFacebook');
Route::get('facebook/callback', 'Auth\SocialController@handleProviderCallbackFacebook');