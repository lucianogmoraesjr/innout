<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\WorkingHours;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use stdClass;

class MonthlyReportController extends Controller
{
  /**
   * Handle the incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function __invoke(Request $request)
  {
    if (!Auth::check()) {
      return redirect('/login');
    }

    $user = Auth::user();
    $users = null;
    $selectedUser = $user->id;

    $currentDate = new DateTime();

    if ($user->is_admin) {
      $usersAll = DB::table('users')->get()->toArray();
      foreach ($usersAll as $key => $value) {
        $users[] = $value;
      }

      $selectedUser = isset($_GET['user']) ? $_GET['user'] : $user->id;
    }

    $selectedPeriod = isset($_GET['period']) ? $_GET['period'] : $currentDate->format('Y-m');

    $date = $currentDate->format('Y-m') . '-' . sprintf('%02d', 1);

    $today = $currentDate->format('Y-m');

    $workingHours = WorkingHours::getMonthlyReport($selectedUser, $selectedPeriod);

    if (!$workingHours) {
      $workingHour = [];
    }

    foreach ($workingHours as $key => $value) {
      $workingHour[$value->work_date] = $value;
    }

    $report = [];
    $workDay = 0;
    $sumWorkedTime = 0;
    $lastDay = getLastDayOfMonth($selectedPeriod)->format('d');

    for ($day = 1; $day <= $lastDay; $day++) {
      $date = $selectedPeriod . '-' . sprintf('%02d', $day);

      if (array_key_exists($date, $workingHour)) {
        $registry = $workingHour[$date];

        if (isPastWorkday($date)) $workDay++;

        if ($registry) {
          $sumWorkedTime += $registry->worked_time;

          if (!$registry->time1 && !isPastWorkday($registry->work_date)) {
            $registry->balance = null;
          } elseif ($registry->worked_time == (60 * 60 * 8)) {
            $registry->balance = '-';
          } else {
            $balance = $registry->worked_time - (60 * 60 * 8);
            $balanceString = getTimeStringFromSeconds(abs($balance));
            $sign = $registry->worked_time >= (60 * 60 * 8) ? '+' : '-';
            $registry->balance = "{$sign}{$balanceString}";
          }

          array_push($report, $registry);
        } else {
          array_push($report, new WorkingHours([
            'work_date' => $date,
            'worked_time' => 0,
          ]));
        }
      } else {
        $registry = (object)['work_date' => $date, 'worked_time' => 0];
        array_push($report, $registry);
      }
    }

    $expectedTime = $workDay * (60 * 60 * 8);
    $balance = getTimeStringFromSeconds(abs($sumWorkedTime - $expectedTime));
    $workedTime = getTimeStringFromSeconds($sumWorkedTime);
    $sign = ($sumWorkedTime >= $expectedTime) ? '+' : '-';
    $balanceFormated = "{$sign}{$balance}";

    return view('monthly-report', compact([
      'report',
      'workedTime',
      'balanceFormated',
      'selectedPeriod',
      'users',
      'selectedUser',
      'user',
      'today'
    ]));
  }
}
