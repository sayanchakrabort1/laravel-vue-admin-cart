<?php

namespace App\Http\Middleware;

use Closure;
use App\Basic;

class CheckUser
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
        if (session()->get('id') == '') {
            return redirect()->route('login');
        }
        return $next($request);
    }
}
