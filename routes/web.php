<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataGenerator;
use App\Http\Controllers\ManagerReportController;
use App\Http\Controllers\MonthlyReportController;
use App\Http\Controllers\PunchClockController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
  return redirect('/dashboard');
});

Route::get('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/dashboard', [DashboardController::class, 'dashboard']);
Route::get('/monthly-report', MonthlyReportController::class);
Route::get('/punch', [PunchClockController::class, 'punchClock']);
Route::post('/punch', [PunchClockController::class, 'punchClock']);
Route::post('/auth', [AuthController::class, 'auth']);

Route::middleware(['admin'])->group(function () {
  Route::get('/manager-report', ManagerReportController::class);
  Route::resource('/users', UserController::class);    
});

