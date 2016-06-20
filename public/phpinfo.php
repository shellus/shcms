<?php
/**
 * Created by PhpStorm.
 * User: shellus
 * Date: 2016-05-24
 * Time: 10:59
 */

// 载入.env 配置
foreach (explode(PHP_EOL,file_get_contents('../.env')) as $evn){
    putenv(trim($evn));
}


if($_GET['app_key'] === getenv('APP_KEY')){
    phpinfo();
}else{
    echo('Permission denied');
}