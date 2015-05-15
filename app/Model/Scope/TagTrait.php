<?php namespace App\Model\Scope;
/**
 * Created by PhpStorm.
 * User: shellus
 * Date: 2015-05-15
 * Time: 17:54
 */

trait TagTrait{

    public static function bootTagTrait()
    {
        static::addGlobalScope(new TagScope);
    }
}


