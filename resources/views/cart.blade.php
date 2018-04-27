@extends('layout.main-layout')

@section('title')
 Корзина товаров
@endsection

@section('content')
<div class="container cart__container">
  <div class="breadcrumbs">
    <a href="/">Главная</a>
    <span> / </span>
    <a href="/products">каталог</a>
    <span> / </span>
    <span>корзина</span>
  </div>
  @if(Cart::count() > 0)

    <div class="cart__title">
      @if(Cart::count() == 1)
        {{Cart::count()}} Товар в корзине:
      @elseif(Cart::count() <= 4)
        {{Cart::count()}} Товара в корзине:
      @else
        {{Cart::count()}} Товаров в корзине:
      @endif
    </div>

    @foreach(Cart::content() as $item)
    <div class="cart__item">
      <div class="cart__img-wrapper">
        <a href="{{route('product.show', $item->model->slug)}}"><img src="{{asset('storage/'.$item->model->image)}}" alt="{{$item->model->name}}"></a>
      </div>
      <div class="cart__item-title">
        <a href="{{route('product.show', $item->model->slug)}}">{{$item->model->name}}</a>
      </div>
      <div class="remote-save">
        <form class="form" action="{{route('cart.destroy', $item->rowId)}}" method="post">
          {{csrf_field()}}
          {{method_field('DELETE')}}
          <button type="submit" name="button">Удалить</button>
        </form>

        <!-- TODO: сделать возможность сохранять товары в корзине,
            сейчас при сохранении несокльикх товаров все ломается и если
            добавлять товар обратно в корзину если там уже есть товар, то все
            снова ламается
        -->
        <!-- <form class="form" action="{{route('cart.saveforlater', $item->rowId)}}" method="post">
          {{csrf_field()}}
          <button type="submit" name="button">Сохранить</button>
        </form> -->



      </div>
      <div class="cart__item-input">
        <select  name="" class="cart__item-select" data-id="{{$item->rowId}}">
          @for($i = 1; $i < 5 + 1; $i++)
            <option {{ $item->qty == $i ? "selected" : ""}}>{{$i}}</option>
          @endfor
        </select>
      </div>
      <div class="cart__item-price">
        {{$item->model->price}}
      </div>
    </div>
    @endforeach

  @else
  <p>Корзина пуста.</p>
  @endif

  <div class="price-block">
    <p class="price-block__text">
      Вы можете указать интересующее вас количество или удалить его из корзины.
    </p>
    <div class="price-block__pirces">
      <div class="subtotal">
        <span>Сумма заказа: </span>
        <span>{{Cart::subtotal()}} p.</span>
      </div>
      <!-- <div class="discount">
        <span>Скидка: </span>
        <span> p.</span>
      </div> -->
      <div class="total-price">
        <span>Итог: </span>
        <span> {{Cart::total()}} p.</span>
      </div>
    </div>
  </div>

  <div class="price-block__buttons">
    <a href="{{route('checkout.index')}}" class="btn btn-success">Оформить заказ</a>
    <a href="{{route('product.product')}}" class="btn">Продолжить покупки.</a>
  </div>

  <div class="card-mini__container save-for-later__container">
    @if(Cart::instance('saveForLater')->count() > 0)
      <span>Сохраненные товары:</span>
      @foreach(Cart::instance('saveForLater')->content() as $item)
        <div class="card-mini">
          <div class="card-mini__img-wrapper">
            <a href="#"><img src="/img/bcaa_1.jpg" alt="bcaa"></a>
          </div>
          <div class="remote-save">
            <form class="form" action="{{route('saveForLater.destroy', $item->rowId)}}" method="post">
              {{csrf_field()}}
              {{method_field('DELETE')}}
              <button type="submit" name="button">Удалить</button>
            </form>
            <form class="form" action="{{route('saveForLater.saveforlater', $item->rowId)}}" method="post">
              {{csrf_field()}}
              <button type="submit" name="button">в корзину</button>
            </form>
          </div>
          <div class="card-mini__content">
            <div class="card-mini__title">
              <a href="#">{{$item->model->name}}</a>
            </div>
            <div class="card-mini__price">
              {{$item->model->price}}
            </div>
          </div>
        </div>
      @endforeach
    @else
      <span>Нет сохраненных товаров <i style="font-size: 0.8rem; color:#333;">(функция "сохранения товаров" в разарботке)</i></span>
    @endif
  </div>
</div>
@endsection
@section('extra-js')
<script type="text/javascript">
  (function(){
    const className = document.querySelectorAll('.cart__item-select');

    Array.from(className).forEach(function(elem) {
      elem.addEventListener('change', function() {
        const id = elem.getAttribute('data-id');

        axios.patch(`/cart/${id}`, {
          quantity: this.value
        })
        .then(function (response) {
          console.log(response);
          window.location.href = '{{route('cart.index')}}'
        })
        .catch(function (error) {
          console.log(error);
        });
      });
    });
  })();
</script>
@endsection
