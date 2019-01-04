<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class voteinfoController extends Controller
{
    //投票详情页面
    public function index(Request $request)
    {
    	return view('home.voteinfo.index');
    }
}
