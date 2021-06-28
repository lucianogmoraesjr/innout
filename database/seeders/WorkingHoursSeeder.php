<?php

namespace Database\Seeders;

use App\Models\WorkingHours;
use DateTime;
use Illuminate\Database\Seeder;

class WorkingHoursSeeder extends Seeder
{

  public function getWorkedDayByOdds($regularRate, $extraRate, $lazyRate)
  {
    $regularDay = [
      'time1' => '08:00:00',
      'time2' => '12:00:00',
      'time3' => '13:00:00',
      'time4' => '17:00:00',
      'worked_time' => 60 * 60 * 8,
    ];

    $extraHourDay = [
      'time1' => '08:00:00',
      'time2' => '12:00:00',
      'time3' => '13:00:00',
      'time4' => '18:00:00',
      'worked_time' => (60 * 60 * 8) + 3600,
    ];

    $lazyDay = [
      'time1' => '08:30:00',
      'time2' => '12:00:00',
      'time3' => '13:00:00',
      'time4' => '17:00:00',
      'worked_time' => (60 * 60 * 8) - 1800,
    ];

    $value = rand(0, 100);
    if ($value <= $regularRate) {
      return $regularDay;
    } elseif ($value <= $regularRate + $extraRate) {
      return $extraHourDay;
    } else {
      return $lazyDay;
    }
  }

  public function workingHoursGenerate($userId, $initialDate, $regularRate, $extraRate, $lazyRate)
  {
    $currentDate = $initialDate;
    $previousDay = new DateTime();
    $previousDay->modify('-1 day');
    $collumns = ['user_id' => $userId, 'work_date' => $currentDate];

    while (isBefore($currentDate, $previousDay)) {
      if (!isWeekend($currentDate)) {
        $workedDays = $this->getWorkedDayByOdds($regularRate, $extraRate, $lazyRate);
        $collumns = array_merge($collumns, $workedDays);
        WorkingHours::create($collumns);
      }
      $currentDate = getNextDay($currentDate)->format('Y-m-d');
      $collumns['work_date'] = $currentDate;
    }
  }
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $lastMonth = strtotime('first day of last month');
    
    $this->workingHoursGenerate(1, date('Y-m-1'), 70, 20, 10);
    $this->workingHoursGenerate(3, date('Y-m-d', $lastMonth), 70, 20, 10);
    $this->workingHoursGenerate(4, date('Y-m-d', $lastMonth), 70, 20, 10);
  }
}