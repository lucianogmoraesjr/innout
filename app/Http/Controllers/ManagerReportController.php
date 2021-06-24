<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\WorkingHours;
use DateTime;
use Illuminate\Http\Request;

class ManagerReportController extends Controller
{
  /**
   * Handle the incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function __invoke(Request $request)
  {
    $yearAndMonth = (new DateTime())->format('Y-m');

    $absentUsers = WorkingHours::getAbsentUsers();

    $activeUsers = User::getActiveUsersCount();

    $workedTimeInMonthInSeconds = WorkingHours::getWorkedTimeInMonth($yearAndMonth);

    $workedHoursInMonth = explode(':', getTimeStringFromSeconds($workedTimeInMonthInSeconds))[0];

    return view('manager-report', compact([
      'absentUsers',
      'activeUsers',
      'workedHoursInMonth'
    ]));
  }
}
