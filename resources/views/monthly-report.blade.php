@extends('templates.master')

@section('content')

  <main class="content">
    <div class="content-title mb-4">
      <i class="icon icofont-ui-calendar me-2"></i>
      <div>
        <h1>Relatório Mensal</h1>
        <h2>Acompanhe seu saldo de horas</h2>
      </div>
    </div>

    <div>
      <table class="table table-bordered table-striped table-hover">
        <thead>
          <th>Dia</th>
          <th>Entrada 1</th>
          <th>Saída 1</th>
          <th>Entrada 2</th>
          <th>Saída 2</th>
          <th>Saldo</th>
        </thead>
        <tbody>
          @foreach ($report as $workingHour)
            <tr>
              <td>{{ formatDateWithLocale($workingHour->work_date, '%A, %d de %B de %Y') }}</td>
              <td>{{ $workingHour->time1 ?? '-' }}</td>
              <td>{{ $workingHour->time2 ?? '-' }}</td>
              <td>{{ $workingHour->time3 ?? '-' }}</td>
              <td>{{ $workingHour->time4 ?? '-' }}</td>
              <td>{{ $workingHour->balance ?? '-'}}</td>
            </tr>
          @endforeach
          <tr class="bg-primary text-white">
            <td>Horas Trabalhadas</td>
            <td colspan="3">{{ $sumWorkedTime }}</td>
            <td>Saldo Mensal</td>
            <td>{{ $balanceFormated }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </main>

@endsection
