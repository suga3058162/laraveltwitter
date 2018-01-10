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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/', 'PostsController@index');

// Route::get('/hello', 'HelloController@index');

//実際にDBにデータを入れる
// Route::post('posts', 'HelloController@post');

Route::get('/post', 'PostsController@index')->middleware('auth');
// Route::get('/post/{id}', 'PostsController@show');
Route::get('/post/{post}', 'PostsController@show')->where('post', '[0-9]+');
Route::get('/post/create', 'PostsController@create');
Route::post('/post', 'PostsController@store');
Route::get('/post/{post}/edit', 'PostsController@edit');
Route::patch('/post/{post}', 'PostsController@update');
Route::delete('/post/{post}', 'PostsController@destroy');
Route::post('/post/{post}/comments', 'CommentsController@store');
Route::delete('/post/{post}/comments/{comment}', 'CommentsController@destroy');
Route::post('/likes', 'LikesController@store');
// Route::post('/likes', function()
// {
//     $name = Input::get('post_id');
//     return "post_id : {$name}";
// });
Route::post('/follows', 'FollowsController@store');
Route::get('/user/{id}', 'UsersController@show')->where('id', '[0-9]+');
Route::get('/user/edit', 'UsersController@edit');
// Route::patch('/post/{post}', 'PostsController@update');
Route::patch('/user', 'UsersController@update');
Route::get('/user/{id}/likes', 'LikesController@index')->where('id', '[0-9]+');
Route::get('/users', 'UsersController@index');
Route::post('/retweets', 'RetweetsController@store');
Route::delete('/user/{id}', 'UsersController@destroy');
Route::delete('/likes/{id}', 'LikesController@destroy');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/', 'HomeController@index')->name('home');
