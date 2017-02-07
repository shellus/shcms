<?php
/**
 * Created by PhpStorm.
 * User: shellus
 * Date: 2017/2/7
 * Time: 16:23
 */

namespace App\Service;

use GuzzleHttp\Client;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Symfony\Component\DomCrawler\Crawler;

class HttpService
{
    public static function request($url)
    {
        $client = new Client();
        \Log::debug("CommandHelper begin request url \"$url\"");
        $res = $client->request('GET', $url, ['connect_timeout' => 10]);
        \Log::debug("CommandHelper request url \"$url\" done, length " . $res->getBody()->getSize() . "");
        return $res->getBody()->getContents();

    }

    public static function requestToCrawler($url)
    {
        $body = self::request($url);
        return new Crawler($body);
    }

    public static function requestToFile($url)
    {
        $urlInfo = parse_url($url);
        $pathInfo = pathinfo($urlInfo['path']);
        $pathInfoKeys = ['filename', 'extension'];
        $pathInfo = Arr::only($pathInfo, $pathInfoKeys);
        $pathInfo = Arr::sort($pathInfo, function ($i, $key) use ($pathInfoKeys) {
            return array_search($key, $pathInfoKeys);
        });
        if(!key_exists('extension', $pathInfo)){
            $pathInfo['extension'] = 'jpg';
        }
        $real_filename = implode('.', $pathInfo);
        $real_path = sys_get_temp_dir() .DIRECTORY_SEPARATOR. $real_filename;

        $client = new Client();
        \Log::debug("CommandHelper begin request url \"$url\"");
        $res = $client->request('GET', $url, ['connect_timeout' => 10, 'sink'=> $real_path]);
        \Log::debug("CommandHelper request url \"$url\" done, length " . $res->getBody()->getSize() . "");
        $mimeType = $res->getHeader('Content-Type');
        $size = $res->getBody()->getSize();

        // TODO 顺序反了
        return new UploadedFile($real_path, $real_filename, $mimeType, $size);
    }
}