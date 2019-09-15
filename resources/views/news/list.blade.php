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
                    <div class="news__iso-control"><span class="news__iso-button is-checked"
                                                         data-filter="*">Лента</span><span class="news__iso-button"
                                                                                           data-filter=".f-company">Компания</span><span
                                class="news__iso-button" data-filter=".f-new">Новинки</span><span
                                class="news__iso-button" data-filter=".f-world">В мире</span><span
                                class="news__iso-button" data-filter=".f-events">События</span></div>
                    <div class="news__subscribe-separator--desktop"></div>
                    <div class="news__subscribe">
                        <div class="news__subscribe--mobile">
                            <button class="btn btn-fill news__subscribe-mobile-modal" type="button">Подписаться на
                                новости
                            </button>
                        </div>
                        <div class="news__subscribe--desktop">
                            <div class="news__subscribe-desktop-text">Подписаться на новости</div>
                            <input class="news__subscribe-desktop-input" name="mail" type="text"
                                   placeholder="Ваш E-mail">
                            <button class="btn btn-empty news__subscribe-mobile-desktop" type="button">Отправить
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container no-gap">
        <div class="news__grid">
            @foreach($newsType as $newType)
                @foreach($news as $new)
                    @if((int)$new->type_id === 2 && (int)$newType->id === 2)
                        <div class="news__item f-world"><a class="n-grid__item" href="#"
                                                           style="background-image:url({{ Voyager::image($new->title_images)}})">
                                <div class="n-grid__content">
                                    <div class="n-grid__sup">{{$new->date}} | {{$newType->title}}</div>
                                    <div class="n-grid__title">{{$new->title}}</div>
                                    <div class="n-grid__more">Подробнее</div>
                                </div>
                            </a></div>
                    @endif
                    @if((int)$new->type_id === 1 && (int)$newType->id === 1)
                        <div class="news__item f-company"><a class="n-grid__item" href="#"
                                                             style="background-image:url({{ Voyager::image($new->title_images)}});">
                                <div class="n-grid__content">
                                    <div class="n-grid__sup">{{$new->date}} | {{$newType->title}}</div>
                                    <div class="n-grid__title">{{$new->title}}</div>
                                    <div class="n-grid__more">Подробнее</div>
                                </div>
                            </a></div>
                    @endif
                    @if((int)$new->type_id === 3 && (int)$newType->id === 3)
                        <div class="news__item f-new"><a class="n-grid__item" href="#"
                                                         style="background-image:url({{ Voyager::image($new->title_images)}});">
                                <div class="n-grid__content">
                                    <div class="n-grid__sup">{{$new->date}} | {{$newType->title}}</div>
                                    <div class="n-grid__title">{{$new->title}}</div>
                                    <div class="n-grid__more">Подробнее</div>
                                </div>
                            </a></div>
                    @endif
                    @if((int)$new->type_id === 4 && (int)$newType->id === 4)
                        <div class="news__item f-events"><a class="n-grid__item" href="#"
                                                            style="background-image:url({{ Voyager::image($new->title_images)}});">
                                <div class="n-grid__content">
                                    <div class="n-grid__sup">{{$new->date}} | {{$newType->title}}</div>
                                    <div class="n-grid__title">{{$new->title}}</div>
                                    <div class="n-grid__more">Подробнее</div>
                                </div>
                            </a></div>
                    @endif
                @endforeach
            @endforeach
        </div>
        {{$news->links('layout.pagination')}}
    </div>
</main>
<script type="text/javascript" src="/js/build.0088a97e011ce894def9.js"></script>
</body>
    @endsection
