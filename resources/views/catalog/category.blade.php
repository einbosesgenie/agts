@extends('layout.layout')

@section('title','Каталог')

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
                @include('catalog.grid')
                </div>
                 {{$products->links('layout.pagination')}}
            </div>
        </div>
    </main>
@endsection