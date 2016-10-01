<?php namespace App\WebSocket;
use Illuminate\Session\SessionManager;
use Guzzle\Http\Message\RequestInterface;
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
    protected $clients;
    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }
    public function onOpen(ConnectionInterface $conn, RequestInterface $request = null) {
        $this->clients->attach($conn);
        // Create a new session handler for this client
        $session = (new SessionManager(app()))->driver();
        // Get the cookies
        $cookies = $conn -> WebSocket -> request ->getCookies();
        // Get the laravel's one
        $laravelCookie = urldecode($cookies[config('session.cookie')]);

        // get the user session id from it
        $idSession = \Crypt::decrypt($laravelCookie);
        // Set the session id to the session handler
        $session->setId($idSession);
        // Bind the session handler to the client connection
        $conn->session = $session;
    }

    public function onMessage(ConnectionInterface $from, $msg) {

        dump($msg);
        // start the session when the user send a message
        // (refreshing it to be sure that we have access to the current state of the session)
        $from->session->start();

        // do what you wants with the session
        // for example you can test if the user is auth and get his id back like this:
        $user_id = $from->session->get(\Auth::getName());

        if (!isset($user_id)) {
            dump("用户未登录");
        } else {
            $user = \App\User::find($user_id);
        }

        try
        {
            $request = \GuzzleHttp\json_decode($msg, true);
        }catch (\Exception $e)
        {
            dump('json pare fial');
        }


        dump('用户解析成功');
        dump($user -> name);

        dump('请求：');
        dump($request);

        try{
            \App\ArticleReadingAnalysis::reading($user_id, $request['article_id']);
        }catch (\Exception $e)
        {
            dump($e -> getFile(), $e -> getLine(), $e -> getMessage());
        }

        $this -> success('统计阅读完成', $from);

        // or you can save data to the session
//        $from->session->put('foo', 'bar');
        // ...
        // and at the end. save the session state to the store
//        $from->session->save();
    }
    protected function message($status, $message, ConnectionInterface $from)
    {
        $s = \GuzzleHttp\json_encode([
            'status' => $status,
            'message' => $message,
        ]);
        try{
            $result = $from ->send($s);
        }catch (\Exception $e)
        {
            dump($e -> getFile(), $e -> getLine(), $e -> getMessage());
        }




    }
    protected function fail($m, ConnectionInterface $from){return $this->message('fail', $m, $from);}
    protected function success($m, ConnectionInterface $from){return $this->message('success', $m, $from);}

    public function onClose(ConnectionInterface $conn) {
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
    }
}