<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * 文章分类透视表，需要在写入时更新分类表缓存
 * Class ArticleCategory
 * @package App
 */
class ArticleCategory extends Pivot
{
    protected static function boot()
    {
        parent::boot();

        // todo 没有效果！！！
        static::created(function (self $articleCategory) {
            self::updateCategoryArticleCountCache($articleCategory);
        });
        static::deleted(function (self $articleCategory) {
            self::updateCategoryArticleCountCache($articleCategory);
        });
        static::updated(function (self $articleCategory) {
            self::updateCategoryArticleCountCache($articleCategory);
        });
    }
    protected static function updateCategoryArticleCountCache(self $articleCategory){
        $category_id = $articleCategory->category_id;
        $articles_count = \DB::table('article_category')->where('category_id', '=', $category_id)->count();
        \DB::table('categories')->where('id', '=', $category_id)->update(['articles_count' => $articles_count]);
    }
}
