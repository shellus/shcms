<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Controllers\ControllerTrait\RestControllerTrait;

use App\Http\Requests;

class ArticleController extends Controller
{
    use RestControllerTrait;

    public function __construct()
    {
        $this -> model = new Article();
    }
}
