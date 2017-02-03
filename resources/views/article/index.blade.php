@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel">
                    <div class="panel-body">
                        @include('components.search-form')
                        <ul id="articles" class="list-unstyled">
                            @foreach($articles as $article)
                                <li style="padding-bottom: 5px">
                                    <div>

                                        <h4>
                                            <span style="padding: 4px 8px; margin-right: 8px;" class="bg-info">
                                                <i class="fa fa-comments-o" aria-hidden="true"></i>
                                                {{ $article->comments_count() }}
                                            </span>

                                        <a class="" title="{{ $article -> title }}" href="{{ $article -> showUrl() }}">
                                            {{ $article -> display_title }}
                                        </a>
                                        </h4>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="text-center">
                        {{ $articles->links() }}
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script>
    </script>

@endsection