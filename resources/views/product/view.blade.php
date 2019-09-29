@extends('layout.layout')

@section('title', $product['name'])

@section('content')
<main class="main">
    <div class="container-fluid no-gap">
        <div class="breadcrumbs-row">
            <div class="container">
                <div class="breadcrumbs">
                    <span><a href="/">Главная</a></span>
                    <span><a href="/catalog">Каталог</a></span>
                    @foreach($breadcrumbs as $breadcrumb)
                        <span><a href="/catalog/category/{{$breadcrumb['id']}}">{{ $breadcrumb['display_name'] }}</a></span>
                    @endforeach
                    <span><a href="/catalog/product/{{$breadcrumbsEnd['id']}}">{{$breadcrumbsEnd['display_name']}}</a></span>
                        <span><a href="/catalog/product/{{$product['id']}}">{{$product['name']}}</a></span>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <h1 class="article__title">Гравиметр CG-5 и аппаратура  OhmMapper</h1>
    </div>
    <div class="container product-card__container">
        <div class="product-card">
            <div class="product-card__img"><img src="/assets/img/p-card-1.jpg"></div>
            <div class="product-card__manufacturer">
                <div class="g-manufacturer__img grid-item__img"><img src="{{'/storage/' . $manufacturer['img']}}" alt="Advanced Logic Technology"></div>
                <div class="g-manufacturer__text">
                    <div class="g-manufacturer__title">{{$manufacturer['title']}}</div>
                    <div class="g-manufacturer__description">{{$manufacturer['body']}}</div><a class="grid-item__link g-manufacturer__link" href="/manufacturer/viewProducts/{{$manufacturer['id']}}">Посмотреть продукцию</a>
                </div>
            </div>
            <div class="product-card__docs"><a class="pc-doc" href="#">
                    <div class="pc-doc__img"><img src="/assets/icons/pdf.png"></div>
                    <div class="pc-doc__text"><span class="pc-doc__name">X612-EM</span><span class="pc-doc__info">PDF - 249 kb</span></div></a><a class="pc-doc" href="#">
                    <div class="pc-doc__img"><img src="/assets/icons/pdf.png"></div>
                    <div class="pc-doc__text"><span class="pc-doc__name">Сертификат</span><span class="pc-doc__info">PDF - 78 kb</span></div></a><a class="pc-doc" href="#">
                    <div class="pc-doc__img"><img src="/assets/icons/zip.png"></div>
                    <div class="pc-doc__text"><span class="pc-doc__name">ПО X612-EM</span><span class="pc-doc__info">PDF - 304 mb</span></div></a></div>
            <div class="product-card__highlight">
                <div class="product-card__hl-title">Области применения:</div>
                <div class="product-card__hl-text">анализ результатов геоэлектрических измерений</div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="article__container with-highlight-news product-card__article-container">
            <div class="article product-card__article">
                <h2>Описание</h2>
                <p>X612-EM: ответ компании MAE на потребность в высоком разрешении и 3-мерном анализе результатов геоэлектрических измерений.</p>
                <p>Прибор X612-EM воплощает новую концепцию георезистивиметра, предназначенного для измерения удельного электрического сопротивления, проведения многоэлектродной томографии, измерения потенциалов самопроизвольной поляризации, поляризуемости, вызванной поляризации (ВП) или проведения вертикального электрического зондирования (ВЭЗ). Прибор объединяет в себе элементы, необходимые для проведения вертикальной геоэлектрической и многоэлектродной разведки с помощью 48 электродов. Число управляемых устройством электродов можно увеличить путем использования внешних расширительных блоков, каждый из которых включает в себя 24 или 48 электродов. Таким образом, число управляемых электродов может возрасти до 288 или более.</p>
                <p>Главной особенностью данного прибора является очень высокая скорость проведения исследований, как 2-мерных, так и 3-мерных. Это стало возможным благодаря применению новой высокотехнологичной платформы сбора данных, которая позволяет производить сбор данных одновременно почти на всех каналах, которыми снабжен прибор.</p>
                <hr>
                <h2>Преимущества:</h2>
                <ul>
                    <li>одновременная поддержка трехэлектродной, двухэлектродной, диполь-дипольной, и трехмерной конфигураций;</li>
                    <li>разрешение 24 бита;</li>
                    <li>создание псевдоразреза в реальном времени;</li>
                    <li>возможность расширения (путем увеличения числа электродов и соответствующего увеличения числа измерительных каналов);</li>
                    <li>центральный процессор и встроенный дисплей.</li>
                </ul>
                <p>Современные методики проведения 2- и 3-мерной геоэлектрической томографии с высоким разрешением требуют вдвое большего числа измерений, по сравнению с традиционными методиками.</p>
                <hr>
                <h2>Технические характеристики</h2><b>ВЫХОДНОЙ ТОК:</b>
                <ul>
                    <li>Автоматическое регулирование (5 этапов)</li>
                </ul>
                <table>
                    <tr>
                        <td>Максимальная интенсивность:</td>
                        <td>5 A при напряжении 50 В</td>
                    </tr>
                    <tr>
                        <td>Выходное напряжение:</td>
                        <td>±50 В, ±100 В, ±250 В, ±500 В, ±800 В (950 В с дополнительным внешним генератором)</td>
                    </tr>
                    <tr>
                        <td>Максимальная мощность:</td>
                        <td>250 Вт (600 Вт с дополнительным внешним генератором)</td>
                    </tr>
                </table>
                <h2>Измерение потенциала:</h2>
                <ul>
                    <li>Автоматический выбор диапазона.</li>
                    <li>Одновременное выполнение измерений на всех подключенных каналах.</li>
                    <li>Автоматическое обнуление потенциала самопроизвольной поляризации.</li>
                    <li>Поляризуемость, измеренная в четырех временных окнах суммарной длительностью 1,2 секунды.</li>
                </ul>
                <div class="product-card__relative-products">
                    <hr>
                    <h2>Связанные продукты</h2>
                    <div class="p-card-rp"><a class="p-card-rp__product" href="#">
                            <div class="p-card-rp__img"><img src="/assets/img/rp-1.png"></div>
                            <div class="p-card-rp__text">
                                <div class="p-card-rp__title">CPE-24-03</div>
                                <div class="p-card-rp__name">Кабель для геоэлектрических исследований</div>
                            </div></a><a class="p-card-rp__product" href="#">
                            <div class="p-card-rp__img"><img src="/assets/img/rp-2.png"></div>
                            <div class="p-card-rp__text">
                                <div class="p-card-rp__title">EL2</div>
                                <div class="p-card-rp__name">Пластина/электрод из нержавеющей стали</div>
                            </div></a><a class="p-card-rp__product" href="#">
                            <div class="p-card-rp__img"><img src="/assets/img/rp-3.png"></div>
                            <div class="p-card-rp__text">
                                <div class="p-card-rp__title">CPP1</div>
                                <div class="p-card-rp__name">Кабель для подключения электродов</div>
                            </div></a></div>
                </div>
            </div>
            <div class="highlight-news">
                <hr class="hr__separator--mobile-tablet">
                @include('layout.highlightNews')
            </div>
        </div>
    </div>
    <div class="container-fluid no-gap">
        <div class="product-card__recomendations">
            <div class="container">
                <div class="pc-recomendation__title">Рекомендуем</div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="pc-news--mobile-tablet">
            @include('layout.highlightNews')
        </div>
    </div>
</main>
    @endsection