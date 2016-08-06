<?php

/**
 * Created by PhpStorm.
 * User: shellus
 * Date: 2016-08-05
 * Time: 12:57
 */
class Test
{

    /**
     * 魔术方法，访问类成员时，会转向调用到此方法
     */
    function __get($name)
    {
        return call_user_func(array($this, $name));
    }

    public function users(){
        return ['a','b','c'];
    }
}

$test = new Test();
var_dump($test -> users);