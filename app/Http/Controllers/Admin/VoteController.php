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

        if ($request -> isMethod('post') ){

            //接收主题信息
            $vote = $request -> only(['title','intro','type','ticket_min','ticket_max','content','status']);

            //根据ID更新主题信息
            if( Vote::where('id',$request->input('id')) -> update($vote) ){

                return '1';
            }

            //更新原有的候选项
            $vote_option = $request -> except(['title','intro','type','ticket_min','ticket_max','content','status','vote_name','id','_token']);

            foreach($vote_option as $key => $value){

                $id = substr($key,9);

                Vote_option::where('vote_id',$request->input('id')) -> where('id',$id) -> update(['vote_name'=>$value]);

            }

            //如有新添加候选项，则执行添加操作
            if($request -> has('vote_name')){

                foreach($request -> input('vote_name') as $value){

                    Vote_option::create(['vote_name'=>$value,'vote_id'=>$request->id]);
                }
            }

            return '1';


        }else{

            //查询该主题的信息
            $vote = Vote::where( 'id',$request -> input('id') ) -> first();

            //查询该主题的下选项信息
            $option = $vote -> vote_option() -> where('vote_id',$vote->id) -> get();

            return view('admin.vote.update',compact('vote','option'));
        }

        
        
    }

    //添加候选人说明
    public function optioninfo(Request $request)
    {
        if( $request -> isMethod('post') ){
 
            $data = $request -> except('_token');
            $id = array_pop($data);
            $num = 0;
            foreach($data['oid'] as $key => $value){

                Vote_option::where('id',$value) -> update([ 'vote_name'=>$data['vote_name'][$key], 'option_content' => $data['option_content'][$key],'model_content' => $data['model_content'][$key] ]);
            }

            return '1';

        }else{

            //获取该主题下的所有候选项
            $option = Vote_option::where( 'vote_id',$request ->input('id') ) -> get();

            return view('admin.vote.optioninfo',compact('option'));
        }
    }
}
