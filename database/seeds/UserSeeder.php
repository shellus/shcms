<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * 添加默认的管理员账号
     *
     * @return void
     */
    public function run()
    {
        $user = \App\Models\User::create([
            'name'        => 'admin',
            'email'       => 'admin@admin.com',
            'password'    => bcrypt('admin'),
            'register_ip' => '',
        ]);
        $adminRole = \App\Models\Role::where('name','=','Admin')->first();
        $user->attachRole($adminRole);
    }
}
