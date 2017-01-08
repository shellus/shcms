<?php
/**
 * Created by PhpStorm.
 * User: shellus
 * Date: 2017-01-08
 * Time: 22:27
 */

namespace App\Wenzi;


class ArticleLexicalAnalysis
{
    private static $wenzi;
    private function __construct(){}

    private static function getInstance()
    {
        require_once __DIR__ . '/../../src/QcloudApi/QcloudApi.php';

        $config = array('SecretId' => env('TX_SecretId'),
            'SecretKey' => env('TX_SecretKey'),
            'RequestMethod' => 'POST',
            'DefaultRegion' => 'gz');

        return \QcloudApi::load(\QcloudApi::MODULE_WENZHI, $config);
    }
    public static function LexicalAnalysis($txt)
    {
        if (!self::$wenzi){
            self::$wenzi = self::getInstance();
        }
        $package = array('text' => $txt, 'code' => 0x00200000, 'type' => 0);
        $a = self::$wenzi->LexicalAnalysis($package);

        $types = ['名词', '形容词', '名动词', '形语素'];
        if ($a === false) {
            $error = self::$wenzi->getError();
            throw new \Exception($error->getMessage());
        } else {
            $result = [];
            foreach ($a['tokens'] as $dist) {
                if (in_array($dist['wtype'], $types) && mb_strlen($dist['word']) >= 2) {
                    $result[] = $dist;
                }
            }
        }
        return $result;
    }
}