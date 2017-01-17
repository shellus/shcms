<?php
/**
 * Created by PhpStorm.
 * User: shellus
 * Date: 2017/1/17
 * Time: 10:33
 */

namespace App\Service;


use App\User;
use Illuminate\Support\Str;

class UserService
{
    /**
     * @param $data
     * @return User
     */
    public static function create($data){
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'register_ip' => \Request::ip(),
            'api_token' => Str::random(60),
        ]);
    }
}