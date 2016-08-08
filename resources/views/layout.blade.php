<!DOCTYPE html>
<html lang="zh-cn">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <title>{{ $title }} - {{ config('app.site_title') }}</title>
    @yield('head')
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header hidden">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{route('index')}}">首页</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="{{ route('index') }}">首页</a></li>
                <li><a href="{{ route('article.index') }}">文章</a></li>
                <li><a href="{{ route('goods.index') }}">商品</a></li>

            </ul>

            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">登陆</a></li>
                    <li><a href="{{ url('/register') }}">注册</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false">
                            {{ Auth::user()->displayName() }}
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('user.edit') }}">编辑资料</a></li>
                            <li><a href="{{ url('/logout') }}">退出</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
<div class="container body-content">
    <div class="row">
        <div class="col-xs-12 col-md-9 main">
            @yield('content')
        </div>
        <div class="col-xs-12 col-md-3 side">
            <h3>右侧</h3>
            <hr>
        </div>
    </div>
</div>
<footer>
    <div class="container">
        娃娃脾气.版权所有
    </div>

</footer>

<script src="/bower_components/jquery/dist/jquery.min.js"></script>
<script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
@if(session('success'))
    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="mySmallModalLabel">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">成功</h4>
                </div>
                <div class="modal-body">
                    {{ session('success') }}
                </div>
                <div class="modal-footer">
                    <a href="{{ route('shop_cart.index') }}" class="btn btn-primary">去购物车</a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">好的</button>
                </div>

            </div>
        </div>
    </div>
    <script type="text/javascript">
        $( function(){
            $('#mySmallModalLabel').modal();
        } )
    </script>
@endif
@yield('foot')

</body>
</html>