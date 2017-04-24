<?php
/**
 * Created by PhpStorm.
 * User: shellus
 * Date: 2017/3/22
 * Time: 10:43
 */

namespace App\Crawl;


use Psr\Http\Message\ResponseInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;//  implements ShouldQueue
use Illuminate\Foundation\Bus\Dispatchable;

/**
 * 采集抽象类
 * 基本上，每个页面对应一个采集类，通过传入不同的url来采集所有同类页面
 * Class Crawl
 * @package App\Crawl
 */
abstract class Crawl implements ShouldQueue
{
    use EasyCrawl, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /** @var string $url 绝对url */
    protected $url = null;
    protected $options = [];
    protected $defaultOptions = [];

    /**
     * 要采集的url，需符合本类规范
     * Crawl constructor.
     * @param $url
     * @param $options
     */
    public function __construct($options = [])
    {
        $this->options = array_merge($this->defaultOptions, $options);
        $this->url = $this->option('url', $this->url);
    }

    /**
     * 获取配置项
     * @param $key
     * @param null $defaultValue
     * @return mixed|null
     */
    protected function option($key, $defaultValue = null)
    {
        if (!key_exists($key, $this->options)) {
            return $defaultValue;
        }
        return $this->options[$key];
    }

    /**
     * 获取url中的查询字符串
     * @param $name
     * @param null $defaultValue
     * @return null
     */
    protected function urlParam($name, $defaultValue = null)
    {
        $queryString = parse_url($this->url, PHP_URL_QUERY)?:'';
        parse_str($queryString, $queryArray);

        if (!key_exists($name, $queryArray)) {
            return $defaultValue;
        }
        return $queryArray[$name];
    }

    /**
     * 验证url是否符合本类需求
     * @param $url
     * @return bool
     */
    abstract public function validateUrl($url);

    /**
     * 返回页面html内容
     * @param $url
     * @return ResponseInterface
     */
    abstract public function request($url);

    /**
     * 验证页面是否符合本类需求
     * @param $body
     * @return bool
     */
    abstract public function validate(\GuzzleHttp\Psr7\Response $body);

    /**
     * 解析页面数据
     * @param $response
     * @return array
     */
    abstract function parse(\GuzzleHttp\Psr7\Response $response);

    /**
     * 储存内容
     * @param array $parseData
     * @return bool
     */
    abstract function store(array $parseData);

    /**
     * 开始执行采集进程
     */
    public function handle()
    {

        app()->call([$this, 'validateUrl'], [$this->url]);

        /** @var \GuzzleHttp\Psr7\Response $response */
        $response = app()->call([$this, 'request'], [$this->url]);

        app()->call([$this, 'validate'], ['response'=>$response]);


        $parseData = app()->call([$this, 'parse'], ['response'=>$response]);

        app()->call([$this, 'store'], [$parseData]);

        // throw new StoreFailException();
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
}