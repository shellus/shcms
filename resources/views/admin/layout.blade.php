<!DOCTYPE html>
<html lang="zh-cn">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/bower_components/AdminLTE/dist/css/AdminLTE.css">
    <link rel="stylesheet" href="/bower_components/font-awesome/css/font-awesome.css">
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <title>{{ config('app.site_title') }} - 后台</title>
    @yield('head')
    <style>
        .content-wrapper, .right-side {
            background-color: #717173;
        }
    </style>
</head>
<body class="skin-blue sidebar-mini">
<div class="wrapper">
    <header class="main-header">
        <a href="{{ route('admin') }}" class="logo">
            <span class="logo-lg"><img height="50" width=230 src="http://cdn.endaosi.com/image/shcms-logo-500-100.gif"></span>
            <span class="logo-mini"><img src="http://cdn.endaosi.com/image/shcms-logo-50-50.gif" width="50" height="50"></span>
        </a>

        <nav class="navbar navbar-static-top" role="navigation">

                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>

                <ul class="nav navbar-nav">
                    {{--顶部导航处--}}
                </ul>
                <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">
                                {{ Auth::user()->displayName() }}
                                <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}">退出</a></li>
                            </ul>
                        </li>
                </ul>
        </nav>
    </header>

    <aside class="main-sidebar">
        <section class="sidebar">

            <ul class="sidebar-menu">
                {!! app('shcms.navigation')->render() !!}
            </ul>
        </section>
    </aside>

    <div class="content-wrapper">
        {{--{!! AdminTemplate::renderBreadcrumbs($breadcrumbKey) !!}--}}

        <div class="content-header">
            <h1>
                {{ config('app.site_title') }}
            </h1>
        </div>

        <div class="content body">
            {{--@if($successMessage)--}}
                {{--<div class="alert alert-success alert-message">--}}
                    {{--<button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
                        {{--<span aria-hidden="true">&times;</span>--}}
                    {{--</button>--}}
                    {{--{!! $successMessage !!}--}}
                {{--</div>--}}
            {{--@endif--}}

            {!! $content !!}
        </div>
    </div>
</div>
<script src="/bower_components/jquery/dist/jquery.min.js"></script>
<script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/bower_components/AdminLTE/dist/js/app.js"></script>
@yield('foot')
</body>
</html>