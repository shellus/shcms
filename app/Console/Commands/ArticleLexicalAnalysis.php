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
    const ARTICLE_BEGIN_VERSION = 0;
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

                try
                {
                    // 解锁
                    /** @var Article $article */
                        $article -> update([
                            'version'   => self::ARTICLE_BEGIN_VERSION,
                        ]);
                }catch (\Throwable $t){
                    dd('unlock fail？？？');
                }
                var_dump($e);
                $this -> error('Error: ' . $e->getMessage());
                $this -> error('File: ' . $e->getFile());
                $this -> error('Line: ' . $e->getLine());
                sleep(5);
            }

        }while(Article::whereVersion(self::ARTICLE_BEGIN_VERSION) -> count() > 0);


        $this -> info('article all to local done');
    }

    /**
     * @param Article $article
     * @return bool
     */
    protected function analysis(Article $article){
        $dicts = \App\Wenzi\ArticleLexicalAnalysis::LexicalAnalysis($article -> body);
        foreach ($dicts as $dict){
            $data = [
                'word' => $dict['word'],
            ];
            $this -> info('key words: (' . mb_convert_encoding($dict['word'],'GBK') . ')');
            $append = ['pos' => $dict['pos']];
            /** @var KeyWords $keyWord */
            $keyWord = KeyWords::firstOrCreate($data);
            $article->keyWords()->attach($keyWord, $append);
            $keyWord -> weights += 1;
            $keyWord -> save();

            $article -> version += 1;
            $article -> save();
            return true;
        }
    }
}
