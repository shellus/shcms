<?php

namespace App\Console\Commands;

use App\File;
use App\Service\HttpService;
use App\Service\SegmentfaultService;
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
        dd(\Storage::url('avatar/user_1/2VxSm9azApyS99ES.jpg'));

//        SegmentfaultService::crawlAvatar(User::find(2));

    }
}
