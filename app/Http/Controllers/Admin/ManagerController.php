<?php

namespace App\Http\Controllers\Admin;

use App\Events\AdminLoginEvent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Admin\Manager;
use App\Events;

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
    public function log()
    {
        echo 'error';
    }
}
