<?php
/**
 * Created by PhpStorm.
 * User: shellus
 * Date: 2017-01-08
 * Time: 22:27
 */

namespace App\Wenzi;
use GuzzleHttp\Client;

class ArticleLexicalAnalysis
{
    private static $wenzi;
    private function __construct(){}

    private static function getInstance()
    {
        return new self();
    }
    public static function LexicalAnalysis($txt)
    {
        if (!self::$wenzi){
            self::$wenzi = self::getInstance();
        }
        $dicts = [];
        $client = new Client();
        $res = $client->request('POST', 'http://api.bosonnlp.com/keywords/analysis', [
            'connect_timeout' => 10,
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept'     => 'application/json',
                'X-Token'      => env('BOSONNLP_TOKEN'),
            ],
            'body' => json_encode($txt),
        ]);

        $body = $res->getBody() -> getContents();
        $res = json_decode($body, true);
        foreach ($res as $re){
            $dicts[] = ['word' => $re[1], 'weight' => $re[0]];
        }

        return $dicts;
    }
}