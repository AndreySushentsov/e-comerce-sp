<div class="overlay-menu__container" id="overlay-menu">
  <div class="overlay-menu__search">
    <form  action="{{route('search')}}" method="get">
      {{ csrf_field() }}
      <i class="fa fa-search"></i>
      <input type="text" name="query" id="query" value="{{request()->input('query')}}" placeholder="Поиск">
    </form>
  </div>
  <nav class="overlay-menu__navigation">
    <ul>
      <li>
        <a href="/products">Каталог товров</a>
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
@section('extra-js')

@endsection
