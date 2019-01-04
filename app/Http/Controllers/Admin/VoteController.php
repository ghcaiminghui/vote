<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Vote;

class VoteController extends Controller
{
	//投票的列表
	public function index()
	{
		//获取所有的主题信息
		$votelist = Vote::get();
		//获取记录数
		$num = Vote::get()->count();

		//加载视图,分配数据
		return view('admin.vote.index',compact('votelist','num'));
	}

    //创建投票主题
    public function create(Request $request)
    {

    	if( $request -> isMethod('post') ){
    		//获取投票主题的数据
    		$vote = $request -> only(['title','intro','type','ticket_min','ticket_max','content','status']);
    		//投票选项表的数据
    		$vote_option = $request -> input('vote_name');

    		//先添加主题信息并返回主题信息对象
    		if(  $voteinfo = Vote::create($vote) ){

    			//循环添加主题候选项表
    			foreach($vote_option as $val){

    				$voteinfo -> vote_option() -> create(['vote_id' => $voteinfo -> id, 'vote_name' => $val]);
    			}

    			//完全成功返回1
    			return '1';
    		}else{

    			//失败返回2
    			return '2';
    		}

    	}else{

    		//否则是GET请求加载视图
    		return view('admin.vote.create');
    	}
    }
}
