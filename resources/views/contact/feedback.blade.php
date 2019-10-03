@extends('layout.layout')

@section('title','Обратная связь')

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
                <div class="breadcrumbs"><span><a href="/">Главная</a></span>
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
                        @foreach($contacts as $contact)
                        <a class="news__iso-button js-contacts-tab-switcher" href="/contact/indexView/{{$contact['id']}}">{{$contact['country']}}</a>
                        @endforeach
                        <a class="news__iso-button js-contacts-tab-switcher is-checked" href="/contact/feedback">Написать нам</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="feedback">
        <div class="container">
            <p>С помощью этой формы вы можете написать нам письмо: задать вопрос по интересующей вас теме или конкретному прибору, узнать про особенности юридического и бухгалтерского оформления сотрудничества, запросить консультацию по продукции.Все поля обязательны для заполнения.</p>
            <form class="feedback-form" action="feedback/add">
                <input name="company" type="text" placeholder="Компания">
                <input name="contact" type="text" placeholder="Контактное лицо">
                <input name="email" type="email" placeholder="Ваш E-mail">
                <textarea name="message" rows="6" placeholder="Текст сообщения"></textarea>
                <label class="feedback__checkbox">
                    <input name="agreement" type="checkbox" required><span>Отправляя форму, Вы принимаете<a class="feedback__agreement" target="_blank" href="/agreement">Положение об обработке  персональных данных</a></span>
                </label>
                <input class="feedback__submit feedback__submit--mobile btn btn-fill" type="submit" value="Отправить">
                <input class="feedback__submit feedback__submit--desktop btn btn-empty" type="submit" value="Отправить">
            </form>
        </div>
    </div>
    <div id="gmap-key" data-key=""></div>
</main>
    @endsection