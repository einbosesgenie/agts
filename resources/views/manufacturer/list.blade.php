@extends('layout.layout')

@section('title','Производители')

@section('content')
    <main class="main">
        <div class="container-fluid no-gap">
            <div class="breadcrumbs-row">
                <div class="container">
                    <div class="breadcrumbs"><span><a href="/">Главная</a></span><span><a href="/manufacturer">Производители</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="manufacturer">
                <h1 class="tall">Производители</h1>
                @include('manufacturer.grid')
                {{$manufacturers->links('layout.pagination')}}
            </div>
        </div>
    </main>
@endsection