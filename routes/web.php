<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', [DashboardController::class, 'index']);
Route::resource('role', RoleController::class);
Route::get('role/{id}/toggle-status', [RoleController::class, 'toggleStatus'])->name('role.toggleStatus');
