<?php

namespace App\Http\Controllers;

use App\Models\WorkingHours;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PunchClockController extends Controller
{
  public function punchClock()
  {
    $user = Auth::user();

    $workingHours = WorkingHours::getWorkingHours($user->id);

    if (!$workingHours->time1) {
      $timeColumn = 'time1';
    } elseif (!$workingHours->time2) {
      $timeColumn = 'time2';
    } elseif (!$workingHours->time3) {
      $timeColumn = 'time3';
    } elseif (!$workingHours->time4) {
      $timeColumn = 'time4';
    } else {
      $timeColumn = null;
    }

    if (!$timeColumn) {
      return redirect()->back()->withErrors("Você já realizou os 4 batimentos do dia.");
    }

    $punch = [$timeColumn => strftime('%H:%M:%S', time())];

    if (isset($_POST['simulatePunch'])) {
      $punch = [$timeColumn => $_POST['simulatePunch']];
    }

    $columns = array_merge($workingHours->toArray(), $punch);

    if ($workingHours->id) {
      WorkingHours::where('id', $workingHours->id)->update($columns);

      return redirect('/dashboard')->with('status', 'Ponto registrado com sucesso.');
    } else {
      WorkingHours::create($columns);

      return redirect('/dashboard')->with('status', 'Ponto registrado com sucesso.');
    }
  }
}
