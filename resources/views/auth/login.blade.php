@extends('layouts.app')

@section('content')
<div class="container py-2 py-lg-4">
    <div class="row">
        <div class="col-md-6 m-auto">
            <div class="card">
                <div class="card-header">Iniciar sesión</div>
                <div class="card-body">
                    <div class="text-center p-3">
                      <p class="text-center">Puedes registrarte o iniciar sesión con un sólo click usando: </p>
                      <div class="btn-group" role="group" aria-label="entrar con">
                        <a href="/login/facebook" class="btn btn-lg btn-primary"><i class="fa fa-facebook"></i> Facebook</a>
                        <a href="/login/google" class="btn btn-lg btn-danger"><i class="fa fa-google"></i> Google</a>
                      </div>
                    </div>
                    <p class="text-center">O con tu email y contraseña: </p>
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group row {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label for="staticEmail" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                              <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                              @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputPassword" class="col-sm-3 col-form-label">Contraseña</label>
                            <div class="col-sm-9">
                              <input id="password" type="password" class="form-control" name="password" required>
                            </div>
                          </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">Entrar</button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    ¿Olvidaste tu password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
