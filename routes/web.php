<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// PostsController
Route::get('/post', 'PostsController@index')->middleware('auth');
Route::get('/post/{post}', 'PostsController@show')->where('post', '[0-9]+');
Route::get('/post/create', 'PostsController@create');
Route::post('/post', 'PostsController@store');
Route::get('/post/{post}/edit', 'PostsController@edit');
Route::patch('/post/{post}', 'PostsController@update');
Route::delete('/post/{post}', 'PostsController@destroy');

// CommentsController
Route::post('/post/{post}/comments', 'CommentsController@store');
Route::delete('/post/{post}/comments/{comment}', 'CommentsController@destroy');

// LikesController
Route::post('/likes', 'LikesController@store');
Route::get('/user/{id}/likes', 'LikesController@index')->where('id', '[0-9]+');
Route::delete('/likes/{id}', 'LikesController@destroy');

//FollowsController
Route::post('/follows', 'FollowsController@store');

// UsersController
Route::get('/user/{id}', 'UsersController@show')->where('id', '[0-9]+');
Route::get('/user/edit', 'UsersController@edit');
Route::patch('/user', 'UsersController@update');
Route::get('/users', 'UsersController@index');
Route::delete('/user/{id}', 'UsersController@destroy');

// RetweetsController
Route::post('/retweets', 'RetweetsController@store');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');