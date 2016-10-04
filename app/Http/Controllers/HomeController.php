<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $read_count = \App\ArticleReadingAnalysis::whereUserId(\Auth::user()->id) -> count();

        $read_time = \App\ArticleReadingAnalysis::whereUserId(\Auth::user()->id) -> sum('reading_at');

        $lest_read_articles = \App\ArticleReadingAnalysis::whereUserId(\Auth::user()->id) -> orderBy('updated_at','desc') -> paginate(20);

        return view('home', compact(['read_count', 'read_time', 'lest_read_articles']));
    }
}
