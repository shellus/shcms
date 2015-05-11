<?php
/**
 * Created by PhpStorm.
 * User: shellus
 * Date: 2015-04-30
 * Time: 16:17
 */


function action($name, $parameters = array())
{
    return app('url')->action($name, $parameters,false);
}
/*
function route($name, $parameters = array(), $absolute = flase, $route = null)
{
    return app('url')->route($name, $parameters, $absolute, $route);
}
function url($path = null, $parameters = array(), $secure = null)
{
    return app('url')->to($path, $parameters, $secure);
}
function asset($path, $secure = null)
{

    return url($path);
}
*/
/**
 * 计算给定时间戳与当前时间相差的时间，并以一种比较友好的方式输出
 */
function tmspan($timestamp, $current_time = 0) {

    if (isset($current_time))$current_time = time ();


    if(!is_int($timestamp))$timestamp = $timestamp -> timestamp;


    $span = $current_time -  $timestamp;

    if ($span < 60) {
        $return = "一分钟内";
    } else if ($span < 3600) {
        $return = intval ( $span / 60 ) . "分钟前";
    } else if ($span < 24 * 3600) {
        $return = intval ( $span / 3600 ) . "小时前";
    } else if ($span < (7 * 24 * 3600)) {
        $return = intval ( $span / (24 * 3600) ) . "天前";
    } else {
        $return = date ( 'Y-m-d', $timestamp );
    }
    return $return;
}