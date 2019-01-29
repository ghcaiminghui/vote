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

            $nextId = $vote -> where('id','>',$vote->id) -> value('id');

    		//查询主题下所有的候选人
    		$vote_option = $vote->vote_option() -> where('vote_id',$vote->id) -> get();

            //判断session是否为空
            if(session('voteRecord')){

                if( in_array($vote_id, session('voteRecord')) ){
                
                    $bool = true;
                }else{

                    $bool = false;
                }
            }else{

                $bool = false;
            }

            //查询该主题下的所有评论
            $comment = $vote -> comment() -> get() ->toArray();

            $ment = Vote::select('id','title','intro') -> get();

    		//判断投票的类型,加载投票详情页
            switch ( $vote->type ) {
                case 2:
                    $viewPath = 'home.voteinfo.index';
                    break;
                case 3:
                    $viewPath = 'home.voteinfo.xingxing';
                    break;
            }

            //加载视图
    		return view($viewPath,compact('vote','vote_option','bool','comment','ment','nextId'));


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

            //判断主题活动是否启用状态
            if( $vote = Vote::where('id',$data['vote_id']) -> where('status','2') -> first() ){

                //判断用户是否已经投过票了
                if( !Count_num::where('user_id',$data['user_id']) -> where('vote_id',$data['vote_id']) ->  first()){

                    //计算客户传过来多少个候选人
                    $num = count($data['vote_option_id']);

                    //控制投票主题的投票上限
                    if( $num >= $vote->ticket_min  && $num <= $vote->ticket_max ){

                        //将传过来的值转换成字符串
                        $data['vote_option_id'] = implode(',',$data['vote_option_id']);

                        //将数据写入到统计表
                        if( Count_num::create($data) ){

                            //每一人投票就往主题表total自增1,用于统计主题的投票人数
                            $vote -> where('id',$data['vote_id']) -> increment('total',1);

                            //遍历选手值,批量增加候选人表的ID值
                            foreach( $request ->input('val') as $val){

                               Vote_option::where('id',$val) -> increment('total',1);
                            }

                            //投票成功之前写入投票的session信息(用于判断用户是否已投票)
                            $request -> session() -> push('voteRecord',$data['vote_id']);

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

            //投票主题处于禁用状态
            }else{

                return response() -> json(['msg' => '5']);
            }
    

        }else{

            //返回3非法操作
            return response() -> json(['msg' => '3']);
        }
    }

    //模态框
    public function model(Request $request)
    {

        $id = $request -> input('id');

        $model = Vote_option::where('id',$id) -> select('model_content','vote_name') -> first();

        return response() -> json(['msg' => $model->model_content,'title'=>$model->vote_name]);
    }

    //处理星星投票的数据
    public function checkXing(Request $request){

        //接收数据
        $data = $request -> only(['arr','jian','vote_id','uid']);

        if( isset($data) && $data['vote_id'] && $data['uid'] ){

            //判断用户是否已经投过票了
            if( !Count_num::where('user_id',$data['uid']) -> where('vote_id',$data['vote_id']) ->  first()){
                //生成新得数组
                $arr = array_combine($data['jian'], $data['arr']);
                //选项的ID值
                $vote_option_id = implode(',', array_keys($arr));
                //选项的成绩
                $score = implode(',', $arr);

                if( Count_num::create([

                    'user_id'   =>  $data['uid'],
                    'vote_id'   =>  $data['vote_id'],
                    'vote_option_id'    =>  $vote_option_id,
                    'vote_option_score' =>  $score
                ]) ){

                    //遍历评分数据$key=候选人的ID,$value=评的分数
                    foreach ($arr as $key => $value){

                        Vote_option::where('id',$key)->where('vote_id',$data['vote_id'])-> increment('total_points',$value);
                    }

                    //主题表更新total代表多了一个投票
                    Vote::where('id',$data['vote_id'])-> increment('total',1);

                    //投票成功之前写入投票的session信息(用于判断用户是否已投票)
                    $request -> session() -> push('voteRecord',$data['vote_id']);

                    //投票成功
                    return response() -> json(['msg' => '1']);

                }
            //用户已经投票
            }else{

                return response() -> json(['msg' => '2']);
            }
        }
    }
}
