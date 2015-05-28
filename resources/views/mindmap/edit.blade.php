@extends('mindmap.layout')
@section('head')
    <meta charset="utf-8">
    <title>KityMinder Editor - Powered By FEX</title>
    <link rel="stylesheet" href="{{ asset('/kity/css/kityminder.editor.css') }}">
    <style>
        #minder-editor {
            position: absolute;
            top: 50px;
            left: 0;
            right: 0;
            bottom: 0;
        }
    </style>
    <style>

    </style>
@overwrite
@section('content')
    {{--<div style="position: relative;">--}}
        {{--<h1 style="margin-right: 100px;">KityMinder Editor - Powered By FEX</h1>--}}
        {{--<button style="position: absolute;top:0;right: 0;" onclick="console.log(editor.minder.exportJson());">保存</button>--}}
    {{--</div>--}}


    <div id="minder-editor"></div>
@endsection

@section('foot')
    <script>
        sh.config.set('MINDMAP_ID',{{ $id }});
    </script>

    <script src="{{ asset('/kity/js/kity.js') }}"></script>
    <script src="{{ asset('/kity/js/kityminder.editor.js') }}"></script>

    <script>


        sh.get('/mindmap/' + sh.config.get('MINDMAP_ID'),function(data){
            console.log(data);
            window.editor = new kityminder.Editor({
                renderTo: 'minder-container'
            });
            //editor.minder.importJson(data);
        });

        // contentchange noderemove nodeattach nodedetach nodecreate
//        editor.minder.on('contentchange', function(evnte) {
//            console.log(evnte);
//
//
//            var node = editor.minder.getSelectedNode();
//            if (node) {
//                console('You selected: "%s"', node.getText());
//            }
//
//        });

    </script>
@endsection