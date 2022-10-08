<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['name' => 'admin' ,'display_name' => 'Quản trị hệ thống'],
            ['name' => 'guest' ,'display_name' => 'Khách hàng'],
            ['name' => 'developer' ,'display_name' => 'Phát triển web'],
            ['name' => 'content' ,'display_name' => 'Chỉnh sửa nội dung'],
        ]);
    }
}
