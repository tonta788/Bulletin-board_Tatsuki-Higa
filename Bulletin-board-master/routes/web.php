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

Route::post('/top', 'Auth\Login\LoginController@login');

Route::post('/login', 'Auth\Login\LoginController@login');
Route::get('/login', 'Auth\Login\LoginController@login');
Route::get('/logout', 'Auth\Login\LoginController@logout');

Route::get('/register', 'Auth\Register\RegisterController@register');
Route::post('/register', 'Auth\Register\RegisterController@register');

Route::get('/added', 'Auth\Register\RegisterController@added');
Route::post('/added', 'Auth\Register\RegisterController@added');

// ログイン中のページ
Route::get('/top','User\Post\PostsController@index');
Route::get('/show/{id}','User\Post\PostsController@show');
Route::get('/category','User\Post\PostsController@category');
Route::post('/categoryadd','User\Post\PostsController@add')->name('categoryadd');
Route::post('/categoryaddsub','User\Post\PostsController@addsub')->name('categoryaddsub');
Route::get('category/{id}/delete', 'User\Post\PostsController@delete');

Route::get('/post','User\Post\PostsController@post');
Route::post('post/create','User\Post\PostsController@create');

Route::get('/post{id}', 'User\Post\PostsController@updateshow');
Route::get('/post/update{id}', 'User\Post\PostsController@postupdate');
Route::get('/post/{id}/delete', 'User\Post\PostsController@postdelete');

Route::get('/comment{id}','User\Post\PostCommentsController@comment');
Route::post('post/comment','User\Post\PostCommentsController@create');
