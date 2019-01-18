<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    //关联数据表
    protected $table = 'vote';
    //关闭时间戳
    public $timestamps = true;
    //设置属性
    protected $fillable = ['title','intro','type','ticket_min','ticket_max','content','total','status'];
    //一对多
    public function vote_option()
    {
    	return $this->hasMany('App\Admin\Vote_option', 'vote_id', 'id');
    }
    //一个主题对多个评论
    public function comment()
    {
        return $this->hasMany('App\Admin\Comment', 'vote_id', 'id');
    }
    
}
