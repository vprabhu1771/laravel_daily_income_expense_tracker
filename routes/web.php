<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\ReportController;

Route::get('/report/today', [ReportController::class, 'generateTodayReport'])->name('report.today');
Route::get('/report/today/download', [ReportController::class, 'downloadTodayReport'])->name('report.today.download');
