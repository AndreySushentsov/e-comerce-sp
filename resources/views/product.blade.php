@extends('layout.main-layout')

@section('content')
<div class="container">
  <div class="breadcrumbs">
    <div class="breadcrumbs__container">
      <a href="/">Главная</a>
      <span> / </span>
      <a href="/products">категории</a>
      <span> / </span>
      <span>{{$product->name}}</span>
    </div>
  </div>
  <div class="product__container">
    <div class="product__img-gallery">
      <div class="image-gallery">
        <div class="image-gallery__main-img">
          <div class="img-wrapper">
            <a href="#"><img id="gallery-img" class="active" src="{{asset('storage/'.$product->image)}}" alt="{{$product->name}}"></a>
          </div>
        </div>
        <div class="image-gallery__small-img">
          <div class="img-wrapper image-gallery__small-img-item">
            <a href="#"><img class="thumbnail-imgs" src="{{asset('storage/'.$product->image)}}" alt="{{$product->name}}"></a>
          </div>
          @foreach(json_decode($product->images, true) as $image)
            <div class="img-wrapper image-gallery__small-img-item">
              <a href="#"><img class="thumbnail-imgs" src="{{asset('storage/'.$image)}}" alt="{{$product->name}}"></a>
            </div>
          @endforeach
        </div>
      </div>
    </div>
    <div class="product__content">
      <div class="product__title">
        {{$product->name}}
      </div>
      <div class="product__descr">
        {{$product->details}}
      </div>
      <div class="product__price">
        {{$product->price}} p.
      </div>
      <p class="product__full-descr">
        {!!$product->description!!}
      </p>
      <form class="product__form" action="{{route('cart.store')}}" method="POST">
        {{csrf_field()}}
        <input type="hidden" name="id" value="{{$product->id}}">
        <input type="hidden" name="name" value="{{$product->name}}">
        <input type="hidden" name="price" value="{{$product->price}}">
        <button type="submit" name="button" class="btn">Добавить</button>
      </form>
    </div>
  </div>
</div>
<div class="same-view">
  <div class="container">
    <div class="same-view__title">
      Вмесет с этим товаром просматривают:
    </div>
    <div class="card-mini__container">
      @foreach ($sameView as $product)
          <div class="card-mini">
            <div class="card-mini__img-wrapper">
              <a href="{{route('product.show', $product->slug)}}"><img src="/img/bcaa_1.jpg" alt="bcaa"></a>
            </div>
            <div class="card-mini__content">
              <div class="card-mini__title">
                <a href="{{route('product.show', $product->slug)}}">{{$product->name}}</a>
              </div>
              <div class="card-mini__price">
                {{$product->price}} p.
              </div>
            </div>
          </div>
      @endforeach
    </div>
  </div>
</div>
@endsection

@section('extra-js')
<script type="text/javascript">
  (function() {
    const mainImg = document.querySelector('#gallery-img');
    const imgs = document.querySelectorAll('.thumbnail-imgs');

    function thumbnailClick(e) {
      // mainImg.src = this.src;

      mainImg.classList.remove('active');
      mainImg.addEventListener('transitionend', () => {
        mainImg.src = this.src;
        mainImg.classList.add('active');
      });

      imgs.forEach((el) => el.classList.remove('selected'));
      this.classList.add('selected');
    }

    imgs.forEach((el) => el.addEventListener('click', thumbnailClick));
  })();
</script>
@endsection
