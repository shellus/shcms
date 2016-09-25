<?php

namespace App\Console\Commands;

use App\Article;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Symfony\Component\DomCrawler\Crawler;

class CrawlArticle extends Command
{
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
            do{
                try{

                    $this -> info('start fetch article lock');
                    $article = $this -> getLockArticle();


                    if ($article !== false){
                        $this -> info('fetch article lock success is .' . $article -> id);
                        $bool = $this -> crawlPage($article);
                        if($bool){
                            $this -> info(Article::whereToLocal(1) -> count() . '/' . Article::count() );
                        }
                    }else{
                        $this -> warn('fetch article lock fail');
                    }

                }catch (\Exception $e){

                    try
                    {
                        // 解锁
                        /** @var Article $article */
//                        $article -> update([
//                            'version'   => 0,
//                        ]);
                    }catch (\Throwable $t){

                    }
                    $this -> error('Error: ' . $e->getMessage());
                    $this -> error('File: ' . $e->getFile());
                    $this -> error('Line: ' . $e->getLine());
                    $this -> error('url: ' . $this -> url);
                    sleep(5);
                }

            }while(Article::whereToLocal(0) -> count() > 0);


        $this -> info('article all to local done');
    }

    /**
     * @param Article $article
     * @return bool
     */
    protected function crawlPage(Article $article){

        $this -> url = 'https://www.228yu.com' . $article -> referrer;
        $this -> info('start http request,url is ' . $this -> url);
        $body = $this -> request($this -> url);
        $this -> info('http request done , size is ' . strlen($body));
        $crawler = new Crawler($body);

        $title = $crawler -> filter('title') -> text();
        $content = $crawler -> filter('.novelContent') -> html();

        // 解锁
        $bool = $article -> update([
            'body'      => $content,
            'title'     => $title,
            'to_local'  => 1,
            'version'   => 0,
        ]);
        return $bool;
    }
    private function request($url){
        $client = new Client();
        $res = $client->request('GET', $url, ['connect_timeout' => 10]);
        return $res->getBody() -> getContents();
    }
    // 乐观锁实现
    protected function getLockArticle(){

        $try = 0;

        do{
            $article = Article::where('version', '=', 0) -> where('to_local', '=', 0) -> first();

            if ($article !== null){
                $this -> info('fetch article lock is ' . $article -> id);
                $bool = Article::where('version', '=', 0) -> where('id', '=', $article -> id) -> update(['version' => 1]);

                if($bool){
                    // hack
                    return Article::find($article->id);
                }
            }
            $this -> warn('article lock fail, 10ms after retry');
            // 等待10毫秒后再试试
            usleep(1000 * 10);

            // 尝试3次还不行就返回false了。
        }while (++$try < 3);

        return false;
    }
}
