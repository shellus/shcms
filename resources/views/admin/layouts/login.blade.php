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
    <link href="/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

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
    <script src="/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/bower_components/jquery-validation/dist/jquery.validate.min.js"></script>

@yield('footer')
</body>
</html>
