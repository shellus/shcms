<?php
/**
 * Created by PhpStorm.
 * User: shellus
 * Date: 2017-01-08
 * Time: 22:27
 */

namespace App\Wenzi;

use Guzzle\Http\Exception\RequestException;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class ArticleLexicalAnalysis
{
    private static $wenzi;
    private static $account = 0;
    private static $token;

    private function __construct()
    {
    }

    private static function getInstance()
    {
        if (!self::$token){
            self::$token = self::getAuthToken();
        }
        return new self();
    }

    public static function LexicalAnalysis($txt)
    {
        if (!self::$wenzi) {
            self::$wenzi = self::getInstance();
        }
        $dicts = [];
        $client = new Client();
        try{
            $res = $client->request('POST', 'http://api.bosonnlp.com/keywords/analysis', [
                'connect_timeout' => 10,
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'X-Token' => self::$token,
                ],
                'body' => json_encode($txt),
            ]);
        }catch (\Exception $e){
            dd($e);
            self::$token = self::getAuthToken();
        }

        dd($res);

        $body = $res->getBody()->getContents();
        $res = json_decode($body, true);
        foreach ($res as $re) {
            $dicts[] = ['word' => $re[1], 'weight' => $re[0]];
        }

        return $dicts;
    }

    private static function getAuthToken()
    {
        $client = new Client(['cookies'=>true]);

        $body = $client->request('GET', 'http://bosonnlp.com/account/login')->getBody()->getContents();
        $csrf = (new Crawler($body))->filter('#csrf_token')->attr('value');

        $url = 'http://bosonnlp.com/account/login';
        $email = explode('@', env('BOSONNLP_USERNAME'))[0] . self::$account . '@' . explode('@', env('BOSONNLP_USERNAME'))[1];

        $res = $client->request('POST', $url, ['connect_timeout' => 10,
            'form_params' => [
                'next' => 'http://bosonnlp.com/',
                'csrf_token' => $csrf,
                'email' => $email,
                'password' => env('BOSONNLP_PASSWORD'),
            ],
        ]);


        $body = $res->getBody()->getContents();
        file_put_contents(app_path('out.html'),$body);
        $dom = new Crawler($body);
        if ($err_str = $dom->filter('.email-warn')->text()){
            throw new \Exception($err_str);
        }


        $out = $dom->filter('.token>code')->html();

        return $out;
    }
}