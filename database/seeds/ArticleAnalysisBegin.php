<?php

use Illuminate\Database\Seeder;

/**
 * 分词任务的准备工作
 * Class ArticleAnalysisBegin
 */
class ArticleAnalysisBegin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tables = [
            'key_words',
            'article_key_words'
        ];
        foreach ($tables as $table){
            $c = DB::table($table) -> delete();
            $this->command->info('table: '.$table.', delete row count :' . $c);
        }
        $c = DB::table('articles')->update(['version' => App\Console\Commands\ArticleLexicalAnalysis::ARTICLE_BEGIN_VERSION]);

        $this->command->info('table: articles, update version row count :' . $c);
    }
}
