<?php
/**
 * Created by PhpStorm.
 * User: shellus
 * Date: 2016-09-25
 * Time: 4:20
 */
function rc4($key, $data)
{
    // Store the vectors "S" has calculated
    static $SC;
    // Function to swaps values of the vector "S"
    $swap = create_function('&$v1, &$v2', '
        $v1 = $v1 ^ $v2;
        $v2 = $v1 ^ $v2;
        $v1 = $v1 ^ $v2;
    ');
    $ikey = crc32($key);
    if (!isset($SC[$ikey])) {
        // Make the vector "S", basead in the key
        $S    = range(0, 255);
        $j    = 0;
        $n    = strlen($key);
        for ($i = 0; $i < 255; $i++) {
            $char  = ord($key{$i % $n});
            $j     = ($j + $S[$i] + $char) % 256;
            $swap($S[$i], $S[$j]);
        }
        $SC[$ikey] = $S;
    } else {
        $S = $SC[$ikey];
    }
    // Crypt/decrypt the data
    $n    = strlen($data);
    $data = str_split($data, 1);
    $i    = $j = 0;
    for ($m = 0; $m < $n; $m++) {
        $i        = ($i + 1) % 256;
        $j        = ($j + $S[$i]) % 256;
        $swap($S[$i], $S[$j]);
        $char     = ord($data[$m]);
        $char     = $S[($S[$i] + $S[$j]) % 256] ^ $char;
        $data[$m] = chr($char);
    }
    return implode('', $data);
}

function isCrawler() {
    $agent = strtolower(\Request::header('HTTP_USER_AGENT'));
    if (!empty($agent)) {
        $spiderSite= array(
            "TencentTraveler",
            "Baiduspider+",
            "BaiduGame",
            "Googlebot",
            "msnbot",
            "Sosospider+",
            "Sogou web spider",
            "ia_archiver",
            "Yahoo! Slurp",
            "YoudaoBot",
            "Yahoo Slurp",
            "MSNBot",
            "Java (Often spam bot)",
            "BaiDuSpider",
            "Voila",
            "Yandex bot",
            "BSpider",
            "twiceler",
            "Sogou Spider",
            "Speedy Spider",
            "Google AdSense",
            "Heritrix",
            "Python-urllib",
            "Alexa (IA Archiver)",
            "Ask",
            "Exabot",
            "Custo",
            "OutfoxBot/YodaoBot",
            "yacy",
            "SurveyBot",
            "legs",
            "lwp-trivial",
            "Nutch",
            "StackRambler",
            "The web archive (IA Archiver)",
            "Perl tool",
            "MJ12bot",
            "Netcraft",
            "MSIECrawler",
            "WGet tools",
            "larbin",
            "Fish search",
        );
        foreach($spiderSite as $val) {
            $str = strtolower($val);
            if (strpos($agent, $str) !== false) {
                return true;
            }
        }
    }
    return false;
};