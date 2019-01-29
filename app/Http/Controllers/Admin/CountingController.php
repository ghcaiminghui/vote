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

    //删除主题投票记录
    public function delete(Request $request)
    {
        //投票主题ID
        $vote_id = $request -> input('id');

        //用户投票记录的id
        $cid = $request -> input('cid');

        //删除主题ID的记录
        if( $vote_id ){

            //删除用户投票记录
            Count_num::where('vote_id',$vote_id)->delete();

            //将投票选项的值初始化
            Vote_option::where('vote_id',$vote_id)->update(['total'=>0,'total_points'=>0]);

            //返回成功信息
            return response() -> json(['msg'=>1]);
        }

        //删除用户的投票记录
        if( $cid ){

            //查询用户投票记录
            $count = Count_num::where('id',$cid)->first();

            //删除用户投票记录
            $count ->  delete();

            $voteResult = explode(',',$count->vote_option_id);

            //判断是星星投票还是多选投票
            $vote = Vote::where('id',$count->vote_id)->first();

            switch ($vote->type){

                case 2:
                    //多选操作
                    foreach( $voteResult as $value){

                        //投票统计票数减一
                        Vote_option::where('id',$value)->decrement('total', 1);
                    }

                    //主题记录投票人数减一
                    $vote -> decrement('total',1);

                    //成功
                    return response()->json(['msg'=>1]);break;

                case 3:
                    //分数转换成数组
                    $voteScore = explode(',',$count->vote_option_score);

                    $arr = array_combine($voteResult,$voteScore);

                    //key是投票选项的ID,$value是评分的分数
                    foreach($arr as $key => $value){

                        Vote_option::where('id',$key)->decrement('total_points',$value);
                    }

                    //主题记录投票人数减一
                    $vote -> decrement('total',1);

                    //成功
                    return response()->json(['msg'=>1]);break;
            }
        }
    }

}
