@extends('app/game/doudizhu/layout')
@section('head')
    <style>



    </style>
@endsection

@section('content')
    <div class="container">
        <div class="scene">



            <div class="chair-left"></div>
            <div class="chair-right"></div>
            <div class="chair-me">

                <div class="me-avatar"></div>

                <div class="poker-wrap">

                </div>
            </div>

            <div class="audio-switch on"></div>
        </div>
    </div>
@endsection
@section('foot')
    <script>
        $(function(){
            $('.poker-back').click(function(){
                if($(this).hasClass('up')){
                    $(this).removeClass('up');
                }else{
                    $(this).addClass('up');
                }
            });

            $('.audio-switch').click(function(){
                if($(this).hasClass('on')){

                    $(this).removeClass('on');
                    $(this).addClass('off');

                    $el_audio.get(0).pause()
                }else{
                    $(this).removeClass('off');
                    $(this).addClass('on');
                    $el_audio.get(0).play()
                }
            });
        });

        function audio(name){
            $el_audio = $('<audio id="audio" src="" loop="false" hidden="true" type="video/ogg"  ></audio>');
            //$el_audio = $('<source src="" type="video/ogg" onplay="" />');
            $el_audio.attr('src','/app/game/doudizhu/audio/' + name + ".ogg");
            $('body').append($el_audio);
            //$el_audio.get(0).play();
        }
        function start(arr){
            for(var i in arr){
                var color = arr[i].substr(0,1);
                var numbers = arr[i].substr(1);
                var tmpl = '<div class="poker-backs">\
                <div class="poker-back">\
                <div class="poker-color-'+color+'"></div>\
                <div class="poker-numbers-'+numbers+'"></div>\
                </div>\
                </div>';

                $('.poker-wrap').append(tmpl);
            }
        }

        start([
            'm1',
            'm2',
            'm3',
            'm4',
            'm5',
            'm6',
            'm7',
            'm8',
            'm9',
            'm10',
            'm11',
            'm12',
            'm13'
        ]);

        audio('MusicEx_Welcome');
    </script>
@endsection