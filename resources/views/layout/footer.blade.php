<footer class="footer">
    <div class="container">
        <div class="footer__grid">
            <div class="footer__grid-item">
                <div class="footer-gi__title">Компания:</div>
                <div class="footer-gi__content">
                    <a class="footer-gi" href="/about">О компании</a>
                    <a class="footer-gi" href="/news">Новости</a>
                    <a class="footer-gi" href="#">Справочники и инструкции</a>
                    <a class="footer-gi" href="/manufacturer">Производители</a>
                </div>
            </div>
            <div class="footer__grid-item">
                <div class="footer-gi__title">Каталог:</div>
                <div class="footer-gi__content footer-gi__content--two-columns">
                    @foreach($catalogParents as $catalogParent)
                        @if(!$catalogParent['parent_id'])
                    <a class="footer-gi" href="/catalog/category/{{$catalogParent['id']}}">{{$catalogParent['display_name']}}</a>
                        @endif
                        @endforeach
                </div>
            </div>
            <div class="footer__grid-item">
                <div class="footer-gi__title">Контакты:</div>
                <div class="footer__contacts"><a class="footer-contacts__phone"
                                                 href="tel:{{setting('site.telephone')}}">{{setting('site.telephone')}}</a><a
                            class="footer-contacts__mail"
                            href="mailto:{{setting('site.company_mail')}}">{{setting('site.company_mail')}}</a>
                    <div class="footer-contacts__address">{!! setting('site.company_address') !!}
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="footer__cred">
            <div class="footer__copy">© AGT 2010–{{(new DateTime())->format('Y')}}. Все права защищены</div>
            <div class="footer__conf"><a href="/agreement">Политика конфиденциальности</a></div>
        </div>
    </div>
</footer>
<script type="text/javascript" src="/js/build.js"></script></body>
