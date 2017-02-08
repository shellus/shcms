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
        if ($id = $this->argument('id')) {
            $article = Article::find($id);
            $article->body = CrawlSegmentfault::filterBody($article->body);
            $article->save();
            return;
        }
        $users = User::where('email', 'LIKE', '%@segmentfault.com')->whereNull('avatar_id')->get();

        foreach ($users as $user) {
            SegmentfaultService::crawlAvatar($user);
            $this->info(User::whereNotNull('avatar_id')->count() . '/' . User::count());
        }
    }
}
