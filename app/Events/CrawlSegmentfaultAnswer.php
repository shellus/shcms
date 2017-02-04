<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CrawlSegmentfaultAnswer extends CrawlSegmentfault
{
    /**
     * Create a new event instance.
     *
     * @param $question
     * @param $answer
     * @internal param $title
     * @internal param $body
     * @internal param $url
     */
    public function __construct($question, $answer)
    {
        $this->title = mb_convert_encoding("回答：" . $question['title'], 'GBK');
        $this->body = mb_convert_encoding(strip_tags($answer['body']), 'GBK');
        $this->url = $question['url'];
        //
    }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }


}
