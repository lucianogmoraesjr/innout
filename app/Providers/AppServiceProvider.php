<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Http\View\Composers\WorkingHoursComposer;
use App\Http\View\Composers\UserComposer;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    //
  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    setlocale(LC_ALL, 'pt_BR.utf-8');

    View::composer(
      ['templates.sidebar'],
      WorkingHoursComposer::class
    );

    View::composer(
      ['templates.header'],
      UserComposer::class
    );
  }
}
