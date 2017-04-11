@extends('layouts.content')
@push('breadcrumbs')
<li class="active">{{ $article_title }}</li>
@endpush

@section('body')

    <div class="col-md-8 col-md-offset-0">
        <div class="app-block">
            @include('components.breadcrumb')
            @include('components.search-form')
            <ul id="articles" class="list-unstyled">
                @foreach($articles as $article)
                    <li style="padding-bottom: 8px">
                        <div>
                            <h4>
                                <a class="" title="{{ $article -> title }}"
                                   href="{{ $article -> showUrl() }}">
                                    {{ $article -> display_title }}
                                </a>
                            </h4>
                            <span style="padding: 4px 8px; margin-right: 8px;" class="bg-info">
                                                <i class="fa fa-comments-o" aria-hidden="true"></i>
                                {{ $article->comments->count() }}
                                            </span>

                            <small>
                                <i class="fa fa-user-o text-warning" aria-hidden="true"></i>
                                <a href="#">{{ $article->user->name }}</a>
                            </small>
                            <small>{{ $article->created_at->diffForHumans() }} 发布</small>

                            @if($article->comments->count())
                                ||
                                <small>
                                    <i class="fa fa-comment-o" aria-hidden="true"></i>
                                    <a href="#">{{ $article->comments->first()->user->name }}</a>
                                </small>
                                <small>{{ $article->comments->first()->updated_at->diffForHumans() }}回复
                                </small>
                            @endif
                        </div>
                    </li>
                @endforeach
            </ul>
            <div class="text-center">
                {{ $articles->links() }}
            </div>
        </div>

    </div>

@endsection
@section('footer')
    <script>
    </script>

@endsection