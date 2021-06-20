<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\WorkingHours;

class DashboardController extends Controller
{
  public function dashboard()
  {
    if (Auth::check()) {
      $user = Auth::user();
      $workingHours = WorkingHours::where('user_id', $user->id)->where('work_date', date('Y-m-d'))->get()->all();

      foreach($workingHours as $workingHour) {
        $workingHours = $workingHour;
      }

      
      if(!$workingHours) {
        $workingHours = new WorkingHours([
          'user_id' => $user->id,
          'work_date' => date('Y-m-d'),
          'worked_time' => 0
        ]);
      }

      return view('dashboard', compact('user', 'workingHours'));
    }

    return redirect('/login');
  }
}
