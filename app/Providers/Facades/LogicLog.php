<?php
/**
 * Created by PhpStorm.
 * User: shellus
 * Date: 2016-06-17
 * Time: 10:40
 */

namespace App\Providers\Facades;


class LogicLog extends \Illuminate\Support\Facades\Facade
{
    /**
     * {@inheritDoc}
     */
    protected static function getFacadeAccessor()
    {
        return 'LogicLog';
    }
}