

@extends('layout')
@title('首页')
@section('content')

    <h3>最新记录</h3>
    <hr>
    (采集thinkphp.cn到articles表，作为测试数据 : )
    <div class="new_article-list">
        @include('partials.article_list',['articles' => \App\Article::getNewList()])
    </div>
@endsection
@section('foot')
@endsection


