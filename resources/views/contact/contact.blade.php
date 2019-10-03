@extends('layout.layout')

@section('title','Контакты')

@section('content')
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
            <input name="agreement" type="checkbox" required><span>Отправляя форму, Вы принимаете<a class="feedback-modal__agreement" href="#">Положение об обработке  персональных данных</a></span>
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
                <div class="m-thanks__text">В ближайшее время мы Вам ответим. Спасибо, что обратились в компанию AGT Systems.</div>
            </div>
        </div>
    </div>
</div>
<main class="main">
    <div class="container-fluid no-gap">
        <div class="breadcrumbs-row">
            <div class="container">
                <div class="breadcrumbs"><span><a href="/">Главная</a></span><span><a href="/contact">Контакты</a></span>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="page-contacts__title">
            <h1>Контакты</h1>
        </div>
    </div>
    <div class="container-fluid no-gap">
        <div class="contacts__switcher">
            <div class="container">
                <div class="news__control">

                    <div class="news__iso-control">
                        @foreach($contacts as $id => $contact)
                            @if($id === 'general' || $contact['general'])
                        <a class="news__iso-button js-contacts-tab-switcher is-checked" href="/contact/indexView/{{$contact['id']}}">{{$contact['country']}}</a>
                            @else
                        <a class="news__iso-button js-contacts-tab-switcher" href="/contact/indexView/{{$contact['id']}}">{{$contact['country']}}</a>
                            @endif
                        @endforeach
                        <a class="news__iso-button js-contacts-tab-switcher" href="/contact/feedback">Написать нам</a></div>
                </div>
            </div>
        </div>
    </div>
    @foreach($contacts as $contact)
        @if($contact['general'])
    <div class="container-fluid no-gap">
        <div class="contacts__page">
            <div class="contacts__places">
                <div class="container">
                    <div class="contacts__content contacts--tab">
                        <div id="contacts__address--gmap"> {!! $contact['address'] !!}</div>
                        <div class="contacts__title">{{$contact['name']}}</div>
                        <div class="contacts__row contacts__phone">
                            <div class="contacts__icon"><img src="/assets/icons/c-phone.png"></div><a href="tel:{{$contact['telephone']}}">{{$contact['telephone']}}</a>
                        </div>
                        <div class="contacts__row contacts__email">
                            <div class="contacts__icon"><img src="/assets/icons/c-mail.png"></div><a href="mail:{{$contact['mail']}}">{{$contact['mail']}}</a>
                        </div>
                        <div class="contacts__row contacts__address">
                            <div class="contacts__icon"><img src="/assets/icons/c-marker.png"></div>
                            {!! $contact['address'] !!}
                        </div>
                        <div class="contacts__extra-text">
                            {!! $contact['how_to_go'] !!}
                        </div>
                    </div>
                </div>
                <div class="map">
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </div>
    <div id="gmap-key" data-key="{{$contact['api_key']}}"></div>
        @endif
        @endforeach
</main>
    @endsection