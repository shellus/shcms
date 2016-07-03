<?php
/**
 * Created by PhpStorm.
 * User: shellus
 * Date: 2016-07-03
 * Time: 0:45
 */
namespace App;

use Illuminate\Support\Facades\Auth;

class PasswordGrantVerifier
{
    public function verify($username, $password)
    {
        $credentials = [
            'name'    => $username,
            'password' => $password,
        ];

        if (Auth::once($credentials)) {
            return Auth::user()->id;
        }

        return false;
    }
}