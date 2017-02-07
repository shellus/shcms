<?php
/**
 * Created by PhpStorm.
 * User: shellus
 * Date: 2017/2/7
 * Time: 16:23
 */

namespace App\Service;

use GuzzleHttp\Client;

class HttpService
{
    public static function request($url){
        $client = new Client();
        \Log::debug("CommandHelper begin request url \"$url\"");
        $res = $client->request('GET', $url, ['connect_timeout' => 10]);
        \Log::debug("CommandHelper request url \"$url\" done, length ".$res->getBody() -> getSize()."");
        return $res->getBody() -> getContents();
    }
}