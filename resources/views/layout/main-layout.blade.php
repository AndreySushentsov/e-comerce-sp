<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- favicon -->
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link rel="icon" href="/favicon.ico" type="image/x-icon">

        <meta name="yandex-verification" content="6894cd7cf5fcb8ac" />
        <meta name="keywords" content="Спортывное питание, купить спортивное питание, купить спортивное питание с доставкой по России, купить гормон роста с доставкой по России, купить жиросжигатели с доставкой по России, гормон роста купить.">
        <meta name="description" content="В нашем интернет-магазине, Вы можете заказать спортивное питание с доставкой в любой регон России, по дострупным ценам.">
        <link href="{{asset('css/app.css')}}" rel="stylesheet">
        <title>Спортивное питание по низким ценам с доставкой по России.</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow" rel="stylesheet">
        <link href="{{asset('css/fontawesome-all.min.css')}}" rel="stylesheet">
        <!-- Styles -->
        @yield('extra-css')
    </head>
    <body>
      <!-- overlay menu -->
      @include('components.overlay-menu')
      <!-- end overlay menu -->

      <div id="app">
        <header>
          <a href="/" class="logo">SportPit-365</a>
          <nav class="navigation">
            <ul>
              <li>
                <a href="/products">Каталог товаров</a>
              </li>
              <!-- <li>
                <a href="#">Производители</a>
              </li> -->
              <li>
                <a href="/delivery">Оплата и доставка</a>
              </li>
              <li>
                <a href="/contacts">Контакты</a>
              </li>
            </ul>
          </nav>
          <div class="search__container">
            <form  action="{{route('search')}}" method="get">
              {{ csrf_field() }}
              <i class="fa fa-search"></i>
              <input type="text" name="query"  value="{{request()->input('query')}}" placeholder="Поиск">
            </form>
          </div>
          <div class="header__tel">
            <span>тел: </span>
            <a href="tel:89630424243" title="Контактный телефон"> 89630424243</a>
          </div>


          <div class="header__icons">
            <a href="/cart"><i class="fas fa-shopping-cart"></i></a>
            @guest
            <a href="/login"><i class="far fa-user"></i></a>
            @else
            <span class="user_name">
              {{ Auth::user()->name }}
            </span>
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
            @endguest

          </div>

          <!-- burger menu -->
          <a href="#" class="nav_burger" id="nav-burger">
            <div class="bar1"></div>
            <div class="bar2"></div>
            <div class="bar3"></div>
          </a>
          <!-- end burger menu -->

        </header>
        <main>
          @yield('content')
        </main>
        <footer class="footer">
          <div class="footer__navigation-container">
            <div class="footer__title">
              Меню
            </div>
            <nav class="footer__navigation">
              <ul>
                <li>
                  <a href="/products">Каталог товаров</a>
                </li>
                <!-- <li>
                  <a href="#">Производители</a>
                </li> -->
                <li>
                  <a href="/delivery">Оплата и доставка</a>
                </li>
                <li>
                  <a href="/contacts">Контакты</a>
                </li>
              </ul>
            </nav>
          </div>
          <div class="footrer__contacts-container">
            <div class="footer__title">
              Контакты
            </div>
            <div class="footer__contacts">
              <span>тел: </span>
              <a href="tel:89630424243" class="footer__tel" title="Контактный телефон"> 89630424243 </a>
              <div class="footer__adress">
                <span>г. Санкт-Петербург пр. Лиговский 108</span>
              </div>
              <div class="footer__title">
                Мы в социальных сетях:
              </div>
              <div class="socials">
                <a href="#"><i class="fab fa-vk"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-facebook-f"></i></a>
              </div>
            </div>
          </div>
        </footer>
      </div>

      <script src="{{asset('js/app.js')}}"></script>
      <script type="text/javascript">
        const burger = document.querySelector('#nav-burger');
        const overlayMenu = document.querySelector('#overlay-menu');
        burger.addEventListener('click', function() {
          if(overlayMenu.style.left == "-70%"){
            burger.classList.add('change');
            overlayMenu.style.left = "0";
          }else{
            burger.classList.remove('change');
            overlayMenu.style.left = "-70%";
          }
        });
      </script>

      @yield('extra-js')

      <!-- Yandex.Metrika counter -->
      <script type="text/javascript" >
          (function (d, w, c) {
              (w[c] = w[c] || []).push(function() {
                  try {
                      w.yaCounter48438506 = new Ya.Metrika({
                          id:48438506,
                          clickmap:true,
                          trackLinks:true,
                          accurateTrackBounce:true,
                          webvisor:true
                      });
                  } catch(e) { }
              });

              var n = d.getElementsByTagName("script")[0],
                  s = d.createElement("script"),
                  f = function () { n.parentNode.insertBefore(s, n); };
              s.type = "text/javascript";
              s.async = true;
              s.src = "https://mc.yandex.ru/metrika/watch.js";

              if (w.opera == "[object Opera]") {
                  d.addEventListener("DOMContentLoaded", f, false);
              } else { f(); }
          })(document, window, "yandex_metrika_callbacks");
      </script>
      <noscript><div><img src="https://mc.yandex.ru/watch/48438506" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
      <!-- /Yandex.Metrika counter -->

      <!-- Global site tag (gtag.js) - Google Analytics -->
      <script async src="https://www.googletagmanager.com/gtag/js?id=UA-117421366-1"></script>
      <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-117421366-1');
      </script>
    </body>
</html>
