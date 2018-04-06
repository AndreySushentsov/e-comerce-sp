@extends('layout.main-layout')

@section('content')
<div class="container">
  <div class="breadcrumbs">
    <div class="breadcrumbs__container">
      <a href="/">Главная</a>
      <span> / </span>
      <span>поиск</span>
    </div>
  </div>
  <div class="products__container">
    <div class="products__content">
<!--
      @if(session()->has('success_message'))
        <div class="alert alert-success">
          {{session()->get('success_message')}}
        </div>
      @endif
      @if(count($errors) > 0)
        <div class="alert alert-danges">
          <ul>
            @foreach($errors->all() as $error)
              <li>{{$error}}</li>
            @endforeach
          </ul>
        </div>
      @endif -->
      <div class="products__title-section">
        <h1 class="products__title">Результат поиска:</h1>
      </div>
      <span>По запросу "{{request()->input('query')}}" найдено: {{$products->count()}} товаров.</span>
      <div style="margin-top:20px;">
        <table class="table">
          <thead>
              <tr>
                  <th>Название:</th>
                  <!-- <th>Описание:</th> -->
                  <th>Цена:</th>
              </tr>
          </thead>
          <tbody>
                  @foreach ($products as $product)
                      <tr>
                          <th><a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a></th>
                          <!-- <td>{!! str_limit($product->description, 50) !!}</td> -->
                          <td>{{ $product->price }}</td>
                      </tr>
                  @endforeach
              </tbody>
        </table>
        {{ $products->appends(request()->input())->links()}}
      </div>
    </div>
  </div>
</div>
@endsection
