<?php

use App\Http\Controllers\Web\Hr\HrBaseController;
use App\Http\Controllers\Web\Hr\RoleController;
use App\Http\Controllers\Web\Auth\AuthController;
use App\Http\Controllers\Web\TimeKeeper\TimeKeeperBaseController;
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
    Route::get('/post', [AuthController::class, 'postLogin'])->name('auth.post_login');
});

/**
 * Маршрутизатор для отдел кадров
 */
Route::middleware(MiddlewareConstants::HR_MIDDLEWARE)->group(function () {
    Route::get('/hr', [HrBaseController::class])->name('admin');
});

/**
 * Маршрутизатор для табельщика
 */
Route::middleware(MiddlewareConstants::HR_MIDDLEWARE)->group(function () {
    Route::get('/time-keeper', [TimeKeeperBaseController::class])->name('admin');
});

/**
 * Маршрутизатор для бухгалтера
 */
Route::middleware(MiddlewareConstants::HR_MIDDLEWARE)->group(function () {
    Route::get('/accounting', [HrBaseController::class])->name('admin');
});
