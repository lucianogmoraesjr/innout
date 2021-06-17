<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DashboardController extends Controller
{
    public function dashboard() {
      if (Auth::check()){
        return view('dashboard');
      }

      return redirect('/login');
    }

    public function index() {
      return view('dashboard');
    }
}
