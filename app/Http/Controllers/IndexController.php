<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Http\Request;

use App\Http\Requests;

class IndexController extends Controller
{
    public function index(Request $request){

        $articles = Article::getByRandom(50);

        return view('index', ['articles' => $articles]);
    }
}
