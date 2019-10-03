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
                @include('product.grid')
                <div class="catalog-products__pagination">
                    {{$products->links('layout.pagination')}}
                </div>
            </div>
        </div>
    </main>
    @endsection
