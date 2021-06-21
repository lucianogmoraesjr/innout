<?php

namespace App\Models;

use DateInterval;
use DateTime;
use DateTimeImmutable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;

class WorkingHours extends Model
{
  use HasFactory;

  protected $table = 'working_hours';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'user_id',
    'work_date',
    'time1',
    'time2',
    'time3',
    'time4',
    'worked_time'
  ];

  public $timestamps = false;

  public static function getCurrentWorkingHours($userId)
  {
    $workingHours = WorkingHours::where('user_id', $userId)->where('work_date', date('Y-m-d'))->get()->all();

    foreach ($workingHours as $workingHour) {
      $workingHours = $workingHour;
    }

    if (!$workingHours) {
      $workingHours = new WorkingHours([
        'user_id' => $userId,
        'work_date' => date('Y-m-d'),
        'worked_time' => 0
      ]);
    }

    return $workingHours;
  }

  private function getTimes()
  {
    $times = [];

    $this->time1 ? array_push($times, getDateFromString($this->time1)) : array_push($times, null);
    $this->time2 ? array_push($times, getDateFromString($this->time2)) : array_push($times, null);
    $this->time3 ? array_push($times, getDateFromString($this->time3)) : array_push($times, null);
    $this->time4 ? array_push($times, getDateFromString($this->time4)) : array_push($times, null);

    return $times;
  }

  public function getNextTime()
  {
    if (!$this->time1) return 'time1';
    if (!$this->time2) return 'time2';
    if (!$this->time3) return 'time3';
    if (!$this->time4) return 'time4';
    return null;
  }

  public function getActiveClock()
  {
    $nextTime = $this->getNextTime();

    if ($nextTime === 'time1' || $nextTime === 'time3') {
      return 'leaveTime';
    } elseif ($nextTime === 'time2' || $nextTime === 'time4') {
      return 'workedHours';
    } else {
      return null;
    }
  }

  public function getWorkedInterval()
  {
    [$time1, $time2, $time3, $time4] = $this->getTimes();

    $anteMeridiem = new DateInterval('PT0S');
    $postMeridiem = new DateInterval('PT0S');

    if ($time1) $anteMeridiem = $time1->diff(new DateTime());
    if ($time2) $anteMeridiem = $time1->diff($time2);
    if ($time3) $postMeridiem = $time3->diff(new DateTime());
    if ($time4) $postMeridiem = $time3->diff($time4);

    return sumInterval($anteMeridiem, $postMeridiem);
  }

  public function getLunchInterval()
  {
    [, $time2, $time3,] = $this->getTimes();
    $lunchInterval = new DateInterval('PT0S');

    if ($time2) $lunchInterval = $time2->diff(new DateTime());
    if ($time3) $lunchInterval = $time2->diff($time3);

    return $lunchInterval;
  }

  public function getLeaveTime()
  {
    [$time1,,, $time4] = $this->getTimes();
    $workday = DateInterval::createFromDateString('8 hours');

    if (!$time1) {
      return (new DateTimeImmutable())->add($workday);
    } elseif ($time4) {
      return $time4;
    } else {
      $leaveHour = sumInterval($workday, $this->getLunchInterval());
      return $time1->add($leaveHour);
    }
  }
}
