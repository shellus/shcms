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

        if (config('app.env') === 'local'){
            exec(mb_convert_encoding('notify -t '.$event->getTitle().' -m "'.$event->getBody().'" -s --open '.$event->getUrl().'', 'GBK'));
        }

    }
}
