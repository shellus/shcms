<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Meta;
use App\Repositories\Content\ArticleRepository;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Repositories\Criteria\RequestCriteria;

class ArticleController extends Controller
{
    /** @var ArticleRepository $repository */
    protected $repository;

    /**
     * ArticleController constructor.
     * @param ArticleRepository $repository
     */
    public function __construct(ArticleRepository $repository)
    {
        $this->repository = $repository->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * 文章列表，兼容分类、标签、关键词搜索
     *
     * @param Request $request
     * @param ArticleRepository $this->repository
     * @param null $metaId
     * @return \Illuminate\Http\Response
     * @internal param null $id
     */
    public function index(Request $request, $metaId = null)
    {
        $meta = new \stdClass();
        $meta->title = '';

        if (\Route::currentRouteName() == 'article.index') {

        }
        if (\Route::currentRouteName() == 'category.show') {
            $meta = Category::where(is_numeric($metaId) ? 'id' : 'slug', $metaId)->firstOrFail();
            $this->repository->pushCriteria(new \App\Repositories\Criteria\CategoryCriteria($meta));
        }
        if (\Route::currentRouteName() == 'tag.show') {
            $meta = Tag::where(is_numeric($metaId) ? 'id' : 'slug', $metaId)->firstOrFail();
            $this->repository->pushCriteria(new \App\Repositories\Criteria\TagCriteria($meta));
        }



        $titleMap = [
            'article.index' => '全部文章',
            'category.show' => '分类 - ' . $meta->title,
            'tag.show' => '标签 - ' . $meta->title,
        ];

        $pn = $request->get('pn', 20);

        $articles = $this->repository->orderBy('updated_at', 'DESC')->with('comments.user')->with('user')->paginate($pn)->appends($request->query());

        return view('article.index', ['articles' => $articles, 'article_title' => $titleMap[\Route::currentRouteName()]]);
    }


    public function show($id)
    {
        $article = $this->repository->with('comments.user')->find($id);
        return view('article.show', ['article' => $article]);
    }

    public function create()
    {
        $model = $this->repository->model();
        return view('article.edit', [
            'article' => new $model,
            'action' => 'create',
            'method' => 'POST',
            'route' => 'article.store',
            'title' => '发布文章',
        ]);
    }

    public function edit($id)
    {
        return view('article.edit', [
            'article' => $this->repository->find($id),
            'action' => 'edit',
            'method' => 'PUT',
            'route' => 'article.update',
            'title' => '编辑文章',
        ]);
    }

    public function store(Request $request)
    {
        $article = $this->repository->create($request->all() + ['user_id' => \Auth::id()]);
        return $this->success('发布成功', ['article' => $article]);
    }

    public function update(Request $request, $id)
    {
        $this->repository->find($id)->update($request->all());
        return $this->success('保存成功');
    }

    public function destroy($id)
    {
        $this->repository->delete($id);
        return $this->success('删除成功');
    }
}
