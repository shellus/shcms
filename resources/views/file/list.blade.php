@extends('layout')
@section('content')
    <div class="row">
        @foreach($files as $file)
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <img src="{{ $file->getFileUrl() }}" alt="">

                    <div class="caption">
                        <h3>标题</h3>

                        <p>说明</p>

                        <p>
                            <a href="{{ $file->getFileUrl() }}" class="btn btn-primary" role="button">打开</a>

                        <form action="{{ action('FileController@destroy',$file->id) }}" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="delete">
                            <input type="submit" class="btn btn-danger" value="删除">
                        </form>
                        </p>
                    </div>
                </div>
            </div>



        @endforeach
    </div>
    {!! $files->render() !!}
@endsection