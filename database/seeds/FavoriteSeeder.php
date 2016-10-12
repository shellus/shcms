<?php

use Illuminate\Database\Seeder;

class FavoriteSeeder extends Seeder
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
                'title' => '一些东西',
                'user_id' => \App\User::whereEmail('shellus@endaosi.com') -> firstOrFail() -> id,
            ],
            [
                'title' => '喜欢的文章',
                'user_id' => \App\User::whereEmail('shellus@endaosi.com') -> firstOrFail() -> id,
            ],
            [
                'title' => '笑话系列',
                'user_id' => \App\User::whereEmail('shellus@endaosi.com') -> firstOrFail() -> id,
            ],
        ];

        foreach ($data_articles as $data_article){
            $article = \App\FavoriteDirectory::create($data_article);
        }
    }
}
