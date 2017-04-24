<?php

namespace App\Crawl;

use Carbon\Carbon;
use GuzzleHttp\Psr7\Response;
use Symfony\Component\DomCrawler\Crawler;


class SegmentfaultQuestionList extends Crawl
{
    use EasyCrawl;

    protected $defaultOptions = [
        'url-template' => 'https://segmentfault.com/questions?page={page}',
        'baseUrl' => 'https://segmentfault.com',
    ];

    public function page($page)
    {
        $this->url = str_replace('{page}', $page, $this->option('url-template'));
    }

    public function parse(Response $response)
    {
        $cacheKey = 'crawl:questions:page:' . $this->urlParam('page', '1');

        $dom = new Crawler($response->getBody()->getContents());

        $new_index_list = [];
        // 从DOM取出问题url列表，并用问题url.回答数量.是否采纳做一个md5.用来对比某个问题是否已经更新，需要再次去采集
        $dom->filter('.stream-list .stream-list__item')->each(function (Crawler $node, $i) use (&$new_index_list) {
            $url = $node->filter('.title a')->attr('href');
            $answersCount = intval($node->filter('.qa-rank .answers')->html());
            $solved = $node->filter('.qa-rank .solved')->count();
            $md5 = "$url-$answersCount-$solved";
            $new_index_list[$md5] = $url;
        });
        // 获取上次抓取列表
        $oldQuestionList = \Cache::get($cacheKey, []);

        // 和上次的问题列表的差集，得出改变的问题列表
        $questionList = array_diff_key($new_index_list, $oldQuestionList);

        // 如果有改变，就存取来作为下次对比差异用
        if ($questionList) {
            \Cache::put($cacheKey, $new_index_list, Carbon::now()->addYear());
        }
        return $questionList;
    }


    public function store(array $questionUrls)
    {
        // 循环抓取每一个问题的数据
        // array_reverse是因为要反向获取，不然顺序是倒的。
        foreach (array_reverse($questionUrls) as $k => $questionPageUrl) {
            $url = $this->option('baseUrl') . $questionPageUrl;
            // 委派队列任务采集子页面
            dispatch((new SegmentfaultQuestionPage(['url' => $url]))->onQueue('high'));
        }
    }
}
