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
        $data_articles = [
            [
                'title' => '欢迎使用shcms, 希望你会喜欢',
                'body' => "当前版本是:".config('app.version')."，并且不兼容之前的版本，无论是程序架构，还是设计思路，都已经焕然一新，希望你会喜欢shcms的新生。",
            ],
        ];

        foreach ($data_articles as $data_article){
            $article = \App\Article::create($data_article);
        }
    }
}
