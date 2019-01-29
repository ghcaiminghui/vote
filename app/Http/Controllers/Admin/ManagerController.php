<?php

namespace App\Http\Controllers\Admin;

use App\Events\AdminLoginEvent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Admin\Manager;
use App\Admin\Manager_log;

class ManagerController extends Controller
{
    //
	public function update()
	{
		return view('admin.manager.index');
	}

	public function store(Request $request)
	{

		$oldpassword = $request -> input('oldpassword');
		$newpassword = $request -> input('newpassword');
		$newpassword2 = $request -> input('newpassword2');

		//判断两次新密码是否一致
		if($newpassword2 === $newpassword && $newpassword!=''){

			//匹配旧密码
			if(Hash::check($oldpassword,$request->user()->password)){

				//新密码加密
				$data['password'] = Hash::make($newpassword);

				//修改密码
				if( Manager::where('id','201')->update($data) ){

					//成功
					return redirect('/admin/manager/update') -> with('status','密码修改成功');
				}

			}else{

				//旧密码不正确
				return redirect('/admin/manager/update') -> with('status','旧密码不正确');
			}


		}else{
			//两次密码不一致
			return redirect('/admin/manager/update') -> with('status','两次密码不一致');
		}
	}

	//系统日志
    public function log(Request $request)
    {
    	//获取所有日志信息
    	$num = count( $log = Manager_log::all() );

    	if( $request -> has('start_time') ){

    		//结束时间不存在就给当前时间戳
    		if( $stop_time = $request->input('stop_time') ){

    			//获取结束时间
    			$stop_time = strtotime('+1 day',strtotime(str_replace('-','',$stop_time)  ));

    		}else{

    			$stop_time = time();
    		}
    		
    		//处理开始时间
   	 		$start_time = strtotime( str_replace('-','',$request->input('start_time')) );
   	 		

   	 		if($request -> has('username')){

   	 			//搜索条件
   	 			$data = [

   	 				['addtime','>=',$start_time],
	   	 			['addtime','<=',$stop_time],
	   	 			['username','like','%'.$request -> input('username').'%']
   	 			];

   	 		}else{

   	 			//搜索条件
   	 			$data = [

   	 				['addtime','>=',$start_time],
	   	 			['addtime','<=',$stop_time]
   	 			];
   	 		}

   	 		//查询对应的日期
   	 		$num = count( $log = Manager_log::where($data)->get() );

    	}

    	//搜索没有日期并且有username搜索条件
    	if( !$request -> input('start_time') && $request -> input('username') ){

    		//查询
    		$num = count( $log = Manager_log::where('username','like','%'.$request -> input('username').'%')->get() );
    	}

    	//展示日志视图
      return view('admin.manager.system_log',compact('log','num'));
    }
}
