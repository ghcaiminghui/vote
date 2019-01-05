<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Vote;
use App\Admin\Count_num;
use App\Admin\Vote_option;

class voteinfoController extends Controller
{
    //投票详情页面
    public function index(Request $request)
    {
    	//如果能获取id值,那么就查询相关的主题数据
    	if( $vote_id = $request -> input('id') ){

    		//查询该主题的内容
    		$vote = Vote::where('id',$vote_id) -> first();

    		//查询主题下所有的候选人
    		$vote_option = $vote->vote_option() -> where('vote_id',$vote->id) -> get();

            if( in_array($vote_id, session('voteRecord')) ){

                $bool = true;
            }else{

                $bool = false;
            }

            //查询该主题下的所有评论
            $comment = $vote -> comment() -> get();

    		//加载投票详情页
    		return view('home.voteinfo.index',compact('vote','vote_option','bool','comment'));

    	//否则重新跳转到投票主页
    	}else{

    		return redirect('/home/index/index');
    	}
    	
    }

    //检查提交的投票数据
    public function check(Request $request)
    {

        //判断是否存在候选项的值和投票主题的ID
        if( $request -> has('val') && $request -> has('vote_id') ){

            //获取基本数据
            $data['user_id'] = $request ->input('uid');
            $data['vote_id'] = $request ->input('vote_id');
            $data['vote_option_id'] = $request ->input('val');

            //判断用户是否已经投过票了
            if( !Count_num::where('user_id',$data['user_id']) -> where('vote_id',$data['vote_id']) ->  first()){

                //获取该主题的限制值
                $restrict = Vote::where('id',$data['vote_id']) ->select('ticket_max','ticket_min') -> first();

                //计算客户传过来多少个值
                $num = count($data['vote_option_id']);

                //统计val数组有多少个值,不能大于限制值
                if( $num >= $restrict->ticket_min  && $num <= $restrict->ticket_max ){

                    //将传过来的值转换成字符串
                    $data['vote_option_id'] = implode(',',$data['vote_option_id']);

                    //将数据写入到统计表
                    if( Count_num::create($data) ){

                        //遍历选手值,批量增加候选人表的ID值
                        foreach( $request ->input('val') as $val){

                           Vote_option::where('id',$val) -> increment('total',1);
                        }

                        //投票成功
                        return response() -> json(['msg' => '1']);
                    }
                   
                }else{

                    //超过限制值
                    return response() -> json(['msg' => '4']);
                }

            //已经投过票了
            }else{

                return response() -> json(['msg' => '2']);
            }
    

        }else{

            //返回3非法操作
            return response() -> json(['msg' => '3']);
        }
    }
}
