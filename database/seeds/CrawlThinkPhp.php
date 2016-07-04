<?php

/**
 * Created by PhpStorm.
 * User: shellus
 * Date: 2016-07-04
 * Time: 16:59
 */
use Symfony\Component\DomCrawler\Crawler;
class CrawlThinkPhp
{

    protected $links;
    private $base_url = 'http://www.thinkphp.cn';

    /**
     * CrawlThinkPhp constructor.
     * @param bool $start
     */
    public function __construct($start = false)
    {
    }
    public function getItem($link){
        $body = $this ->request($link);
        $crawler = new Crawler($body);
        return [
            'title' => $crawler -> filter('.t-head h2') -> text(),
            'body' => $crawler -> filter('.detail-bd') -> html(),
        ];
    }

    /**
     * @return Generator
     */
    public function getItems(){
        foreach ($this -> links as $link){
            yield $this -> getItem($link);
        }
    }
    public function getIndexLinks($page = 1){
        $body = $this ->request($this -> base_url . '/topic/index/p/' . $page . '.html');
        $crawler = new Crawler($body);
        $this -> links = $crawler->filter('.topiclist  li a:nth-child(2)') ->each(function (Crawler $node, $i) {
            return $this -> base_url . $node->attr('href');
        });
        return $this;
    }
    private function request($url){
        $client = new GuzzleHttp\Client();
        $res = $client->request('GET', $url);
        return $res->getBody() -> getContents();
    }
}