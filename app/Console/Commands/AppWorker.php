<?php
/**
 * Created by PhpStorm.
 * User: shellus
 * Date: 2016-09-17
 * Time: 0:41
 */

namespace App\Console\Commands;

use Workerman\Connection\TcpConnection;

class AppWorker extends LaravelWorker
{
    public static $args=[];

    /**
     * AppWorker constructor.
     * @param string $socket_name
     * @param array $context_option
     */
    public function __construct($socket_name, array $context_option = [])
    {
        parent::__construct($socket_name, $context_option);

        // 设置回调
        $this -> onMessage = [$this, 'onMessage'];
    }


    /**
     * 收到消息
     * @param TcpConnection $connection
     * @param $data
     */
    public function onMessage(TcpConnection $connection, $data){
        foreach ($connection -> worker -> connections as $connection){
            /** @var TcpConnection $connection */
            $connection -> send($data);
        }
    }

}