<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Role as Middleware;
use Closure;
use Auth;

class Role extends Middleware
{
    public function handle($request, Closure $next, $roles)
    {
        if (!Auth::check())
            return redirect('login');

        $user = Auth::user();

        if ($user->isAdmin())
            return $next($request);

        foreach ($roles as $role) {
            if ($user->hasRole($role))
                return $next($request);
        }

        return redirect('login');
    }
}
