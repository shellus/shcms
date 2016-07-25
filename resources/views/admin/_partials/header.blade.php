<a href="{{ route('admin') }}" class="logo">
    <span class="logo-lg"><img height="50" width=230 src="http://cdn.endaosi.com/image/shcms-logo-500-300.jpg"></span>
    <span class="logo-mini"><img src="http://cdn.endaosi.com/image/shcms-logo-50-50.jpg"></span>
</a>

<nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a>

    <ul class="nav navbar-nav">
        @yield('navbar')
    </ul>

    <ul class="nav navbar-nav navbar-right">
        @yield('navbar.right')
    </ul>
</nav>