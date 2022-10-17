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

        if (Auth::user()->role == 1) {
            return redirect()->route('index');
        }

        if (Auth::user()->role == 2) {
            return redirect()->route('AdminController');
        }
    }
}
