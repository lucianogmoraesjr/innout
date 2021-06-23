<?php

namespace App\Http\View\Composers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserComposer
{
  /**
   * Bind data to the view.
   *
   * @param  \Illuminate\View\View  $view
   * @return void
   */
  public function compose(View $view)
  {
    $user = Auth::user();

    $view->with('user', $user);
  }
}
