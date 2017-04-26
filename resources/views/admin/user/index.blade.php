@extends('admin::user.layout')
@section('box')
    <div class="box">
        <div class="box-header with-border text-right">
            {{--<h3 class="box-title">用户列表</h3>--}}
            <a class="btn btn-primary margin-r-5" href="{{ route('admin.user.create') }}"><i class="fa fa-plus"></i> 新增 </a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table class="table table-bordered">
                <tr>
                    <th style="width: 10px">#</th>
                    <th>用户名</th>
                    <th>邮箱</th>
                    <th>注册时间</th>
                    <th>Actions</th>
                </tr>
                <?php $models = \App\Models\User::paginate();?>
                @forelse($models as $model)
                    <tr>
                        <td>{{ $model->id }}.</td>
                        <td>{{ $model->name }}</td>
                        <td>{{ $model->email }}</td>
                        <td>{{ (new \Carbon\Carbon($model->created_at))->diffForHumans() }}</td>
                        <td>
                            <a class="text-success" title="查看" href="{{ route('admin.user.show',$model->id) }}"><i class="fa fa-eye"     ></i></a>&nbsp;&nbsp;
                            <a class="text-warning" title="修改" href="{{ route('admin.user.edit',$model->id) }}"><i class="fa fa-pencil"  ></i></a>
                            <form method="POST" class="inline" action="{{ route('admin.user.destroy',$model->id) }}">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button class="btn-link text-danger" title="删除" href=""><i class="fa fa-trash-o" ></i></button>
                            </form>&nbsp;&nbsp;
                        </td>
                    </tr>
                @empty
                    没有任何内容哦
                @endforelse
            </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
            {{ $models->links('admin::pagination') }}
        </div>
    </div>
@endsection