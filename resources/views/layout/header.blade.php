<!DOCTYPE html>
<html lang="ru">
<head>
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/css/build.css" rel="stylesheet">
</head>
<link rel="shortcut icon" href="/assets/img/favicon.ico" type="image/x-icon">
<body>
<header class="header">
    <div class="container">
        <div class="header__content">
            <div class="header__logo"><a href="/"><img
                            src="<?php echo e(Voyager::image(Voyager::setting('site.images_logo', ''))); ?>"></a></div>
            <div class="header__phone--mobile"><a
                        href="tel:{{setting('site.telephone')}}">{{setting('site.telephone')}}</a></div>
            <div class="header__text--desktop">{!! setting('site.header_title')  !!}</div>
            <div class="header__action-group">
                <div class="header__action-group--mobile"><a class="header__search-mobile" href="javascript:;"><img
                                class="header__search-mobile-open" src="/assets/icons/search.png"><img
                                class="header__search-mobile-close" src="/assets/icons/cross.png"></a><a
                            class="header__menu-mobile"
                            href="javascript:;"><img src="/assets/icons/hamburger.png"></a></div>
                <div class="header__action-group--desktop">
                    <div class="header__contact"><a class="header__phone--desktop"
                                                    href="tel:{{setting('site.telephone')}}">{{setting('site.telephone')}}</a><a
                                class="btn btn-empty header__feedback-btn" href="javascript:;">Обратная связь</a></div>
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
                                    <div class="nav__li has-children"><a
                                                href="/catalog/category/{{$catalogs['id']}}">{{$catalogs['display_name']}}</a>
                                        <div class="nav__content">
                                            @foreach($catalogs['childs'] as $children)
                                                @if(array_key_exists('childs', $children))
                                                    <div class="nav__li has-children"><a
                                                                href="/catalog/category/{{$children['id']}}">{{$children['display_name']}}</a>
                                                        <div class="nav__content">
                                                            @foreach($children['childs'] as $childrenSecond)
                                                                @if(array_key_exists('childs', $childrenSecond))
                                                                    <div class="nav__li has-children"><a
                                                                                href="/catalog/category/{{$childrenSecond['id']}}">{{$childrenSecond['display_name']}}</a>
                                                                        <div class="nav__content">
                                                                            @foreach($childrenSecond['childs'] as $childrenThird)
                                                                                <div class="nav__li"><a
                                                                                            href="/catalog/category/{{$childrenThird['id']}}">{{$childrenThird['display_name']}}</a>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                @else
                                                                    <div class="nav__li"><a
                                                                                href="/catalog/category/{{$childrenSecond['id']}}">{{$childrenSecond['display_name']}}</a>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="nav__li"><a
                                                                href="/catalog/category/{{$children['id']}}">{{$children['display_name']}}</a>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    <div class="nav__li"><a
                                                href="/catalog/category/{{$catalogs['id']}}">{{$catalogs['display_name']}}</a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="nav__li"><a href="/about">О компании</a></div>
                    <div class="nav__li"><a href="/news">Новости</a></div>
                    <div class="nav__li"><a href="/manufacturer">Производители</a></div>
                    <div class="nav__li"><a href="/handbooks">Справочники и инструкции</a></div>
                    <div class="nav__li"><a href="/contact">Контакты</a></div>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="header__search-mobile-container">
    <div class="container">
        <form class="header__search-mobile-form" action="/search" formmethod="get">
            <input class="header__search-input--desktop" name="q" type="text">
            <button class="search-icon-abs" type="submit"><img src="/assets/icons/search.png"></button>
        </form>
    </div>
</div>
<div class="modal--bg"></div>
<div class="modal modal--feedback">
    <form class="feedback-modal" action="#">
        <div class="feedback-modal__close"><img src="/assets/icons/thanks-close.png"></div>
        <div class="feedback-modal__title">Обратная связь</div>
        <input name="company" type="text" placeholder="Компания">
        <input name="contact" type="text" placeholder="Контактное лицо">
        <input name="email" type="email" placeholder="Ваш E-mail">
        <textarea name="message" rows="6" placeholder="Текст сообщения"></textarea>
        <label class="feedback-modal__checkbox">
            <input name="agreement" type="checkbox" required><span>Отправляя форму, Вы принимаете<a
                        class="feedback-modal__agreement"
                        href="#">Положение об обработке  персональных данных</a></span>
        </label>
        <input class="feedback-modal__submit btn btn-fill" type="submit" value="Отправить">
    </form>
</div>
<div class="modal--thanks-wrapper">
    <div class="modal modal--thanks">
        <div class="m-thanks">
            <div class="m-thanks__close"><img src="/assets/icons/thanks-close.png"></div>
            <div class="m-thanks__body">
                <div class="m-thanks__title">Ваше сообщение отправлено</div>
                <div class="m-thanks__text">В ближайшее время мы Вам ответим. Спасибо, что обратились в компанию AGT
                    Systems.
                </div>
            </div>
        </div>
    </div>
</div>
</body>
