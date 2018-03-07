<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class checkAbilities
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$ability)
    {
        if(!(Auth::User()->can($ability))){
            return redirect('/');
        }

        return $next($request);
    }
}
