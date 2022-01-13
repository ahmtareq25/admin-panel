<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;

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
        config()->set('session.cookie', Str::slug(config('app.name')).'_admin_session');

        return $next($request);
    }
}
