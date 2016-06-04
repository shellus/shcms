<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $perms = [
            'access_site' => \App\Permission::create([
                'name' => 'access_site',
                'display_name' => '访问网站',
                'description' => '访问网站的权限',
            ]),
            'tag_create' => \App\Permission::create([
                'name' => 'tag_create',
                'display_name' => '创建标签',
                'description' => '',
            ]),
            'tag_delete' => \App\Permission::create([
                'name' => 'tag_delete',
                'display_name' => '删除标签',
                'description' => '',
            ]),
            'tag_change' => \App\Permission::create([
                'name' => 'tag_change',
                'display_name' => '修改标签',
                'description' => '',
            ]),
            'article_create' => \App\Permission::create([
                'name' => 'article_create',
                'display_name' => '创建文章',
                'description' => '',
            ]),
            'article_delete' => \App\Permission::create([
                'name' => 'article_delete',
                'display_name' => '删除文章',
                'description' => '',
            ]),
            'article_change' => \App\Permission::create([
                'name' => 'article_change',
                'display_name' => '修改文章',
                'description' => '',
            ]),
        ];
        $roles = [
            'default' => \App\Role::create([
                'name' => 'default',
                'display_name' => '普通会员',
                'description' => '新用户默认属于此组',
            ]),
            'editer' => \App\Role::create([
                'name' => 'editer',
                'display_name' => '网站编辑',
                'description' => '内容编辑人员，可以创建内容，修改内容',
            ]),
        ];
        $users = [
            'shellus' => \App\User::create([
                'name' => 'shellus',
                'display_name' => '葛佳祥',
                'email' => 'shellus@endaosi.com',
                'password' => bcrypt('a7245810'),
            ]),

            'temp' => \App\User::create([
                'name' => 'temp',
                'email' => 'temp@temp.com',
                'password' => bcrypt('temp'),
            ]),
        ];

        $roles['default'] -> perms() -> saveMany([
            $perms['access_site'],
            $perms['article_create'],
            $perms['article_delete'],
            $perms['article_change'],
        ]);
        $roles['editer'] -> perms() -> saveMany([
            $perms['access_site'],
            $perms['tag_create'],
            $perms['tag_delete'],
            $perms['tag_change'],
            $perms['article_create'],
            $perms['article_delete'],
            $perms['article_change'],
        ]);

        $users['shellus'] -> roles() -> save($roles['editer']);
        $users['temp'] -> roles() -> save($roles['default']);
        // $users
        
    }
}
