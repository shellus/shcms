<?php
/**
 * Created by PhpStorm.
 * User: shellus
 * Date: 2017-01-08
 * Time: 22:46
 */

namespace App\Console\Commands;

use App\Article;
use GuzzleHttp\Client;

trait CommandHelper
{
    private function request($url){
        $client = new Client();
        $res = $client->request('GET', $url, ['connect_timeout' => 10]);
        return $res->getBody() -> getContents();
    }
    // 乐观锁实现
    protected function getLockArticle(){

        $try = 0;

        do{
            $article = Article::where('version', '=', self::ARTICLE_BEGIN_VERSION) -> first();

            if ($article !== null){
                $this -> info('fetch article lock is ' . $article -> id);
                $bool = Article::where('version', '=', self::ARTICLE_BEGIN_VERSION) -> where('id', '=', $article -> id) -> update(['version' => self::ARTICLE_BEGIN_VERSION + 1]);

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