@extends('layout.layout')

@section('content')
    <main class="main">
        <div class="container-fluid no-gap">
            <div class="breadcrumbs-row">
                <div class="container">
                    <div class="breadcrumbs"><span><a href="/">Главная</a></span>
                        <span><a href="/manufacturer">Производители</a></span>
                        <span><a href="#">{{$manufacturer->title}}</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="manufacturer">
                <h1 class="tall">{{$manufacturer->title}}</h1>
                <div class="manufacturer-info">
                    <div class="manufacturer-info__img"><img src="{{'/storage/' . $manufacturer->img}}" alt=""></div>
                    <div class="manufacturer-info__content">
                        <div class="manufacturer-info__text">
                            <p>{{$manufacturer->body}}</p>
                        </div>
                        <div class="manufacturer-info__link"><a href="{{$manufacturer->url}}">{{$manufacturer->display_url ?? 'Ссылка на компанию'}}</a></div>
                    </div>
                </div>
                <h2>Продукция компании</h2>
                <div class="grid">
                    @foreach($products as $product)
                        <div class="grid-item c-product"><a class="grid-item__content" href="#">
                                <div class="c-product__img grid-item__img"><img src="{{'/storage/' . $product->img}}" alt="{{$product->name}}"></div>
                                <div class="c-product__text">
                                    <div class="c-product__sup">{{$manufacturer->title}}</div>
                                    <div class="c-product__title">{{$product->name}}</div>
                                    <div class="grid-item__link">Подробнее</div>
                                </div></a></div>
                    @endforeach
                </div>
                {{$products->links('layout.pagination')}}
            </div>
        </div>
    </main>
    @endsection

<script type="text/javascript" src="/js/build.0088a97e011ce894def9.js"></script>
