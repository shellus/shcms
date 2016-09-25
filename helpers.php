<?php
/**
 * Created by PhpStorm.
 * User: shellus
 * Date: 2016-09-25
 * Time: 4:20
 */
function getQueryLog(){
    $querys = \DB::getQueryLog();
    $returns = [];
    /** @var \Illuminate\Database\Events\QueryExecuted $query */
    foreach ($querys as $query){
        $return['sql'] = $query['query'];
        foreach ($query['bindings'] as $binding){
            $return['sql'] = preg_replace ('/\?/i', '\'' . $binding . '\'', $return['sql'], 1);
        }
        $return['bindings'] = $query['bindings'];
        $return['time'] = $query['time'];
        $returns[] = $return;
    }
    return $returns;
}