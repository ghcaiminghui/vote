<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;


class PublicController extends Controller
{
    //后台登录页面
    public function login()
    {

    	//加载登录页
    	return view('admin.public.login');
    }

    //退出
    public function logout()
    {
    	Auth::guard('admin') -> logout();

    	return redirect('/admin/public/login');
    }

    //后台登录数据验证
    public function check(Request $request)
    {
    	//启用表单验证
    	$this -> validate($request,[

    		//设置验证规则
    		'username'	=> 'required|min:5|max:20',
    		'password'    => 'required|min:4|max:20',
    		'captcha'   => 'required|size:4|captcha'
    	]);

    	//获取用户的基本信息
    	$data = $request -> only(['username','password']);

    	//匹配用户和密码
    	if( Auth::guard('admin') -> attempt($data,$request -> get('online')) ){

    		return redirect('/admin/index/index');
    	}else{

    		return redirect('/admin/public/login') -> withErrors(['loginError' => '用户名或密码错误']);
    	}

    }
}
