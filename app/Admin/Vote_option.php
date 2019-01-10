<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Vote_option extends Model
{
    //关联数据表
    protected $table = 'vote_option';
    //关闭时间戳
    public $timestamps = false;
    //设置属性
    protected $fillable = ['vote_id','vote_name','content','model_content','total'];
}
