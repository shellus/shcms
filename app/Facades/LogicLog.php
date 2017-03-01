<?php namespace App\Facades;
use \Illuminate\Support\Facades\Facade;
/**
 * Created by PhpStorm.
 * User: shellus
 * Date: 2017/3/1
 * Time: 15:49
 */
class LogicLog extends Facade
{
    protected static function getFacadeAccessor() {
        return 'LogicLog';
    }
}