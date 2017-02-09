<?php

namespace App\Http\Controllers;

use App\Article;
use App\ArticleVote;
use App\Category;
use App\SearchHistory;
use App\Tag;
use Illuminate\Http\Request;

use App\Http\Requests;

class ArticleController extends Controller
{

    public function search(Request $request){


        SearchHistory::firstOrCreate([
            'word' => $request['s'],
            'page' => $request -> get('page', 1),
            'user_id' => \Auth::user() -> id,
        ]);

        $articles = Article::search($request['s'],$request['c']);

        return view('article.index', ['articles' => $articles]);

    }

    public function vote(Requests\UserArticleVoteRequest $request)
    {
        $data = [
                'user_id' => $request -> user() -> id,

            ] + $request -> only('article_id');

        if($request['action'] == 'up'){
            $result = ArticleVote::voteUp($data);
        }else{
            $result = ArticleVote::voteDown($data);
        }

        $article = Article::find($request -> get('article_id'));
        $result['article_up_vote'] = $article -> votes() -> where('vote', '>', 0) -> sum('vote');
        $result['article_down_vote'] = $article -> votes() -> where('vote', '<', 0) -> sum('vote');



        return $this -> message($result?'success':'fail',$result?'操作成功':'操作失败', $result);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function tagIndex($id){
        $articles = Tag::findOrFail($id)->articles()->orderBy('articles.updated_at', 'DESC')->paginate(20);

        $articles->load(['comments' => function ($query) {
//            $query->selectRaw('min(id) as id, article_id, count(*) as comments_count');
//            $query->groupBy('article_id');
            $query->orderBy('created_at','DESC');
        }]);
        return view('article.index', ['articles' => $articles]);
    }
    public function categoryIndex($id){
        $articles = Category::findOrFail($id)->articles()->orderBy('articles.updated_at', 'DESC')->paginate(20);

        $articles->load(['comments' => function ($query) {
//            $query->selectRaw('min(id) as id, article_id, count(*) as comments_count');
//            $query->groupBy('article_id');
            $query->orderBy('created_at','DESC');
        }]);
        return view('article.index', ['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        $article->load(['comments.user' => function ($query) {
//            $query->selectRaw('min(id) as id, article_id, count(*) as comments_count');
//            $query->groupBy('article_id');
//            $query->orderBy('created_at','DESC');
        }]);
        return view('article.show',['article' => $article]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('article.edit',['article' => Article::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Article::find($id) -> update($request->all());
        return $this -> success('保存成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return $this -> success('删除成功');
    }
}
