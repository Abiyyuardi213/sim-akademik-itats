<?php

use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('role', RoleController::class);
Route::get('role/{id}/toggle-status', [RoleController::class, 'toggleStatus'])->name('role.toggleStatus');
