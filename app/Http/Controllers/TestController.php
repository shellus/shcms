<?php

namespace App\Http\Controllers;

class TestController extends Controller
{

    public function index()
    {
        include __DIR__ .'/public/index.php';\App\Models\Category::all()->each->buildArticleCountCache();
        return view('test');
    }
}
