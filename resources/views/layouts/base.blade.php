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
    @yield('content')
@yield('footer')
</body>
</html>
