<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\User;
class UserController extends Controller
{
    public function index()
    {
        //获取所有用户
        $data = User::get();

        //用户列表
        return view('admin.user.index',compact('data'));
    }

  	//加载添加页面
    public function create(Request $request)
    {
        //判断请求类型
        if( $request -> isMethod('post')){

            $data = $request -> only(['username','password','status']);

            //将输出的结果转换成数组
            $userlist = User::pluck('username')-> toArray();
            
            //判断用户名是否已经存在
            if( in_array($data['username'],$userlist) ){

                //已存在返回2
                return '2';
            }else{

                if(User::create($data)){
                    //添加成功返回1
                    return '1';
                }else{
                    //失败返回3
                    return '3';
                }
            }

        }else{

            //反则是get请求加载视图
            return view('admin.user.add');
        }
        
    }
}
