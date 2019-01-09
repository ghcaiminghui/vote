<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Vote;
use App\Admin\Comment;
use App\Admin\Count_num;
use App\Admin\Vote_option;

class VoteController extends Controller
{
	//投票的列表
	public function index(Request $request)
	{

        //判断用户是否是提交启用主题投票或停止投票
        if( $request -> isMethod('post') ){

            if ($id = $request -> input('stop_id') ){

                Vote::where('id',$id) -> update( ['status'=>'1'] );

            }

            if ($id = $request -> input('start_id') ){

                Vote::where('id',$id) -> update( ['status'=>'2'] );
            }

            //修改状态成功
            return '1';

        }else{

            //获取所有的主题信息
            $votelist = Vote::get();
            //获取记录数
            $num = Vote::get()->count();

            //加载视图,分配数据
            return view('admin.vote.index',compact('votelist','num'));
        }

		
	}

    //创建投票主题
    public function create(Request $request)
    {

    	if( $request -> isMethod('post') ){

    		//获取投票主题的数据
    		$vote = $request -> only(['title','intro','type','ticket_min','ticket_max','content','status']);

            //将限制值都转换为整数
            $vote['ticket_min'] = abs(intval($vote['ticket_min']));
            $vote['ticket_max'] = abs(intval($vote['ticket_max']));

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

    //删除主题
    public function delete(Request $request)
    {
        //获取主题的ID值
        $id = $request -> input('id');

        //删除主题
        if( Vote::where('id',$id) -> delete() ){

            //删除主题的候选项
            Vote_option::where('vote_id',$id) -> delete();

            //删除主题的相关评论
            Comment::where('vote_id',$id) -> delete();

            //删除主题的投票统计
            Count_num::where('vote_id',$id) -> delete();

        }

        return '1';
    }

    //编辑主题
    public function update(Request $request)
    {

        //获取修改主题的ID
        $id = $request -> input('id');

        //查询该主题的信息
        $vote = Vote::where('id',$id) -> first();

        return view('admin.vote.update',compact('vote'));
    }

    //添加候选人说明
    public function optioninfo(Request $request)
    {
        if( $request -> isMethod('post') ){
 
            $data = $request -> except('_token');

            foreach($data as $key => $val){

                $k = substr($key,14);
                //执行添加
                Vote_option::where('id',$k) -> update(['option_content' => $val]);
            }

            return '1';

        }else{

            //获取所有的主题信息
            $votelist = Vote::get();
            //获取所有的候选人
            $option = Vote_option::get();

            return view('admin.vote.optioninfo',compact('votelist','option'));
        }
    }
}
