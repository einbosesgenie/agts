<div class="news__grid">
    @foreach($news as $new)
        <div class="news__item f-world"><a class="n-grid__item" href="/news/view/{{$new->id}}"
                                           style="background-image:url({{ Voyager::image($new->title_images)}})">
                <div class="n-grid__content">
                    <div class="n-grid__sup">{{$new->date}} | {{$new->title_type}}</div>
                    <div class="n-grid__title">{{$new->title}}</div>
                    <div class="n-grid__more">Подробнее</div>
                </div>
            </a></div>
    @endforeach
</div>