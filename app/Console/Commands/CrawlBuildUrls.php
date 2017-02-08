<?php

namespace App\Console\Commands;

use App\Article;
use App\Category;
use App\Service\HttpService;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Symfony\Component\DomCrawler\Crawler;

class CrawlBuildUrls extends Command
{
    protected $pageUrls = [];
    protected $pageUrl = [];
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl:buildUrls';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function buildPageUrls()
    {
        $url = "https://www.228yu.com/htm/novellist9/{i}.htm";
        for ($i = 1; $i <= 119; $i++) {
            $this->pageUrls[] = str_replace('{i}', $i, $url);
        }
    }

    public function buildUrls()
    {
        $this->output->progressStart(count($this->pageUrls));

        foreach ($this->pageUrls as $index => $pageUrl) {
            $this->pageUrl = [$index => $pageUrl];
            $urls = $this->getItem($pageUrl);
            foreach ($urls as $url) {
                try {
                    $article = Article::create($url);
                    $article->categories()->attach(Category::find(8));
                } catch (\Exception $e) {
                    dump($e);
                    $this->info(\GuzzleHttp\json_encode($this->pageUrl));
                }

            }

            $this->output->progressAdvance();
        }

        $this->output->progressFinish();
    }

    public function getItem($link)
    {
        $body = HttpService::request('GET',$link)->getBody()->getContents();
        $crawler = new Crawler($body);
        $lis = $crawler->filter('.textList li');

        $urls = $lis->each(function (Crawler $node, $i) {

            // 清除日期
            $node->filter('a span')->first()->getNode(0)->nodeValue = '';

            return [
                'title' => '',
                'body' => '',
                'referrer_title' => $node->text(),
                'referrer' => $node->filter('a')->first()->attr('href'),
                'to_local' => 0,
            ];
        });
        return $urls;
    }

    private function request($url)
    {
        $client = new Client();
        $res = $client->request('GET', $url);
        return $res->getBody()->getContents();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->buildPageUrls();
        $this->buildUrls();
    }
}
