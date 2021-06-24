@extends('templates.master')

@section('content')

  <main class="content">
    <div class="content-title mb-4">
      <i class="icon icofont-users me-2"></i>
      <div>
        <h1>Cadastro de Usuários</h1>
        <h2>Mantenha os dados dos usuários atualizados</h2>
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

    <a href="/users/create" class="btn btn-lg btn-primary mb-3">Novo Usuário</a>

    <table class="table table-bordered table-striped table-hover">
      <thead>
        <th>Nome</th>
        <th>Email</th>
        <th>Data de Admissão</th>
        <th>Data de Desligamento</th>
        <th>Ações</th>
      </thead>
      <tbody>
        @foreach ($users as $user)
          <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->start_date }}</td>
            <td>{{ $user->end_date ?? '-' }}</td>
            <td>
              <a href="{{ url("/users/$user->id/edit") }}" class="btn btn-warning rounded-circle me-2">
                <i class="icofont-edit"></i>
              </a>
              <form action="{{ url("users/$user->id") }}" method="POST" class="d-inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger rounded-circle "
                  onclick="return confirm('Deseja realmente deletar?')">
                  <i class="icofont-trash"></i>
                </button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </main>

@endsection
