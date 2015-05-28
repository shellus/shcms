<!DOCTYPE html>
<html lang="cn">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title') - {{ \App\Model\SiteConfig::get('title') }}</title>
	<link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">


    <style>
        html {
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
            background-color: #f0f3f4;
        }
        body {
            font-family: "Microsoft Yahei", "黑体", "SimHei", Arial,sans-serif;
            height: 100%;
            color: #58666e;
        }
        section{
            font-size: 18px;
            line-height: 2;
        }
        section img{
            max-width: 100%;
        }

        .main{
            padding-top: 70px;
            padding-bottom: 20px;
        }

        .sidebar-right{
            top: 90px;
            border-color: #d6e9c6;
            color: #3c763d;
        }
        .tags>li>a{
            color: #FFF;
        }

        footer{
            padding-top: 40px;
            padding-bottom: 40px;
            margin-top: 100px;
            color: #767676;
            text-align: center;
            border-top: 1px solid #e5e5e5;
        }
    </style>

    @yield('head')
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">切换导航</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/">首页</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/post') }}">帖子</a></li>
                    <li><a href="{{ url('/category') }}">分类</a></li>
				</ul>


				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="{{ url('/auth/login') }}">登陆</a></li>
						<li><a href="{{ url('/auth/register') }}">注册</a></li>
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/user') }}">用户中心</a></li>
								<li><a href="{{ url('/auth/logout') }}">注销</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>
    <div class="container main">
        <div class="col-md-9">
	    @yield('content')
        </div>
        <div class="col-md-3" style="padding-left: 30px;padding-top: 150px;">
            <div class="sidebar-right alert alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                @include('sidebar-right')
            </div>
        </div>

        {{--<div id="scrollBar" style="position: fixed; right: 50%; margin-right: -510px; bottom: 75px; display: block;"><a hidefocus="true" href="javascript:$('body').animate({scrollTop: 0}, 500);">回到顶部</a></div>--}}


    </div>


    <footer>
        版权所有.没有人
    </footer>
	<!-- Scripts -->
	<script src="{{ asset('/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/js/app.js') }}"></script>
    @yield('foot')
</body>
</html>
