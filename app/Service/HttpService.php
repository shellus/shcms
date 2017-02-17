<?php
/**
 * Created by PhpStorm.
 * User: shellus
 * Date: 2017/2/7
 * Time: 16:23
 */

namespace App\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Symfony\Component\DomCrawler\Crawler;

class HttpService
{
    /**
     * 封装的HTTP请求方法。应用内所有HTTP请求都要使用这个，方便统计数据和查看程序运行状态
     * @param $method
     * @param string $uri
     * @param array $options
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public static function request($method, $uri = '', array $options = [])
    {
        $maxRetry = 3;
        $retry=0;
        $defaultOptions = ['connect_timeout' => 10];

        $client = new Client();

        \Log::debug("HttpService begin request url \"$uri\"");

        // 自动重试 $maxRetry 次
        do{
            try{
                $res = $client->request($method, $uri, array_merge($defaultOptions, $options));
            }catch (ConnectException $e){
                $retry++;
                \Log::error("HttpService ConnectException retry $retry url $uri");
                if ($retry >= $maxRetry){
                    throw $e;
                }
            }
        }while(empty($res));


        \Log::debug("HttpService request url \"$uri\" done, length " . $res->getBody()->getSize() . "");
        return $res;

    }

    /**
     * 从url生成DOM。
     * @param $method
     * @param string $uri
     * @param array $options
     * @return Crawler
     * @internal param $url
     */
    public static function requestToCrawler($method, $uri = '', array $options = [])
    {
        $body = self::request($method, $uri, $options)->getBody()->getContents();
        return new Crawler($body);
    }

    /**
     * 下载到文件
     * @param $url
     * @return UploadedFile
     */
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


        $res = HttpService::request('GET', $url, ['sink'=> $real_path]);

        $mimeType = $res->getHeader('Content-Type');
        $size = $res->getBody()->getSize();

        // TODO 顺序反了
        return new UploadedFile($real_path, $real_filename, $mimeType, $size);
    }
}