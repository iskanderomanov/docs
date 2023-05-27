<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class HrMiddleware
{
    /**
     * Прокси для админа
     *
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response|RedirectResponse) $next
     * @return JsonResponse
     */
    public function handle(Request $request, Closure $next): JsonResponse
    {
        if (Auth::check() && Auth::user()->isHr()) {
            return $next($request);
        }

        return response()->json(['error' => 'Доступ запрещен'], 403);
    }
}
