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
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN' : window.laravel.csrf_token } });
    </script>

    @yield('header')
</head>
<body>
<div id="app">
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
                        <li><a href="{{ url('/login') }}">登录</a></li>
                        <li><a href="{{ url('/register') }}">注册</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ url('/home') }}" >
                                        用户中心
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ url('/logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        注销
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
    <div class="main" style="margin-bottom: 20px;">
        @yield('content')
    </div>
    <hr>
    <footer class="footer">
        <div class="container">
            <div class="row hidden-xs">
                <dl class="col-sm-2 site-link">
                    <dt>网站相关</dt>
                    <dd><a href="/about">关于我们</a></dd>
                    <dd><a href="/tos">服务条款</a></dd>
                    <dd><a href="/faq">帮助中心</a></dd>
                    <dd><a href="/repu">声望与权限</a></dd>
                    <dd><a href="/markdown">编辑器语法</a></dd>
                    <dd><a href="//weekly.segmentfault.com/">每周精选</a></dd>
                    <dd><a href="/app">App 下载</a></dd>
                    <dd><a href="/community">社区服务中心</a></dd>
                </dl>
                <dl class="col-sm-2 site-link">
                    <dt>联系合作</dt>
                    <dd><a href="/contact">联系我们</a></dd>
                    <dd><a href="/hiring">加入我们</a></dd>
                    <dd><a href="/link">合作伙伴</a></dd>
                    <dd><a href="/press">媒体报道</a></dd>
                    <dd><a href="https://board.segmentfault.com/">建议反馈</a></dd>
                </dl>
                <dl class="col-sm-2 site-link">
                    <dt>常用链接</dt>
                    <dd><a href="//chrome.google.com/webstore/detail/segmentfault-%E7%AC%94%E8%AE%B0/pjklfdmleagfaekibdccmhlhellefcfo" target="_blank">笔记插件: Chrome</a></dd>
                    <dd><a href="//addons.mozilla.org/zh-CN/firefox/addon/sf-note-ext/" target="_blank">笔记插件: Firefox</a></dd>
                    <dd>订阅：<a href="/feeds">问答</a> / <a href="/feeds/blogs">文章</a></dd>
                    <dd><a href="//mirrors.segmentfault.com/" target="_blank">文档镜像</a></dd>
                    <dd><a href="//segmentfault.com/blog/interview" target="_blank">社区访谈</a></dd>
                    <dd><a href="//segmentfault.com/d-day" target="_blank">D-DAY 技术沙龙</a></dd>
                    <dd><a href="//segmentfault.com/hackathon" target="_blank">黑客马拉松 Hackathon</a></dd>
                    <dd><a href="//namebeta.com/" target="_blank">域名搜索注册</a></dd>
                    <dd><a href="https://shop165859711.taobao.com/" target="_blank">周边店铺</a></dd>
                </dl>
                <dl class="col-sm-2 site-link">
                    <dt>关注我们</dt>
                    <dd><a href="//github.com/SegmentFault" target="_blank">Github</a></dd>
                    <dd><a href="//twitter.com/segment_fault" target="_blank">Twitter</a></dd>
                    <dd><a href="http://weibo.com/segmentfault" target="_blank">新浪微博</a></dd>
                    <dd><a href="//segmentfault.com/blog/segmentfault_team" target="_blank">团队日志</a></dd>
                    <dd><a href="//segmentfault.com/blog/segmentfault" target="_blank">产品技术日志</a></dd>
                    <dd><a href="//segmentfault.com/blog/community_admin" target="_blank">社区运营日志</a></dd>
                    <dd><a href="//segmentfault.com/blog/segmentfault_news" target="_blank">市场运营日志</a></dd>
                </dl>
                <dl class="col-sm-4 site-link" id="license">
                    <dt>内容许可</dt>
                    <dd>除特别说明外，用户内容均采用 <a rel="license" target="_blank" href="https://creativecommons.org/licenses/by-nc-nd/4.0/">知识共享署名-非商业性使用-禁止演绎 4.0 国际许可协议</a> 进行许可
                    </dd>
                    <dd>本站由 <a target="_blank" href="https://www.upyun.com/?utm_source=segmentfault&amp;utm_medium=link&amp;utm_campaign=upyun&amp;md=segmentfault">又拍云</a> 提供 CDN 存储服务
                    </dd>
                </dl>
            </div>
            <div class="copyright text-center">
                Copyright © 2011-2017 SegmentFault. 当前呈现版本 17.01.23<br>
                <a href="http://www.miibeian.gov.cn/" rel="nofollow">浙ICP备 15005796号-2</a> &nbsp;
                <a target="_blank" href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=33010602002000" rel="nofollow">浙公网安备 33010602002000号</a>
            </div>
            <p class="text-center">
                <a class="js__view--selector hidden-sm hidden-md hidden-lg" data-action="mobile" href="javascript:;">移动版</a>
                <a class="js__view--selector hidden-sm hidden-md hidden-lg" data-action="desktop" href="javascript:;">桌面版</a>
            </p>
        </div>
    </footer>
</div>
<script src="/js/app.js"></script>
<script>
    console.log("如发现xss或任何其他类型漏洞或安全隐患，请到 'https://github.com/shellus/shcms' 提Issue，感谢您对开源做出的贡献 :)");
</script>
@yield('footer')
</body>
</html>
