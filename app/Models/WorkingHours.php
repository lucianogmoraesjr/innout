<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

  public static function getWorkingHours($userId)
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
}
