<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/icofont/icofont.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/login.css') }}">
    <title>In N' Out</title>
</head>

<body>

  <form class="form-login" action="/auth" method="post">
    @csrf
    <div class="login-card card">
      <div class="card-header d-flex justify-content-center align-items-center">
        <i class="icofont-travelling me-2"></i>
        <span class="fw-light">In</span>
        <span class="fw-bold mx-2">N'</span>
        <span class="fw-light">Out</span>
        <i class="icofont-runner-alt-1 ms-2"></i>
      </div>
      <div class="card-body">
        <div class="form-group">
          <label for="email">E-mail</label>
          <input type="email" id="email" name="email" class="form-control" placeholder="Digite seu e-mail" autofocus>
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

</html>
