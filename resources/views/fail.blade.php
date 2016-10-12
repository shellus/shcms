@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">失败！</div>

                <div class="panel-body">
                    {{ $message }}
                </div>
                <div class="panel-footer">
                    <a href="javascript:history.back()">返回</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
