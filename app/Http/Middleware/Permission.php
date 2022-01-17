<?php

namespace App\Http\Middleware;

use App\Traits\PermissionTrait;
use Closure;
use Illuminate\Support\Facades\Route;

//use Illuminate\Routing\Route;

class Permission
{
    use PermissionTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check()){
            if (auth()->user()->permission_version != session()->get('permission_version')){
                $this->getPermission(auth()->id());
            }
        }

        if (!hasPermission(Route::currentRouteName())){
            flash(__('permission denied'), 'danger');
            return redirect()->route('home');
        }
        return $next($request);
    }
}
