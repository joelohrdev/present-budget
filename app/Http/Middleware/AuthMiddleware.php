<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

final class AuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (! session('authenticated')) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
