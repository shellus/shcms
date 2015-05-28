@extends('layout')
@section('title')用户中心@endsection
@section('content')

        <div class="page-header">
            <h1>用户中心 <small>欢迎你的到来</small></h1>
        </div>
        <div class="row">
            <div class="col-md-6">
                <img width="100" height="100" src="{{ \Auth::user()->getAvatarUrl() }}">
                <h3>修改头像</h3>
                <form id="edit"
                      action="{{ action('UserController@update',\Auth::user()->id) }}"
                      enctype="multipart/form-data"
                      method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="put">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="sr-only">文件</label>
                            <input class="form-control" type="file" name="avatar">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <input type="submit" value="submit">
                        </div>
                    </div>
                </form>



            </div>
            <div class="col-md-6">

            </div>
        </div>

@endsection