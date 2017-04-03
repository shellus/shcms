<?php

namespace App\Http\Controllers;

use App\Article;
use App\ArticleVote;
use App\Category;
use App\Repositories\Interfaces\ArticleRepository;
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
     * @param ArticleRepository $repository
     * @param null $metaId
     * @return \Illuminate\Http\Response
     * @internal param null $id
     */
    public function index(Request $request, ArticleRepository $repository, $metaId = null)
    {
        $meta = new \stdClass();
        $meta->title = '';

        if (\Route::currentRouteName() == 'article.index') {

        }
        if (\Route::currentRouteName() == 'category.show') {
            $meta = Category::where(is_numeric($metaId) ? 'id' : 'slug', $metaId)->firstOrFail();
            $repository->pushCriteria(new \App\Repositories\Criteria\CategoryCriteria($meta));
        }
        if (\Route::currentRouteName() == 'tag.show') {
            $meta = Tag::where(is_numeric($metaId) ? 'id' : 'slug', $metaId)->firstOrFail();
            $repository->pushCriteria(new \App\Repositories\Criteria\TagCriteria($meta));
        }



        $titleMap = [
            'article.index' => '全部文章',
            'category.show' => '分类 - ' . $meta->title,
            'tag.show' => '标签 - ' . $meta->title,
        ];

        $pn = $request->get('pn', 20);

        $articles = $repository->orderBy('updated_at', 'DESC')->with('comments.user', 'user')->paginate($pn)->appends($request->query());

        return view('article.index', ['articles' => $articles, 'article_title' => $titleMap[\Route::currentRouteName()]]);
    }


    public function show(ArticleRepository $repository, $id)
    {
        $article = $repository->with('comments.user')->find($id);
        return view('article.show', ['article' => $article]);
    }

    public function create(ArticleRepository $repository)
    {
        $model = $repository->model();
        return view('article.edit', [
            'article' => new $model,
            'action' => 'create',
            'method' => 'POST',
            'route' => 'article.store',
            'title' => '发布文章',
        ]);
    }

    public function edit(ArticleRepository $repository, $id)
    {
        return view('article.edit', [
            'article' => $repository->find($id),
            'action' => 'edit',
            'method' => 'PUT',
            'route' => 'article.update',
            'title' => '编辑文章',
        ]);
    }

    public function store(Request $request, ArticleRepository $repository)
    {
        $article = $repository->create($request->all() + ['user_id' => \Auth::id()]);
        return $this->success('发布成功', ['article' => $article]);
    }

    public function update(Request $request, ArticleRepository $repository, $id)
    {
        $repository->find($id)->update($request->all());
        return $this->success('保存成功');
    }

    public function destroy(ArticleRepository $repository, $id)
    {
        $repository->delete($id);
        return $this->success('删除成功');
    }
}
