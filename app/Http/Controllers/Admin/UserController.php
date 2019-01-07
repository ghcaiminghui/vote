<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\User;

class UserController extends Controller
{   
    //用于显示用户模块的首页
    public function index(Request $request)
    {

        if( $request -> isMethod('post') ){

            $id = $request -> input('id');

            if (User::where('id',$id) -> delete() ){

                return '1';
            }

        }else{

            //获取所有用户
            $data = User::get();

            //用户列表
            return view('admin.user.index',compact('data'));
        }
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

    //用户批量添加
    public function insert(Request $request)
    {

        if ( $request -> isMethod('post') ){

            $username = $request -> input('usernameArr');
            $password = $request -> input('password');

            //去除首尾的|竖线
            $username = trim($username,'|');

            //将字符串转换成数组,然后去掉重复
            $username = array_unique(explode('|',$username));

            //查询数据库的所有用户
            $user = User::pluck('username') -> toArray();
            
            //遍历新加的数据
            foreach( $username as  $val){

                //如果新加的值非空 并且 新值不存在数据库中,就执行添加操作。
                if( $val != '' && !in_array($val,$user) ){

                    User::create([ 'username'=>$val,'password' => $password ]);
                }              
            }

            return '1';

        }else{

            return view('admin.user.insert');
        }
    }
}
