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
	//管理员管理
	Route::get('/manager/update','Admin\ManagerController@update');
	Route::post('/manager/store','Admin\ManagerController@store');
	//用户管理
	Route::get('/user/index','Admin\UserController@index');
	Route::any('/user/create','Admin\UserController@create');
	//投票管理
	Route::get('/vote/index','Admin\VoteController@index');
	Route::any('/vote/create','Admin\VoteController@create');

});

//前台登录
Route::get('/','Home\PublicController@login');
//前台验证数据
Route::post('/home/public/check','Home\PublicController@check');


//前台路由组
Route::group(['prefix' => 'home', 'middleware' => 'login'],function(){

	//前台首页
	Route::get('/index/index','Home\IndexController@index');
	//前台投票详情页
	Route::get('/voteinfo/index','Home\VoteinfoController@index');
	//检查投票数据
	Route::post('/voteinfo/check','Home\VoteinfoController@check');
	//投票结果显示
	Route::get('/voteresult/index','Home\VoteResultController@index');
	//用户发表评论
	Route::post('/comment/create','Home\CommentController@create');

});
