@extends('admin.layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                后台首页
                <small>查看和管理用户</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
                <li class="active">Here</li>
            </ol>
        </section>

        <section class="content">

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">用户注册曲线</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    最近7天有<span class="text-red"> {{ \App\Models\User::where('created_at','>',date('Y-m-d H:i:s', strtotime('-7day')))->count() }} </span>个新用户
                </div>
            </div>

        </section>
    </div>
@endsection
@section('footer')
@endsection