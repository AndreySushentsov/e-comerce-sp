<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{asset('css/app.css')}}" rel="stylesheet">
        <title>e-comerce</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
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
          <a href="/" class="logo">SportPit</a>
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
            <form class="" action="{{route('search')}}" value="{{request()->input('query')}}" method="get">
              <i class="fa fa-search"></i>
              <input type="text" name="query" id="query" value="" placeholder="Поиск">
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
          <a herf="#" class="nav_burger" id="nav-burger">
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
      </script>
      @yield('extra-js')
    </body>
</html>
