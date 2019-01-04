<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\User;

class PublicController extends Controller
{
    //前台登录
    public function login()
    {
    	//加载视图
    	return view('home.public.login');
    }

    //前台数据检查
    public function check(Request $request)
    {
    	//获取用户基本信息
    	$username = $request -> input('username');
    	$password = $request -> input('password');

    	$this -> validate($request,[

    		'username'	=> 'required',
    		'password'  => 'required'

    	]);

    	//判断用户名是否存在
    	if( $userinfo = User::where('username',$username) -> first()){

    		//判断用户密码是否正确
    		if ($userinfo -> password == $password){

    			//存储用户名和ID值
    			session(['username' => $username , 'id' => $userinfo -> id]);

    			return redirect('/home/index/index');
    		}else{
    			//跳转到登录页和返回错误信息
    			return redirect('/') -> withErrors(['loginError' => '用户名或密码错误']);
    		}
    	}else{
    		//跳转到登录页和返回错误信息
    		return redirect('/') -> withErrors(['loginError' => '用户名不存在']);
    	}
    }
}
