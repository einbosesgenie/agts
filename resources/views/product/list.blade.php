@extends('layout.layout')

@section('title','Справочники')

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
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="catalog-products">
                <h1 class="tall">{{$catalogType}}</h1>
                <div class="grid">
                    @if($products->count())
                    @foreach($products as $product)
                    <div class="grid-item c-product"><a class="grid-item__content" href="/catalog/product/view/{{$product->id}}">
                            <div class="c-product__img grid-item__img">
                                @if($product->img)
                                <img src="{{'/storage/' . $product->img}}" alt="{{$product->name}}">
                                    @endif
                            </div>
                            <div class="c-product__text">
                                <div class="c-product__sup">{{$product->title}}</div>
                                <div class="c-product__title">{{$product->name}}</div>
                                <div class="grid-item__link">Подробнее</div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                        @else
                        <h1 class="tall">Товаров не найдено</h1>
                        @endif
                </div>
                <div class="catalog-products__pagination">
                    {{$products->links('layout.pagination')}}
                </div>
            </div>
        </div>
    </main>
    @endsection
