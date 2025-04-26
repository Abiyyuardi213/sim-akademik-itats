<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PeriodeCutiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', [DashboardController::class, 'index']);
Route::resource('role', RoleController::class);
Route::get('role/{id}/toggle-status', [RoleController::class, 'toggleStatus'])->name('role.toggleStatus');
Route::resource('pengguna', PenggunaController::class);
Route::resource('periode', PeriodeCutiController::class);
Route::get('periode/{id}/toggle-status', [PeriodeCutiController::class, 'toggleStatus'])->name('periode.toggleStatus');
