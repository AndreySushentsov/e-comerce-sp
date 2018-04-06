@extends('layout.main-layout')

@section('content')
<div class="container">
  <form class="form login__form" method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}
    <div class="login__title">Вход в личный кабинет.</div>
    <div class="form__group">
      <input id="email" type="email" class="form-control" placeholder="введите ваш e-mail" name="email" value="{{ old('email') }}" required autofocus>
      @if ($errors->has('email'))
        <span class="help-block">
          <strong>{{ $errors->first('email') }}</strong>
        </span>
      @endif
    </div>

    <div class="form__group">
      <input id="password" type="password" class="form-control" placeholder="введите пароль" name="password" required>
      @if ($errors->has('password'))
        <span class="help-block">
          <strong>{{ $errors->first('password') }}</strong>
        </span>
      @endif
    </div>
    <div class="form__group">
      <label>
        <input type="checkbox" class="form__checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Запоминть меня
      </label>
      <a class="" href="{{ route('password.request') }}">Забыли пароль?</a>
      <a class="form__register-link" href="/register">Зарегистрироваться.</a>
    </div>
    <button type="submit" class="btn btn-success">Вход</button>
  </form>
</div>

@endsection
