<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkingHoursTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('working_hours', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id')
        ->nullable()
        ->constrained()
        ->onUpdate('cascade')
        ->onDelete('cascade');
      $table->date('work_date');
      $table->time('time1')->nullable();;
      $table->time('time2')->nullable();;
      $table->time('time3')->nullable();;
      $table->time('time4')->nullable();;
      $table->integer('worked_time')->nullable();
      $table->index(['user_id', 'work_date'], 'cons_user_day');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('working_hours');
  }
}
