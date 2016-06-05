<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;

class Authorization
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
        if(Auth::user()->type != 'admin')
        {
          Session::flash('flash_message','You are unauthorized to access that page');
          return redirect()->guest('/home');
        }
        return $next($request);
    }
}
