<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $founder = new Role;
        $founder->name = 'Founder';
        $founder->display_name = '创始人';
        $founder->save();

        $admin = new Role;
        $admin->name = 'Admin';
        $admin->display_name = '管理员';
        $admin->save();

        $general = new Role;
        $general->name = 'Default';
        $general->display_name = '普通会员';
        $general->save();

        // Create Permissions
        $manageContent = new Permission;
        $manageContent->name = 'manage_contents';
        $manageContent->display_name = '内容管理权限';
        $manageContent->save();

        $manageUsers = new Permission;
        $manageUsers->name = 'manage_users';
        $manageUsers->display_name = '用户管理权限';
        $manageUsers->save();



        // Assign Permission to Role
        $founder->perms()->sync([$manageContent->id,$manageUsers->id]);

        $admin->perms()->sync([$manageContent->id]);

    }
}
