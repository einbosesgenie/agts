@extends('layout.layout')

@section('content')
    <main class="main">
        <div class="container-fluid no-gap">
            <div class="breadcrumbs-row">
                <div class="container">
                    <div class="breadcrumbs"><span><a href="#">Главная</a></span><span><a href="#">Производители</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="manufacturer">
                <h1 class="tall">Производители</h1>
                <div class="grid">
                    @foreach($manufacturers as $manufacturer)
                        <div class="grid-item g-manufacturer"><a class="grid-item__content" href="/manufacturer/viewProducts/{{$manufacturer->id}}">
                                <div class="g-manufacturer__img grid-item__img"><img src="{{'/storage/' . $manufacturer->img}}" alt="{{$manufacturer->title}}"></div>
                                <div class="g-manufacturer__text">
                                    <div class="g-manufacturer__title">{{$manufacturer->title}}</div>
                                    <div class="g-manufacturer__description">{{$manufacturer->body}}</div>
                                    <div class="grid-item__link g-manufacturer__link">Посмотреть продукцию</div>
                                </div></a></div>
                    @endforeach
                </div>
                {{$manufacturers->links('layout.pagination')}}
            </div>
        </div>
    </main>
@endsection
<script type="text/javascript" src="/js/build.0088a97e011ce894def9.js"></script></body>
</html>