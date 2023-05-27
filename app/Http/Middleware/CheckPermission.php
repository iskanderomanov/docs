<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response|RedirectResponse) $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role): Response|RedirectResponse
    {
        if (!$request->user()->hasRole($role)) {
            // Если у пользователя нет требуемой роли, перенаправьте его на страницу с ошибкой доступа или выполните другие действия по вашему усмотрению.
            return redirect()->route('access.denied');
        }

        return $next($request);
    }

}
