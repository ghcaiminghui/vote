<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class PublicController extends Controller
{
    //后台登录页面
    public function login()
    {

    	//加载登录页
    	return view('admin.public.login');
    }

    //后台登录数据验证
    public function check(Request $request)
    {
    	//启用表单验证
    	$this -> validate($request,[

    		//设置验证规则
    		'username'	=> 'required|min:5|max:20',
    		'passwd'    => 'required|min:5|max:20',
    		'captcha'   => 'required|size:4|captcha'
    	]);
    }
}
