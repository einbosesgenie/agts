@extends('layout.layout')

@section('content')
    <main class="main">
        <div class="container-fluid no-gap">
            <div class="breadcrumbs-row">
                <div class="container">
                    @include('layout.breadcrumbs')
                </div>
            </div>
        </div>
        @foreach($catalogTree as $general)
        <div class="container catalog-category__title">
            <h1>{{$general['display_name']}}</h1>
        </div>
        <div class="catalog-category tile-grid__wrapper">
            <div class="container">
                @if(array_key_exists('childs', $general))
                <div class="tile-grid">

                    @foreach($general['childs'] as $child)
                    <div class="tile-grid-item">
                        @if(array_key_exists('childs', $child))
                        <div class="tile-grid-item__category-name has-children"><a href="/catalog/category/{{$child['id']}}">{{$child['display_name']}}</a></div>
                            <div class="tile-grid-item__content">
                                @foreach($child['childs'] as $secondChild)
                                <div class="tile-grid-item__li"><a href="/catalog/product/{{$secondChild['id']}}">{{$secondChild['display_name']}}</a></div>
                                @endforeach
                            </div>
                            @else
                            <div class="tile-grid-item__category-name"><a href="/catalog/product/{{$child['id']}}">{{$child['display_name']}}</a></div>
                        @endif
                    </div>
                    @endforeach
                </div>
                @endif

            </div>
        </div>
        @endforeach
        <div class="catalog-products catalog-products--in-category">
            <div class="container">
                <div class="grid">
                    @if(count($products)>0)
                    @foreach($products as $product)
                    <div class="grid-item c-product"><a class="grid-item__content" href="/catalog/product/view/{{$product->id}}">
                            <div class="c-product__img grid-item__img"><img src="{{'/storage/' . $product->img}}" alt="{{$product->name}}"></div>
                            <div class="c-product__text">
                                <div class="c-product__sup">{{$product->title}}</div>
                                <div class="c-product__title">{{$product->name}}</div>
                                <div class="grid-item__link">Подробнее</div>
                            </div></a></div>
                        @endforeach
                        @else
                        <h1>ТОВАРОВ НЕ НАЙДЕНО</h1>
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection