<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;

class Manager extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{
    //关联数据表
    protected $table = 'manager';

    //关闭时间戳
    public $timestamps = false;

    protected $fillable = ['password'];

    //使用
    use Authenticatable;
}
