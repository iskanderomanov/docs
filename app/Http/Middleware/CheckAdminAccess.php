<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdminAccess
{
    public function handle($request, Closure $next, $role)
    {
        if (!$request->user()->hasRole($role)) {
            // Если у пользователя нет требуемой роли, перенаправьте его на страницу с ошибкой доступа или выполните другие действия по вашему усмотрению.
            return redirect()->route('access.denied');
        }

        return $next($request);
    }
}

