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
    return redirect("/login");
});

Route::any('/list','Studys\UserPraiyController@getList')->name('praiy.list');
/*用户模块*/
Route::get('/register','User\RegisterController@index'); //注册页面
Route::post('/register','User\RegisterController@register'); //注册行为
Route::get('/login','User\LoginController@index');//登录页面
Route::post('/login','User\LoginController@login');//登录行为
Route::get('/logout','User\LoginController@logout');//登出行为
Route::get('/user/me/setting','User\UserController@setting');//个人设置页面
Route::post('/user/me/setting','User\UserController@settingStore');//个人设置操作

/*文章模块*/
Route::get('/posts','Client\PostController@index')->name('post.index');//文章列表
Route::get('/posts/{post}','Client\PostController@show')->name('post.show');//文章详情 --模型绑定
Route::get('/create/post','Client\PostController@create')->name('post.create');//创建文章
Route::post('/posts','Client\PostController@store')->name('post.store');//保存文章
Route::get('/posts/{post}/edit','Client\PostController@edit')->name('post.edit');//编辑文章 --模型绑定
Route::put('/posts/{post}','Client\PostController@update')->name('post.update');//更新文章 --模型绑定
Route::get('/posts/{post}/delete','Client\PostController@delete')->name('post.delete');//删除文章

/*上传图片*/
Route::any('/posts/image/upload','Client\PostController@uploadImg')->name('post.upload.image');//上传图片
