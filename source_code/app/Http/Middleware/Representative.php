<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class Representative
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
            if(!$user->isRepresentative()){

               return redirect('/representative/login');
           }
       }else{
        return redirect('/representative/login');
       }
       return $next($request);
  }
}
