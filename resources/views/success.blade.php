@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">成功！</div>

                <div class="panel-body">
                    {{ $message }}
                </div>
                <div class="panel-footer">
                    <a href="{{ $return_url }}">返回</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
