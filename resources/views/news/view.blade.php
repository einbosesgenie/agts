@extends('layout.layout')

@section('content')
    <main class="main">
        <div class="container-fluid no-gap">
            <div class="breadcrumbs-row">
                <div class="container">
                    <div class="breadcrumbs"><span><a href="/">Главная</a></span>
                        <span><a href="/news">Новости</a></span>
                        <span><a href="">{{$generalNews->title}}</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <h1 class="article__title">{{$generalNews->title}}</h1>
            <div class="article__container with-highlight-news">
                <div class="article">
                    @if(!empty($generalNews->images))
                    <img src="{{'/storage/' . $generalNews->images}}">
                    @endif
                    <div class="article__date">{{(new \App\Http\Controllers\NewsController())->reductionNewsDate($generalNews)}} &nbsp;|&nbsp; {{$generalNews->title_type}}</div>
                    @if(!empty($generalNews->attention))
                    <div class="article__attention">{{$generalNews->attention}}</div>
                    @endif
                    {!! $generalNews->body !!}
                    @if(!empty($generalNews->source_url))
                    <p class="article__source">Источник: <a href="{{$generalNews->source_url}}">{{empty($generalNews->display_source) ? 'Перейти' : $generalNews->display_source}}</a></p>
                    @endif
                </div>
                @include('layout.highlightNews')
            </div>
        </div>
    </main>
    @endsection