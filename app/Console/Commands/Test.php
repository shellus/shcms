<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

use Illuminate\Contracts\Queue\ShouldQueue;

class Test extends Command implements ShouldQueue
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
        for($i =0 ; $i < 3000; $i++){
            $s = new \App\Crawl\SegmentfaultQuestionList(['url'=>"https://segmentfault.com/questions?page=$i"]);
            dispatch($s);
        }

    }
}
