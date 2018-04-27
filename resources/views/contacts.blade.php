@extends('layout.main-layout')

@section('content')
<div class="jumbotron dilivery__jumbotron">
  <h1>Здесь может располагаться баннер вашего клуба или бренда.</h1>
</div>
<div class="container">
  <div class="breadcrumbs">
    <div class="breadcrumbs__container">
      <a href="/">Главная</a>
      <span> / </span>
      <span>Контакты</span>
    </div>
  </div>
  <div class="contacts__container">
    <div class="contacts__title">
      Адрес:
    </div>
    <p>РФ, г. Санкт-Петербург,<br/> Лиговский проспект д. 108</p>
    <div class="contacts__title">
      Телефон:
    </div>
    <p>8(963)042 42 43</p>
    <div class="contacts__form-title">
      Форма для ваших вопросов и предложений
    </div>
    <p>Мы будем рады выслушать ваши предложения, пожелания по улучшению качества сервиса и работы магазина в целом, а так же ответить на любые интересующие вас вопросы. Не стесняйтесь, спрашивайте и предлагайте.</p>
    <form class="form contacts__form" action="" method="post">
      {{csrf_field()}}
      <div class="form__name">
        <div class="form__group">
          <label for="contacts_name">Имя:</label>
          <input type="text" name="contacts_name" placeholder="Введите имя" id="contacts_name" required>
        </div>
      </div>
      <div class="form__surname">
        <div class="form__group">
          <label for="contacts_phone">Телефон:</label>
          <input type="text" name="contacts_phone" placeholder="Укажите номер телефона" id="contacts_phone">
        </div>
      </div>
      <div class="form__email">
        <div class="form__group">
          <label for="contacts_email">E-mail:</label>
          <input type="email" name="contacts_email" placeholder="email" id="contacts_email">
        </div>
      </div>
      <div class="form__comments">
        <div class="form__group">
          <label for="contacts_comments">Комментарии:</label>
          <textarea name="comments" rows="5" id="contacts_comments" placeholder="Комментарии к заказу"></textarea>
        </div>
      </div>
      <input type="submit"  class="btn btn-success form__submit" value="Отправить вопрос">
    </form>
  </div>
</div>
<div class="map">
  <!-- <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A0cac7c91235866b9cc2f09e451d01cd21652e543455b0af9375485cbf1db3c04&amp;width=100%25&amp;height=400&amp;lang=ru_RU&amp;scroll=true"></script> -->
  <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3Aaae0446e592effcfb641e1ea03ce8b3157a2bf451ec5ff7e5bc8a0814e511dfe&amp;source=constructor" width="100%" height="400" frameborder="0"></iframe>
</div>
@endsection
