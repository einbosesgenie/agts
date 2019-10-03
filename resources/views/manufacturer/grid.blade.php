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