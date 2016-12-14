<?php

namespace App\Http\Middleware;

use App\Constant;
use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        if (Auth::guest()) {
            return redirect('/');
        } else if (Auth::user()->role == Constant::user_admin) {
            return $next($request);
        }

        return redirect('/');
    }
}
