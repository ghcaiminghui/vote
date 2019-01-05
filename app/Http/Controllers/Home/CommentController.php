<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Comment;

class CommentController extends Controller
{
    //发表评论
    public function create(Request $request)
    {

    	$data = $request -> only(['nickname','user_id','content','vote_id']);

    	if( Comment::create($data) ){

    		//成功
    		return '1';
    	}else{

    		//失败
    		return '2';
    	}
    }
}
