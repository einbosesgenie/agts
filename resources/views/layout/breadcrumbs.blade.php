<div class="breadcrumbs"><span><a href="/">Главная</a></span>
    <span><a href="/catalog">Каталог</a></span>
    @foreach($breadcrumbs as $breadcrumb)
        <span><a href="/catalog/category/{{$breadcrumb['id']}}">{{ $breadcrumb['display_name'] }}</a></span>
    @endforeach
</div>
