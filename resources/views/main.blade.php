@extends('layout.main-layout')

@section('content')
<div class="jumbotron">
  <h1>Спортивное питание по самым низким ценам.</h1>
</div>
@include('components.advantages')
<section class="latest">
  <div class="section__title">
    Популярные товары.
  </div>
  @foreach ($products as $product)
    <!-- <div class="pr-card">
      <div class="pr-card__img-wrapper">
        <a href="{{route('product.show', $product->slug)}}"><img src="{{asset('storage/'.$product->image)}}" alt="{{$product->name}}"></a>
      </div>
      <div class="pr-card__title">
        <a href="{{route('product.show', $product->slug)}}">{{$product->name}}</a>
      </div>
      <div class="pr-card__descr">
        <span>{{$product->ditails}}</span>
      </div>
      <div class="pr-card__price">
        <span>{{$product->price}} p.</span>
      </div>
    </div> -->
    @include('components.pr-card')
  @endforeach
</section>
<section class="news-sales">
  <div class="container news-sales__container">
    <a href="#">
      <!-- <img src="{{asset('img/slide_6.jpeg')}}" alt=""> -->
      <!-- <span>Наши акции</span> -->
      Наши новости
    </a>
    <a href="#">Наши акции</a>
  </div>
</section>
@endsection
