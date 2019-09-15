<!DOCTYPE html>
<html lang="ru">
<head>
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/css/build.css" rel="stylesheet"></head>
<body>
<header class="header">
    <div class="container">
        <div class="header__content">
            <div class="header__logo"><a href="/"><img src="<?php echo e(Voyager::image(Voyager::setting('site.images_logo', ''))); ?>"></a></div>
            <div class="header__phone--mobile"><a href="tel:74952320786">+7 (495) 232-07-86</a></div>
            <div class="header__text--desktop">ГЕОФИЗИЧЕСКАЯ АППАРАТУРА, ПРОГРАММНОЕ ОБЕСПЕЧЕНИЕ <br>И ОБОРУДОВАНИЕ ДЛЯ ГЕОЛОГОРАЗВЕДОЧНОЙ ОТРАСЛИ</div>
            <div class="header__action-group">
                <div class="header__action-group--mobile"><a class="header__search-mobile" href="javascript:;"><img src="/assets/icons/search.png"></a><a class="header__menu-mobile" href="javascript:;"><img src="/assets/icons/hamburger.png"></a></div>
                <div class="header__action-group--desktop">
                    <div class="header__contact"><a class="header__phone--desktop" href="tel:74952320786">+7 (495) 232-07-86</a><a class="btn btn-empty header__feedback-btn" href="javascript:;">Обратная связь</a></div>
                    <form class="header__search-desktop" action="/search" formmethod="get">
                        <input class="header__search-input--desktop" name="q" type="text">
                        <button class="search-icon-abs" type="submit"><img src="/assets/icons/search.png"></button>
                    </form>
                </div>
            </div>
        </div>
        <hr class="header__hr-nav--desktop">
    </div>
    <div class="nav__menu">
        <div class="nav__wrapper">
            <div class="nav__row-bg container-fluid no-gap">
                <div class="container">
                    <div class="nav__row"></div>
                </div>
            </div>
            <div class="container no-gap">
                <div class="nav">
                    <div class="nav__li has-children"><a href="/catalog">Каталог</a>
                        <div class="nav__content">
                            @foreach($catalogsTree as $catalogs)
                                @if(array_key_exists('childs', $catalogs))
                                    <div class="nav__li has-children"><a href="#">{{$catalogs['display_name']}}</a>
                                        <div class="nav__content">
                                            @foreach($catalogs['childs'] as $children)
                                                @if(array_key_exists('childs', $children))
                                                    <div class="nav__li has-children"><a
                                                                href="#">{{$children['display_name']}}</a>
                                                        <div class="nav__content">
                                                            @foreach($children['childs'] as $childrenSecond)
                                                                @if(array_key_exists('childs', $childrenSecond))
                                                                    <div class="nav__li has-children"><a href="#">{{$childrenSecond['display_name']}}</a>
                                                                        <div class="nav__content">
                                                                            @foreach($childrenSecond['childs'] as $childrenThird)
                                                                                <div class="nav__li"><a href="#">{{$childrenThird['display_name']}}</a></div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                @else
                                                                    <div class="nav__li"><a href="#">{{$childrenSecond['display_name']}}</a></div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="nav__li"><a href="#">{{$children['display_name']}}</a></div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    <div class="nav__li"><a href="#">{{$catalogs['display_name']}}</a></div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="nav__li"><a href="/about">О компании</a></div>
                    <div class="nav__li"><a href="/news">Новости</a></div>
                    <div class="nav__li"><a href="/manufacturer">Производители</a></div>
                    <div class="nav__li"><a href="#">Справочники и инструкции</a></div>
                    <div class="nav__li"><a href="#">Контакты</a></div>
                </div>
            </div>
        </div>
    </div>
</header>
