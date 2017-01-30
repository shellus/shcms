<?php

namespace App\Console\Commands;

use App\KeyWords;
use Illuminate\Console\Command;
use App\Article;
class ArticleLexicalAnalysis extends Command
{
    use CommandHelper;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'article:analysis';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * 数据开始处理的版本
     */
    const ARTICLE_BEGIN_VERSION = 1;
    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        do{
            try{

                $this -> info('start fetch article lock');
                $article = $this -> getLockArticle();


                if ($article !== false){
                    $this -> info('fetch article lock success is .' . $article -> id);
                    $bool = $this -> analysis($article);
                    if($bool){
                        $this -> info(Article::whereVersion(self::ARTICLE_BEGIN_VERSION + 2) -> count() . '/' . Article::count() );
                    }
                }else{
                    $this -> warn('fetch article lock fail');
                }

            }catch (\Exception $e){

                $this -> info('exception and unlock article is .' . $article -> id);
                    // 解锁
                    /** @var Article $article */
                        $article -> update([
                            'version'   => self::ARTICLE_BEGIN_VERSION,
                        ]);
                throw $e;
            }

        }while(Article::whereVersion(self::ARTICLE_BEGIN_VERSION) -> count() > 0);


        $this -> info('article all to local done');
    }

    /**
     * @param Article $article
     * @return bool
     */
    protected function analysis(Article $article){

        // 分段处理超长文章
        if(mb_strlen($article -> body) > 5000){
            $dicts = [];
            for ($i = 0; $i < mb_strlen($article -> body); $i += 5000){
                $dicts = $dicts + \App\Wenzi\ArticleLexicalAnalysis::LexicalAnalysis(mb_substr($article -> body, $i, 5000));
            }
        }else{
            $dicts = \App\Wenzi\ArticleLexicalAnalysis::LexicalAnalysis($article -> body);
        }

        foreach ($dicts as $dict){
            if (mb_strlen($dict['word']) > 10){
                // 大于十个字符就不要了。没这么长的关键词
                continue;
            }
            $data = [
                'word' => $dict['word'],
            ];
            $append = ['weight' => $dict['weight']];

            $this -> info('key words: (' . $dict['word'] . ')');
            /** @var KeyWords $keyWord */
            $keyWord = KeyWords::firstOrCreate($data);
            $article->keyWords()->attach($keyWord, $append);
        }
        $article -> version = 1 + intval($article -> version);
        $article -> save();
        return true;
    }
}
