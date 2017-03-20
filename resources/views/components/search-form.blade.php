<form method="GET" action="{{ route('article.index') }}">
    <div class="input-group input-group-lg search-box">
        {{--<input type="hidden" name="c" value="*">--}}
        <input id="search-input" autocomplete="off" type="search" class="form-control" name="s"
               value="{{ \Request::get('s') }}" placeholder="点击查看热搜词吧" data-effects="fade">
        <span class="input-group-btn">
            <button class="btn btn-default" type="submit">搜索</button>
        </span>
    </div>
    <label for="search-list"></label>
    <select id="search-list" class="form-control hidden">
        @foreach(\App\Article::searchHistoryTopList() as $search_history)
            <option data-val="{{ $search_history -> word }}">
                {{ $search_history -> word }} 热搜 {{ $search_history -> rows }} 次
            </option>
        @endforeach
    </select>
    <script>
        if(!!$.fn.editableSelect){
            var $place  = $('#search-input');

            var $select = $('#search-list').clone().removeAttr('id').appendTo($place);

            $place.editableSelect().on('select.editable-select', function (e, li) {
                $('#search-input').val(li.data("val"));
            });;
        }
    </script>
</form>