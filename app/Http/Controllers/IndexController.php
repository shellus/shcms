<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request){

        $search_histories = \App\SearchHistory::selectRaw('count(*) as rows ,word') -> where('page', '=', 1) -> orderByRaw('rows desc') -> groupBy('word') -> limit(5) -> get();

        $articles = Article::getByRandom(20);
        return view('index', ['articles' => $articles, 'search_histories' => $search_histories]);
    }
}
