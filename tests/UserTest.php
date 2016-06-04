<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
//        $body = $this -> curl('/auth/login')-> send() -> body;
//        if(preg_match('/name="_token" value="(.*?)"/i', $body, $match)){
//            $token = $match[1];
//        }else{
//            throw new Exception('token Not found');
//        }
        $user = \App\User::first(['email','password']);
        dump(Auth::attempt($user ->toArray()));

        $this->assertTrue(true);
    }
}
