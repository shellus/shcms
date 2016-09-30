<?php namespace App\WebSocket;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
/**
 * Created by PhpStorm.
 * User: shellus-out
 * Date: 2016/9/30
 * Time: 10:07
 */
class AirtcleController implements MessageComponentInterface
{
    public function onOpen(ConnectionInterface $conn) {
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        var_dump($msg);
    }

    public function onClose(ConnectionInterface $conn) {
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
    }
}