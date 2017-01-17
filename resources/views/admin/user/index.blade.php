@extends('admin.layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                用户
                <small>查看和管理用户</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
                <li class="active">Here</li>
            </ol>
        </section>

        <section class="content">



            <div class="box">
                <div class="box-header with-border text-right">
                    {{--<h3 class="box-title">用户列表</h3>--}}
                    <a class="btn btn-primary margin-r-5" href="{{ route('admin.user.create') }}">新增</a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>用户名</th>
                            <th>邮箱</th>
                            <th>注册时间</th>
                            <th style="width: 40px">Actions</th>
                        </tr>
                        <?php $users=\App\User::paginate();?>
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $user->id }}.</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ (new \Carbon\Carbon($user->created_at))->diffForHumans() }}</td>
                                <td>
                                    <a class="btn-link" href="{{ route('admin.user.edit',$user->id) }}">修改</a>
                                </td>
                            </tr>
                        @empty
                            没有任何内容哦
                        @endforelse
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    {{ $users->links('admin::pagination') }}
                </div>
            </div>

        </section>

@endsection
@section('footer')
@endsection