@extends('layout')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">个人资料</div>
				<div class="panel-body">

                    <img src="{{ $model -> getAvatarUrl() }}">
                    <form enctype="multipart/form-data" action="{{ route('avatar.store') }}" method="post">
                        {{csrf_field()}}
                        <input type="file" name="avatar">
                        <button>提交</button>
                    </form>

                    <hr>

                        <form action="{{ route('user.update') }}" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label class="col-md-4 control-label">用户名</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name" value="{{ $model -> name }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">昵称</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="display_name" value="{{ $model -> display_name }}">
                                </div>
                            </div>

                            <button>提交</button>
                        </form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
