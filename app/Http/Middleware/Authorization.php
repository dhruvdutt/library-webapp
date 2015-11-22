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
          Session::flash('flash_message','You are unauthorized to access this page');
          return redirect()->guest('/');
        }
        return $next($request);
    }
}
