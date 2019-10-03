@extends('layout.layout')

@section('title','Результат поиска')

@section('content')
    <main class="main">
        <div class="container-fluid no-gap">
            <div class="breadcrumbs-row">
                <div class="container">
                    <div class="breadcrumbs">
                        <span><a href="/">Главная</a></span>
                        <span><a href="/catalog">Каталог</a></span>
                        <span><a href="#">Результат поиска</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="catalog-products">
                <h1 class="tall">Результат поиска</h1>
                @include('product.grid')
                <div class="catalog-products__pagination">
                    {{$products->links('layout.pagination')}}
                </div>
            </div>
        </div>
    </main>
@endsection
