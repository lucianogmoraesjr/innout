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
    @if ($errors->all())
      @foreach ($errors->all() as $error)
        <div id="alert" class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ $error }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endforeach
    @endif

    @if (session('status'))
      <div id="alert" class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('status') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif

    <div class="card">
      <div class="card-header">
        <h3>{{ strftime('%d de %B de %G') }}</h3>
        <p class="mb-0">Os batimentos efetuados hoje</p>
      </div>
      <div class="card-body">
        <div class="d-flex m-5 justify-content-around">
          <span class="record">Entrada 1: {{ $workingHours->time1 ?? '--:--:--' }}</span>
          <span class="record">Saída 1: {{ $workingHours->time2 ?? '--:--:--' }}</span>
        </div>
        <div class="d-flex m-5 justify-content-around">
          <span class="record">Entrada 2: {{ $workingHours->time3 ?? '--:--:--' }}</span>
          <span class="record">Saída 2: {{ $workingHours->time4 ?? '--:--:--' }}</span>
        </div>
      </div>
      <div class="card-footer d-flex justify-content-center">
        <a href="/punch" class="btn btn-lg">
          <i class="icofont-check me-1"></i>
          Registrar ponto
        </a>
      </div>
    </div>

    <form class="mt-5" action="/punch" method="post">
      @csrf
      <div class="input-group no-border">
        <input name="simulatePunch" type="text" class="form-control" placeholder="Digite o horário para simular o batimento">
        <button class="btn btn-danger ms-3">
          Simular ponto
        </button>
      </div>
    </form>

  </main>

@endsection
