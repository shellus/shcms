<?php

namespace App\Console\Commands;

use App\Article;
use App\Category;
use Illuminate\Console\Command;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test';

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
        $total = Article::count();
        $count = 10;
        $ids = [];
        while ($count --> 1){
            $ids[] = rand(0, $total);
        }
        dump($ids);
        $articles = Article::where('id', 'in', $ids) -> get();
        dd($articles);

//        $articles = Article::limit(10) -> orderByRaw('RAND()') -> get();
    }
}
