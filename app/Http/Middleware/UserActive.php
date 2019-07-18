<?php

namespace App\Http\Middleware;

use Closure;
use Cache;
use Carbon\Carbon;

class UserActive
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
        // print_r(session()->get('id'));
        // die();

        if (session()->get('id') >= 1) {
            // print_r(session()->get('id'));
            // die();
            $expiresAt = Carbon::now()->addMinutes(10);
            Cache::put('user-is-online-'.session()->get('id'), session()->get('id'), $expiresAt);
            // die("after store");
        }
        return $next($request);
    }
}
