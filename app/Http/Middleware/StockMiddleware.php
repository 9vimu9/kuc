<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class StockMiddleware
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
       if (!Auth::guest() && ( $request->user()->type == 1 || $request->user()->type == 0))
		{
		  return $next($request); 
            
		}
         return redirect('home');
    }
}
