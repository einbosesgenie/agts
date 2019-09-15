@extends('layout.layout')

@section('title', 'О компании')

@section('content')
    <main class="main">
        <div class="container-fluid no-gap">
            <div class="breadcrumbs-row">
                <div class="container">
                    <div class="breadcrumbs"><span><a href="#">Главная</a></span><span><a href="#">О компании</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="page-about__title">
                <h1>О компании</h1>
            </div>
            <div class="about-page">
                <div class="about-page__content">
                    {!! $aboutCompany->body !!}
                </div>
                @include('layout.highlightNews')
            </div>
        </div>
    </main>
@endsection