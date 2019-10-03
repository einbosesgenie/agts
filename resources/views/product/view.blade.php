@extends('layout.layout')

@section('title', $product['name'])

@section('content')
    <main class="main">
        <div class="container-fluid no-gap">
            <div class="breadcrumbs-row">
                <div class="container">
                    <div class="breadcrumbs">
                        <span><a href="/">Главная</a></span>
                        <span><a href="/catalog">Каталог</a></span>
                        @foreach($breadcrumbs as $breadcrumb)
                            <span><a href="/catalog/category/{{$breadcrumb['id']}}">{{ $breadcrumb['display_name'] }}</a></span>
                        @endforeach
                        <span><a href="/catalog/product/{{$breadcrumbsEnd['id']}}">{{$breadcrumbsEnd['display_name']}}</a></span>
                        <span><a href="/catalog/product/{{$product['id']}}">{{$product['name']}}</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <h1 class="article__title">{{$product['name']}}</h1>
        </div>
        <div class="container product-card__container">
            <div class="product-card">
                <div class="product-card__img"><img src="{{'/storage/' . $product['img']}}"></div>
                <div class="product-card__manufacturer">
                    <div class="g-manufacturer__img grid-item__img"><img src="{{'/storage/' . $manufacturer['img']}}"
                                                                         alt="Advanced Logic Technology"></div>
                    <div class="g-manufacturer__text">
                        <div class="g-manufacturer__title">{{$manufacturer['title']}}</div>
                        <div class="g-manufacturer__description">{{$manufacturer['body']}}</div>
                        <a class="grid-item__link g-manufacturer__link"
                           href="/manufacturer/viewProducts/{{$manufacturer['id']}}">Посмотреть продукцию</a>
                    </div>
                </div>
                @if(count($files) > 0)
                    <div class="product-card__docs">
                        @foreach($files as $file)
                            @if($file->expansion === 'pdf')
                                <a class="pc-doc" href="http://agts/storage/{{$file->link}}">
                                    <div class="pc-doc__img"><img src="/assets/icons/pdf.png"></div>
                                    <div class="pc-doc__text"><span class="pc-doc__name">{{$file->title}}</span><span
                                                class="pc-doc__info">PDF - {{$file->size}}</span>
                                    </div>
                                </a>
                            @elseif($file->expansion === 'zip')
                                <a class="pc-doc" href="http://agts/storage/{{$file->link}}">
                                    <div class="pc-doc__img"><img src="/assets/icons/zip.png"></div>
                                    <div class="pc-doc__text"><span class="pc-doc__name">{{$file->title}}</span><span
                                                class="pc-doc__info">ZIP - {{$file->size}}</span></div>
                                </a>
                            @else
                                <a class="pc-doc" href="http://agts/storage/{{$file->link}}">
                                    <div class="pc-doc__img"><img src="/assets/icons/doc.png"></div>
                                    <div class="pc-doc__text"><span class="pc-doc__name">{{$file->title}}</span><span
                                                class="pc-doc__info">DOC - {{$file->size}}</span></div>
                                </a>
                            @endif
                        @endforeach
                    </div>
                @endif
                @if($product['application'])
                    <div class="product-card__highlight">
                        <div class="product-card__hl-title">Области применения:</div>
                        <div class="product-card__hl-text">{{$product['application']}}</div>
                    </div>
                @endif
            </div>
        </div>
        <div class="container">
            <div class="article__container with-highlight-news product-card__article-container">
                <div class="article product-card__article">
                    {!! $product['body'] !!}

                    @if(count($relatedProducts) > 0)
                        <div class="product-card__relative-products">
                            <hr>
                            <h2>Связанные продукты</h2>
                            @foreach($relatedProducts as $relatedProduct)
                                <div class="p-card-rp">
                                    <a class="p-card-rp__product" href="/catalog/product/view/{{$relatedProduct->id}}">
                                        <div class="p-card-rp__img"><img src="{{'/storage/' . $relatedProduct->img}}"></div>
                                        <div class="p-card-rp__text">
                                            <div class="p-card-rp__title">{{$relatedProduct->name}}</div>
                                            <div class="p-card-rp__name">{{$relatedProduct->title}}</div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="highlight-news">
                    <hr class="hr__separator--mobile-tablet">
                    @include('layout.highlightNews')
                </div>
            </div>
        </div>
        <div class="container-fluid no-gap">
            <div class="product-card__recomendations">
                <div class="container">
                    <div class="pc-recomendation__title">Рекомендуем</div>
                    <div class="light-swiper product-card__recomendations-slider">
                        <div class="swiper-wrap swiper__tiles">
                            <div class="swipe-item">
                                <div class="grid-item c-product"><a class="grid-item__content" href="#">
                                        <div class="c-product__img grid-item__img"><img src="/assets/img/catalog-product.png" alt="Измерители магниной восприимчивости KT-10 Plus S/C "></div>
                                        <div class="c-product__text">
                                            <div class="c-product__sup">TerraPlus</div>
                                            <div class="c-product__title">Измерители магниной восприимчивости KT-10 Plus S/C</div>
                                            <div class="grid-item__link">Подробнее</div>
                                        </div></a></div>
                            </div>
                            <div class="swipe-item">
                                <div class="grid-item c-product"><a class="grid-item__content" href="#">
                                        <div class="c-product__img grid-item__img"><img src="/assets/img/catalog-product.png" alt="Измерители магниной восприимчивости KT-10 Plus S/C "></div>
                                        <div class="c-product__text">
                                            <div class="c-product__sup">TerraPlus</div>
                                            <div class="c-product__title">Измерители магниной восприимчивости KT-10 Plus S/C</div>
                                            <div class="grid-item__link">Подробнее</div>
                                        </div></a></div>
                            </div>
                            <div class="swipe-item">
                                <div class="grid-item c-product"><a class="grid-item__content" href="#">
                                        <div class="c-product__img grid-item__img"><img src="/assets/img/catalog-product.png" alt="Измерители магниной восприимчивости KT-10 Plus S/C "></div>
                                        <div class="c-product__text">
                                            <div class="c-product__sup">TerraPlus</div>
                                            <div class="c-product__title">Измерители магниной восприимчивости KT-10 Plus S/C</div>
                                            <div class="grid-item__link">Подробнее</div>
                                        </div></a></div>
                            </div>
                        </div>
                        <div class="dot-wrap">
                            <div class="dot"><span class="active"></span></div>
                            <div class="dot"><span></span></div>
                            <div class="dot"><span></span></div>
                        </div>
                    </div>
                    <div class="grid product-card__recomendations-grid">
                        <div class="grid-item c-product"><a class="grid-item__content" href="#">
                                <div class="c-product__img grid-item__img"><img src="/assets/img/catalog-product.png" alt="Измерители магниной восприимчивости KT-10 Plus S/C "></div>
                                <div class="c-product__text">
                                    <div class="c-product__sup">TerraPlus</div>
                                    <div class="c-product__title">Измерители магниной восприимчивости KT-10 Plus S/C</div>
                                    <div class="grid-item__link">Подробнее</div>
                                </div></a></div>
                        <div class="grid-item c-product"><a class="grid-item__content" href="#">
                                <div class="c-product__img grid-item__img"><img src="/assets/img/catalog-product.png" alt="Измерители магниной восприимчивости KT-10 Plus S/C "></div>
                                <div class="c-product__text">
                                    <div class="c-product__sup">TerraPlus</div>
                                    <div class="c-product__title">Измерители магниной восприимчивости KT-10 Plus S/C</div>
                                    <div class="grid-item__link">Подробнее</div>
                                </div></a></div>
                        <div class="grid-item c-product"><a class="grid-item__content" href="#">
                                <div class="c-product__img grid-item__img"><img src="/assets/img/catalog-product.png" alt="Измерители магниной восприимчивости KT-10 Plus S/C "></div>
                                <div class="c-product__text">
                                    <div class="c-product__sup">TerraPlus</div>
                                    <div class="c-product__title">Измерители магниной восприимчивости KT-10 Plus S/C</div>
                                    <div class="grid-item__link">Подробнее</div>
                                </div></a></div>
                        <div class="grid-item c-product"><a class="grid-item__content" href="#">
                                <div class="c-product__img grid-item__img"><img src="/assets/img/catalog-product.png" alt="Измерители магниной восприимчивости KT-10 Plus S/C "></div>
                                <div class="c-product__text">
                                    <div class="c-product__sup">TerraPlus</div>
                                    <div class="c-product__title">Измерители магниной восприимчивости KT-10 Plus S/C</div>
                                    <div class="grid-item__link">Подробнее</div>
                                </div></a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="pc-news--mobile-tablet">
                @include('layout.highlightNews')
            </div>
        </div>
    </main>
@endsection