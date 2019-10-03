@if(count($products)>0)
    @foreach($products as $product)
        <div class="grid-item c-product"><a class="grid-item__content" href="/catalog/product/view/{{$product->id}}">
                <div class="c-product__img grid-item__img"><img src="{{'/storage/' . $product->img}}"
                                                                alt="{{$product->name}}"></div>
                <div class="c-product__text">
                    <div class="c-product__sup">{{$product->title}}</div>
                    <div class="c-product__title">{{$product->name}}</div>
                    <div class="grid-item__link">Подробнее</div>
                </div>
            </a></div>
    @endforeach
@else
    <h1>ТОВАРОВ НЕ НАЙДЕНО</h1>
@endif
