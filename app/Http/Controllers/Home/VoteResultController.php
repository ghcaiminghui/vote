<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Vote;
use App\Admin\Vote_option;

class VoteResultController extends Controller
{
    //投票显示结果
    public function index()
    {
    	//获取所有启用投票主题
    	$ment = Vote::select('id','title','intro') -> get();

    	//获取所有的候选项
    	$vote_option = Vote_option::get();

    	return view('home.voteresult.index',compact('ment','vote_option'));
    }
}
