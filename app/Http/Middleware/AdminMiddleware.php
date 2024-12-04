<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
// Předpokládáme, že uživatel má roli 'admin', pokud to není pravda, přesměrujeme ho
        if (!Auth::check() || !Auth::user()->is_admin) {
// Můžete upravit, kam chcete uživatele přesměrovat
            return redirect('/');
        }

        return $next($request);
    }
}
