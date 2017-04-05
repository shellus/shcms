<?php
/**
 * Created by PhpStorm.
 * User: shellus
 * Date: 2017/2/7
 * Time: 16:17
 */

namespace App\Service;

use App\Models\File;
use App\Models\User;
use GuzzleHttp\Exception\ConnectException;
use Symfony\Component\DomCrawler\Crawler;

class SegmentfaultService
{
    /**
     * 处理Segmentfault的问题、回答主体内容，去掉emoji表情等。
     * @param $body
     * @return string
     */
    public static function filterBody($body)
    {
        $dom = new Crawler();
        $dom->addHtmlContent($body);
        $dom->filter('img[data-src]')->reduce(function (Crawler $node) {
            $node->getNode(0)->setAttribute('src', 'https://segmentfault.com/' . $node->attr('data-src'));
            $node->getNode(0)->removeAttribute('data-src');
        });
        try {
            // 神奇的玩意，会自动加上body标签
            $body = $dom->filter('body')->html();
        } catch (\InvalidArgumentException $e) {
            $body = '';
        }

        // 过滤非法标签
        $body = "\r\n" . trim(\Purifier::clean($body)) . "\r\n";
        return $body;
    }

    /**
     * 抓取Segmentfault用户头像
     * @param User $user
     */
    public static function crawlAvatar(User $user)
    {
        list($name, $t) = explode('@', $user->email);
        $url = 'https://segmentfault.com/u/' . $name;
        try{
            $body = HttpService::request('GET', $url)->getBody()->getContents();
        }catch (ConnectException $e){
            \Log::error('user avatar error:' . $user->email);
            return;
        }
        $src = (new Crawler($body))->filter('.profile__heading--avatar')->attr('src');
        $file = HttpService::requestToFile($src);

        File::updateUserAvatarByUploadedFile($user,$file);
    }
}