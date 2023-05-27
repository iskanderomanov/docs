<?php

use App\Http\Controllers\Web\Admin\AdminBaseController;
use App\Http\Controllers\Web\Admin\RoleController;
use App\Http\Controllers\Web\Auth\AuthController;
use App\Utils\MiddlewareConstants;
use App\Utils\RouteConstants;
use Illuminate\Support\Facades\Route;

/**
 * Маршрутизатор для аутентификации
 */
Route::group([
    RouteConstants::ROUTE_PREFIX => RouteConstants::ROUTE_PREFIX_AUTH
], function () {
    Route::get('/login', [AuthController::class, 'getLoginPage'])->name('auth.get_login');
});

/**
 * Маршрутизатор для админа
 */
Route::middleware(MiddlewareConstants::ADMIN_MIDDLEWARE)->group(function () {
    /**
     * Маршрутизатор для ролей
     */
    Route::group([RouteConstants::ROUTE_PREFIX => RouteConstants::ROUTE_PREFIX_ROLES], function () {
        Route::get('/', [RoleController::class, 'index'])->name('');
        Route::get('/create', [RoleController::class, 'create'])->name('');
    });

    Route::get('/admin', [AdminBaseController::class])->name('');
});

