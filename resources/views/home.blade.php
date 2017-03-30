@extends('layouts.app')

@section('header')
    <style>
    </style>
@endsection


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">个人信息</div>

                    <div class="panel-body">
                        <span><b>{{ \Auth::user() -> name }}</b></span>

                        <form action="/user/update-avatar" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <span>头像: </span>
                            <span><img style="padding: 15px;" class="img-circle" width="100" height="100" src="{{ \Auth::user() -> avatarUrl }}"></span>
                            <input name="avatar" type="file" value="选择文件">
                            <input type="submit" value="上传">
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
