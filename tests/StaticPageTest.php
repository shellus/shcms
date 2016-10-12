<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StaticPageTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testIndexTitle()
    {
        $this->visit(route('index'))
             ->see(env('APP_NAME'));
    }
}
