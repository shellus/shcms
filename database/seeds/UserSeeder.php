<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users_data = [
            ['name' => '娃娃脾气', 'email' => 'shellus@endaosi.com','password' => bcrypt('a7245810')],
        ];

        foreach($users_data as $user_data){
            $user = User::create($user_data);
            $user -> save();
            $this -> command -> info('insert user: ' . $user['email']);
        }


        /** @var User $user */
        $user = User::whereEmail('shellus@endaosi.com') -> firstOrFail();


        $user->attachRole(\App\Role::whereName('Admin') -> firstOrFail());
    }
}
