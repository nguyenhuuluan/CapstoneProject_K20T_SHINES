<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class Student
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
      if(Auth::check()){
            $user = Auth::user();
            if(!$user->isStudent()){
              Auth::logout();
               return redirect('/login');
           }
       }else{
        return redirect('/login');
       }
       return $next($request);
  }
}
