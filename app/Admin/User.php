<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //关联数据表
    protected $table = 'user';

    //关闭时间戳
    public $timestamps = false;

    protected $fillable = ['username','password','status'];
}
