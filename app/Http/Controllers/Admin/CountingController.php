<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Count_num;
use App\Admin\Vote_option;
use App\Admin\Vote;

class CountingController extends Controller
{
    //票数统计(列表页)
    public function index()
    {
    	//查询相关信息
    	$data = Count_num::join('user as u','count_num.user_id','=','u.id') ->join('vote as v','count_num.vote_id','=','v.id') -> select('count_num.*','u.username','v.title','v.total') ->get() -> toArray();

    	//查询所有的候选人
    	$vote_name = Vote_option::select('id','vote_name') -> get() -> toArray();

    	//用于存储所有的候选人
    	$name = [];

    	//遍历数据将候选人信息写入到data(步骤一)
    	foreach($vote_name as $k => $v){

    		//将候选人的ID值当作键,候选人的选项做值
    		$name[$v['id']] = $v['vote_name'];
    	}

    	//遍历数据将候选人信息写入到data(步骤二)
    	foreach($data as $key => $value){

	    	$data[$key]['vote_option_id'] = explode(',',$value['vote_option_id']);

	    	foreach($data[$key]['vote_option_id'] as $k => $val){

	    		//重新写入数据
	    		$data[$key]['vote_option_id'][$k] = $name[$val];
	    	}
    	}
    	
    	return view('admin.counting.index',compact('data','vote_name'));
    }

    //主题投票情况
    public function show()
    {
        //获取所有启用投票主题
        $vote = Vote::where('status','2') -> get();

        //获取所有的候选项
        $vote_option = Vote_option::get();


        return view('admin.counting.show',compact('vote','vote_option'));
    }
}
