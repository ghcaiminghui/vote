<?php

use Illuminate\Database\Seeder;

class ManagerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //定义数据
        $data = [

        	'username' => 'admin',
        	'passwd'   => bcrypt('admin')
        ];

        //写入数据
        DB::table('manager') -> insert($data);
    }
}
