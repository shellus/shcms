@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">联动！</div>

                    <div class="panel-body">
                        <select name="province">

                        </select>
                        <select name="city">

                        </select>
                        <select name="county">

                        </select>
                    </div>
                    <div class="panel-footer">
                        <a href="javascript:history.back()">返回</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const LEVELS = {
            'province': 1,
            'city': 2,
            'county': 3,
            1: 'province',
            2: 'city',
            3: 'county',
        };
        function getRegion(level, parentId) {
            let from = {};
            if (level !== undefined){
                from['level'] = level;
            }
            if (level !== undefined){
                from['parent_id'] = parentId;
            }
            $.getJSON('/api/region', from, function(data){
                let el = $('[name='+LEVELS[level]+']');
                el.html('');
                for (let i in data['data']){
                    el.append('<option value="'+ data['data'][i]['id'] +'">'+data['data'][i]['name']+'</option>');
                }
            });
        }

        $(document).on('change', function(event){
            let el = $(event.target);
            getRegion(LEVELS[el.attr('name')] + 1, el.find("option:selected").attr('value'));
        });

        getRegion(LEVELS.province);
    </script>
@endsection
