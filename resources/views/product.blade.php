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

  <div class="product__container" itemscope itemtype="http://schema.org/Product">
    <div class="product__img-gallery">
      <div class="image-gallery">
        <div class="image-gallery__main-img">
          <div class="img-wrapper">
            <a href="#" itemprop="image"><img id="gallery-img" class="active" src="{{asset('storage/'.$product->image)}}" alt="{{$product->name}}"></a>
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
      <h1 class="product__title" itemprop="name">
        {{$product->name}}
      </h1>
      <div class="product__descr">
        {{$product->details}}
      </div>
      <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
        <div class="product__price">
          {{$product->price}} p.
        </div>
        <meta itemprop="price" content={{$product->price}}>
        <meta itemprop="priceCurrency" content="RUB">
        <link itemprop="availability" href="http://schema.org/InStock">
      </div>
      <p class="product__full-descr" itemprop="description">
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
              <a href="{{route('product.show', $product->slug)}}"><img src="{{asset('storage/'.$product->image)}}" alt="{{$product->name}}"></a>
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
