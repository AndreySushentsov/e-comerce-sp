@extends('layout.main-layout')

@section('content')
<div class="container">
                <form class="form login__form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                        <div class="login__title">Зарегистрироваться</div>
                        <div class="form__group">
                            <label for="name" class="col-md-4 control-label">Ваше имя:</label>
                            <input id="name" type="text" class="" name="name" value="{{ old('name') }}" required autofocus>
                            @if ($errors->has('name'))
                              <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                              </span>
                            @endif
                        </div>

                        <div class="form__group">
                          <label for="email" class="">Ваш E-Mail:</label>
                          <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                          @if ($errors->has('email'))
                            <span class="help-block">
                              <strong>{{ $errors->first('email') }}</strong>
                            </span>
                          @endif
                        </div>
                        <div class="form__group">
                            <label for="password" class="">Пароль</label>
                            <input id="password" type="password" class="form-control" name="password" required>
                            @if ($errors->has('password'))
                              <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                              </span>
                            @endif
                        </div>
                        <div class="form__group">
                            <label for="password-confirm" class="">Еще разок</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                        <button type="submit" class="btn btn-success">Зарегистрироваться</button>
                    </form>

</div>
@endsection
