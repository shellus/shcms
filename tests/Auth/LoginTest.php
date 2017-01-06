<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{
    protected $testUser = [
            'name' => 'unittest',
            'email' => 'unittest@test.com',
            'password' => 'unitx2.1@NP',
        ];

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRegister()
    {

        $testUser = $this -> testUser;

        $this->visit(route('register'))
            ->type($testUser['name'], 'name')
            ->type($testUser['email'], 'email')
            ->type($testUser['password'], 'password')
            ->type($testUser['password'], 'password_confirmation')
            ->press('register')
            ->seePageIs(route('home'));

        $this ->visit(route('home'))->press('')->seePageIs(route('index'));
    }

    public function testLogin()
    {
        $testUser = $this -> testUser;

        $this->visit(route('login'))
            ->type($testUser['email'], 'email')
            ->type($testUser['password'], 'password')
            ->check('remember')
            ->press('login')
            ->seePageIs(route('home'));

        $this ->visit(route('home'))->press('')->seePageIs(route('index'));
    }

    public function testDeleteTestUser(){
        $testUser = \Illuminate\Support\Arr::only($this -> testUser,['name','email']);
        $deleteRowCount = \App\User::where($testUser) -> delete();
        $this -> assertEquals(1, $deleteRowCount);
    }

}
