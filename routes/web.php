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

// Route::get('/hello', 'HelloController@index');

//実際にDBにデータを入れる
// Route::post('posts', 'HelloController@post');

Route::get('/post', 'PostsController@index');
// Route::get('/post/{id}', 'PostsController@show');
Route::get('/post/{post}', 'PostsController@show')->where('post', '[0-9]+');
Route::get('/post/create', 'PostsController@create');
Route::post('/postposts', 'PostsController@store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
