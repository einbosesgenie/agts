@extends('layout.layout')

@section('title','Каталог')

@section('content')
    <main class="main">
        <div class="container-fluid no-gap">
            <div class="breadcrumbs-row">
                <div class="container">
                    <div class="breadcrumbs"><span><a href="/">Главная</a></span><span><a href="">Каталог</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container catalog-category__title">
            <h1>Каталог</h1>
        </div>
        <div class="catalog-category tile-grid__wrapper">
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
        </div>
    </main>
    @endsection