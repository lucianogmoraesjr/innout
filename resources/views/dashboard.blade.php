@extends('templates.master')

@section('content')
  <main class="content">
    <div class="content-title mb-4">
      <i class="icon icofont-check-alt me-2"></i>
      <div>
        <h1>Registrar Ponto</h1>
        <h2>Mantenha seu ponto consistente!</h2>
      </div>
    </div>

    <div class="card">
      <div class="card-header">
        <h3>{{ strftime('%d de %B de %G') }}</h3>
        <p class="mb-0">Os batimentos efetuados hoje</p>
      </div>
      <div class="card-body">
        <div class="d-flex m-5 justify-content-around">
          <span class="record">Entrada 1: ---</span>
          <span class="record">Saída 1: ---</span>
        </div>
        <div class="d-flex m-5 justify-content-around">
          <span class="record">Entrada 2: ---</span>
          <span class="record">Saída 2: ---</span>
        </div>
      </div>
      <div class="card-footer d-flex justify-content-center">
        <a href="#" class="btn btn-success btn-lg">
          <i class="icofont-check me-1"></i>
          Registrar ponto
        </a>
      </div>
    </div>

  </main>

@endsection
