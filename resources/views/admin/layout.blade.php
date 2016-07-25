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
</head>
<body class="skin-blue sidebar-mini">
<div class="wrapper">
    <header class="main-header">
        @include('admin._partials.header')
    </header>

    <aside class="main-sidebar">
        @include('admin._partials.navigation')
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