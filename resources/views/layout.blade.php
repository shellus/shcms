<!DOCTYPE html>
<html lang="zh-cn">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/bootstrap/dist/css/bootstrap.min.css">
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
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
                <li><a href="/">首页</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">登陆</a></li>
                    <li><a href="{{ url('/register') }}">注册</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false">
                            <span class="label label-info">{{ Auth::user()->roleName() }}</span>
                            {{ Auth::user()->displayName() }}
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/logout') }}">退出</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-9 main">
            @yield('content')
        </div>
        <div class="col-xs-12 col-md-3 side">
            <h2>右侧</h2>
            <hr>
            <div id="tag-cloud" style="height: 400px"></div>
        </div>
    </div>

</div>

<script src="/jquery/dist/jquery.min.js"></script>
<script src="/js/jqcloud-1.0.4.js"></script>
<script src="/bootstrap/dist/js/bootstrap.min.js"></script>
<script>
    var tags = {!! \App\Tag::all() !!};

    var word_array = [];
    for(var i in tags){
        word_array.push({
            text:tags[i]['title'],
            weight: 3
        });
    }
    $(function() {
        $("#tag-cloud").jQCloud(word_array);
    });
</script>

@yield('foot')
</body>
</html>