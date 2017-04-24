<?php
/**
 * Created by PhpStorm.
 * User: shellus
 * Date: 2017/3/22
 * Time: 11:16
 */

namespace App\Crawl;

use App\Crawl\Exceptions\InvalidResponseException;
use App\Crawl\Exceptions\InvalidUrlException;
use App\Crawl\Exceptions\RequestFailException;
use App\Service\HttpService;
use Psr\Http\Message\ResponseInterface;

/**
 * 轻松采集。
 * Class EasyCrawl
 * @package App\Crawl
 */
trait EasyCrawl
{
    /**
     * @param $url
     * @throws InvalidUrlException
     */
    public function validateUrl($url){

        if (!filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED)){
            throw new InvalidUrlException("Url Invalid : $url");
        }
    }
    /**
     * @param $url
     * @return mixed|ResponseInterface
     * @throws RequestFailException
     */
    public function request($url)
    {
        try{
            return HttpService::request('GET', $url);
        }catch (\GuzzleHttp\Exception\RequestException $e){
            throw new RequestFailException($e->getMessage());
        }
    }
    public function validate(\GuzzleHttp\Psr7\Response $response)
    {
        $code = $response->getStatusCode();
        if (substr($code,0,1) !== '2'){
            throw new InvalidResponseException("Response Http status code: $code");
        }

        if (($size = $response->getBody()->getSize()) < 1){
            throw new InvalidResponseException("Response Body size so min: $size");
        }
    }
}