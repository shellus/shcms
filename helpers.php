<?php
/**
 * Created by PhpStorm.
 * User: shellus
 * Date: 2016-09-25
 * Time: 4:20
 */
function getQueryLog(){
    static $querys;
    if (!$querys){
        $querys = \DB::getQueryLog();
    }
    $returns = [
        'total_time' => 0,
        'sqls' => [],
    ];
    /** @var \Illuminate\Database\Events\QueryExecuted $query */
    foreach ($querys as $query){
        $return['sql'] = $query['query'];
        foreach ($query['bindings'] as $binding){
            $return['sql'] = preg_replace ('/\?/i', '\'' . $binding . '\'', $return['sql'], 1);
        }
        $return['bindings'] = $query['bindings'];
        $return['time'] = $query['time'];
        $returns['sqls'][] = $return;
        $returns['total_time'] += $query['time'];
    }
    return $returns;
}

function br2nl($text){
    return preg_replace('/<br\\s*?\/??>/i','',$text);
}