<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardCutiController;
use App\Http\Controllers\DashboardFasilitasController;
use App\Http\Controllers\DashboardGuestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PeriodeCutiController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\MahasiswaCutiController;
use App\Http\Controllers\LegalisirController;
use App\Http\Controllers\GedungController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\PeminjamanRuanganController;
use App\Http\Controllers\PengajuanPeminjamanController;
use App\Http\Controllers\PengumumanController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// Route::get('/', function () {
//     return redirect()->route('login');
// });

Route::get('/', function () {
    return redirect()->route('home');
});

Route::middleware('guest')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/about', [HomeController::class, 'about'])->name('about');
});

Route::middleware('guest:admin')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'adminLogin'])->name('login.admin');
});

Route::middleware('guest:users')->group(function () {
    Route::get('login-guest', [AuthController::class, 'showLoginGuestForm'])->name('login.guest');
    Route::post('login-guest', [AuthController::class, 'guestLogin'])->name('login.guest.post');
});

Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::name('admin.')->middleware(['auth:admin'])->group(function () {
    Route::get('/dashboard-admin', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware('ensure.admin:admin')->group(function () {
        Route::resource('user', UserController::class);
        Route::post('role/{id}/toggle-status', [RoleController::class, 'toggleStatus'])->name('role.toggleStatus');
        Route::resource('role', RoleController::class);
        Route::post('prodi/{id}/toggle-status', [ProdiController::class, 'toggleStatus'])->name('prodi.toggleStatus');
        Route::resource('prodi', ProdiController::class);
    });

    Route::middleware('ensure.admin:admin,CSR')->group(function () {
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

        Route::resource('pengumuman', PengumumanController::class);
    });

    Route::get('profile', [UserController::class, 'editProfile'])->name('profile.edit');
    Route::put('profile', [UserController::class, 'updateProfile'])->name('profile.update');
});

Route::name('admin.')->middleware('ensure.admin:admin,CSR')->group(function () {
    Route::get('pengajuan-ruangan', [PengajuanPeminjamanController::class, 'indexAdmin'])
        ->name('pengajuan-ruangan.index');
    Route::get('pengajuan-ruangan/{id}', [PengajuanPeminjamanController::class, 'showAdmin'])
        ->name('pengajuan-ruangan.show');

    Route::post('pengajuan-ruangan/{id}/approve', [PengajuanPeminjamanController::class, 'approve'])
        ->name('pengajuan-ruangan.approve');
    Route::post('pengajuan-ruangan/{id}/reject', [PengajuanPeminjamanController::class, 'reject'])
        ->name('pengajuan-ruangan.reject');
});

Route::name('users.')->middleware(['auth:users', 'users'])->group(function () {
    Route::get('/dashboard-user', [DashboardGuestController::class, 'index'])->name('dashboard');

    Route::prefix('pengajuan')->name('pengajuan.')->group(function () {
        Route::get('/', [PengajuanPeminjamanController::class, 'index'])->name('index');
        // ubah: create menerima parameter kelas
        Route::get('/create/{kelas}', [PengajuanPeminjamanController::class, 'create'])->name('create');
        Route::post('/', [PengajuanPeminjamanController::class, 'store'])->name('store');
        Route::get('/riwayat', [PengajuanPeminjamanController::class, 'riwayat'])->name('riwayat');
        Route::get('/status', [PengajuanPeminjamanController::class, 'status'])->name('status');
        Route::get('/{id}', [PengajuanPeminjamanController::class, 'show'])->name('show');
    });
});

Route::middleware(['auth:users'])->group(function () {
    Route::get('/notifications/{id}/go', function ($id, Request $request) {
        $notification = $request->user()->notifications()->findOrFail($id);
        $notification->markAsRead();
        return redirect($notification->data['url']);
    })->name('notifications.go');

    Route::post('/notifications/{id}/read', function ($id, Request $request) {
        $notification = $request->user()->notifications()->findOrFail($id);
        $notification->markAsRead();
        return back();
    })->name('notifications.read');

    Route::post('/notifications/read-all', function (Request $request) {
        $request->user()->unreadNotifications->markAsRead();
        return back();
    })->name('notifications.readAll');
});
