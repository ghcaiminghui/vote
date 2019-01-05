<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //关联数据表
    protected $table = 'comment';
    //关闭时间戳
    public $timestamps = false;
    //设置属性
    protected $fillable = ['nickname','content','user_id','vote_id'];
}
