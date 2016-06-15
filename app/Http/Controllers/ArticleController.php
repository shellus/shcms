<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Controllers\ControllerTrait\RestControllerTrait;

use App\Http\Requests;
use App\Tag;
use App\User;

class ArticleController extends Controller
{
    use RestControllerTrait;

    public function __construct()
    {
        $this -> model = new Article();
    }
    public function index($slug_or_id){
        return view('article.list',[
            'list_type' => 'default',
            'title' => '内容列表',
            'model' => $this -> model -> paginate()
        ]);
    }
    public function show($id)
    {
        $data = $this -> model -> with('user') -> findOrFail($id);

        return view('article/show', ['model' => $data]);
    }
    public function getTagAdd($id,$tag_id){

        $this -> model -> findOrFail($id) -> tags() -> attach($tag_id);
        return back();
    }
    public function getTag($slug_or_id){
        $tag = Tag::where(is_numeric($slug_or_id)?'id':'slug',$slug_or_id) -> firstOrFail();
        return view('article.list',[
            'list_type' => 'tag',
            'title' => $tag -> title,
            'model' => $tag -> articles() -> paginate()
        ]);
    }
}