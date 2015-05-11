<?php
/**
 * Created by PhpStorm.
 * User: shellus
 * Date: 2015-04-20
 * Time: 14:47
 */
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = [
            [
                'name' => '娃娃脾气',
                'email' => 'shellus@vip.qq.com',
                'password' => '$2y$10$NGpz8lhg63otXuTQiywcYOsPrVRZwWvQ4ABx.JlklOh9SM7otx56S',
            ],
        ];


        foreach($users as $user){
            $model = \App\Model\User::create($user);

            $this -> command -> info($model -> id);
        }
    }
}

