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
      <form class="mb-4" action="#" method="GET">
        <div class="input-group">
          @if ($user->is_admin)
            <select name="user" class="form-control me-2" placeholder="Selecione o usuário...">
              @php
                foreach ($users as $user) {
                    $selected = $user->id == $selectedUser ? 'selected' : '';
                    echo "<option value='{$user->id}' {$selected}>{$user->name}</option>";
                }
              @endphp
            </select>
          @endif
          <input class="form-control" type="month" name="period" value={{$today == $selectedPeriod ? $today : $selectedPeriod}}>
          <button class="btn btn-primary ms-2">
            <i class="icofont-search"></i>
          </button>
        </div>
      </form>

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
              <td>{{ $workingHour->balance ?? '-' }}</td>
            </tr>
          @endforeach
          <tr class="bg-primary text-white">
            <td>Horas Trabalhadas</td>
            <td colspan="3">{{ $workedTime }}</td>
            <td>Saldo Mensal</td>
            <td>{{ $balanceFormated }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </main>

@endsection
