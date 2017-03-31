@extends('layouts.app')
@push('breadcrumbs')
<li class="active">{{ $article_title }}</li>
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-0">
                    <div class="app-block">
                        @include('components.search-form')
                        <ul id="articles" class="list-unstyled">
                            @foreach($articles as $article)
                                <li style="padding-bottom: 8px">
                                    <div>
                                        <h4>
                                            <a class="" title="{{ $article -> title }}"
                                               href="{{ $article -> showUrl() }}">
                                                {{ $article -> display_title }}
                                            </a>
                                        </h4>
                                        <span style="padding: 4px 8px; margin-right: 8px;" class="bg-info">
                                                <i class="fa fa-comments-o" aria-hidden="true"></i>
                                            {{ $article->comments->count() }}
                                            </span>

                                        <small>
                                            <i class="fa fa-user-o text-warning" aria-hidden="true"></i>
                                            <a href="#">{{ $article->user->name }}</a>
                                        </small>
                                        <small>{{ $article->created_at->diffForHumans() }} 发布</small>

                                        @if($article->comments->count())
                                            ||
                                            <small>
                                                <i class="fa fa-comment-o" aria-hidden="true"></i>
                                                <a href="#">{{ $article->comments->first()->user->name }}</a>
                                            </small>
                                            <small>{{ $article->comments->first()->updated_at->diffForHumans() }}回复
                                            </small>
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <div class="text-center">
                            {{ $articles->links() }}
                        </div>
                    </div>

            </div>
            <div class="col-md-4">
                <div class="app-block">
                    <h3>功能</h3>
                    <ul class="">
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">登录</a></li>
                            <li><a href="{{ url('/register') }}">注册</a></li>
                        @else
                            <li>
                                <a href="{{ url('/home') }}">
                                    登录为：{{ Auth::user()->name }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('article.create') }}">
                                    发布文章
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    注销
                                </a>

                                <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="app-block">
                    <h3>分类</h3>
                    @include('components.category', ['categories' => \App\Category::get()])
                </div>
            </div>
            <div class="col-md-4">
                <div class="app-block">
                    <h3>标签</h3>
                    @include('components.tag', ['categories' => \App\Tag::withCount('articles')->orderBy('articles_count', 'DESC')->limit(40)->get()])
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script>
    </script>

@endsection