<?php
/**
 * Created by PhpStorm.
 * User: shellus
 * Date: 2016-08-16
 * Time: 2:42
 */

namespace App;


class AdminTemplate
{

    public static function view($view = null, $data = [], $mergeData = [])
    {
        return view('admin/layout',['content' => view('admin/' . $view, $data, $mergeData)]);
    }
}