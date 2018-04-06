<div class="pr-card">
  <div class="pr-card__img-wrapper">
    <a href="{{route('product.show', $product->slug)}}"><img src="{{asset('storage/'.$product->image)}}" alt="{{$product->name}}"></a>
  </div>
  <div class="pr-card__title">
    <span>{{$product->name}}</span>
  </div>
  <div class="pr-card__descr">
    <span>{{$product->details}}</span>
  </div>
  <div class="pr-card__price">
    <span>{{$product->price}} p.</span>
  </div>
  <div class="pr-card__button">
    <a href="{{route('product.show', $product->slug)}}" class="btn btn-success">В корзину</a>
  </div>
</div>
