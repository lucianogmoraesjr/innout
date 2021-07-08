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

    $workingHours = WorkingHours::getCurrentWorkingHours($user->id);

    $timeColumn = $workingHours->getNextTime();

    if (!$timeColumn) {
      return redirect()->back()->withErrors("Você já realizou os 4 batimentos do dia.");
    }

    $punch = [$timeColumn => strftime('%H:%M:%S', time())];

    $workingHours->worked_time = getSecondsFromDateInterval($workingHours->getWorkedInterval());

    $columns = array_merge($workingHours->toArray(), $punch);

    if ($workingHours->id) {
      $workingHours->update($columns);

      return redirect('/dashboard')->with('status', 'Ponto registrado com sucesso.');
    } else {
      WorkingHours::create($columns);

      return redirect('/dashboard')->with('status', 'Ponto registrado com sucesso.');
    }
  }
}
