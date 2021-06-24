@extends('templates.master')

@section('content')

  <main class="content">
    <div class="content-title mb-4">
      <i class="icon icofont-chart-histogram me-2"></i>
      <div>
        <h1>Relatório Gerencial</h1>
        <h2>Resumo das horas trabalhadas dos funcionários</h2>
      </div>
    </div>

    <div class="summary-boxes">
      <div class="summary-box bg-primary">
        <i class="icon icofont-users"></i>
        <p class="title">Qtde de funcionários</p>
        <h3 class="value">{{ $activeUsers }}</h3>
      </div>
      <div class="summary-box bg-danger">
        <i class="icon icofont-patient-bed"></i>
        <p class="title">Ausências</p>
        <h3 class="value">{{ count($absentUsers) }}</h3>
      </div>
      <div class="summary-box bg-success">
        <i class="icon icofont-sand-clock"></i>
        <p class="title">Horas trabalhadas</p>
        <h3 class="value">{{ $workedHoursInMonth }}h</h3>
      </div>
    </div>
    @if (count($absentUsers) > 0)
      <div class="card mt-4">
        <div class="card-header">
          <h4 class="card-title">Ausentes do dia</h4>
          <p class="card-category mb-0">Relação dos funcionários que estão ausentes</p>
        </div>
        <div class="card-body">
          <table class="table table-bordered table-striped table-hover">
            <thead>
              <th>Nome</th>
            </thead>
            <tbody>
              @foreach ($absentUsers as $absentUser)
                <tr>
                  <td>{{ $absentUser }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    @endif

  </main>

@endsection
