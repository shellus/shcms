<?php

use Illuminate\Database\Seeder;

class ArticlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $default_category = \App\Category::create(['title' => '默认分类']);
        $default_user = \App\User::first();



        $data_article = [
            'title' => '欢迎使用shcms, 希望你会喜欢',
            'body' => "当前版本是:".config('env.version')."，并且不兼容之前的版本，无论是程序架构，还是设计思路，都已经焕然一新，希望你会喜欢shcms的新生。",
        ];
        $article = \App\Article::create($data_article);
        $article -> categorys() -> attach($default_category);
//        $article -> tags() -> attach(\Illuminate\Support\Arr::first($tags));
        $default_user -> articles() -> save($article);
    }
}
