<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DashboardController extends Controller
{
  public function dashboard()
  {
    if (Auth::check()) {
      $user = Auth::user();
      return view('dashboard', compact('user'));
    }

    return redirect('/login');
  }
}
