@extends('layout')
@section('content')
    <form onkeydown="if(event.ctrlKey&&event.keyCode==13)$(this).submit()"
          action="{{ action('FileController@store') }}"
          enctype="multipart/form-data"
          method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row">
            <div class="form-group col-md-6">
                <label class="sr-only">文件</label>
                <input class="form-control" type="file" name="file">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <input type="submit" value="submit">
            </div>
        </div>
    </form>
@endsection