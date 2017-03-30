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

    /**
     * 文章列表，兼容分类、标签、关键词搜索
     *
     * @param Request $request
     * @param null $id
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id = null)
    {
        $meta = new \stdClass();
        $meta->title = '';

        $article = new Article();
        if (\Route::currentRouteName() == 'article.index') {

        }
        if (\Route::currentRouteName() == 'category.show') {
            $meta = Category::where(is_numeric($id) ? 'id' : 'slug', $id)->firstOrFail();
            $article->whereHas('categories', function ($query) use ($meta) {
                $query->where('id', '=', $meta->id);
            });
        }
        if (\Route::currentRouteName() == 'tag.show') {
            $meta = Tag::where(is_numeric($id) ? 'id' : 'slug', $id)->firstOrFail();
            $article->whereHas('tags', function ($query) use ($meta) {
                $query->where('id', '=', $meta->id);
            });
        }
        // 搜索
        if (($searchWord = $request->get('s'))) {
            if (\Auth::check()) {
                SearchHistory::firstOrCreate([
                    'word' => $request['s'],
                    'page' => $request->get('page', 1),
                    'user_id' => \Auth::user()->id,
                ]);
            }
        }

        $titleMap = [
            'article.index' => '全部文章',
            'category.show' => '分类 - ' . $meta->title,
            'tag.show' => '标签 - ' . $meta->title,
        ];
        /** @var Article $article */


        $article = $article->withSearch($searchWord);

        $pn = $request->get('pn', 20);

        $articles = $article->orderBy('updated_at', 'DESC')->with('comments.user', 'user')->paginate($pn)->appends($request->query());
        return view('article.index', ['articles' => $articles, 'article_title' => $titleMap[\Route::currentRouteName()]]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        $article->load(['comments.user']);
        return view('article.show', ['article' => $article]);
    }

    public function create()
    {
        return view('article.edit', [
            'article' => new Article,
            'action' => 'create',
            'method' => 'POST',
            'route' => 'article.store',
        ]);
    }

    public function edit($id)
    {
        return view('article.edit', [
            'article' => Article::find($id),
            'action' => 'edit',
            'method' => 'PUT',
            'route' => 'article.update',
        ]);
    }

    public function store(Request $request)
    {
        $article = Article::create($request->all() + ['user_id' => \Auth::id()]);
        return $this->success('发布成功', ['article' => $article]);
    }

    public function update(Request $request, $id)
    {
        Article::find($id)->update($request->all());
        return $this->success('保存成功');
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return $this->success('删除成功');
    }
}
