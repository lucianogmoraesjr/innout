@extends('templates.master')

@section('content')
  <main class="content">
    <div class="content-title mb-4">
      <i class="icon icofont-users me-2"></i>
      <div>
        <h1>
          @if (isset($user))
            Editar Usuário
          @else
            Cadastro de Usuários
          @endif
        </h1>
        <h2>Crie e atualize o usuário</h2>
      </div>
    </div>

    @if (isset($user))
      <form action="{{ url("users/$user->id") }}" method="post">
      @method('PUT')
    @else
      <form action="{{ url("users") }}" method="post">
    @endif
      @csrf
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="name">Nome</label>
        <input 
          type="text" 
          id="name" 
          name="name" 
          class="form-control @error('name') is-invalid @enderror" 
          placeholder="Digite o nome do usuário"
          value="{{ isset($user->name) ? $user->name : old('name') }}"
        >
        @error('name')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
        @enderror
      </div>

      <div class="form-group col-md-6">
        <label for="email">Email</label>
        <input 
          type="email" 
          id="email " 
          name="email" 
          class="form-control @error('email') is-invalid @enderror" 
          placeholder="Digite o email"
          value="{{ isset($user->email) ? $user->email : old('email') }}"
        >
        @error('email')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
        @enderror
      </div>

      <div class="form-group col-md-6">
        <label for="password">Senha</label>
        <input 
          type="password" 
          id="password" 
          name="password"
          class="form-control @error('password') is-invalid @enderror" 
          placeholder="Digite a senha"
        >
        @error('password')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
        @enderror
      </div>

      <div class="form-group col-md-6">
        <label for="password_confirm">Confirme a senha</label>
        <input 
          type="password" 
          id="password_confirmation" 
          name="password_confirmation" 
          class="form-control @error('password_confirmation') is-invalid @enderror"
          placeholder="Confirme a senha"
        >
        @error('password_confirmation')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
        @enderror
      </div>

      <div class="form-group col-md-6">
        <label for="start_date">Data de Admissão</label>
        <input 
          type="date" 
          id="start_date " 
          name="start_date" 
          class="form-control @error('start_date') is-invalid @enderror"
          placeholder="Digite a data de admissão"
          value="{{ isset($user->start_date) ? $user->start_date : old('start_date') }}"
        >
        @error('start_date')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
        @enderror
      </div>

      <div class="form-group col-md-6">
        <label for="end_date">Data de Desligamento</label>
        <input 
          type="date" 
          id="end_date" 
          name="end_date" 
          class="form-control"
          placeholder="Digite a data de desligamento"
          value="{{ isset($user->end_date) ? $user->end_date : old('end_date') }}"
        >
      </div>
    </div>

    <div class="form-group col-md-6 ms-1">
      <input 
        type="checkbox" 
        id="is_admin" 
        name="is_admin" 
        class="form-check-input" 
        {{ isset($user->is_admin) ? 'checked' : '' }}>
      <label 
      for="is_admin" class="form-check-label ms-1">Administrador</label>
    </div>

    <button class="btn btn-lg btn-primary" type="submit">Salvar</button>
    <a href="/users" class="btn btn-lg btn-secondary">Cancelar</a>
    </form>
  </main>
@endsection
