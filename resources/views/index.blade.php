

@extends('layout')
@section('head')

    <title>{{ config('system.site_title') }} - 首页</title>
    <style>
        .panel-body {
            height: 400px;
            overflow: auto;
            overflow-x: hidden;
        }
        .panel-body::-webkit-scrollbar{height:8px;width:8px;background:rgba(152, 152, 152, 0.3);border-radius:5px;}
        .panel-body::-webkit-scrollbar-button{display:none;}
        .panel-body::-webkit-scrollbar-track{background-color:#ffffff;}
        .panel-body::-webkit-scrollbar-track-piece{background:#ffffff;}
        .panel-body::-webkit-scrollbar-thumb{width:8px;min-height:15px;background:rgba(0, 0, 0, 0.2);border-radius:5px;}
        .panel-body::-webkit-scrollbar-thumb:hover{background:rgba(0, 0, 0, 0.6);}
        .panel-body::-webkit-scrollbar-thumb:active{background:rgba(0, 0, 0, 0.8);}

        .opencode{
            padding: 10px;
        }
    </style>
@endsection
@section('content')

    <h2>最新记录</h2>
    <hr>
            <div class="panel panel-default">
                <div class="panel-body" id="opentimes">

                </div>
            </div>

            <div class="time">
                <label>当前时间:<span id="time"></span></label>
            </div>
        @scriptVar('lottery_id',$lottery->id)


@endsection
@section('foot')
@endsection


