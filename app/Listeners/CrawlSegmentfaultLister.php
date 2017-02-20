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
        $title = $event->getTitle();


        if (config('app.env') === 'local'){
            // TODD 除Windows系列都设定其为UTF-8编码
            $os = strtoupper(substr(PHP_OS, 0, 3)) === 'WIN' ? 'GBK' : 'UTF-8';
            exec(mb_convert_encoding('notify -t '.$title.' -m "'.$body.'" -s --open '.$event->getUrl().'', $os));
        }
    }
}
