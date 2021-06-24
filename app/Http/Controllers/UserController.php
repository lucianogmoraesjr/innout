<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $users = User::all();

    foreach ($users as $user) {
      $user->start_date = (new DateTime($user->start_date))->format('d/m/Y');
      if ($user->end_date) {
        $user->end_date = (new DateTime($user->end_date))->format('d/m/Y');
      }
    }

    return view('users', compact('users'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('create-user');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $request->is_admin = $request->is_admin ? 1 : 0;

    $request->validate([
      'name' => ['required'],
      'email' => ['required', 'email'],
      'password' => ['required', 'confirmed'],
      'password_confirmation' => ['required'],
      'start_date' => ['required']
    ],
    [
      'name.required' => "O campo nome é obrigatório",
      'email.required' => "O campo e-mail é obrigatório.",
      'password.required' => "O campo senha é obrigatório.",
      'password.confirmed' => "Senhas não coincidem",
      'password_confirmation.required' => "O campo confirmação de senha é obrigatório",
      'password_confirmation.confirmed' => "Senhas não coincidem",
      'start_date.required' => "O campo data de admissão é obrigatório",
    ]);

    $store = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password),
      'start_date' => $request->start_date,
      'end_date' => $request->end_date,
      'is_admin' => $request->is_admin
    ]);

    if (!$store) {
      return redirect('/users')->withErrors("Erro ao cadastrar o usuário.");
    }

    return redirect('/users')->with('status', 'Usuário cadastrado com sucesso.');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $user = User::find($id);

    return view('create-user', compact('user'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $request->is_admin = $request->is_admin ? 1 : 0;

    $request->validate([
      'name' => ['required'],
      'email' => ['required', 'email'],
      'password' => ['required', 'confirmed'],
      'password_confirmation' => ['required'],
      'start_date' => ['required']
    ],
    [
      'name.required' => "O campo nome é obrigatório",
      'email.required' => "O campo e-mail é obrigatório.",
      'password.required' => "O campo senha é obrigatório.",
      'password.confirmed' => "Senhas não coincidem",
      'password_confirmation.required' => "O campo confirmação de senha é obrigatório",
      'password_confirmation.confirmed' => "Senhas não coincidem",
      'start_date.required' => "O campo data de admissão é obrigatório",
    ]);

    $update = User::where(['id' => $id])->update([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password),
      'start_date' => $request->start_date,
      'end_date' => $request->end_date,
      'is_admin' => $request->is_admin
    ]);

    if (!$update) {
      return redirect('/users')->withErrors("Erro ao atualizar o usuário.");
    }

    return redirect('/users')->with('status', 'Usuário atualizado com sucesso.');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $delete = User::find($id)->delete();

    if (!$delete) {
      return redirect('/users')->withErrors("Erro ao deletar o usuário.");
    }

    return redirect('/users')->with('status', 'Usuário deletado com sucesso.');
  }
}
