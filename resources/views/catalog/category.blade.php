@extends('layout.layout')

@section('content')
    <main class="main">
        <div class="container-fluid no-gap">
            <div class="breadcrumbs-row">
                <div class="container">
                    <div class="breadcrumbs"><span><a href="/">Главная</a></span>
                        <span><a href="/catalog">Каталог</a></span>
                        @foreach($breadcrumbs as $breadcrumb)
                        <span><a href="/catalog/category/{{$breadcrumb['id']}}">{{ $breadcrumb['display_name'] }}</a></span>
                            @endforeach
                    </div>
                </div>
            </div>
        </div>
        @foreach($catalogTree as $general)
        <div class="container catalog-category__title">
            <h1>{{$general['display_name']}}</h1>
        </div>
        <div class="catalog-category tile-grid__wrapper">
            <div class="container">
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
                            <div class="tile-grid-item__category-name"><a href="#">{{$child['display_name']}}</a></div>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </main>
    @endsection