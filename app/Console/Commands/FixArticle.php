<?php

namespace App\Console\Commands;

use App\Article;
use App\Comment;
use Illuminate\Console\Command;

class FixArticle extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'FixArticle {id?}';

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

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if($id = $this->argument('id')){
            $article = Article::find($id);
            $article->body = CrawlSegmentfault::filterBody($article->body);
            $article->save();
            return;
        }
        Article::chunk(100, function ($articles){
            /** @var Article $article */
            foreach ($articles as $article){
                $article->body = CrawlSegmentfault::filterBody($article->body);
                $article->timestamps = false;
                $article->save();
            }
        });
        Comment::chunk(100, function ($articles){
            /** @var Article $article */
            foreach ($articles as $article){
                $article->body = CrawlSegmentfault::filterBody($article->body);
                $article->timestamps = false;
                $article->save();
            }
        });
    }
}
