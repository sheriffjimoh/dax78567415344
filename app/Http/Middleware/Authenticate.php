<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {

         $date = date('Y-m-d');
      $datecheck = date('Y-m-d', strtotime('+10 day'));
     if ($date ==$datecheck || $date >  $datecheck ) {
      return redirect('/warning');
      
     }else{
        if (!$request->expectsJson()) {
            return route('login');
        }
    }
    }
}
