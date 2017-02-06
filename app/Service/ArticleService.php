<?php
/**
 * Created by PhpStorm.
 * User: shellus
 * Date: 2017-02-06
 * Time: 8:48
 */

namespace App\Service;


use Symfony\Component\DomCrawler\Crawler;

class ArticleService
{
    public static function filterSegmentfaultBody($body){
        $dom = new Crawler();
        $dom->addHtmlContent($body);
        $dom->filter('img[data-src]')->reduce(function (Crawler $node){
            $node->getNode(0)->setAttribute('src', 'https://segmentfault.com/'.$node->attr('data-src'));
            $node->getNode(0)->removeAttribute('data-src');
        });
        try{
            // 神奇的玩意，会自动加上body标签
            $body = $dom->filter('body')->html();
        }catch (\InvalidArgumentException $e){
            $body = '';
        }

        // 过滤非法标签
        $body = "\r\n" . trim(\Purifier::clean($body)) . "\r\n";
        return $body;
    }
}