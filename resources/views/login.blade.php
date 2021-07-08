<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="{{ asset('site/bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/icofont/icofont.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
  <title>PunchClock | Login</title>
</head>

<body>
  <form class="form-login" action="/auth" method="post">
    @csrf
    <div class="login-card card">
      <div class="card-header d-flex justify-content-center align-items-center">
        <img src="assets/punch-clock-dark.svg" alt="PunchClock">
      </div>
      <div class="card-body">
        @if ($errors->all())
          @foreach ($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
              {{ $error }}
            </div>
          @endforeach
        @endif

        <div class="form-group">
          <label for="email">E-mail</label>
          <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}"
            placeholder="Digite seu e-mail" autofocus>
        </div>
        <div class="form-group">
          <label for="password">Senha</label>
          <input type="password" id="password" name="password" class="form-control" placeholder="Digite sua senha">
        </div>
      </div>
      <div class="card-footer d-flex justify-content-end">
        <button class="btn btn-lg btn-primary">Entrar</button>
      </div>
    </div>
  </form>
</body>
<html>
