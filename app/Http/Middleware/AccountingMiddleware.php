<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountingMiddleware
{

    /**
     * @param Request $request
     * @param Closure $next
     * @return JsonResponse|mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if (Auth::check() && Auth::user()->isAccounting()) {
            return $next($request);
        }

        return response()->json(['error' => 'Доступ запрещен'], 403);
    }
}
