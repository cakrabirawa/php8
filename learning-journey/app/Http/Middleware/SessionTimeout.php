<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SessionTimeout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $timeout = 15 * 60; // 15 menit

        if (session('last_activity') && (time() - session('last_activity')) > $timeout) {
            auth()->logout();
            session()->flush();
            return redirect('/login')->with('message', 'Session expired!');
        }

        session(['last_activity' => time()]);

        return $next($request);
    }
}
