<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Manager_log extends Model
{
    //日志表
    protected $table = 'manager_log';

    //关闭时间戳
    public $timestamps = false;
}
