<?php

namespace App\Http\Controllers;

use App\Models\WorkingHours;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    $currentDate = new DateTime();

    $date = $currentDate->format('Y-m') . '-' . sprintf('%02d', 1);

    $workingHours = WorkingHours::getMonthlyReport($user->id, $currentDate);

    foreach ($workingHours as $key => $value) {
      $workingHour[$value->work_date] = $value;
    }

    $report = [];
    $workDay = 0;
    $sumWorkedTime = 0;
    $lastDay = getLastDayOfMonth($currentDate)->format('d');

    for ($day = 1; $day <= $lastDay; $day++) {
      $date = $currentDate->format('Y-m') . '-' . sprintf('%02d', $day);

      if (array_key_exists($date, $workingHour)) {
        $registry = $workingHour[$date];

        if (isPastWorkday($date)) $workDay++;

        if ($registry) {
          $sumWorkedTime += $registry->worked_time;

          if(!$registry->time1 && !isPastWorkday($registry->work_date)) {
            $registry->balance = null;
          } elseif($registry->worked_time == (60 * 60 * 8)) {
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
    $sign = ($sumWorkedTime >= $expectedTime) ? '+' : '-';
    $balanceFormated = "{$sign}{$balance}";

    return view('monthly-report', compact([
      'report' => 'report',
      'sumWorkedTime' => 'sumWorkedTime',
      'balance' => 'balanceFormated'
    ]));
  }
}
