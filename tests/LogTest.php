<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class LogTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $handler = new StreamHandler(__DIR__.'/../debug.sql', Logger::DEBUG);
        $logger = new Logger('sqlLog', array($handler));

        $logger ->error('123',$trace = debug_backtrace());
    }
}
