<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\WorkingHours;
use DateInterval;

class DashboardController extends Controller
{
  public function dashboard()
  {
    if (Auth::check()) {
      $user = Auth::user();

      $workingHours = WorkingHours::getCurrentWorkingHours($user->id);
      
      return view('dashboard', compact('user', 'workingHours'));
    }

    return redirect('/login');
  }
}
