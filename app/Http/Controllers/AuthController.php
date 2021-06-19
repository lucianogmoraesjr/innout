<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
  public function auth(Request $request)
  {
    $credentials = $request->validate(
      [
        'email' => ['required', 'email'],
        'password' => ['required'],
      ],
      [
        'email.required' => "O campo e-mail é obrigatório.",
        'password.required' => "o campo senha é obrigatório."
      ]
    );

    if (Auth::attempt($credentials)) {
      $request->session()->regenerate();
      return redirect()->intended('dashboard');
    }

    return redirect()->back()->withInput()->withErrors("Usuário ou senha inválidos.");
  }

  public function login() {
    if (Auth::check()) {
      return redirect('/dashboard');
    }

    return view('login');
  }

  public function logout(Request $request)
  {
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
  }
}
