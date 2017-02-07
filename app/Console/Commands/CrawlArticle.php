<?php

namespace App\Console\Commands;

use App\Article;
use Illuminate\Console\Command;
use Symfony\Component\DomCrawler\Crawler;

class CrawlArticle extends Command
{
    use CommandHelper;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cwawl:articleToLocal';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    protected $url;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        do {
            try {

                $this->info('start fetch article lock');
                $article = $this->getLockArticle();


                if ($article !== false) {
                    $this->info('fetch article lock success is .' . $article->id);
                    $bool = $this->crawlPage($article);
                    if ($bool) {
                        $this->info(Article::whereToLocal(1)->count() . '/' . Article::count());
                    }
                } else {
                    $this->warn('fetch article lock fail');
                }

            } catch (\Exception $e) {

                try {
                    // 解锁
                    /** @var Article $article */
//                        $article -> update([
//                            'version'   => 0,
//                        ]);
                } catch (\Throwable $t) {

                }
                $this->error('Error: ' . $e->getMessage());
                $this->error('File: ' . $e->getFile());
                $this->error('Line: ' . $e->getLine());
                $this->error('url: ' . $this->url);
                sleep(5);
            }

        } while (Article::whereToLocal(0)->count() > 0);


        $this->info('article all to local done');
    }

    /**
     * @param Article $article
     * @return bool
     */
    protected function crawlPage(Article $article)
    {

        $this->url = 'https://www.228yu.com' . $article->referrer;
        $this->info('start http request,url is ' . $this->url);
        $body = HttpService::request($this->url);
        $this->info('http request done , size is ' . strlen($body));
        $crawler = new Crawler($body);

        $title = $crawler->filter('title')->text();
        $content = $crawler->filter('.novelContent')->html();

        // 解锁
        $bool = $article->update([
            'body' => $content,
            'title' => $title,
            'to_local' => 1,
            'version' => 0,
        ]);
        return $bool;
    }

}
