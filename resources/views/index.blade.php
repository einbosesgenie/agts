@extends('layout.layout')

@section('title','Главная')

@section('content')
    <main class="main">
        <div class="container-fluid no-gap hero">
            <div class="container">
                <div class="hero__text">
                    <div class="hero__title">20 лет —</div>
                    <div class="hero__subtitle">обеспечиваем и поддерживаем геологразведку нашей страны</div>
                    <div class="hero__p">Поставки различного специального оборудования, инструментов, аппаратуры как в
                        виде отдельных изделий, так и в интегрированных комплексах целевого назначения. Имея обширные
                        связи с производителями и поставщиками из разных стран, мы можем подобрать для Ваших конкретных
                        условий оптимальные изделия, отвечающие самым современным технологическим требованиям.
                    </div>
                    <a class="hero__link grid-item__link" href="/about">О компании</a>
                </div>
            </div>
            <div class="hero__bg"></div>
        </div>
        <div class="catalog-index catalog-category tile-grid__wrapper">
            <div class="container">
                <div class="tile-grid">
                    @foreach($catalogTree as $catalogParent)
                        <div class="tile-grid-item">
                            <div class="tile-grid-item__icon"><img src="{{'/storage/' . $catalogParent['icon']}}"></div>
                            @if(array_key_exists('childs', $catalogParent))
                                <div class="tile-grid-item__category-name has-children"><a href="/catalog/category/{{$catalogParent['id']}}">{{$catalogParent['display_name']}}</a></div>
                                <div class="tile-grid-item__content">
                                    @foreach($catalogParent['childs'] as $catalogChildren)
                                        @if(array_key_exists('childs', $catalogParent))
                                            <div class="tile-grid-item__li"><a href="/catalog/category/{{$catalogChildren['id']}}">{{$catalogChildren['display_name']}}</a></div>
                                        @else
                                            <div class="tile-grid-item__li"><a href="/catalog/product/{{$catalogChildren['id']}}">{{$catalogChildren['display_name']}}</a></div>
                                        @endif
                                    @endforeach
                                </div>
                            @else
                                <div class="tile-grid-item__category-name"><a href="/catalog/product/{{$catalogParent['id']}}">{{$catalogParent['display_name']}}</a></div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>        <div class="container-fluid no-gap index-manuf__bg">
            <div class="container index-manuf__wrapper">
                <div class="index-manuf">
                    <div class="index-manuf__title">Мы сотрудничаем с производителями и поставщиками более чем из 15
                        стран:
                    </div>
                    <a class="index-manuf__link grid-item__link" href="/manufacturer">Все производители</a>
                </div>
                <div class="light-swiper">
                    <div class="swiper-wrap swiper__tiles">
                        <div class="swipe-item">
                            <div class="index-manuf__grid">
                                @foreach($manufacturerFirst as $manufacturer)
                                <a class="index-manuf__img" href="/manufacturer/viewProducts/{{$manufacturer['id']}}">
                                    <img src="{{'/storage/' . $manufacturer['img']}}">
                                </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="swipe-item">
                            <div class="index-manuf__grid">
                                @foreach($manufacturerSecond as $manufacturer)
                                    <a class="index-manuf__img" href="/manufacturer/viewProducts/{{$manufacturer['id']}}">
                                        <img src="{{'/storage/' . $manufacturer['img']}}">
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="dot-wrap">
                        <div class="dot"><span class="active"></span></div>
                        <div class="dot"><span></span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container no-gap">
            <div class="index-news__text">
                <div class="index-news__title">Новости</div>
                <div class="index-news__all"><a class="grid-item__link" href="/news">Все новости</a></div>
            </div>
            <div class="light-news-swiper">
                <div class="swiper-wrap swiper__tiles">
                    <div class="swipe-item index__news">
                        <div class="news__grid">
                            @foreach($newsFirst as $news)
                                <div class="news__item"><a class="n-grid__item" href="/news/view/{{$news['id']}}"
                                                                    style="background-image:url({{ Voyager::image($news['title_images'])}});">
                                        <div class="n-grid__content">
                                            <div class="n-grid__sup">{{(new \App\Http\Controllers\NewsController())->reductionNewsDateArray($news)}} | {{$news['title_type']}}</div>
                                            <div class="n-grid__title">{{$news['title']}}</div>
                                            <div class="n-grid__more">Подробнее</div>
                                        </div>
                                    </a></div>
                            @endforeach
                        </div>
                    </div>
                    <div class="swipe-item index__news">
                        <div class="news__grid">
                            @foreach($newsSecond as $news)
                                <div class="news__item"><a class="n-grid__item" href="/news/view/{{$news['id']}}"
                                                           style="background-image:url({{ Voyager::image($news['title_images'])}});">
                                        <div class="n-grid__content">
                                            <div class="n-grid__sup">{{(new \App\Http\Controllers\NewsController())->reductionNewsDateArray($news)}} | {{$news['title_type']}}</div>
                                            <div class="n-grid__title">{{$news['title']}}</div>
                                            <div class="n-grid__more">Подробнее</div>
                                        </div>
                                    </a></div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="dot-wrap">
                    <div class="dot"><span class="active"></span></div>
                    <div class="dot"><span></span></div>
                </div>
            </div>
        </div>
    </main>
@endsection