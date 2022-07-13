<?php

namespace App\Http\Middleware;

use Closure;

class isAdmin
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
        if (\Auth::user() &&  \Auth::user()->isAdmin == true) {
            return $next($request);
       }

          return response("hanya admin yang dpt mengakses");  
    //    return back()->with('error','Opps, You\'re not Admin');
    }
}
