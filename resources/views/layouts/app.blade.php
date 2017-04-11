<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - {{ config('app.sub_name') }}</title>

    <!-- Styles -->
    <link href="/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="/bower_components/jquery-editable-select/dist/jquery-editable-select.min.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">

    <!-- Scripts -->
    <script src="/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/bower_components/jquery-editable-select/dist/jquery-editable-select.min.js"></script>

    <!-- Scripts -->
    <script>
        window.laravel = {};
        window.laravel.csrf_token = document.getElementsByName('csrf-token')[0].content;
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': window.laravel.csrf_token}});
    </script>

    <style>
        .breadcrumb {
            padding: 0;
            margin-bottom: 10px;
            list-style: none;
            background-color: inherit;
            border-radius: 0;
        }

        .app-block {
            background-color: #fff;
            padding: 10px 15px;
            margin-bottom: 10px;
        }
        .app-block img{
            max-width: 100%;
        }
        .app-search-box {

        }
    </style>
    @yield('header')
</head>
<body id="app">
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ route('index') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                {{--
                <li>
                    <a href="{{ url('/category') }}">
                        分类
                    </a>
                </li>
                --}}
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->

            </ul>
        </div>
    </div>
</nav>
<div class="main" style="margin-bottom: 20px;">
    @yield('content')
</div>
<hr>

@include('layouts.foot')
<script src="/js/app.js"></script>
<script>
    console.log("如发现xss或任何其他类型漏洞或安全隐患，请到 'https://github.com/shellus/shcms' 提Issue，感谢您对开源做出的贡献 :)");
</script>
@yield('footer')
</body>
</html>
