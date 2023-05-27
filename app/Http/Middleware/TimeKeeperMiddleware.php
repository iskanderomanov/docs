<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimeKeeperMiddleware
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if (Auth::check() && Auth::user()->isTimeKeeper()) {
            return $next($request);
        }

        return response()->json(['error' => 'Доступ запрещен'], 403);
    }
}
