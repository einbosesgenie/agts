@extends('layout.layout')

@section('title','Справочники')

@section('content')
    <main class="main">
        <div class="container-fluid no-gap">
            <div class="breadcrumbs-row">
                <div class="container">
                    <div class="breadcrumbs"><span><a href="#">Главная</a></span><span><a href="#">Справочники и инструкции</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <h1 class="tall">Справочники и инструкции</h1>
        </div>
        <div class="container">
            <div class="files__container">
                <div class="files-filter-wrapper">
                    <div class="files-filter">
                        <div class="files-filter__title">Фильтр</div>
                        <div class="files-filter__content">
                            <div class="filters">
                                @if(count($lineProductFilter) > 0)
                                    <div class="filter" data-name="category">
                                        <div class="filter__title">Линия продукции</div>
                                        @foreach($lineProductFilter as $filter)
                                            <span class="filter-value" data-val="{{$filter->id}}">
                                            <div class="square"></div>
                                            <div class="ftext">{{$filter->display_name}}</div>
                                    </span>
                                        @endforeach
                                    </div>
                                @endif
                                @if(count($industrialFilter) > 0)
                                    <div class="filter" data-name="industry">
                                        <div class="filter__title">Промышленность</div>
                                        @foreach($industrialFilter as $filter)
                                            <span class="filter-value" data-val="{{$filter->id}}">
                                            <div class="square"></div>
                                            <div class="ftext">{{$filter->display_name}}</div>
                                    </span>
                                        @endforeach
                                    </div>
                                @endif
                                @if(count($resourceTypeFilter) > 0)
                                    <div class="filter" data-name="type">
                                        <div class="filter__title">Тип ресурса</div>
                                        @foreach($resourceTypeFilter as $filter)
                                            <span class="filter-value" data-val="{{$filter->id}}">
                                            <div class="square"></div>
                                            <div class="ftext">{{$filter->display_name}}</div>
                                    </span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <div class="filter__buttons-wrapper">
                                <div class="container">
                                    <div class="filter__buttons">
                                        <button class="btn btn-fill filter-apply">Применить</button>
                                        <button class="btn btn-empty filter-reset">Сбросить фильтр</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="files-wrapper">
                    @include('handbooks.fileWrap')
                </div>
                <div>
                    {{$files->links('layout.pagination')}}
                </div>
            </div>
        </div>
    </main>
@endsection
