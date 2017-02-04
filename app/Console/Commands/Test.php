<?php

namespace App\Console\Commands;

use App\User;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Str;


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
        $name = '需求是，给一个table表格的tr添加hover效果,过年前是将background-color属性加在<tr>上，结果hover效果只有三边，当时百思不得骑姐。但是年后的我把background-color属性加在<tbody>上时，居然可以了。

我总结了下，也就是说😊，如果要实现这种列表式的悬浮阴影效果，首先是和background-color有关(我之前一直以为是和border属性有关)，其次这个background-color需要加在父级元素上，而不是需要浮动的元素本身。

演示示例点击预览

请大神解释下这是为什么😊';
        \Storage::put('out.txt', utf8_to_unicode_str($name));
        dd('ok');
        $count = 500000;
        $min = 0.1;
        $max = 666;

        $overCount = \DB::table('articles')->where('money','!=','0')->count();

    }
}
