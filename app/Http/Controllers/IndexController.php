<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request){
        return \Response::redirectToRoute('category.show',['default']);
//        $articles = Article::getByRandom(20);
//        return view('index', ['articles' => $articles]);
    }
}
