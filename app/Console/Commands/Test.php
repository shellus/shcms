<?php

namespace App\Console\Commands;

use App\User;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Symfony\Component\DomCrawler\Crawler;


class Test extends Command
{
    use CommandHelper;
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
        $name = '<p><img data-src="/img/bVIIqL?w=755&amp;h=341"><br>实际开发中有这么一个需求 看到了antd的RightTab<br>由于字体太大 导致占据高度太多 请问是否可以改变字体大小？<br><img data-src="/img/bVIIqN?w=938&amp;h=663"></p>';

        $name = CrawlSegmentfault::filterBody($name);
        var_dump($name);
        dd();
        $overCount = \DB::table('articles')->where('money','!=','0')->count();

    }
}
