<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
  use HasFactory, Notifiable;

  protected $table = 'users';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name',
    'password',
    'email',
    'start_date',
    'end_date',
    'is_admin',
  ];

  protected $hidden = [
    'password'
  ];

  protected $casts = [
    'is_admin' => 'boolean'
  ];

  public static function getActiveUsersCount() {
    return User::whereNull('end_date')->count();
  }

  public function relWorkingHours() {
    return $this-> hasMany('App\Models\WorkingHours', 'id_user');
}
}
