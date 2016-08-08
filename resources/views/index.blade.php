

@extends('layout')
@title('首页')
@section('content')

    <h3>最新记录</h3>
    <hr>
    <div class="new_articles-list">
        @include('partials.article_list',['articles' => \App\Article::getNewList()])
    </div>
@endsection
@section('foot')
@endsection


