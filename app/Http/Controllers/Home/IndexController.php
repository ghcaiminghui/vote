<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Vote;

class IndexController extends Controller
{
    //前台首页
    public function index(Request $request)
    {

    	//获取所有status=2的主题
    	$vote = Vote::get(); 

    	return view('home.index.index',compact('vote'));
    }
}
