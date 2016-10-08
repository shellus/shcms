<!DOCTYPE html>
<html lang="cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page_title') - {{ config('app.name', 'Laravel') }} - {{ config('app.sub_name') }}</title>

    <!-- Styles -->
    <link href="/bootstrap-3.3.0-dist/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.laravel = {};
        window.laravel.csrf_token = document.getElementsByName('csrf-token')[0].content;
    </script>

    @yield('header')
</head>
<body>

    @yield('content')
    <!-- Scripts -->
    <script src="/jquery-2.2.4/dist/jquery.min.js"></script>
    <script src="/bootstrap-3.3.0-dist/dist/js/bootstrap.min.js"></script>

@yield('footer')
</body>
</html>
