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

Route::get('/', function () {
    return view('welcome');
});

Route::any('/list','Studys\UserPraiyController@getList')->name('praiy.list');
/*文章*/
Route::get('/posts','Client\PostController@index')->name('post.index');//文章列表
Route::get('/posts/{post}','Client\PostController@show')->name('post.show');//文章详情
Route::get('/posts/create','Client\PostController@create')->name('post.create');//创建文章
Route::post('/posts/store','Client\PostController@store')->name('post.store');//保存文章
Route::get('/posts/{post}/edit','Client\PostController@edit')->name('post.edit');//编辑文章
Route::put('/posts/store','Client\PostController@update')->name('post.update');//更新文章
Route::get('/posts/{post}/delete','Client\PostController@delete')->name('post.delete');//更新文章
