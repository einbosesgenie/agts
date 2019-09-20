<div class="highlight-news">
    <hr class="hr__separator--mobile-tablet">
    <h2 class="highlight-news__title">{{$news->title}}</h2>
    <div class="highlight-news__container">
        @foreach($news->news as $new)
            <a class="rn-item" href="/news/view/{{$new['id']}}">
            <div class="n-grid__sup">{{$new['date']}} &nbsp;|&nbsp; {{$new['title_type']}}</div>
            <div class="n-grid__title">{{$new['title']}}</div>
            </a>
            @endforeach
    </div>
</div>