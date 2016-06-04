<!DOCTYPE html>
<html ng-app="app">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/game/shishicai/css/main.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/game/shishicai/css/index.css') }}" rel="stylesheet">


    <style>


    </style>


    @yield('head')


</head>

<body >


<div class="header">
    <div class="container">
        {{--<span class="logo"><a href="home"><img src="{{ asset('/app/game/shishicai/images/logo4.png') }}"></a></span>--}}
        <ul class="nav navbar-nav">

            <li class="active"><a href="home">首页</a></li>
            <li class="active"><a href="lotterybet-SSC">时时彩</a></li>
            <li><a href="#">十一选五</a></li>
            <li><a href="#">快乐十分</a></li>
            <li><a href="#">快三</a></li>
            <li><a href="#">赛车</a></li>
            <li><a href="lotterybet-KLC">快乐彩</a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    一般彩票
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="#">香港六合彩</a></li>
                    <li><a href="#">福彩3D</a></li>
                    <li><a href="#">排列三</a></li>
                </ul>
            </li>



            @if (Auth::guest())
                <li class="login"><a href="{{ url('/auth/login') }}"><i
                                class="glyphicon glyphicon-user"></i>&nbsp;登录</a></li>
                <li class="register"><a href="{{ url('/auth/register') }}">注册</a></li>
            @else
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                       aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ url('/auth/logout') }}">退出</a></li>
                    </ul>
                </li>
            @endif


        </ul>


      <div ng-controller="skin">
        <!--换颜色-->
        <button type="button" class="btn btn-primary btn-md transfer-skin"   ng-click='toggleSkin()'>换颜色skin</button>

        <div class="new-box" ng-show='menuState.show' >

                <a class="btn-skin btn-skin-0 active" href="#" ng-click=""></a>

                <a class="btn-skin btn-skin-02" href="#"></a>
                <a class="btn-skin btn-skin-03" href="#"></a>
                <a class="btn-skin btn-skin-04" href="#"></a>
                <a class="btn-skin btn-skin-05" href="#"></a>
                <a class="btn-skin btn-skin-06" href="#"></a>
                <a class="btn-skin btn-skin-07" href="#"></a>
                <a class="btn-skin btn-skin-08" href="#"></a>
                <a class="btn-skin btn-skin-09" href="#"></a>
                <a class="btn-skin btn-skin-10" href="#"></a>
                <a class="btn-skin btn-skin-11" href="#"></a>
                <a class="btn-skin btn-skin-16" href="#"></a>
                <a class="btn-skin btn-skin-17" href="#"></a>
                <a class="btn-skin btn-skin-18" href="#"></a>


        </div>
      </div>

        {{--<script>--}}
            {{--$('.transfer-skin').click(function () {--}}
                {{--$('.new-box').slideToggle("slow");--}}
            {{--})--}}
        {{--</script>--}}
    </div>


    <div class="line"></div>
</div>

@yield('banner')

<div class="container content">
        @include('game.shishicai.sidebar')
        <div class="right-contain col-md-10">
            @yield('content')
        </div>
</div>
@yield('foot')
</body>

</html>