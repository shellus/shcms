

@extends('layout')
@section('head')
    <style>

    </style>
@endsection
@section('content')
    <a href="#" id="btn-test">test</a>
@endsection
@section('foot')
    <script>
        $('#btn-test').click(function (event) {
            alert('btn click!')
        });
    </script>
@endsection


