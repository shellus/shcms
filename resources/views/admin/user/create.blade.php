@extends('admin::user.layout')
@section('box')
<div class="row">
    <div class="col-md-8">
        <div class="box">
            <div class="box-header with-border text-right">
                <h3 class="box-title">修改用户</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form class="form-horizontal">
                    {{ csrf_field() }}
                    @foreach(array_keys($model->toArray()) as $name)
                        <input type="text" name="{{ $name }}" value="{{ $model->$name }}">
                    @endforeach

                    <button class="btn btn-primary">保存</button>
                </form>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
            </div>
        </div>
    </div>
</div>
@endsection