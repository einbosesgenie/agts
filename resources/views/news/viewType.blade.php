@extends('layout.layout')

@section('title','Новости')

@section('content')
    <main class="main">
        <div class="container-fluid no-gap">
            <div class="breadcrumbs-row">
                <div class="container">
                    <div class="breadcrumbs"><span><a href="/">Главная</a></span><span><a href="/news">Новости</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <h1 class="news__title">Новости</h1>
        </div>
        <div class="container-fluid no-gap">
            <div class="news__control-row">
                <div class="container">
                    <div class="news__control">
                        <div class="news__iso-control">
                            <a class="news__iso-button" href="/news">Лента</a>
                            <a class="news__iso-button {{$typeNews->id === 1 ? 'is-checked' : ''}}" href="/news/typeView/{{1}}">Компания</a>
                            <a class="news__iso-button {{$typeNews->id === 3 ? 'is-checked' : ''}}" href="/news/typeView/{{3}}">Новинки</a>
                            <a class="news__iso-button {{$typeNews->id === 2 ? 'is-checked' : ''}}" href="/news/typeView/{{2}}">В мире</a>
                            <a class="news__iso-button {{$typeNews->id === 4 ? 'is-checked' : ''}}" href="/news/typeView/{{4}}">События</a></div>
                        <div class="news__subscribe-separator--desktop"></div>
                        <div class="news__subscribe">
                            <div class="news__subscribe--mobile">
                                <button class="btn btn-fill news__subscribe-mobile-modal" type="button">Подписаться на новости</button>
                            </div>
                            <div class="news__subscribe--desktop">
                                <div class="news__subscribe-desktop-text">Подписаться на новости</div>
                                <input class="news__subscribe-desktop-input" name="mail" type="email" placeholder="Ваш E-mail">
                                <button class="btn btn-empty news__subscribe-mobile-desktop" type="button">Отправить</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container no-gap">
            <div class="news__grid">
                @foreach($news as $new)
                    <div class="news__item f-world"><a class="n-grid__item" href="/news/view/{{$new->id}}"
                                                       style="background-image:url({{ Voyager::image($new->title_images)}})">
                            <div class="n-grid__content">
                                <div class="n-grid__sup">{{$new->date}} | {{$new->title_type}}</div>
                                <div class="n-grid__title">{{$new->title}}</div>
                                <div class="n-grid__more">Подробнее</div>
                            </div>
                        </a></div>
                @endforeach
            </div>
            {{$news->links('layout.pagination')}}
        </div>
    </main>
    <script type="text/javascript" src="/js/build.0088a97e011ce894def9.js"></script>
    </body>
@endsection

