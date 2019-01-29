<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Count_num extends Model
{
    //关联数据表
    protected $table = 'count_num';
    //关闭时间戳
    public $timestamps = false;
    //设置属性
    protected $fillable = ['user_id','vote_id','vote_option_id','count_num','vote_option_score'];
}
