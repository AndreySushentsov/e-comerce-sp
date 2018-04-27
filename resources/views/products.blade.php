@extends('layout.main-layout')

@section('title')
 Каталог товаров
@endsection

@section('content')
<div class="container">
  <div class="breadcrumbs">
    <div class="breadcrumbs__container">
      <a href="/">Главная</a>
      <span> / </span>
      <span>категории</span>
    </div>
  </div>
  <div class="products__container">
    <div class="products__sidebar">
      <div class="products__menu-title">Категории товаров</div>
      <ul class="products__menu-list">
        @foreach($categories as $category)
          <li class="products__menu-item {{ request()->category == $category->slug ? 'active' : '' }}">
            <a href="{{route('product.product', ['category' => $category->slug])}}">{{$category->name}}</a>
          </li>
        @endforeach
      </ul>
    </div>
    <div class="products__content">
      <div class="products__title-section">
        <h1 class="products__title">{{$categoryName}}</h1>
        <div class="products__sort-filter">
          <a href="{{route('product.product', ['category' => request()->category, 'sort' => 'low_high'])}}">по возрастанию </a>
          <span> | </span>
          <a href="{{route('product.product', ['category' => request()->category, 'sort' => 'high_low'])}}"> по убыванию</a>
        </div>
      </div>

      <div class="products__cards-container">
        @foreach($products as $product)
          <!-- <div class="pr-card">
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
          </div> -->
          @include('components.pr-card')
        @endforeach
      </div>


      <!-- @forelse ($products as $product)
        <div class="pr-card">
          <div class="pr-card__img-wrapper">
            <a href="{{route('product.show', $product->slug)}}"><img src="{{asset('storage/'.$product->image)}}" alt="{{$product->name}}"></a>
          </div>
          <div class="pr-card__title">
            <a href="{{route('product.show', $product->slug)}}">{{$product->name}}</a>
          </div>
          <div class="pr-card__descr">
            <span>{{$product->details}}</span>
          </div>
          <div class="pr-card__price">
            <span>{{$product->price}} p.</span>
          </div>
          <div class="pr-card__button">
            <a href="#"> В корзину </a>
          </div>
        </div>
      @empty
        <div>
          <strong>В данной категории нет товаров.</strong>
        </div>
      @endforelse -->
      <div class="pagination">
        {{ $products->appends(request()->input())->links() }}
      </div>
    </div>
  </div>
</div>
@endsection
