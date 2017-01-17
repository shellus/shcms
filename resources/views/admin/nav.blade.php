

<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">

    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
        <div class="pull-left image">
            <img src="{{ Auth::user()->avatarUrl }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
            <p>{{ Auth::user()->name }}</p>
            <!-- Status -->
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
    </div>

    <!-- search form (Optional)TODO 菜单搜索 -->
    <form action="#" method="get" class="sidebar-form" hidden>
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
    </form>
    <!-- /.search form -->

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
        <li class="header">菜单</li>
        <!-- Optionally, you can add icons to the links -->
        <li><a href="{{ route('admin') }}"><i class="fa fa-calculator"></i> <span>主页</span></a></li>
        <li class="treeview">
            <a href="#"><i class="fa fa-users"></i> <span>用户</span>
                <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{ route('admin.user.index') }}"><i class="fa fa-list-ul"></i> <span>查看</span></a></li>
                <li><a href="{{ route('admin.user.index') }}"><i class="fa fa-plus"></i> <span>创建</span></a></li>
            </ul>
        </li>


        <li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li>
        <li class="treeview">
            <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span>
                <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="#">Link in level 2</a></li>
                <li><a href="#">Link in level 2</a></li>
            </ul>
        </li>
    </ul>
    <script type="text/javascript">
        /* 导航加上活动类 */
        (function(){
            // 闭包，立即执行，给侧边导航栏添加active状态
            var $this = $('.sidebar-menu a[href="' + location.href + '"]').first();
            var parent_li = $this.parent("li");
            $this.find('i').addClass('text-blue');
            parent_li.addClass('active');

            parent_ul = parent_li.parent('ul');
            if (parent_ul.is('.treeview-menu')){
                parent_ul.addClass('menu-open').show();
                var checkElement = parent_li.parent().parent("li.treeview");
                checkElement.addClass('menu-open');
            }
        })();


    </script>
    <!-- /.sidebar-menu -->
</section>
<!-- /.sidebar -->
  