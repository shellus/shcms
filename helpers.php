<?php
/**
 * Created by PhpStorm.
 * User: shellus
 * Date: 2016-09-25
 * Time: 4:20
 */
function getQueryLog(){
    static $querys;
    if (!$querys){
        $querys = \DB::getQueryLog();
    }
    $returns = [
        'total_time' => 0,
        'sqls' => [],
    ];
    /** @var \Illuminate\Database\Events\QueryExecuted $query */
    foreach ($querys as $query){
        $return['sql'] = $query['query'];
        foreach ($query['bindings'] as $binding){
            $return['sql'] = preg_replace ('/\?/i', '\'' . $binding . '\'', $return['sql'], 1);
        }
        $return['bindings'] = $query['bindings'];
        $return['time'] = $query['time'];
        $returns['sqls'][] = $return;
        $returns['total_time'] += $query['time'];
    }
    return $returns;
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