<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Http\Request;

use App\Http\Requests;

class IndexController extends Controller
{
    public function index(Request $request){


        
        $total = Article::count();
        $count = 100;
        $randoms = [];
        $ids = [];

        $articles = [];


        do{
            $randoms[] = rand(0, $total);
        }while ($count --> 1);

        $all_ids = \Cache::rememberForever('all_ids', function() {
            return \DB::select('select `id` from `articles`;');
        });

        foreach ($randoms as $random){
            $ids[] = $all_ids[$random] -> id;
        }

//        $articles = Article::limit(10) -> orderByRaw('RAND()') -> get();

        $articles = Article::whereIn('id', $randoms) -> get(['id', 'title']);

        return view('index', ['articles' => $articles]);
    }
}
