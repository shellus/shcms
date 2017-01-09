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


        return $dicts;
    }
}