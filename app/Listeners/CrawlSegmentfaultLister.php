<?php

namespace App\Listeners;

use App\Events\CrawlSegmentfault;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CrawlSegmentfaultLister implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CrawlSegmentfault  $event
     * @return void
     */
    public function handle(CrawlSegmentfault $event)
    {
        $body = mb_str_replace('\r\n','',$event->getBody());
        $body = mb_str_replace('\n','',$body);
        $body = mb_substr($body,0,100);

        if (config('app.env') === 'local'){
            $os = '';
            //TODO 操作系统更改编码
            stristr(PHP_OS, 'DAR')   && $os = 'utf-8';
            stristr(PHP_OS, 'WIN')   && $os = 'GBK';
            stristr(PHP_OS, 'LINUX') && $os = 'utf-8';
            // 窗口输出
            exec(mb_convert_encoding('notify -t '.$event->getTitle().' -m "'.$body.'" -s --open '.$event->getUrl().'', $os));
    }
}
