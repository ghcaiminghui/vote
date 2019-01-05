<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Comment;

class CommentController extends Controller
{
    //评论列表
    public function index(Request $request)
    {

    	if( $request -> isMethod('post') ){

    		//判断结果的参数为真的话就执行删除
    		if( $id = $request -> input('id') ){

    			if (Comment::where('id',$id) -> delete() ){

    				return '1';
    			}
    		}


    	}else{

	    	//获取所有的评论
	    	$data = Comment::join('user as u','comment.user_id','=','u.id')->join('vote as v','comment.vote_id','=','v.id')-> select('comment.*','u.username as name','v.title') -> get();

	    	//dd($data);

	    	return view('admin.comment.index',compact('data'));
    	}
    }

    //修改评论
    public function update(Request $request)
    {
    	if($request -> isMethod('post')){

    		$data = $request -> only(['nickname','content','id']);
    		$id = array_pop($data);
    		
    		//更新到数据库
    		if( Comment::where('id',$id) -> update($data) ){

    			return '1';
    		}

    	}else{

    		//获取修改用户的ID
    		$id = $request -> input('id');
    		//查询用户的数据
    		$commentinfo = Comment::where('id',$id) -> first();

    		return view('admin.comment.update',compact('commentinfo'));
    	}
    	
    }

}
