@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @yield('body')
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
                @include('components.category', ['categories' => app(\App\Repositories\Content\CategoryRepository::class)->TagTopList()])
            </div>
        </div>
        <div class="col-md-4">
            <div class="app-block">
                <h3>标签</h3>
                @include('components.tag', ['categories' => app(\App\Repositories\Content\TagRepository::class)->TagTopList()])
            </div>
        </div>
    </div>
</div>

@endsection