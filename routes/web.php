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

//后台路由组
Route::group(['prefix' => 'admin'] , function(){

	//后台登录
	Route::get('/public/login','Admin\PublicController@login') -> name('login');
	//后台数据验证
	Route::post('/public/check','Admin\PublicController@check');
	//后台退出
	Route::get('/public/logout','Admin\PublicController@logout');


});

//后台路由组(需要权限验证)
Route::group(['prefix' => 'admin','middleware' => 'auth:admin'] , function(){

	//后台首页
	Route::get('/index/index','Admin\IndexController@index');
	Route::get('/index/welcome','Admin\IndexController@welcome');

});