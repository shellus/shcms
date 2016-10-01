<!DOCTYPE html>
<html lang="cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - 谈天说性吧 - 看小说就到shuoxingba.com</title>

    <!-- Styles -->
    <link href="/bootstrap-3.3.0-dist/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    <style>
        body{
            font-size: 1.6em;
            line-height: 1.5em;
        }
        footer {
            color: #777;
            padding: 30px 0;
            border-top: 1px solid #e5e5e5;
            margin-top: 70px;
            margin-bottom: 40px;
        }
        pre.inline{
            display: inline;
            padding: 0 10px;
            margin: 0;
        }
        .sql-dumper{
            border: 1px solid #f5e79e;
            margin: 10px;
        }
        .debug-bar{
            position: fixed;
            bottom: 0px;
            padding: 5px;
            z-index: 999;
            width: 100%;
            background-color: #2b2b2b;
            color: #a8b6c5;
        }
        #articles{
            line-height: 2em;
            min-height: 400px;
        }
        .search-box>input{
            border-radius: 0 !important;
        }
        .search-box>.input-group-btn>.btn{
            border-radius: 0;
        }
        body{
            background-color: #d8e0eb;
            /*background-image: url("/images/index.jpg");*/
            /*background-size: cover;*/
        }
        .navbar-default {
            background-color: rgba(248, 248, 248, 0.6);
        }
        .panel {
            background-color: rgba(255, 255, 255, 0.28);
        }
    </style>


    @yield('header')
</head>
<body>
{{--<div class="debug-bar">--}}
    {{--<div class="container">--}}
                {{--<div id="collapseOne" class="panel-collapse collapse sql-dumper" role="tabpanel" aria-labelledby="headingOne">--}}
                    {{--<div class="panel-body text-left">--}}
                        {{--<ul>--}}
                            {{--@foreach(getQueryLog()['sqls'] as $key => $query)--}}
                                {{--<li>--}}
                                    {{--{{ $key }} . <pre class="inline"><code>{{ $query['sql'] }}</code></pre> in {{ $query['time'] }}  ms.--}}
                                {{--</li>--}}
                            {{--@endforeach--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<p>--}}
                    {{--sql count {{ count(getQueryLog()['sqls']) }} in {{ getQueryLog()['total_time'] }} ms.--}}
                    {{--<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">--}}
                        {{--detail--}}
                    {{--</a>--}}
                {{--</p>--}}
    {{--</div>--}}
{{--</div>--}}

    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li>
                        <a href="{{ url('/category') }}" >
                            分类
                        </a>
                    </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ url('/home') }}" >
                                        Home
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ url('/logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <footer class="text-center">

        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">

                    没有版权.随便抄袭


                </div>
            </div>
        </div>

    </footer>
    <!-- Scripts -->
    <script src="/jquery-2.2.4/dist/jquery.min.js"></script>
    <script src="/bootstrap-3.3.0-dist/dist/js/bootstrap.min.js"></script>

@yield('footer')
</body>
</html>
