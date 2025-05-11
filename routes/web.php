<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardCutiController;
use App\Http\Controllers\DashboardFasilitasController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PeriodeCutiController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\MahasiswaCutiController;
use App\Http\Controllers\LegalisirController;
use App\Http\Controllers\GedungController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\PeminjamanRuanganController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

    Route::middleware('checkRole:admin,dosen')->group(function () {
        Route::resource('user', UserController::class);

        Route::post('role/{id}/toggle-status', [RoleController::class, 'toggleStatus'])->name('role.toggleStatus');
        Route::resource('role', RoleController::class);

        Route::post('prodi/{id}/toggle-status', [ProdiController::class, 'toggleStatus'])->name('prodi.toggleStatus');
        Route::resource('prodi', ProdiController::class);
    });

    Route::post('periode/{id}/toggle-status', [PeriodeCutiController::class, 'toggleStatus'])->name('periode.toggleStatus');
    Route::resource('periode', PeriodeCutiController::class);

    Route::get('/mahasiswa-cuti/dashboard', [DashboardCutiController::class, 'index'])->name('mahasiswa-cuti.dashboard');
    Route::get('mahasiswa-cuti/export', [MahasiswaCutiController::class, 'exportCsv'])->name('mahasiswa-cuti.export');
    Route::post('mahasiswa-cuti/import', [MahasiswaCutiController::class, 'importCsv'])->name('mahasiswa-cuti.import');
    Route::post('mahasiswa-cuti/import/confirm', [MahasiswaCutiController::class, 'importConfirm'])->name('mahasiswa-cuti.import.confirm');
    Route::resource('mahasiswa-cuti', MahasiswaCutiController::class);

    Route::get('legalisir/export', [LegalisirController::class, 'exportCsv'])->name('legalisir.export');
    Route::post('legalisir/import', [LegalisirController::class, 'importCsv'])->name('legalisir.import');
    Route::post('legalisir/import/confirm', [LegalisirController::class, 'importConfirm'])->name('legalisir.import.confirm');
    Route::resource('legalisir', LegalisirController::class);

    Route::post('gedung/{id}/toggle-status', [GedungController::class, 'toggleStatus'])->name('gedung.toggleStatus');
    Route::resource('gedung', GedungController::class);

    Route::post('kelas/{id}/toggle-status', [KelasController::class, 'toggleStatus'])->name('kelas.toggleStatus');
    Route::resource('kelas', KelasController::class);

    Route::resource('peminjaman-ruangan', PeminjamanRuanganController::class);

    Route::get('fasilitas/dashboard', [DashboardFasilitasController::class, 'index'])->name('fasilitas.dashboard');
});
