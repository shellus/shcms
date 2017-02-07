<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CrawlSegmentfaultQuestion extends CrawlSegmentfault
{
    /**
     * Create a new event instance.
     *
     * @param $question
     * @internal param $answer
     * @internal param $title
     * @internal param $body
     * @internal param $url
     */
    public function __construct($question)
    {
        $this->title = "提问：" . $question['title'];
        $this->body = $question['user']['name'] .': '.trim(strip_tags($question['body']));
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
