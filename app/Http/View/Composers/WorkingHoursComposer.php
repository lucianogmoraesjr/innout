<?php

namespace App\Http\View\Composers;

use App\Models\WorkingHours;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class WorkingHoursComposer
{
  /**
   * Bind data to the view.
   *
   * @param  \Illuminate\View\View  $view
   * @return void
   */
  public function compose(View $view)
  {
    $user = Auth::user();
    $workingHours = WorkingHours::getCurrentWorkingHours($user->id);
    $workedInterval = $workingHours->getWorkedInterval()->format('%H:%I:%S');
    $leaveTime = $workingHours->getLeaveTime()->format('H:i:s');
    $activeClock = $workingHours->getActiveClock();

    $view->with([
      'workedInterval' => $workedInterval,
      'leaveTime' => $leaveTime,
      'activeClock' => $activeClock
    ]);
  }
}
