<?php
/**
 * Created by PhpStorm.
 * User: shellus
 * Date: 2017-02-06
 * Time: 8:48
 */

namespace App\Service;


use Illuminate\Support\Str;

class ArticleService
{
    /**
     * 处理标签slug
     * @param string $slug
     * @return string
     */
    public static function filterTagSlug($slug)
    {
        $map = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890.-';
        $map = str_split($map);
        for ($i = 0; $i < strlen($slug); $i++) {
            if (!array_search(substr($slug,$i,1),$map)){
                return Str::random();
            }
        }
        return $slug;
    }
}