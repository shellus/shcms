<?php

namespace App\Http\Controllers\Api;

use App\Article;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this -> middleware('api.auth');
    }
    public function index(){
        return Article::paginate();
    }

    public function profile(){

    }
}
