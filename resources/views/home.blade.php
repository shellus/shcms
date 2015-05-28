@extends('layout')

@section('content')

        <div class="page-header">
            <h1>个人中心 <small>欢迎你的到来</small></h1>
        </div>
        <div class="row">
            <div class="col-md-6">

                <form id="edit"
                      onkeydown="if(event.ctrlKey&&event.keyCode==13)$(this).submit()"
                      action="{{ action('UserController@update',$user->id) }}"
                      enctype="multipart/form-data"
                      method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="sr-only">文件</label>
                            <input class="form-control" type="file" name="images">
                        </div>
                    </div>
                </form>



            </div>
            <div class="col-md-6">

            </div>
        </div>

@endsection