@extends('layout.layout')

@section('title','Пользовательское соглашение')

@section('content')
    <main class="main">
        <div class="container-fluid no-gap">
            <div class="breadcrumbs-row">
                <div class="container">
                    <div class="breadcrumbs"><span><a href="/">Главная</a></span><span><a>Пользовательское соглашение</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="u-agreement">
                {!!  $agreement  !!}
            </div>
        </div>
    </main>
    @endsection
