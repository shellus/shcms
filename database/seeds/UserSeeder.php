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
            ['name' => '娃娃脾气', 'email' => 'shellus@endaosi.com','password' => 'a7245810'],
        ];

        foreach($users_data as $user_data){
            $user = with(new \App\Http\Controllers\Auth\RegisterController()) -> create($user_data);
            $this -> command -> info('insert user: ' . $user['email']);
        }


        /** @var User $user */
        $user = User::whereEmail('shellus@endaosi.com') -> firstOrFail();


        $user->attachRole(\App\Role::whereName('Admin') -> firstOrFail());
    }
}
