<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request){

        // 删除空格 和后面的内容
        // UPDATE articles SET title=LEFT( title, INSTR(title, ' ') - 1) WHERE title LIKE '% %'

        // 删除·作者·和后面的内容
        // UPDATE articles SET title=LEFT( title, INSTR(title, '作者') - 1) WHERE title LIKE '%作者%'

        // 删除后面的括号
        // UPDATE articles SET title=LEFT(title, char_length(title)-1) WHERE title LIKE '%（' AND id=482
//        $ArticleReadingAnalysis = ReadingHistory::orderBy('reading_at') -> limit(20) -> get();

        // 删除错误的关联数据
        // DELETE article_reading_analyses FROM article_reading_analyses LEFT JOIN articles a on a.id=article_reading_analyses.article_id WHERE a.id is null

        
//        $articles = [];
//        foreach ($ArticleReadingAnalysis as $analysi)
//        {
//            $articles[] = $analysi -> article;
//        }
        $articles = Article::getByRandom(20);
        return view('index', ['articles' => $articles]);
    }
}
