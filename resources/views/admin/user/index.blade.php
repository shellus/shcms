@extends('admin.layouts.app')
@section('content')
    <ul class="list-unstyled">
    @forelse(\App\User::paginate() as $user)
        <li>{{ $user->name }}</li>
    @empty
        没有任何内容哦
    @endforelse
    </ul>
@endsection
@section('footer')
@endsection