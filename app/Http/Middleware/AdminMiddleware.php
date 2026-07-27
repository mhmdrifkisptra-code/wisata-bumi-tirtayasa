<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // belum login -> arahkan ke login
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // login tapi bukan admin -> 403
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Khusus admin.');
        }

        return $next($request);
    }
}
