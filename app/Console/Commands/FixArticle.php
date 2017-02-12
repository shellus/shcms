<?php

namespace App\Console\Commands;

use App\Article;
use App\Comment;
use App\Service\ArticleService;
use App\Service\SegmentfaultService;
use App\User;
use GuzzleHttp\Exception\ConnectException;
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
        $comment_datas = \DB::table('comments')->get();
        foreach ($comment_datas as $comment_data){
            $data = (array)$comment_data;
            unset($data['id']);
            unset($data['parent_id']);
            $data['type'] = 'comment';
            \DB::table('articles')->insert($data);
        }
    }
}
