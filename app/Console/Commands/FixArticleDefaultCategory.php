<?php

namespace App\Console\Commands;

use App\Article;
use Illuminate\Console\Command;

class FixArticleDefaultCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'FixArticleDefaultCategory';

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
        Article::chunk(100, function ($articles){
            /** @var Article $article */
            foreach ($articles as $article){
                $article->category();
            }
        });
    }
}
