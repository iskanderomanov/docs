<?php

use App\Http\Controllers\Web\Accounting\AccountingController;
use App\Http\Controllers\Web\HR\HRController;
use App\Http\Controllers\Web\ReportCard\ReportCardController;
use Illuminate\Support\Facades\Route;


// Маршрут для "Табельщика"
Route::middleware('check.admin.access:Tabel')->group(function () {
    Route::get('/tabel', [ReportCardController::class, 'index'])->name('admin.tabel');
});

// Маршрут для "Отдела кадров"
Route::middleware('check.admin.access:HR')->group(function () {
    Route::get('/hr', [HRController::class, 'index'])->name('admin.hr');
});

// Маршрут для "Бухгалтерии"
Route::middleware('check.admin.access:Accounting')->group(function () {
    Route::get('/accounting', [AccountingController::class, 'index'])->name('admin.accounting');
});

