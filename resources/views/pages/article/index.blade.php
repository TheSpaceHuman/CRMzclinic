@extends('layouts.articles')


@section('content')
    <aside class="sidebar-left col-md-3 p-3">
        <ul class="list-items lvl-1">
            @foreach ($article_categories  as $category)
                <li class="list-item dropdown {{ Request::is('articles/category/' . $category->slug) ? 'active' : '' }}">
                    <a class="link-def" href="articles/category/{{$category->slug}}" aria-expanded="false" aria-controls="{{$category->id}}">{{$category->title}}</a>
                    <div class="collapse" id="{{$category->id}}">
                        <ul class="list-items lvl-2">
                            @foreach ($category->article  as $article)
                                <li class="list-item {{ Request::is('articles/show/' . $article->slug) ? 'active' : '' }}">
                                    <a class="link-def" href="articles/show/{{$article->slug}}">{{$article->title}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </li>
            @endforeach
        </ul>
    </aside>


    <div class="content col-9">
        <form action="{{route('page.article.index')}}" method="get" class="row">
            <div class="form-group col-8 offset-2">
                <input type="text" class="form-control" placeholder="Введите название статьи" name="s" value="{{ isset($s) ? $s : '' }}">
            </div>
            <div class="form-group col-2">
                <div class="d-flex justify-content-center">
                    <button class="btn btn-success">Поиск</button>
                </div>
            </div>
        </form>

        <div class="articles-items">
            @foreach($articles as $article)
                <div class="articles-item search-li">
                    <div class="articles-item_title search-link">
                        {{ $article->title }}
                    </div>
                    <div class="articles-item_intro">
                        {{ $article->getIntrotext($article->introtext) }}
                    </div>
                    <div class="articles-item_author">
                        <i class="fas fa-calendar-check"></i>
                        {{ $article->getServices() }}
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="articles/show/{{ $article->slug }}" class="btn btn-primary">Подробнее</a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center">
            {!! $articles->links() !!}
        </div>
    </div>
@endsection